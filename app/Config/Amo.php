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
    public $authorizationCode = 'def50200611e8eaab34e4ff849726832f7ec29e5f45706f1056b8e0fef2f19d1ffd58005609bc9b5fba59f6a0ef80781d58da7a122391df2356c52aca4d5dacb8ba45c56d767f381b64a33993ba26dc299c5193b45cdd9f4733f63df9f67dc675d9a98344d0784331ab320371cab56d95642bfd0cb775b91d471fa38099a4db67ea436af563ad237708a456557491e7bc14cdfa46ffed5a0bc13247436b08a100188fbd666b9b3a3ff8bb862501f6f09495de678058b1e7addb6e88a8af9d498ecb596b3d903efc19556bba2f6542256567e595b2abeb0a53f1be95e6b648c2a98bacd087db6b20457c030632b0ae095b9ae7de6cf3faa14da747ba5f3fbc770229b5df3440e2e32a60a7fce4366f8ea23cd07aff12ce49ac105ee0b7d8319abbea0bf8c03c071a67361f0465fb15fd348e90aa6d99d5f48df2a5ac6697657db2ee2cf57f37e3babe2367e83bfd85e2960e79f9ca3e1d181f6c7722cc3deeb6ea8f35e72faa7ae37a5d5a825d3fcc5f6e881c8cd426c0c411e630d55732010a76c48c5d725cc8ee363442e2d59e8b95605ab66659d8dfc2752d1c8a5b03595fab9cdd3202de05ade435b6482a1f7d12738d5dd3eae4c6c2f6c7e8ddbe237268f7f9c9a1c8c5aed67ce';

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
