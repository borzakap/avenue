<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;


/**
 * Description of LayoutsController
 *
 * @author alexey
 */
class LayoutsController extends BaseController{
    protected $helpers = ['form'];

    public function list(){
        $data = [];
        return view('admin/layouts/list', $data);
    }
    
    public function create(){
        
    }
    
    public function update(int $id){
        
    }
}
