<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Amo extends BaseConfig {
    
    /**
     * amo base domain
     * @var string
     */
    public $baseDomain = 'idilika.amocrm.ru';
    
    /**
     * amo id
     * @var string
     */
    public $clientId = 'cbc4a1b8-9bd1-486c-bed3-dd872d793ba4';

    /**
     * amo secret
     * @var string
     */
    public $clientSecret = 'JgAG9DBjPXbflLAzrUzp5VgYKfKwnhrTynsAnatl6M0o0rXlH6BcwxbmBqpr2OKC';

    /**
     * amo redirect url
     * @var string
     */
    public $redirectUri = 'https://avenue.idilika.com.ua/api/token';

    /**
     * amo Authorization code
     * @var string
     */
    public $authorizationCode = 'def50200f9508dfac7b152dfde7ac292e9c28ed19b3303710e97b8eea05f9599da968716a19361eb2ca15fb06057416c01d6242b889720659ae1c96af65e8926516e28984109c422191fe6abc565b7157106979e800fc97c54c05d425e9c0a1813b5a7b4f0b742f1d05a7dafe09f2ee1914596a46f2d0546c35ba84bb47b1c7b14cb27a586ffc08a5f70cacf8c940d900289ff20637bb2ff0238ba4d308e4f26235e280fe0723e575239880735e6ca1b1afd790509c8b777e3037d532ca384485aca0617c0e48aae0ca2e469137d6b687be66ea15b4ae1181b5dda6d2f3ce874443f5716940a4359b09a735dbf1532419dd284fc1d6c4ab3427e89f086ac1e639e76197857844a651e105973a939e77f74321161ffdef7752cb4fc8976531cae201ddeabed8dca1faffd7630ce98c6b32375adc5edbaff49cf423328277925188e778be0722af32183c6f354638ca09fda446eda0d78ecc9f05e5d80e13cdf3c7dec96ee3ed460a1a28186ff35507266e07c94882161d4d1b7a1f51b0f57d301e99c916f1fa3c125dbd42d84784e4a1cad1d093efdc54ef115f439d6534ce21dfa7b682a4e9677c0368bf9bee2fac12fcc02f27d88145a1e3a537d69e5777b3c1ded45c46b4b937fa5691808971182eef258f9';

    /**
     * clozed stage id
     * @var integer 
     */
    public $closedLead = 143;
    
    /**
     * success stage id
     * @var integer 
     */
    public $successLead = 142;
    
    /**
     * pipline id
     * @var integer
     */
    public $piplineId = 4361656;
        
    /**
     * new stage id
     * @var integer
     */
    public $newLead = 18904171;
    /**
     * contact`s phone number custom_field id
     * @var integer 
     */
    public $contactPhoneFieldId = 61775;
    
    /**
     * contact`s email custom_field id
     * @var integer 
     */
    public $contactEmailFieldId = 61777;
    
    /**
     * contact`s city custom_field id
     * @var integer
     */
    public $contactCityFieldId = 390059;

    /**
     * contact`s region custom_field id
     * @var integer
     */
    public $contactRegionFieldId = 390057;
    
    /**
     * lead`s typeLead field custom_feild values
     * @var array
     */
    public $leadTypeLeadFieldValues = [
        'CallTracking' => 764483,
        'GetCall' => 764485,
        'SiteForm' => 884021,
        'JivoChat' => 888921,
        'SitePopup' => 896935,
        'FacebookChat' => 896937,
        'FacebookLead' => 896939,
        'DirectCall' => 906695,
    ];
    
}
