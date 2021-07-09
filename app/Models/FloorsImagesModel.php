<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of FloorsImagesModel
 *
 * @author alexey
 */
class FloorsImagesModel extends Model {
    protected $table = 'floor_images';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\FloorsImagesEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['image_src', 'image_code', 'image_name', 'image_mime', 'section_id', 'order', 'image_size'];
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
    
    /**
     * get floor images by section
     * @param int $section_id
     * @return object
     */
    public function getSectionFloorsImages(int $section_id){
        try{
            return $this->where('section_id', $section_id)
                    ->get()->getResultArray();
        } catch (Exception $e) {
            die($e->getTraceAsString());
        }
    }
    
    
}
