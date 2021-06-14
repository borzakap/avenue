<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;


/**
 * Description of ClientsRequestsController
 *
 * @author alexey
 */
class ClientsRequestsController extends BaseController{

    /**
     * list of requests
     * @return type
     */
    public function list() {
        $model = model(ClientsRequestsModel::class);
        $items = $model->findAll();
        $this->breadcrumb->add(lang('Residentials.Breadcrumb.Admin.Residentials'), '/admin/requests');
        $data = [
            'items' => $items,
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/requests/list', $data);
    }
}
