<?php

namespace App\Controllers\Api;

use App\Controllers\Api\BaseController;
use AmoCRM\Models\LeadModel;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\Unsorted\FormUnsortedModel;
use AmoCRM\Models\Unsorted\FormsMetadata;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use Ramsey\Uuid\Uuid;
use CodeIgniter\I18n\Time;

/**
 * Description of ClientsRequestsController
 *
 * @author alexey
 */
class ClientsRequestsController extends BaseController {

    //put your code here
    public function send() {
        $return = [
            'success' => false,
            'message' => lang('Site.Popapform.Messages.Error.UndefinedError'),
        ];
        if (!$this->request->isAJAX()) {
            $return['message'] = lang('Site.Popapform.Messages.Error.NotAjax');
            return $this->response->setJSON($return);
        }
        
        // prepare data for amoService
        $this->prepareData();
        
        // if no phone or not valid
        if(!$this->amoService->getContactPhone()){
            $return['message'] = lang('Site.Popapform.Messages.Error.NotValidPhone');
            return $this->response->setJSON($return);
        }
        
        if(!$this->sendUnsorted()){
            $return['message'] = lang('Site.Popapform.Messages.Error.AmoError');
            return $this->response->setJSON($return);
        }
        
        $this->writeLog();
        
        $return['success'] = true;
        $return['message'] = lang('Site.Popapform.Messages.Success.Message');
        return $this->response->setJSON($return);
    }

    /**
     * preparing the amoService data
     * @return void
     */
    private function prepareData(): void{
        // set amoservice vars
        $this->amoService->setUnsortedUid(Uuid::uuid4());
        $this->amoService->setFormId('AvenueIdilika');
        $this->amoService->setFormName(lang('Amo.Titles.FormNameFromSite'));
        $this->amoService->setLeadName(lang('Amo.Titles.LeadNameFromSite'));
        $this->amoService->setContactName($this->request->getPost('name', FILTER_SANITIZE_STRING));
        $this->amoService->setContactPhone($this->request->getPost('phone'));
        $this->amoService->setContactEmail($this->request->getPost('email', FILTER_SANITIZE_EMAIL));
        $this->amoService->setLeadMessage($this->request->getPost('text', FILTER_SANITIZE_STRING));
        $this->amoService->setFormUrl((string) $this->request->uri);
        $this->amoService->setLeadDomain((string) $this->request->uri->getHost());
        $this->amoService->setFormUserIp($this->request->getIPAddress());
        $this->amoService->setLeadUtmSource($this->request->getGet('utm_source', FILTER_SANITIZE_STRING));
        $this->amoService->setLeadUtmMedium($this->request->getGet('utm_medium', FILTER_SANITIZE_STRING));
        $this->amoService->setLeadUtmCampaign($this->request->getGet('utm_campaign', FILTER_SANITIZE_STRING));
        $this->amoService->setLeadUtmTerm($this->request->getGet('utm_term', FILTER_SANITIZE_STRING));
        $this->amoService->setLeadUtmContent($this->request->getGet('utm_content', FILTER_SANITIZE_STRING));
        $this->amoService->setLeadUserAgent($this->request->getUserAgent());

//        $this->amoService->setLeadGacid($this->request->getVar('client_gacid'));
//        $this->amoService->setLeadGclid($this->request->getVar('client_gclid'));
//        $this->amoService->setLeadTypeLead($this->request->getVar('type_lead'));
        
    }

    /**
     * write data to log table
     * @return bool
     */
    private function writeLog(): bool{
        $model = model(ClientsRequestsModel::class);
        $data = [
            'name' => $this->amoService->getContactName(),
            'phone' => $this->amoService->getContactPhone(),
            'email' => $this->amoService->getContactEmail(),
            'text' => $this->amoService->getLeadMessage(),
            'page' => $this->amoService->getFormUrl(),
            'form' => $this->request->getPost('form', FILTER_SANITIZE_STRING),
            'utm_source' => $this->amoService->getLeadUtmSource(),
            'utm_medium' => $this->amoService->getLeadUtmMedium(),
            'utm_campaign' => $this->amoService->getLeadUtmCampaign(),
            'utm_term' => $this->amoService->getLeadUtmTerm(),
            'utm_content' => $this->amoService->getLeadUtmContent(),
            'language' => $this->request->getLocale(),
            'code' => '',
            'status' => $model::STATUS_NEW,
        ];
        return $model->save($data);
    }

    private function sendUnsorted() {

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
            log_message('info', '[INFO] {add_unsorted_log}', ['add_unsorted_log' => $add_unsorted_log]);
        } catch (AmoCRMApiException $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return false;
        }
    }

}
