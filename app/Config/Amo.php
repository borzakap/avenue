<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Amo extends BaseConfig {
    
    /**
     * amo base domain
     * @var string
     */
    public $baseDomain = 'rbuilding.amocrm.ru';
    
    /**
     * amo id
     * @var string
     */
    public $clientId = '6c0e8b5c-097e-4045-8972-e6a4e9a2bbfd';

    /**
     * amo secret
     * @var string
     */
    public $clientSecret = 'R7cPJzVO83QerYwdysB2jPHa5hYHCuJy3epdaD8h0VkYbdw3JbqJt84OpJVTta8a';

    /**
     * amo redirect url
     * @var string
     */
    public $redirectUri = 'https://avenue.idilika.com.ua/api/token';

    /**
     * amo Authorization code
     * @var string
     */
    public $authorizationCode = 'def502002b841347fc00238e2a4363757568b107584322c035fff27d234be283e8ee0c6c36a021eb93a16211840a93db320c2d862562da4720ba4d811e516cde8f4eb5a581b60cefa07e25edca8e451c421f5114e6906f7c0399139ee88cbb4e5e3e0fb1f5ec39b2cd9c088cde3363525a11f8f118b5a0ef24bf3740c1eb56ebae11395340c780f79e400a92548ed772be5cd87ee8a0825a477968d8143d6ca83d886bf87375aa3ba4053d78d422e709ebd4af7c00ae48af825db8acd754b02c73ae934cc4699b31f96b5a40ea919e14c71f377b986907602e499acbcce24d1cf53b758f1715590b7f727ebd6483c01a39c3166b999d876500812a31edec4b25edf62bea97d0cdff1de7b617e1e47b430ad2e94f39ed126e6d17415507ca98598194e5e333aa75d9e8253b5e2c56923a14c464a7a7d0d8f53ae9a75848b378f834b5b92c05050e1c190d1d196eeb813bed54d723c2747a58b5461e018248d5fa444124bbeb8a391b87b08a6818c85d9a7847d6d617249a3428434693ab35da9429bb978090db6eecec4064d3472f4e2dd3a8b0f80d901314e58f36b81d3db55f003832bb1f71a7a12546cf21159ef8804047d2851c991ae3701c73f6cc47501a98824e63739c6f2c0f30b408e3f0a9b2b28e91';

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
