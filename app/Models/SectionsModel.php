<?php

namespace App\Models;

use CodeIgniter\Model;
use Cocur\Slugify\Slugify;

class SectionsModel extends Model {

    protected $table = 'sections';
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\SectionsEntity';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['slug', 'section_code', 'residential_id', 'section_build_start', 'section_build_end', 'ceil_height', 'floors_number', 'publish', 'title', 'meta_title', 'description', 'meta_description', 'translation', 'language'];
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
    

    public function getSections(string $language): array {
        try {
            return $this->select('sections.*, sections_translation.title, sections_translation.meta_title, sections_translation.description, sections_translation.meta_description, sections_translation.language')
                            ->join('sections_translation', 'sections_translation.section_id = sections.id', 'inner')
                            ->where('sections_translation.language', $language)
                            ->findAll();
        } catch (\Exception $exc) {
            die($exc->getTraceAsString());
        }
    }
    
    public function getTranslations(int $section_id): array{
        try{
            return $this->db->table('sections_translation')->where('section_id', $section_id)->get()->getResultObject();
        } catch (\Exception $exc) {
            die($exc->getTraceAsString());
        }
    }
    
    /**
     * return the chained list id->title of sections
     * @param string $language
     * @return array
     */
    public function getSectionsList(string $language): array {
        try {
            if (! $found = cache("{$language}_sections_list")){
                $found = [];
                $items = $this->builder()
                        ->select('sections.id, sections.section_code, sections.residential_id, sections_translation.title')
                        ->join('sections_translation', 'sections_translation.section_id = sections.id', 'inner')
                        ->where('sections_translation.language', $language)
                        ->get()->getResultArray();
                
                foreach ($items as $item){
                    $data = [];
                    $data['chained'] = $item['residential_id'];
                    $data['name'] = $item['section_code'];
                    $found[$item['id']] = $data;
                }
                
                cache()->save("{$language}_sections_list", $found, 0);
            }
            return $found;
        } catch (\Exception $exc) {
            die($exc->getTraceAsString());
        }
    }
    
    public function createSection(array $data): int {
        $appConfig = config('App');
        // insert the data about section
        try {
            $section_id = $this->insert($this->retrieveMainData($data), true);
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        // insert translations
        $translations = [];
        foreach ($data['translation'] as $language => $translation) {
            if (!in_array($language, $appConfig->supportedLocales)) {
                continue;
            }
            $translations[] = $this->retrieveTranslationData($section_id, $language, $translation);
        }
        if (empty($translations)) {
            throw new Exception('there must be the translations');
        }
        try {
            $this->db->table('sections_translation')->insertBatch($translations);
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        return $section_id;
        
    }
    
    protected function retrieveMainData(array $data): array {
        
        $appConfig = config('App');
        $slugify = new Slugify();
        if(!isset($data['slug']) || empty($data['slug'])){
            $data['slug'] = isset($data['translation'][$appConfig->defaultLocale]['title']) ? $data['translation'][$appConfig->defaultLocale]['title'] : substr(str_shuffle(MD5(microtime())), 0, 10);
        }
        
        $retrieved = [
            'slug' => $slugify->slugify($data['slug']),
            'section_build_start' => $data['section_build_start'],
            'section_build_end' => $data['section_build_end'],
            'section_code' => $data['section_code'],
            'residential_id' => $data['residential_id'],
            'ceil_height' => $data['ceil_height'],
            'floors_number' => $data['floors_number'],
            'publish' => !isset($data['publish']) ? self::UNPUBLISH : self::PUBLISH,
        ];
        return $retrieved;
    }
    
    protected function retrieveTranslationData(int $section_id, string $language, array $data): array {
        $retrieved = [
            'section_id' => $section_id,
            'language' => $language,
            'title' => $data['title'],
            'meta_title' => $data['meta_title'],
            'description' => $data['description'],
            'meta_description' => $data['meta_description'],
        ];
        return $retrieved;
        
    }

}
