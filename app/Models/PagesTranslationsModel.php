<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of PagesTranslationsModel
 *
 * @author alexey
 */
class PagesTranslationsModel extends Model {

    protected $table = 'static_pages_translation';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\PagesTranslationsEntity';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = ['slug', 'language', 'code', 'text'];
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
     * get translations array for current page and lagnuage
     * @param string $slug
     * @param string $language
     * @return type
     */
    public function getTranslationBySlug(string $slug, string $language) {
//        if(!$found = cache("progress_{$residential_id}")){
//            
//        }
        return $this->select('*')
                        ->where('slug', $slug)
                        ->where('language', $language)
                        ->findAll();
    }

    /**
     * get translation for editing
     * @param string $slug
     * @return object|boolen
     */
    public function getTranslations(string $slug) {
        return $this->select('*')
                        ->where('slug', $slug)
                        ->findAll();
    }

    /**
     * updating translation
     * @param array $data
     * @param string $slug
     * @return bool
     */
    public function updateTranslations(array $data, string $slug): bool {
        foreach ($data['translation'] as $language => $translation) {
            foreach ($translation as $code => $text) {
                $insert = $this->formatTranslation($code, $language, $text, $slug);
                $this->replace($insert);
            }
        }
        // delete translation cahe
        cache()->deleteMatching('*_translation');
        return true;
    }

    /**
     * formating data for insertBatch
     * @param string $code
     * @param string $language
     * @param string $text
     * @param string $slug
     * @return array
     */
    protected function formatTranslation(string $code, string $language, string $text, string $slug): array {
        return [
            'slug' => $slug,
            'language' => $language,
            'code' => $code,
            'text' => $text,
        ];
    }

}
