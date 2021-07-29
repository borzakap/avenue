<?php

namespace App\Controllers;

/**
 * Description of Complex
 *
 * @author alexey
 */
class Complex extends BaseController{
    //put your code here
    public function genplan(){
        helper('html', 'url');
        return view('site/complexes/genplan', $this->data);
    }
}
