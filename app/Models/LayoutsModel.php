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
    protected $allowedFields = ['code', 'slug', 'residential_id', 'section_id', 'image_2d', 'image_3d', 'image_other', 'file_to_upload', 'rooms', 'levels', 'ceil_height', 'all_area', 'live_area', 'kit_area', 'balcon', 'advertise', 'sold_out', 'publish', 'price', 'floor_images_id', 'poligon', 'language', 'title', 'meta_title', 'description', 'meta_description'];
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
     * @return array
     */
    public function getPoligons(int $floor_images_id): array
    {
        try {
            return $this->where('floor_images_id', $floor_images_id)->findAll();
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
        $appConfig = config('App');
        // insert the data about layout
        $main = $this->retrieveMainData($data);

        try {
            $layout_id = $this->insert($main, true);
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
     * updating layout
     * @param int $layout_id
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function updateItem(int $layout_id, array $data): int{
        $appConfig = config('App');
        // update layout
        try {
            $this->update($layout_id, $this->retrieveMainData($data));
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        // insert translations
        $translations = [];
        foreach ($data['translation'] as $language => $translation) {
            if (!in_array($language, $appConfig->supportedLocales)) {
                continue;
            }
            $translations[] = $this->retrieveTranslation($layout_id, $language, $translation);
        }
        if (empty($translations)) {
            throw new Exception('there must be the translations');
        }
        try {
            foreach($translations as $translation){
                $this->db->table('layouts_translation')->replace($translation);
            }
//            $this->db->table('layouts_translation')->updateBatch($translations, 'layout_id');
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
    public function retrieveMainData(array $data): array 
    {
        
        $appConfig = config('App');
        $slugify = new Slugify();
        if(!isset($data['slug']) || empty($data['slug'])){
            $data['slug'] = isset($data['code']) ? $data['code'] : substr(str_shuffle(MD5(microtime())), 0, 10);
        }
        
        $retrieved = [
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
