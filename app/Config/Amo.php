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
    public $clientSecret = 'PnoAt1CILz3aMiYGCkPdt3VbeyFBngIsMXqQMBCohFxXIF89VgcyRpfPyL7AU6b0';

    /**
     * amo redirect url
     * @var string
     */
    public $redirectUri = 'https://avenue.idilika.com.ua/api/token';

    /**
     * amo Authorization code
     * @var string
     */
    public $authorizationCode = 'def502001637f4663fa15a24f350ba1ac3718923cb464fe8a2c0be30c9d0c642a23e5acab93ff59527faa92b6461a59c917eb95f903ce0ab70b18413cf965003e23a332d0a59ae63e0d018ea5237253d64e72ac5e8568cfad62a157da0204be6632f203ac00c6b315d5ea322b265263a10f08a4d4e131a89a1fbea08091252173cdeca0bdd024599c9c6c9003e1da10ce260c88781d7ce8d2f8133966fa2ed20787c97e102487ddeee72494fea3c5175343d031c922b411afc99879baef5ea236c7e9edd8be9f0b773edfb836f57d00ef2798b4bbf19649efdee15c48de152a5690b7acd1239a2ee2fb0f5601695ad55cfe51727862eeb953fccf532c188bd7294f7ef325f8a0775d009aa4000c5c59d5f0fa729d4ae8799c190ee81c6e038452dbdd3444077df3fc4bde035f1391257e4804cf05f7bc264a7b111a84274117056dc40b12ba86445edf5849d535921c06b1ec4224cfd69895445097b1aad0e4eafb7b4fd8a1dc7da7b1ba222d361d1144cf332b8e1aebba3e24a10edd1e8ddf90ba8a80d6a61314cf9598f1ab3995aa7f4bff9e75bfd2636dec9992b7e648ff89936f45c7477ccfdf8cf33354e77bbb92fada4c55ac7de18c3cd7acde45b1763d72b543fbfc934d6e7';

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
     * lead`s google analytics client Id custom_field id
     * @var integer 
     */
    public $leadGacidFieldId = 574267;
    
    /**
     * lead`s google ads data custom_field id
     * @var integer
     */
    public $leadGclidFieldId = 574267;
    
    /**
     * lead`s utm_source field custom_field id
     * @var type integer
     */
    public $leadUtmSourceFieldId = 574237;
    
    /**
     * lead`s utm_medium field custom_fild id
     * @var type integer
     */
    public $leadUtmMediumFieldId = 574239;
    
    /**
     * lead`s utm_term field custom_field id
     * @var integer
     */
    public $leadUtmTermFieldId = 574243;

    /**
     * lead`s utm_content field custom_field id
     * @var integer
     */
    public $leadUtmContentFieldId = 574245;
    
    /**
     * lead`s utm_compaing field custom_field id
     * @var integer
     */
    public $leadUtmCompaingFieldId = 574241;
    
    /**
     * lead`s page field custom_field id
     * @var integer
     */
    public $leadPageFieldId = 574265;
    
    /**
     * lead`s page field custom_field id
     * @var integer
     */
    public $leadDomainFieldId = 574255;
    
    /**
     * lead`s user agetn custom_field id
     * @var integer
     */
    public $leadUserAgentFieldId = 580761;
    
    /**
     * lead`s user IP custom_field is
     * @var integer
     */
    public $leadUserIpFieldId = 580763;

    /**
     * lead`s typeLead field custom_field id
     * @var integer
     */
    public $leadTypeLeadFieldId = 580765;
    
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
