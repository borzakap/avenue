<?php


namespace App\Controllers\Api;

use App\Controllers\Api\BaseController;
use AmoCRM\Filters\LeadsFilter;
use AmoCRM\Models\LeadModel;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Exceptions\AmoCRMApiException;
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
        print_r($response->getBody());
    }


    // finde unprossesed
    private function getUnprossesLeadsId(){
        $filter = new LeadsFilter();
        $filter->setCustomFieldsValues([412215 => '']);
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
            return $notes->getByParentId($id);
        } catch (AmoCRMApiException $e) {
            die(PHP_EOL . $e->getErrorCode());
        }
    }
    
    
//    private function searchContact(){
//        try{
//            return $this->apiClient->contacts()->get()
//        } catch (Exception $ex) {
//
//        }
//    }
    
    
    //put your code here
}
