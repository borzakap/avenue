<?php

namespace App\Models;

use CodeIgniter\Model;
use Cocur\Slugify\Slugify;
use App\Models\TranslationInterface;

class ResidentialsModel extends Model implements TranslationInterface {

    protected $table = 'residentials';
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\ResidentialsEntity';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['slug', 'residential_build_start', 'residential_build_end', 'latitude', 'longitude', 'ceil_height', 'floors_number', 'publish', 'title', 'meta_title', 'description', 'meta_description', 'address', 'translation', 'language'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'slug' => 'required|min_length[3]|max_length[15]|alpha_dash|is_unique[residentials.slug,id,{id}]',
        'ceil_height' => 'decimal',
    ];
    protected $validationMessages = [
        'slug' => [
            'required' => 'Validation.slug.required',
            'min_length' => 'Validation.slug.minlength',
            'max_length' => 'Validation.slug.alphadash',
            'is_unique' => 'Validation.slug.isunique'
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
            return $this->select('residentials.*, residentials_translation.title, residentials_translation.meta_title, residentials_translation.description, residentials_translation.meta_description, residentials_translation.address, residentials_translation.language')
                    ->join('residentials_translation', 'residentials_translation.residential_id = residentials.id', 'inner')
                    ->where('residentials.slug', $slug)
                    ->where('residentials_translation.language', $language)
                    ->first();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
    
    /**
     * get residentials list
     * @param string $language
     * @return array
     */
    public function getList(string $language, array $params = []): array
    {
        try {
            return $this->select('residentials.*, residentials_translation.title, residentials_translation.meta_title, residentials_translation.description, residentials_translation.meta_description, residentials_translation.address, residentials_translation.language')
                    ->join('residentials_translation', 'residentials_translation.residential_id = residentials.id', 'inner')
                    ->where('residentials_translation.language', $language)
                    ->findAll();
        } catch (\Exception $e) {
            die($e->getTraceAsString());
        }
    }

    /**
     * get translations by residential_id
     * @param int $residential_id
     * @return object
     */
    public function getTranslations(int $residential_id): array{
        try{
            return $this->db->table('residentials_translation')->where('residential_id', $residential_id)->get()->getResultObject();
        } catch (\Exception $exc) {
            die($exc->getTraceAsString());
        }
    }
    
    /**
     * cretating the residential
     * @param array $data
     * @return int
     */
    public function createItem(array $data): int 
    {
        $appConfig = config('App');
        // insert the data about complex
        try {
            $residential_id = $this->insert($this->retrieveMainData($data), true);
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        // insert translations
        $translations = [];
        foreach ($data['translation'] as $language => $translation) {
            if (!in_array($language, $appConfig->supportedLocales)) {
                continue;
            }
            $translations[] = $this->retrieveTranslation($residential_id, $language, $translation);
        }
        if (empty($translations)) {
            throw new Exception('there must be the translations');
        }
        try {
            $this->db->table('residentials_translation')->insertBatch($translations);
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        return $residential_id;
    }

    /**
     * updating section
     * @param int $item_id
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function updateItem(int $item_id, array $data): int
    {
        // update layout
        try {
            $this->update($item_id, $this->retrieveMainData($data, $item_id));
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
            foreach($translations as $translation){
                $this->db->table('sections_translation')->replace($translation);
            }
//            $this->db->table('layouts_translation')->updateBatch($translations, 'layout_id');
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        return $item_id;
    }
    
    
    /**
     * retrieving the main data for complex table
     * @param array $data
     * @return array
     */
    public function retrieveMainData(array $data, int $id = 0): array {
        
        $appConfig = config('App');
        $slugify = new Slugify();
        if(!isset($data['slug']) || empty($data['slug'])){
            $data['slug'] = isset($data['translation'][$appConfig->defaultLocale]['title']) ? $data['translation'][$appConfig->defaultLocale]['title'] : substr(str_shuffle(MD5(microtime())), 0, 10);
        }
        
        $retrieved = [
            'id' => $id,
            'slug' => $slugify->slugify($data['slug']),
            'residential_build_start' => $data['residential_build_start'],
            'residential_build_end' => $data['residential_build_end'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'ceil_height' => $data['ceil_height'],
            'floors_number' => $data['floors_number'],
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
    public function retrieveTranslation(int $residential_id, string $language, array $data): array {
        $retrieved = [
            'residential_id' => $residential_id,
            'language' => $language,
            'title' => $data['title'],
            'meta_title' => $data['meta_title'],
            'description' => $data['description'],
            'meta_description' => $data['meta_description'],
            'address' => $data['address'],
        ];
        return $retrieved;
        
    }
    
    /**
     * return the list id->title of residential
     * @param string $language
     * @return array
     */
    public function getResidentialsList(string $language): array {
        try {
            if (! $found = cache("{$language}_residentials_list")){
                $found = [];
                $residentials = $this->builder()
                        ->select('residentials.id, residentials_translation.title')
                        ->join('residentials_translation', 'residentials_translation.residential_id = residentials.id', 'inner')
                        ->where('residentials_translation.language', $language)
                        ->get()->getResultArray();
                
                foreach ($residentials as $residential){
                    $found[$residential['id']] = $residential['title'];
                }
                
                cache()->save("{$language}_residentials_list", $found, 0);
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
        $appConfig = config('App');
        // delete the Residentials list cache
        foreach($appConfig->supportedLocales as $language){
            cache()->delete("{$language}_residentials_list");
        }
        return $data;
    }


}
