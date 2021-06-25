<?php

namespace App\Libraries;

use CodeIgniter\I18n\Time;
use AmoCRM\Client\AmoCRMApiClient;
use League\OAuth2\Client\Token\AccessTokenInterface;

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
     * @return \App\Libraries\Amoservice
     */
    public function setUnsortedUid(string $UnsortedUid): Amoservice {
        $this->unsortedUid = $UnsortedUid;
        return $this;
    }

    /**
     * get the unsorted uid
     * @return string
     */
    public function getUnsortedUid(): string {
        return $this->unsortedUid;
    }

    /**
     * set the unsorted form id
     * @param string|null $FormId
     * @return \App\Libraries\Amoservice
     */
    public function setFormId(?string $FormId): Amoservice {
        $this->formId = $FormId;
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
     * @param string|null $FormName
     * @return \App\Libraries\Amoservice
     */
    public function setFormName(?string $FormName): Amoservice {
        $this->formName = $FormName;
        return $this;
    }

    /**
     * get the unsorted form name
     * @return string
     */
    public function getFormName(): string {
        if (!$this->formName) {
            $this->formName = lang('Amoservice.FormName');
        }
        return $this->formName;
    }

    /**
     * set the unsorted form from url
     * @param string|null $FormUrl
     * @return \App\Libraries\Amoservice
     */
    public function setFormUrl(?string $FormUrl): Amoservice {
        $this->formUrl = $this->validateTextFieldLength(urldecode($FormUrl));
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
     * @param string|null $FormReferer
     * @return \App\Libraries\Amoservice
     */
    public function setFormReferer(?string $FormReferer): Amoservice {
        $this->formReferer = $this->validateTextFieldLength($FormReferer);
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
     * @param string|null $UserIp
     * @return \App\Libraries\Amoservice
     */
    public function setFormUserIp(?string $UserIp): Amoservice {
        $this->formUserIp = $UserIp;
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
     * @param int|null $ResponsibleUserId
     * @return \App\Libraries\Amoservice
     */
    public function setResponsibleUserId(?int $ResponsibleUserId): Amoservice {
        $this->responsibleUserId = $ResponsibleUserId;
        return $this;
    }

    /**
     * get the responsible user id
     * @return int
     */
    public function getResponsibleUserId(): int {
        return $this->responsibleUserId;
    }

    // -----------------------------------

    /**
     * set the valid contact`s email
     * @param string|null $ContactEmail
     * @return \App\Libraries\Amoservice
     */
    public function setContactEmail(?string $ContactEmail): Amoservice {
        $this->contactEmail = filter_var($ContactEmail, FILTER_VALIDATE_EMAIL);
        return $this;
    }

    /**
     * get the contact`s email
     * @return string|null
     */
    public function getContactEmail(): ?string {
        return $this->contactEmail;
    }

    /**
     * set the valid contact`s phone
     * @param string|null $ContactPhone
     * @return \App\Libraries\Amoservice
     */
    public function setContactPhone(?string $ContactPhone): Amoservice {
        $phoneUtil = service('phone');
        try {
            $phone = $phoneUtil->parse($ContactPhone, "UA");
        } catch (Exception $ex) {
            $this->contactPhone = false;
            return $this;
        }
        if (!$phoneUtil->isValidNumber($phone)) {
            $this->contactPhone = false;
            return $this;
        }
        $this->contactPhone = $phoneUtil->format($phone, \libphonenumber\PhoneNumberFormat::E164);
        return $this;
    }

    /**
     * get the contact`s phone
     * @return string|null
     */
    public function getContactPhone(): ?string {
        return $this->contactPhone;
    }

    /**
     * set the contact`s name
     * @param string|null $ContactName
     * @return \App\Libraries\Amoservice
     */
    public function setContactName(?string $ContactName): Amoservice {
        $this->contactName = $this->validateTextFieldLength($ContactName);
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
     * @param string|null $ContactCountry
     * @return \App\Libraries\Amoservice
     */
    public function setContactCountry(?string $ContactCountry): Amoservice {
        $this->contactCountry = $this->validateTextFieldLength($ContactCountry);
        return $this;
    }

    /**
     * get the contact`s country
     * @return string|null
     */
    public function getContactCountry(): ?string {
        return $this->contactCountry;
    }

    /**
     * set the contact`s city
     * @param string|null $ContactCity
     * @return \App\Libraries\Amoservice
     */
    public function setContactCity(?string $ContactCity): Amoservice {
        $this->contactCity = $this->validateTextFieldLength($ContactCity);
        return $this;
    }

    /**
     * get the contact`s city
     * @return string|null
     */
    public function getContactCity(): ?string {
        return $this->contactCity;
    }

    // ---------------------------------------------

    /**
     * set lead Name
     * @param string|null $LeadName
     * @return \App\Libraries\Amoservice
     */
    public function setLeadName(?string $LeadName): Amoservice {
        $this->leadName = $this->validateTextFieldLength($LeadName);
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
     * @param string|null $LeadGacid
     * @return \App\Libraries\Amoservice
     */
    public function setLeadGacid(?string $LeadGacid): Amoservice {
        $this->leadGacid = $this->validateTextFieldLength($LeadGacid);
        return $this;
    }

    /**
     * get the google analitycs client id
     * @return string|null
     */
    public function getLeadGacid(): ?string {
        return $this->leadGacid;
    }

    /**
     * set the google ads gclid data
     * @param string|null $LeadGclid
     * @return \App\Libraries\Amoservice
     */
    public function setLeadGclid(?string $LeadGclid): Amoservice {
        $this->leadGclid = $this->validateTextFieldLength($LeadGclid);
        return $this;
    }

    /**
     * get the google ads gclid data 
     * @return string|null
     */
    public function getLeadGclid(): ?string {
        return $this->leadGclid;
    }

    /**
     * set the utm_source
     * @param string|null $LeadUtmSource
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUtmSource(?string $LeadUtmSource): Amoservice {
        $this->leadUtmSource = $this->validateTextFieldLength($LeadUtmSource);
        return $this;
    }

    /**
     * get the utm_source
     * @return string|null
     */
    public function getLeadUtmSource(): ?string {
        return $this->leadUtmSource;
    }

    /**
     * set the utm_medium
     * @param string|null $LeadUtmMedium
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUtmMedium(?string $LeadUtmMedium): Amoservice {
        $this->leadUtmMedium = $this->validateTextFieldLength($LeadUtmMedium);
        return $this;
    }

    /**
     * get utm_medium
     * @return string|null
     */
    public function getLeadUtmMedium(): ?string {
        return $this->leadUtmMedium;
    }

    /**
     * set the utm_term
     * @param string|null $LeadUtmTerm
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUtmTerm(?string $LeadUtmTerm): Amoservice {
        $this->leadUtmTerm = $this->validateTextFieldLength($LeadUtmTerm);
        return $this;
    }

    /**
     * get the utm_term
     * @return string|null
     */
    public function getLeadUtmTerm(): ?string {
        return $this->leadUtmTerm;
    }

    /**
     * set the utm_content
     * @param string|null $LeadUtmContent
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUtmContent(?string $LeadUtmContent): Amoservice {
        $this->leadUtmContent = $this->validateTextFieldLength($LeadUtmContent);
        return $this;
    }

    /**
     * get the utm_content
     * @return string|null
     */
    public function getLeadUtmContent(): ?string {
        return $this->leadUtmContent;
    }

    /**
     * set the utm_campaign
     * @param string|null $LeadUtmCampaign
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUtmCampaign(?string $LeadUtmCampaign): Amoservice {
        $this->leadUtmCampaign = $this->validateTextFieldLength($LeadUtmCampaign);
        return $this;
    }

    /**
     * get the utm_campaign
     * @return string|null
     */
    public function getLeadUtmCampaign(): ?string {
        return $this->leadUtmCampaign;
    }

    /**
     * set the type lead data
     * @param string|null $TypeLead
     * @return \App\Libraries\Amoservice
     */
    public function setLeadTypeLead(?string $TypeLead): Amoservice {
        if (isset($this->amoConf->leadTypeLeadFieldValues[$TypeLead])) {
            $this->leadTypeLeadValue = $TypeLead;
            $this->leadTypeLeadEnum = $this->amoConf->leadTypeLeadFieldValues[$TypeLead];
        }
        return $this;
    }

    /**
     * get type lead value
     * @return string|null
     */
    public function getLeadTypeLeadValue(): ?string {
        return $this->leadTypeLeadValue;
    }

    /**
     * get type lead enum
     * @return string|null
     */
    public function getLeadTypeLeadEnum(): ?string {
        return $this->leadTypeLeadEnum;
    }

    /**
     * set the site domain
     * @param string|null $LeadDomain
     * @return \App\Libraries\Amoservice
     */
    public function setLeadDomain(?string $LeadDomain): Amoservice {
        $this->leadDomain = $this->validateTextFieldLength($LeadDomain);
        return $this;
    }

    /**
     * get the site domain
     * @return string|null
     */
    public function getLeadDomain(): ?string {
        if (!$this->leadDomain && $this->formUrl) {
            $url = parse_url($this->formUrl);
            if (isset($url['host'])) {
                $this->leadDomain = $url['host'];
            }
        }
        return $this->leadDomain;
    }

    /**
     * set the user Agent data
     * @param string|null $LeadUserAgent
     * @return \App\Libraries\Amoservice
     */
    public function setLeadUserAgent(?string $LeadUserAgent): Amoservice {
        $this->leadUserAgent = $this->validateTextFieldLength($LeadUserAgent);
        return $this;
    }

    /**
     * get the user Agent data
     * @return string|null
     */
    public function getLeadUserAgent(): ?string {
        return $this->leadUserAgent;
    }

    /**
     * set the lead`s message
     * @param string|null $LeadMessage
     * @return \App\Libraries\Amoservice
     */
    public function setLeadMessage(?string $LeadMessage): Amoservice {
        $this->leadMessage = strip_tags($LeadMessage);
        return $this;
    }

    /**
     * get the lead`s Message
     * @return string|null
     */
    public function getLeadMessage(): ?string {
        return $this->leadMessage;
    }

    /**
     * set created at the lead
     * @param int|null $leadCreatedAt
     * @return \App\Libraries\Amoservice
     */
    public function setLeadCreatedAt(?int $leadCreatedAt): Amoservice {
        $this->leadCreatedAt = $leadCreatedAt;
        return $this;
    }

    /**
     * get lead created at
     * @return int|null
     */
    public function getLeadCreatedAt(): ?int {
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
