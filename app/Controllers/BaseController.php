<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller {

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['html'];

    /**
     * Defatul data for template
     * @var array
     */
    public $data = [];

    /**
     * 
     * @var instanse of translation service
     */
    public $text;


    /**
     * Constructor.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param LoggerInterface   $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        
        $this->text = service('translation');

        // default metadata for template
        $this->data['meta_title'] = $this->text->translate('meta_title', 'common');
        $this->data['meta_description'] = $this->text->translate('meta_description', 'common');
        $this->data['page_header'] = 'Idilika Avenue';
        $this->data['contact_phone'] = '(067) 390-15-05';
        $this->data['contact_email'] = 'borzakap@gmail.com';
        $this->data['socials'] = [
            'Facebook' => 'https://www.facebook.com/idilikaavenue.com.ua/',
            'Instagram' => 'https://www.instagram.com/idilikaavenue.rb/',
            'Youtube' => 'https://www.youtube.com/@r-building',
        ];
        $this->data['breadcrumbs'][] = ['url' => route_to('site_home'), 'title' => lang('Site.Breadcrumb.Home')];
        

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.: $this->session = \Config\Services::session();
    }

}
