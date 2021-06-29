<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use AmoCRM\Exceptions\AmoCRMApiException;
use App\Libraries\Amoservice;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\TextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\SelectCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\TrackingDataCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\TextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\SelectCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\TrackingDataCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\TextCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\SelectCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\TrackingDataCustomFieldValueModel;
use AmoCRM\Collections\CustomFieldsValuesCollection;

use AmoCRM\Models\ContactModel;
use AmoCRM\Models\LeadModel;

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
        $gacidFieldValueModel->setFieldId($this->amoConf->leadGacidFieldId);
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
        $gclidFieldValueModel->setFieldId($this->amoConf->leadGclidFieldId);
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
        $utmSourceFieldValueModel->setFieldId($this->amoConf->leadUtmSourceFieldId);
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
        $utmMediumFieldValueModel->setFieldId($this->amoConf->leadUtmMediumFieldId);
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
        $utmTermFieldValueModel->setFieldId($this->amoConf->leadUtmTermFieldId);
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
        $utmContentFieldValueModel->setFieldId($this->amoConf->leadUtmContentFieldId);
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
        $utmCompaingFieldValueModel->setFieldId($this->amoConf->leadUtmCompaingFieldId);
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
        $pageFieldValueModel->setFieldId($this->amoConf->leadPageFieldId);
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
        $domainFieldValueModel->setFieldId($this->amoConf->leadDomainFieldId);
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
        $userAgentFieldValueModel->setFieldId($this->amoConf->leadUserAgentFieldId);
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
        $userIpFieldValueModel->setFieldId($this->amoConf->leadUserIpFieldId);
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
        $typeLeadFieldValueModel->setFieldId($this->amoConf->leadTypeLeadFieldId);
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
//        $lead->setPipelineId($pipelineId);
        $lead->setCustomFieldsValues($this->assignLeadCustomFields());
        try{
            return $this->apiClient->leads()->addOne($lead);
        } catch (AmoCRMApiException $e){
            print_r($e->getLastRequestInfo());
            die($e->getMessage());
        }

    }

}
