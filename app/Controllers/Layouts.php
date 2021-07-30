<?php

namespace App\Controllers;

/**
 * Description of Layouts
 *
 * @author alexey
 */
class Layouts extends BaseController{
    
    public function view(string $slug) {
        
        return view('site/layouts/layout', $this->data);
    }

    //put your code here
}
