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
    public $clientId = 'fa822b13-ab8b-4af6-80a2-65dc3f231c70';

    /**
     * amo secret
     * @var string
     */
    public $clientSecret = 'Qxokb5RfmCcGwu3cMrNPJns0M9sz5RhjrKHBTqzWP7UWqpQFsg4lKSxTG2HPTk4m';

    /**
     * amo redirect url
     * @var string
     */
    public $redirectUri = 'https://avenue.idilika.com.ua/api/token';

    /**
     * amo Authorization code
     * @var string
     */
    public $authorizationCode = 'def502005d4217434a441c04941b61cfa3206898829a60899e12b071cdd1b2dceb17d7399e1aee6df00ef0685ad0677053f52b11acf0a137602b26f80596749fa4567ace5311969ecc3a827411520fb58922a124a0db9fa9bd57567c9c3be2007d253554f801b191adcdf17490a1704b5ff7fd0a61ab1382415da4c22e73c1bbffa74d191d4cc19a64d864442092587ec2f820852dea2996c5229a81875993b3cdb63a2a26c2c776d0d5c2df214aca4e09ee4984064f3f5e22942a1dea67e11cb7bbd3cf0dd85f5caa9b5d9e4a23100ed243b9d6fb5b5b5257f031d8c1dc082bbf561dee01bf779c39c27165843247260364c43e1374a87d6ae435ad75a063390dce32cdfe0f8025af94d9fdd5b9021d5f13c21de581567e2848d5d75fd5cab0fb8f27a74e2552b844684875751c80cc162482a66bab22f14f23e1947be4deebef652af9601137e07568db7b38815cee37d35b86f4a0a225edcf26b2d94c4b437c043f55f9dfa158af805dd8c4994c1f911e2dbb6523412aeb680fcb8a94edc6456172d10f0751e344843ce95873cf275ef9c92bb8f5cb17382c4a69731e10d8d897ab2e629c3997a6f5d7fa8ed329b685ad62cb370714c30f7495efe8cfec0f16295a212f50c51c7cc3563a81c1';

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
