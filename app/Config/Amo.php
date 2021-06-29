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
    public $clientSecret = 'GFjdbDm1VtxLY6EbWatE80y7kQYvkgxszYejFCyNYVl2f6bRF2xga1GqGc4zNzeM';

    /**
     * amo redirect url
     * @var string
     */
    public $redirectUri = 'https://avenue.idilika.com.ua/api/token';

    /**
     * amo Authorization code
     * @var string
     */
    public $authorizationCode = 'def502001ea2ed5eb5d71671daaa79f921008305eec51bba5b08a942d6e939befede746e6aad996fe2a8252e0cc6b0c62c4ddc160729a1522ceb8eb648befc764a10c14f22c3e8a1a933368f293fec8ae642cb6ab220a68feae0fe6e1d9a178a197742e8230f8fee5b18bf31d21832ebf5e9dc8f5bcc4142ee8eea7ca69578d485ac953543ebc29847e70b95a95a8ab9f33bc3e0ba17983b488ddc2124f2cea6deb2eb92bc99bf250979fa141a073efc7681b418c78a1d29f003eaa180d545913c3405726ef643b0b625c689427a9620eb1c1595c06c7e2d9744f69ad458fd05722a7c85bc6e983e418559fc888de5aad1359c6b67e9c68cdc0217bf8e787eaa442db1f453fa22e94b423baae769e5484e3c64b8e7047a6fc829fd5eacd572ecb389f6a30b5247b9c9601de0f05fd9b18bbd8c1839fc1317e806159e82d19ca9f38024545e2497967441e05dcc7876f1ba95063f21f0917df553c49385f93296885ead009b12ef617ff66b84c970c074fdf35fc723a923c086b1f5a95f3ef5c66175d2c3db711828dd18725e87e08c86061c00557c8ea776576c9eb232d261d3deaca91c3ef913929e85905614c0dde91935f25864ff83f4c0cdf202df3b3f1eb2a22886147fb5ee91864e07a79a070e77e984';

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
