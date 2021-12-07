<?php


namespace App\Controllers\Api;

use App\Controllers\Api\BaseController;
use AmoCRM\Filters\LeadsFilter;
use AmoCRM\Models\LeadModel;
use AmoCRM\Helpers\EntityTypesInterface;
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
                $return['contacts'][$k]['name'] = $contact->getName();
                $fields_c = $c->getCustomFieldsValues();
                if(!empty($fields_c)){
                    $return['contacts'][$k]['phones'] = $fields_c->getBy('fieldCode', 'PHONE');
                }
                print_r($c);
            }
        }

        print_r($return);
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
