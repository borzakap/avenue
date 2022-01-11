<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use AmoCRM\Exceptions\AmoCRMApiException;
use App\Libraries\Amoservice;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\TrackingDataCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\TrackingDataCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\TrackingDataCustomFieldValueModel;

use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\ContactsCollection;

use AmoCRM\Models\ContactModel;
use AmoCRM\Models\LeadModel;

use AmoCRM\Models\Unsorted\FormUnsortedModel;
use AmoCRM\Models\Unsorted\FormsMetadata;
use AmoCRM\Collections\Leads\Unsorted\FormsUnsortedCollection;
use CodeIgniter\I18n\Time;


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
class BaseController extends ResourceController {

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];
    
    /**
     * instance of Amo
     * @var instanse of Amo
     */
    protected $apiClient;

    /**
     * instanse of amoservice
     * @var instanse of amoservice
     */
    protected $amoService;

    /**
     * amo configuratuion
     * @var instans of amo configuration
     */
    protected $amoConf;

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
        // preload amo config
        $this->amoConf = config('Amo');
        // preload amoservice
        $this->amoService = new Amoservice();
        // preload Amo
        $this->apiClient = $this->amoService->connect();
    }
    
    /**
     * finding the contact id
     * @param string $contact
     * @return int|null
     */
    protected function findContact(?string $contact): ?int {
        if (empty($contact)) {
            return false;
        }
        try {
            $cont = $this->apiClient->getRequest()->get('/api/v4/contacts', ['query' => $contact]);
        } catch (AmoCRMApiException $e) {
            if ($e->getErrorCode() == 204) {
                return false;
            } else {
                die($e->getTraceAsString());
            }
        }
        if (isset($cont['_embedded']['contacts'][0]['id']) and $cont['_embedded']['contacts'][0]['id']) {
            return $cont['_embedded']['contacts'][0]['id'];
        }
        return false;
    }

    /**
     * assign the lead`s custom fields
     * @return CustomFieldsValuesCollection
     */
    protected function assignLeadCustomFields() {
        $leadCustomFields = new CustomFieldsValuesCollection();
        // assign the utm_source
        if ($this->amoService->getLeadUtmSource()) {
            $leadCustomFields->add($this->assignLeadUtmSource());
        }
        // assign the utm_medium
        if ($this->amoService->getLeadUtmMedium()) {
            $leadCustomFields->add($this->assignLeadUtmMedium());
        }
        // assign the utm_term
        if ($this->amoService->getLeadUtmTerm()) {
            $leadCustomFields->add($this->assignLeadUtmTerm());
        }
        // assign the utm_content
        if ($this->amoService->getLeadUtmContent()) {
            $leadCustomFields->add($this->assignLeadUtmContent());
        }
        // assign the utm_compaing
        if ($this->amoService->getLeadUtmCampaign()) {
            $leadCustomFields->add($this->assignLeadUtmCampaign());
        }
        // assign the gacid
        if ($this->amoService->getLeadGacid()) {
            $leadCustomFields->add($this->assignLeadGacid());
        }
        if ($this->amoService->getLeadGclid()) {
            $leadCustomFields->add($this->assignLeadGclid());
        }
        // assign type lead
        if ($this->amoService->getLeadTypeLeadValue()) {
            $leadCustomFields->add($this->assignLeadTypeLeads());
        }
        // assign the page
        if ($this->amoService->getFormUrl()) {
            $leadCustomFields->add($this->assignLeadPage());
        }
        // assign the domain
        if ($this->amoService->getLeadDomain()) {
            $leadCustomFields->add($this->assignLeadDomain());
        }
        // assign the user Agent
        if ($this->amoService->getLeadUserAgent()) {
            $leadCustomFields->add($this->assignLeadUserAgent());
        }
        // assign the user IP
        if ($this->amoService->getFormUserIp()) {
            $leadCustomFields->add($this->assignLeadUserIp());
        }

        return $leadCustomFields;
    }

    /**
     * assign the client phone
     * @return MultitextCustomFieldValuesModel
     */
    protected function assignContactPhone() {
        $phoneFieldValueModel = new MultitextCustomFieldValuesModel();
        $phoneFieldValueModel->setFieldCode('PHONE');
        $phoneFieldValueModel->setValues(
                (new MultitextCustomFieldValueCollection())
                        ->add((new MultitextCustomFieldValueModel())->setEnum('WORKDD')->setValue($this->amoService->getContactPhone()))
        );
        return $phoneFieldValueModel;
    }

    /**
     * asign the client email
     * @return MultitextCustomFieldValuesModel
     */
    protected function assignContactEmail() {
        $emailFieldValueModel = new MultitextCustomFieldValuesModel();
        $emailFieldValueModel->setFieldCode('EMAIL');
        $emailFieldValueModel->setValues(
                (new MultitextCustomFieldValueCollection())
                        ->add((new MultitextCustomFieldValueModel())->setEnum('WORK')->setValue($this->amoService->getContactEmail()))
        );
        return $emailFieldValueModel;
    }

    /**
     * assign the lead google analytics cleint id
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadGacid() {
        $gacidFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $gacidFieldValueModel->setFieldCode('GCLIENTID');
        $gacidFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getLeadGacid()))
        );
        return $gacidFieldValueModel;
    }

    /**
     * assign the lead google ads gclid data
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadGclid() {
        $gclidFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $gclidFieldValueModel->setFieldCode('GCLID');
        $gclidFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getLeadGclid()))
        );
        return $gclidFieldValueModel;
    }

    /**
     * assign the lead utm_source data
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadUtmSource() {
        $utmSourceFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $utmSourceFieldValueModel->setFieldCode('UTM_SOURCE');
        $utmSourceFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getLeadUtmSource()))
        );
        return $utmSourceFieldValueModel;
    }

    /**
     * assign the utm_medium data
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadUtmMedium() {
        $utmMediumFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $utmMediumFieldValueModel->setFieldCode('UTM_MEDIUM');
        $utmMediumFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getLeadUtmMedium()))
        );
        return $utmMediumFieldValueModel;
    }

    /**
     * assign the utm_term
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadUtmTerm() {
        $utmTermFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $utmTermFieldValueModel->setFieldCode('UTM_TERM');
        $utmTermFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getLeadUtmTerm()))
        );
        return $utmTermFieldValueModel;
    }

    /**
     * assign the utm_content 
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadUtmContent() {
        $utmContentFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $utmContentFieldValueModel->setFieldCode('UTM_CONTENT');
        $utmContentFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getLeadUtmContent()))
        );
        return $utmContentFieldValueModel;
    }

    /**
     * assign the utm_compaing
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadUtmCampaign() {
        $utmCompaingFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $utmCompaingFieldValueModel->setFieldCode('UTM_CAMPAIGN');
        $utmCompaingFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getLeadUtmCampaign()))
        );
        return $utmCompaingFieldValueModel;
    }

    /**
     * assign the url (page)
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadPage() {
        $pageFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $pageFieldValueModel->setFieldCode('FROM');
        $pageFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getFormUrl()))
        );
        return $pageFieldValueModel;
    }

    /**
     * assign the domain
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadDomain() {
        $domainFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $domainFieldValueModel->setFieldCode('REFERRER');
        $domainFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getLeadDomain()))
        );
        return $domainFieldValueModel;
    }

    /**
     * assign the user Agent data
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadUserAgent() {
        $userAgentFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $userAgentFieldValueModel->setFieldCode('USER_AGENT');
        $userAgentFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getLeadUserAgent()))
        );
        return $userAgentFieldValueModel;
    }

    /**
     * assign the user ip
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadUserIp() {
        $userIpFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $userIpFieldValueModel->setFieldCode('IP');
        $userIpFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getFormUserIp()))
        );
        return $userIpFieldValueModel;
    }

    /**
     * assign the lead type
     * @return TrackingDataCustomFieldValuesModel
     */
    protected function assignLeadTypeLeads() {
        $typeLeadFieldValueModel = new TrackingDataCustomFieldValuesModel();
        $typeLeadFieldValueModel->setFieldCode('TYPE_LEAD');
        $typeLeadFieldValueModel->setValues(
                (new TrackingDataCustomFieldValueCollection())
                        ->add((new TrackingDataCustomFieldValueModel())->setValue($this->amoService->getLeadTypeLeadValue()))
        );
        return $typeLeadFieldValueModel;
    }

//    /**
//     * assign the lead type
//     * @return SelectCustomFieldValuesModel
//     */
//    protected function assignLeadTypeLeads(): SelectCustomFieldValuesModel {
//        $typeLeadFieldValueModel = new SelectCustomFieldValuesModel();
//        $typeLeadFieldValueModel->setFieldId($this->amoConf->leadTypeLeadFieldId);
//        $typeLeadFieldValueModel->setValues(
//                (new SelectCustomFieldValueCollection())
//                        ->add((new SelectCustomFieldValueModel())
//                                ->setEnumId($this->amoService->getLeadTypeLeadEnum())
//                                ->setValue($this->amoService->getLeadTypeLeadValue()))
//        );
//        return $typeLeadFieldValueModel;
//    }
    
    /**
     * create the new contact
     * @return ContactModel
     */
    protected function createContact(): ContactModel{
        $contact = new ContactModel();
        $contact->setName($this->amoService->getContactName());
        $contact->setResponsibleUserId($this->amoService->getResponsibleUserId());
        $contactCustomFields = new CustomFieldsValuesCollection();
        if($this->amoService->getContactPhone()){
            $contact->setCustomFieldsValues($contactCustomFields->add($this->assignContactPhone()));
        }
        if($this->amoService->getContactEmail()){
            $contact->setCustomFieldsValues($contactCustomFields->add($this->assignContactEmail()));
        }
        try {
            return $this->apiClient->contacts()->addOne($contact);
        } catch (AmoCRMApiException $e) {
            print_r($e->getLastRequestInfo());
            die($e->getMessage());
        }
    }
    
    /**
     * create the lead
     * @return LeadModel
     */
    protected function createLead(): LeadModel{
        $lead = new LeadModel();
        $lead->setName($this->amoService->getLeadName());
        $lead->setResponsibleUserId($this->amoService->getResponsibleUserId());
        $lead->setStatusId($this->amoConf->newLead);
        $lead->setCreatedAt($this->amoService->getLeadCreatedAt());
        $lead->setPipelineId($this->amoConf->piplineId);
        $lead->setCustomFieldsValues($this->assignLeadCustomFields());
        try{
            return $this->apiClient->leads()->addOne($lead);
        } catch (AmoCRMApiException $e){
            print_r($e->getLastRequestInfo());
            die($e->getMessage());
        }

    }
    
    
    protected function sendUnsorted() {

        $formUnsorted = new FormUnsortedModel();
        $formMetadata = new FormsMetadata();
        // form metadata
        $formMetadata->setFormId($this->amoService->getFormId())
                ->setFormName($this->amoService->getFormName())
                ->setFormSentAt(Time::now()->getTimestamp())
                ->setFormPage($this->amoService->getFormUrl())
                ->setReferer($this->amoService->getFormReferer())
                ->setIp($this->amoService->getFormUserIp());

        ## lead
        $unsortedLead = new LeadModel();
        $unsortedLead->setName($this->amoService->getLeadName());
        $unsortedLead->setCustomFieldsValues($this->assignLeadCustomFields());

        ## contact
        $unsortedContactsCollection = new ContactsCollection();
        $unsortedContact = new ContactModel();
        $unsortedContact->setName($this->amoService->getContactName());

        $contactCustomFields = new CustomFieldsValuesCollection();

        // assign the contact`s phone
        if ($this->amoService->getContactPhone()) {
            $unsortedContact->setCustomFieldsValues($contactCustomFields->add($this->assignContactPhone()));
        }
        // assign the contact`s email
        if ($this->amoService->getContactEmail()) {
            $unsortedContact->setCustomFieldsValues($contactCustomFields->add($this->assignContactEmail()));
        }

        $unsortedContactsCollection->add($unsortedContact);

        $formUnsorted
                ->setSourceName($this->amoService->getFormId())
                ->setSourceUid((string) $this->amoService->getUnsortedUid())
                ->setCreatedAt(Time::now()->getTimestamp())
                ->setMetadata($formMetadata)
                ->setLead($unsortedLead)
                ->setPipelineId($this->amoConf->piplineId)
                ->setContacts($unsortedContactsCollection);

        $formsUnsortedCollection = new FormsUnsortedCollection();
        $formsUnsortedCollection->add($formUnsorted);

        try {
            $add_unsorted_log = $this->apiClient->unsorted()->add($formsUnsortedCollection);
//            log_message('error', '[INFO] {add_unsorted_log}', ['add_unsorted_log' => $add_unsorted_log]);
            return $add_unsorted_log;
        } catch (AmoCRMApiException $e) {
            log_message('error', '[ERROR] {exception} {trase}', ['exception' => $e, 'trase' => $e->getTraceAsString()]);
            return false;
        }
    }

    

}
