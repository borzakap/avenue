<?php

namespace App\Models;

use CodeIgniter\Model;
use Cocur\Slugify\Slugify;
use App\Models\TranslationInterface;

class SectionsModel extends Model implements TranslationInterface{

    protected $table = 'sections';
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\SectionsEntity';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['slug', 'section_code', 'residential_id', 'section_build_start', 'section_build_end', 'ceil_height', 'floors_number', 'leaving_poligon', 'commerce_poligon', 'pantry_poligon', 'publish', 'title', 'meta_title', 'description', 'meta_description', 'translation', 'language'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'slug' => 'required|min_length[5]|max_length[15]|alpha_dash|is_unique[sections.slug,id,{id}]',
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
     * get section data by slug and language (frontend)
     * @param string $slug
     * @param string $language
     * @return object|null
     */
    public function getBySlug(string $slug, string $language): ?object {
        return $this->select('sections.*, sections_translation.title, sections_translation.meta_title, sections_translation.description, sections_translation.meta_description, sections_translation.language')
                        ->join('sections_translation', 'sections_translation.section_id = sections.id', 'inner')
                        ->where('sections_translation.language', $language)
                        ->where('sections.slug', $slug)
                        ->first();
    }

    /**
     * get list of sections
     * @param string $language
     * @param array $params
     * @return array|null
     */
    public function getList(string $language, array $params = []): ?array {
        return $this->select('sections.*, sections_translation.title, sections_translation.meta_title, sections_translation.description, sections_translation.meta_description, sections_translation.language')
                        ->join('sections_translation', 'sections_translation.section_id = sections.id', 'inner')
                        ->where('sections_translation.language', $language)
                        ->findAll();
    }

    /**
     * get section`s translation
     * @param int $section_id
     * @return array
     */
    public function getTranslations(int $section_id): array {
        return $this->db->table('sections_translation')
                        ->where('section_id', $section_id)
                        ->get()->getResultObject();
    }

    /**
     * create the section
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function createItem(array $data): int {
        $appConfig = config(App::class);
        // insert the data about section
        $section_id = $this->insert($this->retrieveMainData($data), true);
        // insert translations
        $translations = [];
        foreach ($data['translation'] as $language => $translation) {
            if (!in_array($language, $appConfig->supportedLocales)) {
                continue;
            }
            $translations[] = $this->retrieveTranslation($section_id, $language, $translation);
        }
        if (empty($translations)) {
            throw new Exception('there must be the translations');
        }
        $this->db->table('sections_translation')->insertBatch($translations);
        return $section_id;
    }

    /**
     * updating section
     * @param int $item_id
     * @param array $data
     * @return int|null
     * @throws Exception
     */
    public function updateItem(int $item_id, array $data): ?int {
        // update layout
        if(!$this->update($item_id, $this->retrieveMainData($data, $item_id))){
            return null;
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
        foreach ($translations as $translation) {
            $this->db->table('sections_translation')->replace($translation);
        }
        return $item_id;
    }

    /**
     * get main data from post 
     * @param array $data
     * @param int $id
     * @return array
     */
    public function retrieveMainData(array $data, int $id = 0): array {
        $slugify = new Slugify();
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = isset($data['translation'][config(App::class)->defaultLocale]['title']) ? $data['translation'][config(App::class)->defaultLocale]['title'] : substr(str_shuffle(MD5(microtime())), 0, 10);
        }

        $retrieved = [
            'id' => $id,
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

    /**
     * get translations data from post
     * @param int $section_id
     * @param string $language
     * @param array $data
     * @return array
     */
    public function retrieveTranslation(int $section_id, string $language, array $data): array {
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

    /**
     * find the section by id
     * @param int $id
     * @param string $language
     * @return object|null
     */
    public function findItem(int $id, string $language): ?object {
        return $this->select('sections.*, sections_translation.title, sections_translation.meta_title, sections_translation.description, sections_translation.meta_description, sections_translation.language')
                        ->join('sections_translation', 'sections_translation.section_id = sections.id', 'inner')
                        ->where('sections_translation.language', $language)
                        ->where('sections.id', $id)
                        ->first();
    }

    /**
     * find the sections by residential
     * @param int $residential_id
     * @param string $language
     * @return array|null
     */
    public function findSections(int $residential_id, string $language): ?array {
        return $this->select('sections.*, sections_translation.title, sections_translation.meta_title, sections_translation.description, sections_translation.meta_description, sections_translation.language')
                        ->join('sections_translation', 'sections_translation.section_id = sections.id', 'inner')
                        ->where('sections_translation.language', $language)
                        ->where('sections.residential_id', $residential_id)
                        ->findAll();
    }

    /**
     * return the chained list id->title of sections
     * @param string $language
     * @return array
     */
    public function getSectionsList(string $language): array {
        if (!$found = cache("sections_list_{$language}")) {
            $found = [];
            $items = $this->builder()
                            ->select('sections.id, sections.section_code, sections.residential_id, sections_translation.title')
                            ->join('sections_translation', 'sections_translation.section_id = sections.id', 'inner')
                            ->where('sections_translation.language', $language)
                            ->get()->getResultArray();

            foreach ($items as $item) {
                $data = [];
                $data['chained'] = $item['residential_id'];
                $data['name'] = $item['section_code'];
                $found[$item['id']] = $data;
            }

            cache()->save("sections_list_{$language}", $found, 0);
        }
        return $found;
    }

    /**
     * get sections for filter
     * @param int $residential_id
     * @return array|null
     */
    public function getSectionsListFilter(int $residential_id): ?array {
        if (!$found = cache("sections_for_filter_{$residential_id}")) {
            $found = $this->builder()
                            ->select('id, section_code')
                            ->where('residential_id', $residential_id)
                            ->orderBy('section_code', 'ASC')
                            ->get()->getResultArray();
            cache()->save("sections_for_filter_{$residential_id}", $found, 0);
        }
        return $found;
    }

    /**
     * delete caches in callbacks
     * @return array
     */
    protected function deleteCaches(array $data): array {
        cache()->deleteMatching('sections_list*');
        cache()->deleteMatching('sections_for_filter*');
        return $data;
    }
    
    
}
