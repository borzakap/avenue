<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;

/**
 * Description of UsersController
 *
 * @author alexey
 */
class UsersController  extends BaseController{
    
    protected $helpers = ['form'];
    
    public function list(){
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Sections'), '/admin/users');
        $model = model(UserModel::class);
        $items = $model->findAll();
        $data = [
            'items' => $items,
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/users/list', $data);
    }
    
    public function update(int $id){
        
    }
}
