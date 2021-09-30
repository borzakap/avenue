<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TranslationInterface;
use Cocur\Slugify\Slugify;


class LayoutsModel extends Model implements TranslationInterface{

    protected $table = 'layouts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\LayoutsEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['code', 'slug', 'residential_id', 'section_id', 'image_2d', 'image_3d', 'image_other', 'file_to_upload', 'rooms', 'levels', 'ceil_height', 'all_area', 'live_area', 'kit_area', 'balcon', 'advertise', 'sold_out', 'publish', 'price', 'floor_images_id', 'poligon', 'language', 'title', 'meta_title', 'description', 'meta_description', 'plans_images_id', 'plan_poligon'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'slug' => 'required|min_length[2]|max_length[20]|alpha_dash|is_unique[layouts.slug,id,{id}]',
        'residential_id' => 'required',
        'section_id' => 'required',
        'code' => 'required',
    ];
    protected $validationMessages = [
        'slug' => [
            'is_unique' => 'Validation.Unique.Slug',
            'required' => 'Validation.Required.Slug',
            'min_length' => 'Validation.MinLength.Slug',
            'max_length' => 'Validation.MaxLength.Slug',
        ],
        'residential_id' => [
            'required' => 'Validation.ResidentialId.Required',
        ],
        'section_id' => [
            'required' => 'Validation.SectionId.Required',
        ],
        'code' => [
            'required' => 'Validation.Code.Required',
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

    const PUBLISH = 1;
    const UNPUBLISH = 0;
    
    /**
     * get by curren slug
     * @param string $slug
     * @param string $language
     * @return object|null
     */
    public function getBySlug(string $slug, string $language): ?object
    {
        try {
            return $this->select('layouts.*, layouts_translation.title, layouts_translation.meta_title, layouts_translation.description, layouts_translation.meta_description, layouts_translation.language')
                    ->join('layouts_translation', 'layouts_translation.layout_id = layouts.id', 'inner')
                    ->where('layouts.slug', $slug)
                    ->where('layouts_translation.language', $language)
                    ->first();
        } catch (\Exception $exc) {
            die($exc->getTraceAsString());
        }
    }
    
    /**
     * get layouts list
     * @param string $language
     * @return array
     */
    public function getList(string $language, array $params = []): array{
        try {
            return $this->select('layouts.*, layouts_translation.title, layouts_translation.meta_title, layouts_translation.description, layouts_translation.meta_description, layouts_translation.language')
                    ->join('layouts_translation', 'layouts_translation.layout_id = layouts.id', 'inner')
                    ->where('layouts_translation.language', $language)
                    ->findAll();
        } catch (\Exception $e) {
            die($e->getTraceAsString());
        }
    }

    /**
     * get translations by layout_id
     * @param int $layout_id
     * @return object
     */
    public function getTranslations(int $layout_id): array {
        try {
            return $this->db->table('layouts_translation')->where('layout_id', $layout_id)->get()->getResultObject();
        } catch (\Exception $e) {
            die($e->getTraceAsString());
        }
    }
    
    /**
     * get layouts poligon and other data for floor image
     * @param int $floor_images_id
     * @return array|null
     */
    public function getPoligons(int $floor_images_id): ?array
    {
        try {
            return $this->where('floor_images_id', $floor_images_id)->findAll();
        } catch (\Exception $e) {
            die($e->getTraceAsString());
        }
    }

    /**
     * get layouts genplan poligon and other data for floor image
     * @param int $plans_images_id
     * @return array|null
     */
    public function getPlanPoligons(int $plans_images_id): ?array
    {
        try {
            return $this->where('plans_images_id', $plans_images_id)->findAll();
        } catch (\Exception $e) {
            die($e->getTraceAsString());
        }
    }

    /**
     * cretating the layout
     * @param array $data
     * @return int
     */
    public function createItem(array $data): int 
    {
        try {
            $item_id = $this->insert($this->retrieveMainData($data), true);
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        // insert translations
        $translations = [];
        foreach ($data['translation'] as $language => $translation) {
            if (!in_array($language, config(App::class)->supportedLocales)) {
                continue;
            }
            $translations[] = $this->retrieveTranslation($item_id, $language, $translation);
        }
        if (empty($translations)) {
            throw new Exception('there must be the translations');
        }
        try {
            $this->db->table('layouts_translation')->insertBatch($translations);
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        return $item_id;
    }
    
    /**
     * updating layout
     * @param int $item_id
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function updateItem(int $item_id, array $data): int{
        // update layout
        if(!$this->update($item_id, $this->retrieveMainData($data, $item_id))){
            return false;
        }
        // insert translations
        $translations = [];
        foreach ($data['translation'] as $language => $translation) {
            if (!in_array($language, config(App::class)->supportedLocales)) {
                continue;
            }
            $translations[] = $this->retrieveTranslation($item_id, $language, $translation);
        }
        if (empty($translations)) {
            throw new Exception('there must be the translations');
        }
        try {
            foreach($translations as $translation){
                $this->db->table('layouts_translation')->replace($translation);
            }
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        return $item_id;
    }

    /**
     * retrieving the main data for complex table
     * @param array $data
     * @return array|null
     */
    public function retrieveMainData(array $data, int $id = 0): ?array 
    {
        $slugify = new Slugify();
        if(!isset($data['slug']) || empty($data['slug'])){
            $data['slug'] = isset($data['code']) ? $data['code'] : substr(str_shuffle(MD5(microtime())), 0, 10);
        }
        
        $retrieved = [
            'id' => $id,
            'code' => $data['code'],
            'slug' => $slugify->slugify($data['slug']),
            'rooms' => (int)$data['rooms'],
            'levels' => (int)$data['levels'],
            'ceil_height' => $data['ceil_height'],
            'all_area' => $data['all_area'],
            'live_area' => $data['live_area'],
            'kit_area' => $data['kit_area'],
            'balcon' => $data['balcon'] ?? 0,
            'advertise' => $data['advertise'] ?? 0,
            'sold_out' => $data['sold_out'] ?? 0,
            'price' => $data['price'],
            'residential_id' => (int)$data['residential_id'],
            'section_id' => (int)$data['section_id'],
            'floor_images_id' => (int)$data['floor_images_id'],
            'plans_images_id' => (int)$data['plans_images_id'],
            'publish' => !isset($data['publish']) ? self::UNPUBLISH : self::PUBLISH,
        ];
        return $retrieved;
    }

    /**
     * retreive the translation data
     * @param int $layout_id
     * @param string $language
     * @param array $data
     * @return array
     */
    public function retrieveTranslation(int $layout_id, string $language, array $data): array {
        $retrieved = [
            'layout_id' => $layout_id,
            'language' => $language,
            'title' => $data['title'],
            'meta_title' => $data['meta_title'],
            'description' => $data['description'],
            'meta_description' => $data['meta_description'],
        ];
        return $retrieved;
        
    }

}
