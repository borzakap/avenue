<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of ProgressImagesModel
 *
 * @author alexey
 */
class ProgressImagesModel extends Model {
    
    const MAIN = 1;

    protected $table = 'progress_images';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\ProgressImagesEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['image_name', 'image_width', 'image_height', 'progress_id', 'main', 'order'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'image_name' => 'required|is_unique[progress_images.image_name]',
    ];
    protected $validationMessages = [
        'image_name' => [
            'required' => 'Validation.Required.ImageName',
            'is_unique' => 'Validation.IsUnique.ImageName',
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
     * get images by progress
     * @param int $progress_id
     * @return array|null
     */
    public function getImages(int $progress_id): ?array {
        return $this->where('progress_id', $progress_id)
                        ->find();
    }

    /**
     * get main image 
     * @param int $progress_id
     * @return object|null
     */
    public function getMainImage(int $progress_id): ?object{
        return $this->where('progress_id', $progress_id)
                ->where('main', self::MAIN)
                ->first();
    }

}
