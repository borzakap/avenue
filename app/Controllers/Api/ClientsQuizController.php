<?php

namespace App\Controllers\Api;

use App\Controllers\Api\BaseController;

/**
 * Description of ClientsQuizController
 *
 * @author alexey
 */
class ClientsQuizController extends BaseController{
    
    public function send(){

        if ($this->request->getMethod() != 'post') {
            return $this->fail('not a post', 400);
        }

        $this->prepareData();

        $this->sendUnsorted();

        $this->writeLog();
        
        // Respond with 201 status code
        return $this->respond(['status' => 'ok']);
        
    }

    public function prepareData() :void{
        $this->amoService->setUnsortedUid(Uuid::uuid4());
        $this->amoService->setFormId('AvenueIdilika');
        $this->amoService->setFormName(lang('Amo.Titles.FormNameFromQuiz'));
        $this->amoService->setLeadName(lang('Amo.Titles.FormNameFromQuiz'));
        $this->amoService->setContactEmail($this->request->getJsonVar('contacts.email'));
        $this->amoService->setContactPhone($this->request->getJsonVar('contacts.phone'));
        $this->amoService->setContactName($this->request->getJsonVar('contacts.name'));
        $this->amoService->setFormUrl($this->request->getJsonVar('extra.href'));
        $this->amoService->setLeadUtmSource($this->request->getJsonVar('extra.utm.source'));
        $this->amoService->setLeadUtmMedium($this->request->getJsonVar('extra.utm.medium'));
        $this->amoService->setLeadUtmCampaign($this->request->getJsonVar('extra.utm.campaign'));
        $this->amoService->setLeadUtmContent($this->request->getJsonVar('extra.utm.content'));
        $this->amoService->setLeadUtmTerm($this->request->getJsonVar('extra.utm.term'));
        $this->amoService->setLeadGacid($this->request->getJsonVar('extra.cookies._ga'));
//        $this->amoService->setLeadTypeLead('SiteForm');
        $message = '';
        foreach($this->request->getJsonVar('answers', true) as $ans){
            $message .= 'q: ' . $ans['q'] . PHP_EOL;
            $message .= 'a: ' . $ans['a'] . PHP_EOL;
        }
        $this->amoService->setLeadMessage($message);

    }

    /**
     * write data to log table
     * @return bool
     */
    private function writeLog(): bool{
        $model = model(ClientsRequestsModel::class);
        $data = [
            'name' => $this->amoService->getContactName(),
            'phone' => $this->amoService->getContactPhone(),
            'email' => $this->amoService->getContactEmail(),
            'text' => $this->amoService->getLeadMessage(),
            'page' => $this->amoService->getFormUrl(),
            'form' => 'quiz',
            'utm_source' => $this->amoService->getLeadUtmSource(),
            'utm_medium' => $this->amoService->getLeadUtmMedium(),
            'utm_campaign' => $this->amoService->getLeadUtmCampaign(),
            'utm_term' => $this->amoService->getLeadUtmTerm(),
            'utm_content' => $this->amoService->getLeadUtmContent(),
            'language' => $this->request->getLocale(),
            'code' => '',
            'status' => $model::STATUS_NEW,
        ];
        return $model->save($data);
    }

    //put your code here
}
