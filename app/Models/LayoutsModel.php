<?php

namespace App\Models;

use CodeIgniter\Model;
use Cocur\Slugify\Slugify;


class LayoutsModel extends Model {

    protected $table = 'layouts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\LayoutsEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['code', 'slug', 'residential_id', 'section_id', 'image_2d', 'image_3d', 'image_other', 'file_to_upload', 'rooms', 'levels', 'ceil_height', 'all_area', 'live_area', 'kit_area', 'balcon', 'advertise', 'sold_out', 'publish', 'price', 'floor_images_id', 'poligon', 'language', 'title', 'meta_title', 'description', 'meta_description'];
    // Dates
    protected $useTimestamps = false;
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

    const PUBLISH = 1;
    const UNPUBLISH = 0;
    
    /**
     * get by curren slug
     * @param string $slug
     * @param string $language
     * @return object
     */
    public function getLayoutBySlug(string $slug, string $language): object{
        try {
            return $this->select('layouts.*, layouts_translation.title, layouts_translation.meta_title, layouts_translation.description, layouts_translation.meta_description, layouts_translation.language')
                    ->joint('layouts_translation', 'layouts_translation.layout_id = layouts.id', 'inner')
                    ->where('layouts.slug', $slug)
                    ->where('layouts_translation.language', $language)
                    ->findAll();
        } catch (\Exception $exc) {
            die($exc->getTraceAsString());
        }
    }
    
    /**
     * get layouts list
     * @param string $language
     * @return array
     */
    public function getLayouts(string $language): array{
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
        } catch (\Exception $exc) {
            die($exc->getTraceAsString());
        }
    }
    
    /**
     * cretating the residential
     * @param array $data
     * @return int
     */
    public function createLayout(array $data): int {
        $appConfig = config('App');
        // insert the data about complex
        try {
            $layout_id = $this->insert($this->retrieveMainData($data), true);
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        // insert translations
        $translations = [];
        foreach ($data['translation'] as $language => $translation) {
            if (!in_array($language, $appConfig->supportedLocales)) {
                continue;
            }
            $translations[] = $this->retrieveTranslationData($layout_id, $language, $translation);
        }
        if (empty($translations)) {
            throw new Exception('there must be the translations');
        }
        try {
            $this->db->table('layouts_translation')->insertBatch($translations);
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        return $layout_id;
    }
    
    /**
     * retrieving the main data for complex table
     * @param array $data
     * @return array
     */
    protected function retrieveMainData(array $data): array {
        
        $appConfig = config('App');
        $slugify = new Slugify();
        if(!isset($data['slug']) || empty($data['slug'])){
            $data['slug'] = isset($data['code']) ? $data['code'] : substr(str_shuffle(MD5(microtime())), 0, 10);
        }
        
        $retrieved = [
            'code' => $data['code'],
            'slug' => $slugify->slugify($data['slug']),
            'residential_id' => (int)$data['residential_id'],
            'section_id' => (int)$data['section_id'],
            'floor_images_id' => (int)$data['floor_images_id'],
            'image_2d' => $data['image_2d'] ?? null,
            'image_3d' => $data['image_3d'] ?? null,
            'image_other' => $data['image_other'] ?? null,
            'file_to_upload' => $data['file_to_upload'] ?? null,
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
            'poligon' => $data['poligon'] ?? null,
            'publish' => !isset($data['publish']) ? self::UNPUBLISH : self::PUBLISH,
        ];
        return $retrieved;
    }

    /**
     * retreive the translation data
     * @param int $residential_id
     * @param string $language
     * @param array $data
     * @return array
     */
    protected function retrieveTranslationData(int $layout_id, string $language, array $data): array {
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
