<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of FloorsImagesModel
 *
 * @author alexey
 */
class FloorsImagesModel extends Model {
    
    const TYPE_COMMERCE = 'commerce';
    const TYPE_LEAVING = 'leaving';
    const TYPE_PANTRY = 'pantry';
    
    protected $table = 'floor_images';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\FloorsImagesEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['image_code', 'image_name', 'image_width', 'section_id', 'order', 'image_height', 'floor_type'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'image_name' => 'required|is_unique[floor_images.image_name,id,{id}]',
        'image_code' => 'required|is_unique[floor_images.image_code,id,{id}]',
        'floor_type' => 'required|in_list['.self::TYPE_COMMERCE.','.self::TYPE_LEAVING.','.self::TYPE_PANTRY.']',
    ];
    protected $validationMessages = [
        'image_name' => [
            'required' => 'Validation.Required.ImageName',
            'is_unique' => 'Validation.IsUnique.ImageName',
        ],
        'image_code' => [
            'required' => 'Validation.Required.ImageCode',
        ],
        'floor_type' => [
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
     * get floor images by section
     * @param int $section_id
     * @return array|null
     */
    public function getSectionFloorsImages(int $section_id): ?array {
        return $this->where('section_id', $section_id)
                        ->get()->getResultArray();
    }

    /**
     * get floor image data
     * @param int $id
     * @return object|null
     */
    public function getImage(?int $id): ?object {
        return $this->where('id', $id)->first();
    }

    /**
     * get the floors for layouts
     * @param int $section_id
     * @return array|null
     */
    public function getSectionsFloorsLayouts(int $section_id): ?array {
        return $this->where('section_id', $section_id)
                        ->where('floor_type', self::TYPE_LEAVING)
                        ->find();
    }

    /**
     * get the floors for commerce
     * @param int $section_id
     * @return array|null
     */
    public function getSectionsFloorsCommerce(int $section_id): ?array {
        return $this->where('section_id', $section_id)
                        ->where('floor_type', self::TYPE_COMMERCE)
                        ->find();
    }

    /**
     * return the chained list id->title of pantry floors layouts images
     * @return array
     */
    public function getFloorsPantryList(): array {
        $floor_type = self::TYPE_PANTRY;
        if (!$found = cache("floors_list_{$floor_type}")) {
            $found = [];
            $items = $this->where('floor_type', $floor_type)->get()->getResultArray();
            foreach ($items as $item) {
                $data = [];
                $data['chained'] = $item['section_id'];
                $data['name'] = $item['image_code'];
                $found[$item['id']] = $data;
            }

            cache()->save("floors_list_{$floor_type}", $found, 0);
        }
        return $found;
    }

    /**
     * return the chained list id->title of commerce floors images
     * @return array
     */
    public function getFloorsCommerceList(): array {
        $floor_type = self::TYPE_COMMERCE;
        if (!$found = cache("floors_list_{$floor_type}")) {
            $found = [];
            $items = $this->where('floor_type', $floor_type)->get()->getResultArray();
            foreach ($items as $item) {
                $data = [];
                $data['chained'] = $item['section_id'];
                $data['name'] = $item['image_code'];
                $found[$item['id']] = $data;
            }

            cache()->save("floors_list_{$floor_type}", $found, 0);
        }
        return $found;
    }

    /**
     * return the chained list id->title of floors images
     * @return array
     */
    public function getFloorsLayoutsList(): array {
        $floor_type = self::TYPE_LEAVING;
        if (!$found = cache("floors_list_{$floor_type}")) {
            $found = [];
            $items = $this->where('floor_type', $floor_type)->get()->getResultArray();
            foreach ($items as $item) {
                $data = [];
                $data['chained'] = $item['section_id'];
                $data['name'] = $item['image_code'];
                $found[$item['id']] = $data;
            }

            cache()->save("floors_list_{$floor_type}", $found, 0);
        }
        return $found;
    }

    /**
     * get list of layout`s floors for filter
     * @return array|null
     */
    public function getFloorsLayoutsFilter(): ?array {
        $floor_type = self::TYPE_LEAVING;
        if (!$found = cache("floors_for_filter_{$floor_type}")) {
            $found = $this->builder()
                            ->select('id, image_code')
                            ->where('floor_type', $floor_type)
                            ->orderBy('image_code', 'ASC')
                            ->get()->getResultArray();

            cache()->save("floors_for_filter_{$floor_type}", $found, 0);
        }
        return $found;
    }

    /**
     * get list of commerce`s floors for filter
     * @return array|null
     */
    public function getFloorsCommerceFilter(): ?array {
        $floor_type = self::TYPE_COMMERCE;
        if (!$found = cache("floors_for_filter_{$floor_type}")) {
            $found = $this->builder()
                            ->select('id, image_code')
                            ->where('floor_type', $floor_type)
                            ->orderBy('image_code', 'ASC')
                            ->get()->getResultArray();

            cache()->save("floors_for_filter_{$floor_type}", $found, 0);
        }
        return $found;
    }

    /**
     * delete caches in callbacks
     * @return array
     */
    protected function deleteCaches(array $data): array {
        cache()->deleteMatching('floors_list*');
        cache()->deleteMatching('floors_for_filter*');
        return $data;
    }

    /**
     * get the floor types
     * @return array
     */
    public function getFloorTypes(): array {
        return [
            self::TYPE_COMMERCE => lang('Admin.List.CommerceType'),
            self::TYPE_LEAVING => lang('Admin.List.LeavingType'),
            self::TYPE_PANTRY => lang('Admin.List.LeavingPangtry'),
        ];
    }

}
