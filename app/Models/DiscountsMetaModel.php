<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of DiscountsMetaModel
 *
 * @author alexey
 */
class DiscountsMetaModel extends Model{
    
    const TYPE_SUM = 'sum';
    const TYPE_PERC = 'perc';
    const TYPE_EMPTY = 'empty';
    
    protected $table = 'discounts_meta';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\DiscountsMetaEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['discount_id', 'entity_id', 'entity_type', 'value_type', 
        'value', 'date_to', 'date_from'];
    // Validation
    protected $validationRules = [
        'entity_id' => 'required',
        'entity_type' => 'required',
    ];
    protected $validationMessages = [
        'entity_id' => [
            'required' => 'Validation.EntityId.Required',
        ],
        'entity_type' => [
            'required' => 'Validation.EntityType.Required',
        ],
    ];
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
    
    /**
     * get the main discount meta
     * @param int $discount_id
     * @return object
     */
    public function getMainDiscount(int $discount_id): object {
        return $this->where('discount_id', $discount_id)
                ->where('entity_type', 'residential')
                ->first();
    }
    
    /**
     * get the values type list
     * @return array
     */
    public function getValueTipes(): array{
        return [
            self::TYPE_EMPTY => lang('Admin.List.Discount.Types.Empty'),
            self::TYPE_PERC => lang('Admin.List.Discount.Types.Perc'),
            self::TYPE_SUM => lang('Admin.List.Discount.Types.Sum'),
        ];
    }
    
    

}
