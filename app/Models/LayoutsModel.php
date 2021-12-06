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
    protected $allowedFields = ['code', 'slug', 'residential_id', 'section_id', 'image_2d', 'image_3d', 'image_other', 'file_to_upload', 'rooms', 'levels', 'ceil_height', 'all_area', 'live_area', 'kit_area', 'balcon', 'advertise', 'sold_out', 'publish', 'price', 'floor_images_id', 'poligon', 'language', 'title', 'meta_title', 'description', 'meta_description', 'plans_images_id', 'plan_poligon'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'slug' => 'required|min_length[2]|max_length[20]|alpha_dash|is_unique[layouts.slug,id,{id}]',
        'residential_id' => 'required',
        'section_id' => 'required',
        'code' => 'required',
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
        'section_id' => [
            'required' => 'Validation.SectionId.Required',
        ],
        'code' => [
            'required' => 'Validation.Code.Required',
        ],
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = ['deleteCacheRoomsList'];
    protected $beforeUpdate = [];
    protected $afterUpdate = ['deleteCacheRoomsList'];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = ['deleteCacheRoomsList'];

    const PUBLISH = 1;
    const UNPUBLISH = 0;
    
    /**
     * get by curren slug
     * @param string $slug
     * @param string $language
     * @return object|null
     */
    public function getBySlug(string $slug, string $language): ?object {
        return $this->select('layouts.*, layouts_translation.title, layouts_translation.meta_title, layouts_translation.description, layouts_translation.meta_description, layouts_translation.language')
                        ->join('layouts_translation', 'layouts_translation.layout_id = layouts.id', 'inner')
                        ->where('layouts.slug', $slug)
                        ->where('layouts_translation.language', $language)
                        ->first();
    }

    /**
     * get layouts list
     * @param string $language
     * @return array|null
     */
    public function getList(string $language, array $params = []): ?array {
        $layouts = $this->select('layouts.*, layouts_translation.title, layouts_translation.meta_title, layouts_translation.description, layouts_translation.meta_description, layouts_translation.language')
                ->join('layouts_translation', 'layouts_translation.layout_id = layouts.id', 'inner')
                ->where('layouts_translation.language', $language);
        if (isset($params['rooms']) && is_array($params['rooms'])) {
            $layouts->whereIn('rooms', $params['rooms']);
        }
        if (isset($params['sections']) && is_array($params['sections'])) {
            $layouts->whereIn('section_id', $params['sections']);
        }
        if(isset($params['ids']) && is_array($params['ids'])){
            $layouts->whereIn('layout_id', $params['ids']);
        }
        if (isset($params['floors']) && is_array($params['floors'])) {
            $floor_images_builder = \Config\Database::connect()->table('floor_images');
            $floors = $params['floors'];
            $layouts->whereIn('floor_images_id', function($floor_images_builder) use ($floors){
                return $floor_images_builder->select('id')->from('floor_images')
                        ->whereIn('image_code',$floors);
            });
        }
        if (isset($params['order']) && !empty($params['order'])) {
            $order = explode(':', $params['order']);
            $field = $order[0] ?? 'all_area';
            $value = $order[1] ?? 'ASC';
            $layouts->orderBy($field, $value);
        }
        $page = $params['page_layouts'] ?? 1;
        
        return $layouts->paginate(9, 'layouts', (int)$page);
    }

    /**
     * get translations by layout_id
     * @param int $layout_id
     * @return object
     */
    public function getTranslations(int $layout_id): array {
        return $this->db->table('layouts_translation')
                        ->where('layout_id', $layout_id)
                        ->get()->getResultObject();
    }

    /**
     * get layouts poligon and other data for floor image
     * @param int $floor_images_id
     * @return array|null
     */
    public function getPoligons(int $floor_images_id): ?array {
        return $this->where('floor_images_id', $floor_images_id)->findAll();
    }

    /**
     * get layouts genplan poligon and other data for floor image
     * @param int $plans_images_id
     * @return array|null
     */
    public function getPlanPoligons(int $plans_images_id): ?array {
        return $this->where('plans_images_id', $plans_images_id)->findAll();
    }

    /**
     * cretating the layout
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
        $this->db->table('layouts_translation')->insertBatch($translations);
        return $item_id;
    }

    /**
     * updating layout
     * @param int $item_id
     * @param array $data
     * @return int|null
     * @throws Exception
     */
    public function updateItem(int $item_id, array $data): ?int {
        // update layout
        if (!$this->update($item_id, $this->retrieveMainData($data, $item_id))) {
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
            $this->db->table('layouts_translation')->replace($translation);
        }
        return $item_id;
    }

    /**
     * retrieving the main data
     * @param array $data
     * @return array|null
     */
    public function retrieveMainData(array $data, int $id = 0): ?array {
        $slugify = new Slugify();
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = isset($data['code']) ? $data['code'] : substr(str_shuffle(MD5(microtime())), 0, 10);
        }

        $retrieved = [
            'id' => $id,
            'code' => $data['code'],
            'slug' => $slugify->slugify($data['slug']),
            'rooms' => (int) $data['rooms'],
            'levels' => (int) $data['levels'],
            'ceil_height' => $data['ceil_height'],
            'all_area' => $data['all_area'],
            'live_area' => $data['live_area'],
            'kit_area' => $data['kit_area'],
            'balcon' => $data['balcon'] ?? 0,
            'advertise' => $data['advertise'] ?? 0,
            'sold_out' => $data['sold_out'] ?? 0,
            'price' => $data['price'],
            'residential_id' => (int) $data['residential_id'],
            'section_id' => (int) $data['section_id'],
            'floor_images_id' => (int) $data['floor_images_id'],
            'plans_images_id' => (int) $data['plans_images_id'],
            'publish' => !isset($data['publish']) ? self::UNPUBLISH : self::PUBLISH,
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
            'layout_id' => $id,
            'language' => $language,
            'title' => $data['title'],
            'meta_title' => $data['meta_title'],
            'description' => $data['description'],
            'meta_description' => $data['meta_description'],
        ];
        return $retrieved;
    }

    /**
     * get the list of rooms count
     * @return array|null
     */
    public function getRoomsListFilter(): ?array {
        if (!$found = cache("rooms_list")) {
            $found = $this->builder()
                            ->select('rooms')
                            ->groupBy('rooms')
                            ->orderBy('rooms', 'ASC')
                            ->get()->getResultArray();
            cache()->save("rooms_list", $found, 0);
        }
        return $found;
    }

    /**
     * delete rooms list cache
     * @param array $data
     * @return array
     */
    public function deleteCacheRoomsList(array $data): array {
        cache()->delete("rooms_list");
        return $data;
    }

}
