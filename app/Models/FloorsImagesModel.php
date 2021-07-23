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
    protected $allowedFields = ['image_src', 'image_code', 'image_name', 'image_width', 'section_id', 'order', 'image_height'];
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
    protected $afterInsert = ['deleteCaches'];
    protected $beforeUpdate = [];
    protected $afterUpdate = ['deleteCaches'];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = ['deleteCaches'];
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
    
    /**
     * get layouts poligon and other data for floor image
     * @param int $floor_images_id
     * @return array
     */
    public function getPoligons(int $floor_images_id): array{
        try {
            return $this->db->table('layouts')->where('floor_images_id', $floor_images_id)->get()->getResultObject();
        } catch (Exception $e) {
            die($e->getTraceAsString());
        }
    }
    
    
    
    /**
     * return the chained list id->title of floors images
     * @param string $language
     * @return array
     */
    public function getFloorsList(): array {
        try {
            if (! $found = cache("floors_list")){
                $found = [];
                $items = $this->get()->getResultArray();
                foreach ($items as $item){
                    $data = [];
                    $data['chained'] = $item['section_id'];
                    $data['name'] = $item['image_code'];
                    $found[$item['id']] = $data;
                }
                
                cache()->save("floors_list", $found, 0);
            }
            return $found;
        } catch (\Exception $exc) {
            die($exc->getTraceAsString());
        }
    }
    
    /**
     * delete caches in callbacks
     * @return array
     */
    protected function deleteCaches(array $data): array{
        cache()->delete('floors_list');
        return $data;
    }
    
}
