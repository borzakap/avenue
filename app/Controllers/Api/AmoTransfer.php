<?php


namespace App\Controllers\Api;

use App\Controllers\Api\BaseController;
use AmoCRM\Filters\LeadsFilter;
use AmoCRM\Models\LeadModel;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\CheckboxCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\CheckboxCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\CheckboxCustomFieldValueModel;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Filters\NotesFilter;
use AmoCRM\Models\Factories\NoteFactory;
/**
 * Description of AmoTransfer
 *
 * @author alexey
 */
class AmoTransfer extends BaseController{
    
    public function find(){
        
        $return = [];
        
        $unprosessed = $this->getUnprossesLeadsId();
        $return['name'] = $unprosessed->getName();
        $return['price'] = $unprosessed->getPrice();
        $return['responsible'] = $unprosessed->getResponsibleUserId();
        $return['created_at'] = $unprosessed->getCreatedAt();
        $return['status'] = $unprosessed->getStatusId();
        $lead_custom_f = $unprosessed->getCustomFieldsValues();
        if(!empty($lead_custom_f)){
            // rooms
            $rooms = $lead_custom_f->getBy('fieldId', 580767);
            if($rooms){
                $return['custom_fields']['rooms'] = $rooms->getValues();
            }
            // status
            $status = $lead_custom_f->getBy('fieldId', 580771);
            if($status){
                $return['custom_fields']['status'] = $status->getValues();
            }
            // condition
            $condition = $lead_custom_f->getBy('fieldId', 580773);
            if($condition){
                $return['custom_fields']['condition'] = $condition->getValues();
            }
        }
        $notes = $this->getNotesBylead($unprosessed->getId());
        if(!empty($notes)){
            foreach($notes as $k => $note){
                $return['notes'][$k]['text'] = $note->getText();
//                print_r($note);
                $return['notes'][$k]['created_at'] = $note->createdAt;
            }
        }
        $leadContacts = $unprosessed->getContacts();
        if (!empty($leadContacts)) {
            foreach ($leadContacts as $k => $contact) {
                $c = $this->apiClient->contacts()->getOne($contact->getId());
                $return['contacts'][$k]['name'] = $c->getName();
                $return['contacts'][$k]['created_at'] = $c->getCreatedAt();
                $fields_c = $c->getCustomFieldsValues();
                if(!empty($fields_c)){
                    $phones = $fields_c->getBy('fieldCode', 'PHONE');
                    if(!empty($phones)){
                        foreach($phones->getValues() as $k => $ph){
                            $return['contacts'][$k]['phones'][$k] = $ph->getValue();
                        }
                    }
                    $emails = $fields_c->getBy('fieldCode', 'EMAIL');
                    if(!empty($emails)){
                        foreach($emails->getValues() as $k => $em){
                            $return['contacts'][$k]['emails'][$k] = $em->getValue();
                        }
                    }
                }
            }
        }
        $tasksFilter = new \AmoCRM\Filters\TasksFilter();
        $tasksFilter->setEntityIds($unprosessed->getId());
//        $tasksFilter->setIsCompleted(false);
        $tasksFilter->setEntityType(2);
        try{
            $task_collection = $this->apiClient->tasks()->get($tasksFilter);
        } catch (AmoCRMApiException $ex) {
            if($ex->getCode() == 204){
                $task_collection = [];
            }
        }
        if(!empty($task_collection)){
            foreach($task_collection as $k => $task){
                $return['tasks'][$k]['created_at'] = $task->getCreatedAt(); 
                $return['tasks'][$k]['text'] = $task->getText(); 
                $return['tasks'][$k]['complete_till'] = $task->getCompleteTill(); 
                $return['tasks'][$k]['completed'] = $task->getIsCompleted(); 
                $return['tasks'][$k]['relsult'] = $task->getResult(); 
            }
//            $return['tasks'] = $task_collection;
        }

        // sending to rmanager
        $client = \Config\Services::curlrequest();
        $response = $client->request('POST', 'https://r-manager.com.ua/api/transfer', ['form_params' => $return]);
        if($response){
            $this->setLeadProssesed($unprosessed->getId());
        }
        print_r($response->getBody());
    }


    // finde unprossesed
    private function getUnprossesLeadsId(){
        $filter = new LeadsFilter();
        $filter->setCustomFieldsValues([591677 => false]);
        try {
            $lead = $this->apiClient->leads()->get($filter, [LeadModel::CONTACTS])->first();
        } catch (AmoCRMApiException $e) {
            die(PHP_EOL . $e->getErrorCode());
        }
        return $lead;
    }

    // find notes
    private function getNotesBylead(int $id){
        try{
            $notes = $this->apiClient->notes(EntityTypesInterface::LEADS);
            return $notes->getByParentId($id, (new NotesFilter())->setNoteTypes([NoteFactory::NOTE_TYPE_CODE_COMMON]));
        } catch (AmoCRMApiException $e) {
            die(PHP_EOL . $e->getErrorCode());
        }
    }
    
    
    private function setLeadProssesed(int $entityIds){
        try {
            $lead = $this->apiClient->leads()->getOne($entityIds);
        } catch (AmoCRMApiException $e) {
            die(PHP_EOL . $e->getErrorCode());
        }
        
        $customFields = $lead->getCustomFieldsValues();
        if(empty($customFields)){
            $customFields = new CustomFieldsValuesCollection();
        }
        
        foreach($customFields as $customField){
            $vals = $customField->getValues();
            foreach ($vals as $value){
                // the length must be < 255
                $val = $value->getValue();
                if(strlen($val) > 255){
                    $val = substr($val, 0, 255);
                    $value->setValue($val);
                }
//                print_r($value->getValue());
            }
        }
        

        $prossesed_field = $customFields->getBy('fieldId', 591677);
        if(empty($prossesed_field)){
            $prossesed_field = (new CheckboxCustomFieldValuesModel())->setFieldId(591677);
            $customFields->add($prossesed_field);
        }
        
        $prossesed_field->setValues(
        (new CheckboxCustomFieldValueCollection())
            ->add(
                (new CheckboxCustomFieldValueModel())
                    ->setValue(true)
            )
        );
        
        $lead->setCustomFieldsValues($customFields);

        $active_amo_users = [2267560, 2780884, 2843521, 2963260, 3481210];
        if(!in_array($lead->getCreatedBy(), $active_amo_users)){
            $lead->setCreatedBy(0);
        }
        if(!in_array($lead->getUpdatedBy(), $active_amo_users)){
            $lead->setUpdatedBy(0);
        }
        
        try{
            $this->apiClient->leads()->updateOne($lead);
        } catch (AmoCRMApiException $e){
            print_r($e->getLastRequestInfo());
            die(PHP_EOL . 'Updated lead prossesed N ' . $entityIds . ' ' . $e->getErrorCode() . ' ' . $e->getMessage());
        }
    }
    
    
    //put your code here
}
