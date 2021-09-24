<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TranslationInterface;
use Cocur\Slugify\Slugify;


/**
 * Description of CommerceModel
 *
 * @author alexey
 */
class CommerceModel extends Model implements TranslationInterface{
    protected $table = 'commerce';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\CommerceEntity';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['slug', 'residential_id', 'section_id', 'code', 'advertise', 'sold_out', 'booked_for', 'price', 'floor', 'ceil_height', 'all_area', 'image_2d', 'image_3d', 'file_to_upload', 'floor_images_id', 'poligon', 'levels', 'publish', 'title', 'meta_title', 'description', 'meta_description'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'slug' => 'required|min_length[5]|is_unique[commerce.slug]',
        'residential_id' => 'required',
        'section_id' => 'required',
        'code' => 'required',
        'floor_images_id' => 'required',
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
        'section_id' => [
            'required' => 'Validation.SectionId.Required',
        ],
        'code' => [
            'required' => 'Validation.Code.Required',
        ],
        'floor_images_id' => [
            'required' => 'Validation.FloorImagesId.Required',
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
     * get by curren slug
     * @param string $slug
     * @param string $language
     * @return object|null
     */
    public function getBySlug(string $slug, string $language): ?object
    {
        try {
            return $this->select('commerce.*, commerce_translation.title, commerce_translation.meta_title, commerce_translation.description, commerce_translation.meta_description, commerce_translation.language')
                    ->join('commerce_translation', 'commerce_translation.commerce_id = commerce.id', 'inner')
                    ->where('commerce.slug', $slug)
                    ->where('commerce_translation.language', $language)
                    ->first();
        } catch (\Exception $exc) {
            die($exc->getTraceAsString());
        }
    }

    /**
     * get commerce list
     * @param string $language
     * @return array
     */
    public function getList(string $language, array $params = []): array{
        try {
            return $this->select('commerce.*, commerce_translation.title, commerce_translation.meta_title, commerce_translation.description, commerce_translation.meta_description, commerce_translation.language')
                    ->join('commerce_translation', 'commerce_translation.commerce_id = commerce.id', 'inner')
                    ->where('commerce_translation.language', $language)
                    ->findAll();
        } catch (\Exception $e) {
            die($e->getTraceAsString());
        }
    }
    
    /**
     * get translations by commerce_id
     * @param int $item_id
     * @return object
     */
    public function getTranslations(int $item_id): array {
        try {
            return $this->db->table('commerce_translation')->where('commerce_id', $item_id)->get()->getResultObject();
        } catch (\Exception $e) {
            die($e->getTraceAsString());
        }
    }

    /**
     * get commerce poligon and other data for floor image
     * @param int $floor_images_id
     * @return array|null
     */
    public function getPoligons(int $floor_images_id): ?array
    {
        try {
            return $this->where('floor_images_id', $floor_images_id)->findAll();
        } catch (\Exception $e) {
            die($e->getTraceAsString());
        }
    }

    /**
     * cretating the commerce
     * @param array $data
     * @return int
     */
    public function createItem(array $data): int {
        // insert the data about layout
        $main = $this->retrieveMainData($data);

        try {
            $item_id = $this->insert($main, true);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
        // insert translations
        $translations = [];
        foreach ($data['translation'] as $language => $translation) {
            if (!in_array($language, config('App')->supportedLocales)) {
                continue;
            }
            $translations[] = $this->retrieveTranslation($item_id, $language, $translation);
        }
        if (empty($translations)) {
            throw new Exception('there must be the translations');
        }
        try {
            $this->db->table('commerce_translation')->insertBatch($translations);
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        return $item_id;
    }
    
    /**
     * updating layout
     * @param int $item_id
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function updateItem(int $item_id, array $data): int
    {
        // update layout
        try {
            $this->update($item_id, $this->retrieveMainData($data));
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
                $this->db->table('commerce_translation')->replace($translation);
            }
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
    public function retrieveMainData(array $data): array {
        $slugify = new Slugify();
        if(!isset($data['slug']) || empty($data['slug'])){
            $data['slug'] = $data['code'] ?? substr(str_shuffle(MD5(microtime())), 0, 10);
        }
        
        $retrieved = [
            'slug' => $slugify->slugify($data['slug']),
            'residential_id' => (int)$data['residential_id'],
            'section_id' => (int)$data['section_id'],
            'code' => $data['code'],
            'advertise' => $data['advertise'] ?? self::YES,
            'sold_out' => $data['sold_out'] ?? self::NO,
            'price' => (float)$data['price'],
            'floor' => (int)$data['floor'],
            'ceil_height' => $data['ceil_height'],
            'all_area' => $data['all_area'],
            'levels' => (int)$data['levels'],
            'floor_images_id' => (int)$data['floor_images_id'],
            'publish' => $data['publish'] ?? self::YES,
        ];
        return $retrieved;
    }

    /**
     * retreive the translation data
     * @param int $commerce_id
     * @param string $language
     * @param array $data
     * @return array
     */
    public function retrieveTranslation(int $commerce_id, string $language, array $data): array {
        $retrieved = [
            'commerce_id' => $commerce_id,
            'language' => $language,
            'title' => $data['title'],
            'meta_title' => $data['meta_title'],
            'description' => $data['description'],
            'meta_description' => $data['meta_description'],
        ];
        return $retrieved;
        
    }

    
    
}
