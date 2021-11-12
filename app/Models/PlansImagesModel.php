<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of FloorsImagesModel
 *
 * @author alexey
 */
class PlansImagesModel extends Model {
    
    const TYPE_COMMERCE = 'commerce';
    const TYPE_LEAVING = 'leaving';
    const TYPE_PANTRY = 'pantry';
    
    protected $table = 'plans_images';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\PlansImagesEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['image_name', 'image_width', 'residential_id', 'order', 'image_height', 'plan_type', 'image_code'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'image_name' => 'required|is_unique[floor_images.image_name]',
        'plan_type' => 'required|in_list['.self::TYPE_COMMERCE.','.self::TYPE_LEAVING.','.self::TYPE_PANTRY.']',
    ];
    protected $validationMessages = [
        'image_name' => [
            'required' => 'Validation.Required.ImageName',
            'is_unique' => 'Validation.IsUnique.ImageName',
        ],
        'plan_type' => [
            'required' => 'Validation.Required.FloorType',
            'in_list' => 'Validation.InList.FloorType',
        ],
    ];
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
    protected $beforeDelete = [];
    protected $afterDelete = ['deleteCaches'];
    
    /**
     * get plans images by residential
     * @param int $residential_id
     * @return array|null
     */
    public function getImages(int $residential_id): ?array
    {
        return $this->where('residential_id', $residential_id)
                ->find();
    }
    
    /**
     * get plan image data
     * @param int $id
     * @return object|null
     */
    public function getImage(?int $id): ?object
    {
        return $this->where('id', $id)->first();
    }

    /**
     * get the floors for layouts
     * @param int $residential_id
     * @return array|null
     */
    public function getPlanLayouts(int $residential_id): ?array
    {
        return $this->where('residential_id', $residential_id)
                ->where('plan_type', self::TYPE_LEAVING)
                ->find();
    }
    
    /**
     * get the floors for commerce
     * @param int $residential_id
     * @return array|null
     */
    public function getPlanCommerce(int $residential_id): ?array
    {
        return $this->where('residential_id', $residential_id)
                ->where('plan_type', self::TYPE_COMMERCE)
                ->find();
    }
    
    /**
     * return the chained list id->title of pantry floors layouts images
     * @return array
     */
    public function getFloorsPantryList(): array 
    {
        $plan_type = self::TYPE_PANTRY;
        if (! $found = cache("plans_list_{$plan_type}")){
            $found = [];
            $items = $this->where('plan_type', $plan_type)->get()->getResultArray();
            foreach ($items as $item){
                $data = [];
                $data['chained'] = $item['residential_id'];
                $data['name'] = $item['image_code'];
                $found[$item['id']] = $data;
            }

            cache()->save("plans_list_{$plan_type}", $found, 0);
        }
        return $found;
    }
    
    /**
     * return the chained list id->title of commerce floors images
     * @return array
     */
    public function getFloorsCommerceList(): array 
    {
        $plan_type = self::TYPE_COMMERCE;
        if (! $found = cache("plans_list_{$plan_type}")){
            $found = [];
            $items = $this->where('plan_type', $plan_type)->get()->getResultArray();
            foreach ($items as $item){
                $data = [];
                $data['chained'] = $item['residential_id'];
                $data['name'] = $item['image_code'];
                $found[$item['id']] = $data;
            }

            cache()->save("plans_list_{$plan_type}", $found, 0);
        }
        return $found;
    }

    /**
     * return the chained list id->title of floors images
     * @return array
     */
    public function getFloorsLayoutsList(): array 
    {
        $plan_type = self::TYPE_LEAVING;
        if (! $found = cache("plans_list_{$plan_type}")){
            $found = [];
            $items = $this->where('plan_type', $plan_type)->get()->getResultArray();
            foreach ($items as $item){
                $data = [];
                $data['chained'] = $item['residential_id'];
                $data['name'] = $item['image_code'];
                $found[$item['id']] = $data;
            }

            cache()->save("plans_list_{$plan_type}", $found, 0);
        }
        return $found;
    }

    /**
     * get the floor types
     * @return array
     */
    public function getTypes() :array
    {
        return [
            self::TYPE_COMMERCE => lang('Admin.List.CommerceType'),
            self::TYPE_LEAVING => lang('Admin.List.LeavingType'),
            self::TYPE_PANTRY => lang('Admin.List.LeavingPangtry'),
        ];
    }
    
    /**
     * delete caches in callbacks
     * @return array
     */
    protected function deleteCaches(array $data): array
    {
        cache()->deleteMatching('plans_list*');
        return $data;
    }
    
    
}
