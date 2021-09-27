<?php

namespace App\Models;

/**
 *
 * @author alexey
 */
interface TranslationInterface {

    /**
     * retrive single data by slug
     * @param string $slug
     * @param string $language
     * @return object
     */
    public function getBySlug(string $slug, string $language): ?object;
    
    /**
     * get list of items by language
     * @param string $language
     * @param array $params
     * @return array
     */
    public function getList(string $language, array $params = []): array;
    
    /**
     * get translations for current item
     * @param int $item_id
     * @return array
     */
    public function getTranslations(int $item_id): array;

    /**
     * cretate item 
     * @param array $data
     * @return int
     */
    public function createItem(array $data): int;
    
    /**
     * update item
     * @param int $item_id
     * @param array $data
     * @return int
     */
    public function updateItem(int $item_id, array $data): int;

    /**
     * retraive data for main table
     * @param array $data
     * @return array|null
     */
    public function retrieveMainData(array $data, int $id = 0): ?array;
    
    /**
     * retrive translations
     * @param int $item_id
     * @param string $language
     * @param array $data
     * @return array|null
     */
    public function retrieveTranslation(int $item_id, string $language, array $data): ?array;    
}
