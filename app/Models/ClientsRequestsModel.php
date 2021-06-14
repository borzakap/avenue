<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of ClientsRequestsModel
 *
 * @author alexey
 */
class ClientsRequestsModel extends Model {

    protected $table = 'clients_requests';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\ClientsRequestsEntity';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'phone', 'email', 'text', 'page', 'form', 'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'language', 'code', 'status'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    const STATUS_NEW = 1;

}
