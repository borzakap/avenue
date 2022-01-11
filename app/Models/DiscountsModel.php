<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TranslationInterface;
use Cocur\Slugify\Slugify;

/**
 * Description of DiscountsModel
 *
 * @author alexey
 */
class DiscountsModel extends Model implements TranslationInterface {

    protected $table = 'discounts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\DiscountsEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['slug', 'residential_id', 'image', 'publish', 'language', 
        'title', 'meta_title', 'description', 'meta_description', 'slogan', 'value_type', 
        'value', 'date_to', 'date_from', 'rules', 'info'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'slug' => 'required|min_length[3]|max_length[255]|alpha_dash|is_unique[layouts.slug,id,{id}]',
        'residential_id' => 'required',
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

    const YES = 1;
    const NO = 0;

    /**
     * get the discount
     * @param string $slug
     * @param string $language
     * @return object|null
     */
    public function getBySlug(string $slug, string $language): ?object {
        return $this->select('discounts.*, discounts.id AS discounts_id, discounts_meta.*, discounts_translation.title, discounts_translation.meta_title, discounts_translation.description, discounts_translation.meta_description, discounts_translation.slogan, discounts_translation.info, discounts_translation.language')
                        ->join('discounts_translation', 'discounts_translation.discount_id = discounts.id', 'inner')
                        ->join('discounts_meta', 'discounts_meta.discount_id = discounts.id', 'inner')
                        ->where('discounts.slug', $slug)
                        ->where('discounts_meta.entity_type', 'residential')
                        ->where('discounts_translation.language', $language)
                        ->first();
    }

    /**
     * get the discount
     * @param int $id
     * @param string $language
     * @return object|null
     */
    public function findItem(int $id): ?object {
        return $this->select('discounts.*, discounts_meta.value_type, discounts_meta.value, '
                . 'discounts_meta.date_to, discounts_meta.date_from')
                        ->join('discounts_meta', 'discounts_meta.discount_id = discounts.id', 'inner')
                        ->where('discounts.id', $id)
                        ->where('discounts_meta.entity_type', 'residential')
                        ->first();
    }

    /**
     * get the list of discounts
     * @param string $language
     * @param array $params
     * @return array|null
     */
    public function getList(string $language, array $params = []): ?array {
        $items = $this->select('discounts.*, discounts_meta.value_type, discounts_meta.value, '
                . 'discounts_meta.date_to, discounts_meta.date_from, '
                . 'discounts_translation.title, discounts_translation.meta_title, '
                . 'discounts_translation.description, discounts_translation.meta_description, '
                . 'discounts_translation.slogan, discounts_translation.info, '
                . 'discounts_translation.language')
                ->join('discounts_translation', 'discounts_translation.discount_id = discounts.id', 'inner')
                ->join('discounts_meta', 'discounts_meta.discount_id = discounts.id', 'inner')
                ->where('discounts_meta.entity_type', 'residential')
                ->where('discounts_translation.language', $language)
                ->orderBy('discounts_meta.date_to', 'DESC');
        return $items->paginate();
    }

    /**
     * get translations
     * @param int $id
     * @return object
     */
    public function getTranslations(int $id): array {
        return $this->db->table('discounts_translation')
                        ->where('discount_id', $id)
                        ->get()->getResultObject();
    }

    /**
     * create item
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
        $this->db->table('discounts_translation')->insertBatch($translations);
        // insert metadata
        $meta = $this->retraiveMetaData($item_id, $data['residential_id'], $data['meta']);
        $this->db->table('discounts_meta')->insert($meta);
        
        return $item_id;
    }
    
    /**
     * update the descount
     * @param int $item_id
     * @param array $data
     * @return int|null
     */
    public function updateItem(int $item_id, array $data): ?int {
        // update layout
        if (!$this->update($item_id, $this->retrieveMainData($data, $item_id))) {
            return null;
        }
        // insert translations
        foreach ($data['translation'] as $language => $translation) {
            if (!in_array($language, config(App::class)->supportedLocales)) {
                continue;
            }
            $this->db->table('discounts_translation')->replace($this->retrieveTranslation($item_id, $language, $translation));
        }
        // update main meta
        // for all meta about current discount_id
        $meta = $this->retraiveMetaData($item_id, $data['residential_id'], $data['meta']);
        $this->db->table('discounts_meta')
                ->where('discount_id', $item_id)
                ->update(array_diff_key($meta, ['discount_id', 'entity_id', 'entity_type']));
        return $item_id;
    }
    
    /**
     * retraive main data
     * @param array $data
     * @param int $id
     * @return array|null
     */
    public function retrieveMainData(array $data, int $id = 0): ?array {
        $slugify = new Slugify();
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = substr(str_shuffle(MD5(microtime())), 0, 10);
        }
        return [
            'id' => $id,
            'slug' => $slugify->slugify($data['slug']),
            'residential_id' => (int) $data['residential_id'],
            'publish' => !isset($data['publish']) ? self::YES : self::NO,
        ];
    }
    
    /**
     * retreive the translation data
     * @param int $id
     * @param string $language
     * @param array $data
     * @return array
     */
    public function retrieveTranslation(int $id, string $language, array $data): array {
        return [
            'discount_id' => $id,
            'language' => $language,
            'title' => $data['title'],
            'meta_title' => $data['meta_title'],
            'description' => $data['description'],
            'meta_description' => $data['meta_description'],
            'slogan' => $data['slogan'],
            'info' => $data['info'],
        ];
    }
    
    /**
     * retraiv metadata
     * @param int $id
     * @param int $residential_id
     * @param array $data
     * @return array
     */
    public function retraiveMetaData(int $id, int $residential_id, array $data): array{
        return [
            'discount_id' => $id,
            'entity_id' => $residential_id,
            'entity_type' => 'residential',
            'value_type' => $data['value_type'],
            'value' => (float)$data['value'],
            'date_to' => $data['date_to'],
            'date_from' => $data['date_from'],
        ];
    }
    
}
