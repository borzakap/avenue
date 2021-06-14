<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Description of LocalizationFilter
 *
 * @author alexey
 */
class LocalizationFilter implements FilterInterface {

    public function before(RequestInterface $request, $params = null) {

        // Make sure this isn't admin area
        if (url_is('console*') || url_is('api*') || url_is('login')) {
            return;
        }

        $appConfig = config(App::class);
        $current = current_url(true);
        
        // if localization segment is empty
        if(empty($current->getSegment(1))){
            return redirect()->to('/'.$appConfig->defaultLocale);
        }
        
        // else set 404
        if (!in_array($current->getSegment(1), $appConfig->supportedLocales)) {
            // set 404
            throw new PageNotFoundException();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        
    }

}
