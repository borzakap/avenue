<?php

namespace App\Controllers\Api;

use App\Controllers\Api\BaseController;

/**
 * Description of ClientsRequestsController
 *
 * @author alexey
 */
class ClientsRequestsController extends BaseController {

    //put your code here
    public function send() {
        $return = [
            'success' => false,
            'message' => lang('Site.Popapform.Messages.Error.UndefinedError'),
        ];
        if (!$this->request->isAJAX()) {
            $return['message'] = lang('Site.Popapform.Messages.Error.NotAjax');
            return $this->response->setJSON($return);
        }
        
        $phone = $this->request->getPost('phone');
        if(!$phone){
            $return['message'] = lang('Site.Popapform.Messages.Error.EmptyPhone');
            return $this->response->setJSON($return);
        }
        // validate phone
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        try {
            $pphone = $phoneUtil->parse($phone, "UA");
        } catch (\libphonenumber\NumberParseException $e) {
            $return['message'] = $e->getMessage();
            return $this->response->setJSON($return);
        }
        if(!$phoneUtil->isValidNumber($pphone)){
            $return['message'] = lang('Site.Popapform.Messages.Error.NotValidPhone');
            return $this->response->setJSON($return);
        }

        $fphone = $phoneUtil->format($pphone, \libphonenumber\PhoneNumberFormat::E164);
        
        $model = model(ClientsRequestsModel::class);
        
        $data = [
            'name' => $this->request->getPost('name', FILTER_SANITIZE_STRING),
            'phone' => $fphone,
            'email' => $this->request->getPost('email', FILTER_SANITIZE_EMAIL),
            'text' => $this->request->getPost('text', FILTER_SANITIZE_STRING),
            'page' => (string)$this->request->uri,
            'form' => $this->request->getPost('form', FILTER_SANITIZE_STRING),
            'utm_source' => $this->request->getGet('utm_source', FILTER_SANITIZE_STRING),
            'utm_medium' => $this->request->getGet('utm_medium', FILTER_SANITIZE_STRING),
            'utm_campaign' => $this->request->getGet('utm_campaign', FILTER_SANITIZE_STRING),
            'utm_term' => $this->request->getGet('utm_term', FILTER_SANITIZE_STRING),
            'utm_content' => $this->request->getGet('utm_content', FILTER_SANITIZE_STRING),
            'language' => $this->request->getLocale(),
            'code' => '',
            'status' => $model::STATUS_NEW,
        ];
        
        if($model->save($data)){
            $return['success'] = true;
            $return['message'] = lang('Site.Popapform.Messages.Success.Message');
            return $this->response->setJSON($return);
        }
        return $this->response->setJSON($return);
    }

}
