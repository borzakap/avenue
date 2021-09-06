<?php

namespace App\Libraries;

use CodeIgniter\I18n\Time;
use AmoCRM\Client\AmoCRMApiClient;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Ramsey\Uuid\Uuid;

class Amoservice {

    /**
     *
     * @var Amo Config
     */
    protected $amoConf;

    /**
     * unsorted uid
     * @var string
     */
    protected $unsortedUid;

    /**
     * unsorted form id
     * @var string
     */
    protected $formId;

    /**
     * unsorted form name
     * @var string
     */
    protected $formName;

    /**
     * unsorted form url
     * @var string
     */
    protected $formUrl;

    /**
     * unsorted from referer
     * @var string
     */
    protected $formReferer;

    /**
     * unsorted user ip
     * @var string
     */
    protected $formUserIp;

    /**
     * responsible user id
     * @var integer|null
     */
    protected $responsibleUserId;

    /**
     * contact`s email
     * @var string|null
     */
    protected $contactEmail;

    /**
     * contact`s phone
     * @var string|null
     */
    protected $contactPhone;

    /**
     * contact`s name
     * @var string
     */
    protected $contactName;

    /**
     * contact`s country
     * @var string|null
     */
    protected $contactCountry;

    /**
     * contact`s city
     * @var string|null
     */
    protected $contactCity;

    /**
     * name of lead
     * @var string
     */
    protected $leadName;

    /**
     * google analytics client id
     * @var string|null
     */
    protected $leadGacid;

    /**
     * gloogle ads gclid data
     * @var string|null
     */
    protected $leadGclid;

    /**
     * utm_sourse data
     * @var string|null
     */
    protected $leadUtmSource;

    /**
     * utm_medium data
     * @var string|null
     */
    protected $leadUtmMedium;

    /**
     * utm_term data
     * @var string|null
     */
    protected $leadUtmTerm;

    /**
     * utm_content data
     * @var string|null
     */
    protected $leadUtmContent;

    /**
     * utm_campaign data
     * @var string|null
     */
    protected $leadUtmCampaign;

    /**
     * type lead value
     * @var string|null
     */
    protected $leadTypeLeadValue;

    /**
     * type lead enum
     * @var string|null
     */
    protected $leadTypeLeadEnum;

    /**
     * site (domain)
     * @var string|null
     */
    protected $leadDomain;

    /**
     * user Agent
     * @var string|null
     */
    protected $leadUserAgent;

    /**
     * message for lead
     * @var string|null
     */
    protected $leadMessage;

    /**
     * created at lead
     * @var int
     */
    protected $leadCreatedAt;

    public function __construct() {
        $this->amoConf = config('Amo');
    }

    /**
     * set the unsorted uid
     * @param mixed $UnsortedUid
     * @return \App\Libraries\Amoservice
     */
    public function setUnsortedUid($UnsortedUid): Amoservice {
        $this->unsortedUid = filter_var($UnsortedUid, FILTER_SANITIZE_STRING);
        return $this;
    }

    /**
     * get the unsorted uid
     * @return string
     */
    public function getUnsortedUid(): string {
        if(!$this->unsortedUid){
            $this->unsortedUid = Uuid::uuid4();
        }
        return $this->unsortedUid;
    }

    /**
     * set the unsorted form id
     * @param mixed $FormId
     * @return \App\Libraries\Amoservice
     */
    public function setFormId($FormId): Amoservice {
        $this->formId = filter_var($FormId, FILTER_SANITIZE_STRING);
        return $this;
    }

    /**
     * get the unsorted form id
     * @return string
     */
    public function getFormId(): string {
        if (!$this->formId) {
            $this->formId = 'DefaultForm';
        }
        return $this->formId;
    }

    /**
     * set the unsorted form name
     * @param mixed $FormName
     * @return \App\Libraries\Amoservice
     */
    public function setFormName($FormName): Amoservice {
        $this->formName = filter_var($FormName, FILTER_SANITIZE_STRING);
        return $this;
    }

    /**
     * get the unsorted form name
     * @return string
     */
    public function getFormName(): string {
        if (!$this->formName) {
            $this->formName = lang('Amoservice.DefaultFormName');
        }
        return $this->formName;
    }

    /**
     * set the unsorted form from url
     * @param mixed $FormUrl
     * @return \App\Libraries\Amoservice
     */
    public function setFormUrl($FormUrl): Amoservice {
        $this->formUrl = filter_var($FormUrl, FILTER_VALIDATE_URL);
        if($this->formUrl){
            $this->formUrl = $this->validateTextFieldLength(urldecode($this->formUrl));
        }
        return $this;
    }

    /**
     * get the unsorted form from url
     * @return string
     */
    public function getFormUrl(): string {
        if (!$this->formUrl) {
            $this->formUrl = $this->amoConf->baseDomain;
        }
        return $this->formUrl;
    }

    /**
     * set the unsorted form referer
     * @param mixed $FormReferer
     * @return \App\Libraries\Amoservice
     */
    public function setFormReferer($FormReferer): Amoservice {
        $this->formReferer = filter_var($FormReferer, FILTER_VALIDATE_URL);
        if($this->formReferer){
            $this->formReferer = $this->validateTextFieldLength(urldecode($this->formReferer));
        }
        return $this;
    }

    /**
     * get the unsorted form referer
     * @return string
     */
    public function getFormReferer(): string {
        if (!$this->formReferer) {
            $this->formReferer = $this->amoConf->baseDomain;
        }
        return $this->formReferer;
    }

    /**
     * set the unsorted user ip
     * @param mixed $UserIp
     * @return \App\Libraries\Amoservice
     */
    public function setFormUserIp($UserIp): Amoservice {
        $this->formUserIp = filter_var($UserIp, FILTER_VALIDATE_IP);
        return $this;
    }

    /**
     * get the unsorted user ip
     * @return string
     */
    public function getFormUserIp(): string {
        if (!$this->formUserIp) {
            $request = \Config\Services::request();
            $this->formUserIp = $request->getIPAddress();
        }
        return $this->formUserIp;
    }

    /* ----------------------------- */

    /**
     * set the resposible user id
     * @param mixed $ResponsibleUserId
     * @return \App\Libraries\Amoservice
     */
    public function setResponsibleUserId($ResponsibleUserId): Amoservice {
        $this->responsibleUserId = filter_var($ResponsibleUserId, FILTER_VALIDATE_INT);
            return $this;
    }

    /**
     * get the responsible user id
     * @return int
     */
    public function getResponsibleUserId(): int {
        if(!$this->responsibleUserId){
            $this->responsibleUserId = 0;
        }
        return $this->responsibleUserId;
    }

    // -----------------------------------

    /**
     * set the valid contact`s email
     * @param mixed $ContactEmail
     * @return \App\Libraries\Amoservice
     */
    public function setContactEmail($ContactEmail): Amoservice {
        $this->contactEmail = filter_var($ContactEmail, FILTER_VALIDATE_EMAIL);
        return $this;
    }

    /**
     * get the contact`s email
     * @return string|null
     */
    public function getContactEmail(): ?string {
        if(!$this->contactEmail){
            $this->contactEmail = null;
        }
        return $this->contactEmail;
    }

    /**
     * set the valid contact`s phone
     * @param mixed $ContactPhone
     * @return \App\Libraries\Amoservice
     */
    public function setContactPhone($ContactPhone): Amoservice {
        $phone = filter_var($ContactPhone, FILTER_SANITIZE_STRING);
        if(!$phone){
            $this->contactPhone = null;
            return $this;
        }
        $phoneUtil = service('phone');
        try {
            $r_phone = $phoneUtil->parse($phone, "UA");
        } catch (Exception $e) {
            $this->contactPhone = null;
            return $this;
        }
        if (!$phoneUtil->isValidNumber($r_phone)) {
            $this->contactPhone = null;
            return $this;
        }
        $this->contactPhone = $phoneUtil->format($r_phone, \libphonenumber\PhoneNumberFormat::E164);
        return $this;
    }

    /**
     * get the contact`s phone
     * @return string|null
     */
    public function getContactPhone(): ?string {
        if(!$this->contactPhone){
            $this->contactPhone = null;
        }
        return $this->contactPhone;
    }

    /**
     * set the contact`s name
     * @param mixed $ContactName
     * @return \App\Libraries\Amoservice
     */
    public function setContactName($ContactName): Amoservice {
        $this->contactName = filter_var($ContactName, FILTER_SANITIZE_STRING);
        if($this->contactName){
            $this->contactName = $this->validateTextFieldLength($this->contactName);
        }
        return $this;
    }

    /**
     * get the contact`s name
     * @return string
     */
    public function getContactName(): string {
        if (!$this->contactName) {
            $this->contactName = lang('Amoservice.ClientName');
        }
        return $this->contactName;
    }

    /**
     * set the contact`s country
     * @param mixed $ContactCountry
     * @return \App\Libraries\Amoservice
     */
    public function setContactCountry($ContactCountry): Amoservice {
        $this->contactCountry = filter_var($ContactCountry, FILTER_SANITIZE_STRING);
        if($this->contactCountry){
            $this->contactCountry = $this->validateTextFieldLength($this->contactCountry);
        }
        return $this;
    }

    /**
     * get the contact`s country
     * @return string|null
     */
    public function getContactCountry(): ?string {
        if(!$this->contactCountry){
            $this->contactCountry = null;
        }
        return $this->contactCountry;
    }

    /**
     * set the contact`s city
     * @param mixed $ContactCity
     * @return \App\Libraries\Amoservice
     */
    public function setContactCity($ContactCity): Amoservice {
        $this->contactCity = filter_var($ContactCity, FILTER_SANITIZE_STRING);
        if($this->contactCity){
            $this->contactCity = $this->validateTextFieldLength($this->contactCity);
        }
        return $this;
    }

    /**
     * get the contact`s city
     * @return string|null
     */
    public function getContactCity(): ?string {
        if(!$this->contactCity){
            $this->contactCity = null;
        }
        return $this->contactCity;
    }

    // ---------------------------------------------

    /**
     * set lead Name
     * @param mixed $LeadName
     * @return \App\Libraries\Amoservice
     */
    public function setLeadName($LeadName): Amoservice {
        $this->leadName = filter_var($LeadName, FILTER_SANITIZE_STRING);
        if($this->leadName){
            $this->leadName = $this->validateTextFieldLength($this->leadName);
        }
        return $this;
    }

    /**
     * get the lead Name
     * @return string
     */
    public function getLeadName(): string {
        if (!$this->leadName) {
            $this->leadName = lang('Amoservice.LeadName');
        }
        return $this->leadName;
    }

    /**
     * set the google analytics client id
     * @param mixed $LeadGacid
     * @return \App\Libraries\Amoservice
     */
    public function setLeadGacid($LeadGacid): Amoservice {
        $this->leadGacid = filter_var($LeadGacid, FILTER_SANITIZE_STRING);
        if($this->leadGacid){
            $this->leadGacid = $this->validateTextFieldLength($this->leadGacid);
        }
        return $this;
    }

    /**
     * get the google analitycs client id
     * @return string|null
     */
    public function getLeadGacid(): ?string {
        if(!$this->leadGacid){
            $this->leadGacid = null;
        }
        return $this->leadGacid;
    }

    /**
     * set the google ads gclid data
     * @param mixed $LeadGclid
     * @return \App\Libraries\Amoservice
     */
    public function setLeadGclid($LeadGclid): Amoservice {
        $this->leadGclid = filter_var($LeadGclid, FILTER_SANITIZE_STRING);
        if($this->leadGclid){
            $this->leadGclid = $this->validateTextFieldLength($this->leadGclid);
        }
        return $this;
    }

    /**
     * get the google ads gclid data 
     * @return string|null
     */
    public function getLeadGclid(): ?string {
        if(!$this->leadGclid){
            $this->leadGclid = null;
        }
        return $this->leadGclid;
    }

    /**
     * set the utm_source
     * @param mixed $LeadUtmSource
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUtmSource($LeadUtmSource): Amoservice {
        $this->leadUtmSource = filter_var($LeadUtmSource, FILTER_SANITIZE_STRING);
        if($this->leadUtmSource){
            $this->leadUtmSource = $this->validateTextFieldLength($this->leadUtmSource);
        }
        return $this;
    }

    /**
     * get the utm_source
     * @return string|null
     */
    public function getLeadUtmSource(): ?string {
        if(!$this->leadUtmSource){
            $this->leadUtmSource = null;
        }
        return $this->leadUtmSource;
    }

    /**
     * set the utm_medium
     * @param mixed $LeadUtmMedium
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUtmMedium($LeadUtmMedium): Amoservice {
        $this->leadUtmMedium = filter_var($LeadUtmMedium, FILTER_SANITIZE_STRING);
        if($this->leadUtmMedium){
            $this->leadUtmMedium = $this->validateTextFieldLength($this->leadUtmMedium);
        }
        return $this;
    }

    /**
     * get utm_medium
     * @return string|null
     */
    public function getLeadUtmMedium(): ?string {
        if(!$this->leadUtmMedium){
            $this->leadUtmMedium = null;
        }
        return $this->leadUtmMedium;
    }

    /**
     * set the utm_term
     * @param mixed $LeadUtmTerm
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUtmTerm(?string $LeadUtmTerm): Amoservice {
        $this->leadUtmTerm = filter_var($LeadUtmTerm, FILTER_SANITIZE_STRING);
        if($this->leadUtmTerm){
            $this->leadUtmTerm = $this->validateTextFieldLength($this->leadUtmTerm);
        }
        return $this;
    }

    /**
     * get the utm_term
     * @return string|null
     */
    public function getLeadUtmTerm(): ?string {
        if(!$this->leadUtmTerm){
            $this->leadUtmTerm = null;
        }
        return $this->leadUtmTerm;
    }

    /**
     * set the utm_content
     * @param mixed $LeadUtmContent
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUtmContent(?string $LeadUtmContent): Amoservice {
        $this->leadUtmContent = filter_var($LeadUtmContent, FILTER_SANITIZE_STRING);
        if($this->leadUtmContent){
            $this->leadUtmContent = $this->validateTextFieldLength($this->leadUtmContent);
        }
        return $this;
    }

    /**
     * get the utm_content
     * @return string|null
     */
    public function getLeadUtmContent(): ?string {
        if(!$this->leadUtmContent){
            $this->leadUtmContent = null;
        }
        return $this->leadUtmContent;
    }

    /**
     * set the utm_campaign
     * @param mixed $LeadUtmCampaign
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUtmCampaign($LeadUtmCampaign): Amoservice {
        $this->leadUtmCampaign = filter_var($LeadUtmCampaign, FILTER_SANITIZE_STRING);
        if($this->leadUtmCampaign){
            $this->leadUtmCampaign = $this->validateTextFieldLength($this->leadUtmCampaign);
        }
        return $this;
    }

    /**
     * get the utm_campaign
     * @return string|null
     */
    public function getLeadUtmCampaign(): ?string {
        if(!$this->leadUtmCampaign){
            $this->leadUtmCampaign = null;
        }
        return $this->leadUtmCampaign;
    }

    /**
     * set the type lead data
     * @param mixed $TypeLead
     * @return \App\Libraries\Amoservice
     */
    public function setLeadTypeLead($TypeLead): Amoservice {
        $Type = filter_var($TypeLead, FILTER_SANITIZE_STRING);
        if($Type && isset($this->amoConf->leadTypeLeadFieldValues[$Type])){
            $this->leadTypeLeadValue = $Type;
            $this->leadTypeLeadEnum = $this->amoConf->leadTypeLeadFieldValues[$Type];
        }
        return $this;
    }

    /**
     * get type lead value
     * @return string|null
     */
    public function getLeadTypeLeadValue(): ?string {
        if(!$this->leadTypeLeadValue){
            $this->leadTypeLeadValue = null;
        }
        return $this->leadTypeLeadValue;
    }

    /**
     * get type lead enum
     * @return string|null
     */
    public function getLeadTypeLeadEnum(): ?string {
        if(!$this->leadTypeLeadEnum){
            $this->leadTypeLeadEnum = null;
        }
        return $this->leadTypeLeadEnum;
    }

    /**
     * set the site domain
     * @param mixed $LeadDomain
     * @return \App\Libraries\Amoservice
     */
    public function setLeadDomain($LeadDomain): Amoservice {
        $this->leadDomain = filter_var($LeadDomain, FILTER_VALIDATE_DOMAIN);
        if($this->leadDomain){
            $this->leadDomain = $this->validateTextFieldLength($this->leadDomain);
        }
        return $this;
    }

    /**
     * get the site domain
     * @return string|null
     */
    public function getLeadDomain(): ?string {
        if(!$this->leadDomain && $this->formUrl){
            $url = parse_url($this->formUrl);
            if(isset($url['host'])){
                $this->leadDomain = $url['host'];
            }
        }
        if(!$this->leadDomain){
            $this->leadDomain = null;
        }
        return $this->leadDomain;
    }

    /**
     * set the user Agent data
     * @param mixed $LeadUserAgent
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUserAgent($LeadUserAgent): Amoservice {
        $this->leadUserAgent = filter_var($LeadUserAgent, FILTER_SANITIZE_STRING);
        if($this->leadUserAgent){
            $this->leadUserAgent = $this->validateTextFieldLength($this->leadUserAgent);
        }
        return $this;
    }

    /**
     * get the user Agent data
     * @return string|null
     */
    public function getLeadUserAgent(): ?string {
        if(!$this->leadUserAgent){
            $this->leadUserAgent = null;
        }
        return $this->leadUserAgent;
    }

    /**
     * set the lead`s message
     * @param mixed $LeadMessage
     * @return \App\Libraries\Amoservice
     */
    public function setLeadMessage($LeadMessage): Amoservice {
        $this->leadMessage = filter_var($LeadMessage, FILTER_SANITIZE_STRING);
        if($this->leadMessage){
            $this->leadMessage = strip_tags($this->leadMessage);
        }
        return $this;
    }

    /**
     * get the lead`s Message
     * @return string|null
     */
    public function getLeadMessage(): ?string {
        if(!$this->leadMessage){
            $this->leadMessage = null;
        }
        return $this->leadMessage;
    }

    /**
     * set created at the lead
     * @param mixed $leadCreatedAt
     * @return \App\Libraries\Amoservice
     */
    public function setLeadCreatedAt($leadCreatedAt): Amoservice {
        $this->leadCreatedAt = filter_var($leadCreatedAt, FILTER_VALIDATE_INT);
        return $this;
    }

    /**
     * get lead created at
     * @return int
     */
    public function getLeadCreatedAt(): int {
        if (!$this->leadCreatedAt) {
            return Time::now()->getTimestamp();
        }
        return $this->leadCreatedAt;
    }

    /**
     * force the max length for text field
     * @param string|null $TextField
     * @return string|null
     */
    public function validateTextFieldLength(?string $TextField): ?string {
        if (strlen($TextField) > 255) {
            $TextField = substr($TextField, 0, 255);
        }

        return $TextField;
    }

    /**
     * connect to Amo
     * @return AmoCRMApiClient
     */
    public function connect() {
        // load the amo helpers
        helper('amo');

        // init Amo
        $apiClient = new AmoCRMApiClient($this->amoConf->clientId, $this->amoConf->clientSecret, $this->amoConf->redirectUri);

        $accessToken = amo_get_token();

        $apiClient->setAccessToken($accessToken)
                ->setAccountBaseDomain($accessToken->getValues()['baseDomain'])
                ->onAccessTokenRefresh(
                        function (AccessTokenInterface $accessToken, string $baseDomain) {
                            amo_save_token(
                                    [
                                        'accessToken' => $accessToken->getToken(),
                                        'refreshToken' => $accessToken->getRefreshToken(),
                                        'expires' => $accessToken->getExpires(),
                                        'baseDomain' => $baseDomain,
                                    ]
                            );
                        }
        );

        return $apiClient;
    }

}
