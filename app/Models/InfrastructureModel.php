<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TranslationInterface;

/**
 * Description of InfrastructureModel
 *
 * @author alexey
 */
class InfrastructureModel extends Model implements TranslationInterface {

    const YES = 1;
    const NO = 0;

    protected $table = 'infrastructure';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\InfrastructureEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['residential_id', 'latitude', 'longitude', 'distance', 'image', 'type', 'publish'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'residential_id' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
    ];
    protected $validationMessages = [
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
        return null;
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
        $retrieved = [
            'id' => $id,
            'residential_id' => (int) $data['residential_id'],
            'latitude' => (float)$data['latitude'],
            'longitude' => (float)$data['longitude'],
            'distance' => (int)$data['distance'],
            'image' => $data['image'],
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
            'description' => $data['description'],
        ];
        return $retrieved;
    }

}
