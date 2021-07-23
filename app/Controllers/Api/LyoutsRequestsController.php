<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

/**
 * Description of LyoutsController
 *
 * @author alexey
 */
class LyoutsRequestsController extends BaseController{
    //put your code here
    public function load(){
        helper('html');
        $return = [
            'success' => false,
            'message' => lang('Site.Popapform.Messages.Error.UndefinedError'),
            'html' => '',
        ];
        if (!$this->request->isAJAX()) {
            $return['message'] = lang('Site.Popapform.Messages.Error.NotAjax');
            return $this->response->setJSON($return);
        }
        $slug = $this->request->getPost('slug');
        $language = $this->request->getLocale();
        $model = model(LayoutsModel::class);
        $layout = $model->getLayoutBySlug($slug, $language);
        $data = ['data' => $layout];
        $return['html'] = view('site/layouts/layouts_modal', $data);
        $return['success'] = true;
        $return['message'] = '';
        return $this->response->setJSON($return);
    }
    
}
