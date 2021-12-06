<?php


namespace App\Controllers\Api;

use App\Controllers\Api\BaseController;
use AmoCRM\Filters\LeadsFilter;
use AmoCRM\Models\LeadModel;

/**
 * Description of AmoTransfer
 *
 * @author alexey
 */
class AmoTransfer extends BaseController{
    
    public function find(){
        $unprosessed = $this->getUnprossesLeadsId();
        print_r($unprosessed);
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

//    private function searchContact(){
//        try{
//            return $this->apiClient->contacts()->get()
//        } catch (Exception $ex) {
//
//        }
//    }
    
    
    //put your code here
}
