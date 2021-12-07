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
        print_r($return);
        print_r($unprosessed);
        $notes = $this->getNotesBylead($unprosessed->getId());
        $leadContacts = $unprosessed->getContacts();
        foreach ($leadContacts as $contact){
            $contact = $this->apiClient->contacts()->getOne($contact->getId());
            print_r($contact);
        }
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
