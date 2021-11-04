<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TranslationInterface;
use Cocur\Slugify\Slugify;

/**
 * Description of InfrastructureModel
 *
 * @author alexey
 */
class InfrastructureModel extends Model implements TranslationInterface {

    const YES = 1;
    const NO = 0;
    
    const TYPE_SERVICES = 'services';
    const TYPE_MEDICINE = 'medicine';
    const TYPE_SPORT = 'sport';
    const TYPE_PARKS = 'parks';
    const TYPE_TRANSPORT = 'transport';
    const TYPE_SHOPS = 'shops';
    const TYPE_ENTERTAIMENT = 'entertainment';
    const TYPE_EDUCATION = 'education';
    const TYPE_EMPTY = 'empty';
    
    protected $table = 'infrastructure';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\InfrastructureEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['residential_id', 'slug', 'latitude', 'longitude', 'distance', 'image', 'type', 'publish'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'slug' => 'required|min_length[2]|max_length[20]|alpha_dash|is_unique[infrastructure.slug,id,{id}]',
        'residential_id' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
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

    /**
     * get the infrastructure item by slug (not used ?yet)
     * @param string $slug
     * @param string $language
     * @return object|null
     */
    public function getBySlug(string $slug, string $language): ?object {
        return $this->select('infrastructure.*, infrastructure_translation.title, infrastructure_translation.meta_title, infrastructure_translation.description, infrastructure_translation.meta_description, infrastructure_translation.language')
                        ->join('infrastructure_translation', 'layouts_translation.layout_id = layouts.id', 'inner')
                        ->where('infrastructure.slug', $slug)
                        ->where('infrastructure_translation.language', $language)
                        ->first();
    }
    
    /**
     * get list of infrastructure items
     * @param string $language
     * @param array $params
     * @return array|null
     */
    public function getList(string $language, array $params = []): ?array {
        $list = $this->select('infrastructure.*, infrastructure_translation.title, infrastructure_translation.description, infrastructure_translation.language')
                        ->join('infrastructure_translation', 'infrastructure_translation.infrastructure_id = infrastructure.id', 'inner')
                        ->where('infrastructure_translation.language', $language);
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
        return $this->db->table('infrastructure_translation')
                        ->where('infrastructure_id', $item_id)
                        ->get()->getResultObject();
    }

    /**
     * create infrastructure item 
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
        $this->db->table('infrastructure_translation')->insertBatch($translations);
        return $item_id;
    }

    /**
     * update unfrasturcture item
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
            $this->db->table('infrastructure_translation')->replace($translation);
        }
        return $item_id;
    }

    /**
     * get the data for infrasturcture item from form
     * @param array $data
     * @param int $id
     * @return array|null
     */
    public function retrieveMainData(array $data, int $id = 0): ?array {
        $slugify = new Slugify();
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = substr(str_shuffle(MD5(microtime())), 0, 10);
        }
        $retrieved = [
            'id' => $id,
            'slug' => $slugify->slugify($data['slug']),
            'residential_id' => (int) $data['residential_id'],
            'latitude' => (float)$data['latitude'],
            'longitude' => (float)$data['longitude'],
            'distance' => (int)$data['distance'],
            'type' => $data['type'],
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
            'infrastructure_id' => $id,
            'language' => $language,
            'title' => $data['title'],
            'meta_title' => $data['meta_title'],
            'description' => $data['description'],
            'meta_description' => $data['meta_description'],
        ];
        return $retrieved;
    }
    
    /**
     * get named infrasturcture types
     * @return array
     */
    public function getInfrastructureTypes(): array {
        return [
            self::TYPE_SERVICES => lang('Admin.List.Infrastructure.Types.Services'),
            self::TYPE_MEDICINE => lang('Admin.List.Infrastructure.Types.Medicine'),
            self::TYPE_SPORT => lang('Admin.List.Infrastructure.Types.Sport'),
            self::TYPE_PARKS => lang('Admin.List.Infrastructure.Types.Parks'),
            self::TYPE_TRANSPORT => lang('Admin.List.Infrastructure.Types.Transport'),
            self::TYPE_SHOPS => lang('Admin.List.Infrastructure.Types.Shops'),
            self::TYPE_ENTERTAIMENT => lang('Admin.List.Infrastructure.Types.Entertaiment'),
            self::TYPE_EDUCATION => lang('Admin.List.Infrastructure.Types.Education'),
            self::TYPE_EMPTY => lang('Admin.List.Infrastructure.Types.Empty'),
        ];
    }
    

}
