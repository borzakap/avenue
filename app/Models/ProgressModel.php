<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TranslationInterface;
use Cocur\Slugify\Slugify;

/**
 * Description of ProgressModel
 *
 * @author alexey
 */
class ProgressModel extends Model implements TranslationInterface{
    
    const YES = 1;
    const NO = 0;

    protected $table = 'progress';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\ProgressEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['slug', 'residential_id', 'video', 'progressed_at', 'publish'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'slug' => 'required|min_length[2]|max_length[20]|alpha_dash|is_unique[progress.slug,id,{id}]',
        'residential_id' => 'required',
    ];
    protected $validationMessages = [
        'slug' => [
            'is_unique' => 'Validation.Slug.Unique',
            'required' => 'Validation.Slug.Required',
            'min_length' => 'Validation.Slug.MinLength',
        ],
        'residential_id' => [
            'required' => 'Validation.ResidentialId.Required',
        ],
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = ['deleteNavigation'];
    protected $beforeUpdate = [];
    protected $afterUpdate = ['deleteNavigation'];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = ['deleteNavigation'];

    /**
     * get by curren slug
     * @param string $slug
     * @param string $language
     * @return object|null
     */
    public function getBySlug(string $slug, string $language): ?object {
        return $this->select('progress.*, progress_translation.title, progress_translation.meta_title, progress_translation.description, progress_translation.meta_description, progress_translation.language, residentials.slug as residential_slug, residentials_translation.title as residential_title')
                        ->join('progress_translation', 'progress_translation.progress_id = progress.id', 'inner')
                        ->join('residentials', 'residentials.id = progress.residential_id', 'inner')
                        ->join('residentials_translation', 'residentials_translation.residential_id = residentials.id', 'inner')
                        ->where('progress.slug', $slug)
                        ->where('progress_translation.language', $language)
                        ->where('residentials_translation.language', $language)
                        ->first();
    }

    /**
     * get progress list
     * @param string $language
     * @return array|null
     */
    public function getList(string $language, array $params = []): ?array {
        $list = $this->select('progress.*, progress_translation.title, progress_translation.meta_title, progress_translation.description, progress_translation.meta_description, progress_translation.language')
                        ->join('progress_translation', 'progress_translation.progress_id = progress.id', 'inner')
                        ->where('progress_translation.language', $language)
                        ->orderBy('progressed_at', 'DESC');
        if(isset($params['residential_id'])){
            $list->where('residential_id', $params['residential_id']);
        }
        return $list->paginate();
    }

    /**
     * get translations by item_id
     * @param int $item_id
     * @return array
     */
    public function getTranslations(int $item_id): array {
        return $this->db->table('progress_translation')
                        ->where('progress_id', $item_id)
                        ->get()->getResultObject();
    }
    
    
    /**
     * create progress item
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function createItem(array $data): int {
        $item_id = $this->insert($this->retrieveMainData($data), true);
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
        $this->db->table('progress_translation')->insertBatch($translations);
        return $item_id;
    }
    
    /**
     * update progress item
     * @param int $item_id
     * @param array $data
     * @return int|null
     * @throws Exception
     */
    public function updateItem(int $item_id, array $data): ?int {
        if (!$this->update($item_id, $this->retrieveMainData($data, $item_id))) {
            return null;
        }
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
            $this->db->table('progress_translation')->replace($translation);
        }
        return $item_id;
    }
    
    /**
     * retrieving the main data for complex table
     * @param array $data
     * @return array|null
     */
    public function retrieveMainData(array $data, int $id = 0): ?array {
        $slugify = new Slugify();
        
        // create slug by time 
        $retrieved = [
            'id' => $id,
            'slug' => $slugify->slugify($data['residential_id'] . '-' . $data['progressed_at']),
            'residential_id' => (int) $data['residential_id'],
            'video' => $data['video'],
            'progressed_at' => $data['progressed_at'],
            'publish' => !isset($data['publish']) ? self::NO : self::YES,
        ];
        return $retrieved;
    }

    /**
     * retreive the translation data
     * @param int $id
     * @param string $language
     * @param array $data
     * @return array
     */
    public function retrieveTranslation(int $id, string $language, array $data): array {
        $retrieved = [
            'progress_id' => $id,
            'language' => $language,
            'title' => $data['title'],
            'meta_title' => $data['meta_title'],
            'description' => $data['description'],
            'meta_description' => $data['meta_description'],
        ];
        return $retrieved;
    }
    
    /**
     * get create the navigation for view progress
     * @param int $residential_id
     * @return type
     */
    public function getNavigation(int $residential_id): ?array{
        if(!$found = cache("progress_{$residential_id}")){
            $found = $this->select('slug, progressed_at')
                    ->where('residential_id', $residential_id)
                    ->orderBy('progressed_at','DESC')
                    ->findAll(10);
            cache()->save("progress_{$residential_id}", $found, 0);
        }
        return $found;
    }
    
    /**
     * deleting navigation data
     * @param array $data
     * @return array|null
     */
    public function deleteNavigation(array $data): ?array{
        $residential_id = $data['data']['residential_id'] ?? false;
        
        if($residential_id){
            cache()->delete("progress_{$residential_id}");
        }else{
            cache()->deleteMatching('progress_*');
        }
        return $data;
    }
    
    
    
}
