<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of ProgressEntity
 *
 * @author alexey
 */
class ProgressEntity extends Entity{
    // attributes
    protected $attributes = [
        'title' => null,
        'meta_title' => null,
        'description' => null,
        'meta_description' => null,
        'language' => null,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'progressed_at',
    ];
    protected $casts = [];
    // all languages variants
    protected $translations = [];
    // main image
    protected $image;
    // all images
    protected $images;
    // update and delete links
    protected $update_link = '';
    protected $delete_link = '';
    
    /**
     * get translations for layouts
     * @return self
     * @throws \RuntimeException
     */
    public function withTranslations(): self{
        if(empty($this->id)){
            throw new \RuntimeException('Progress must be created before getting translations.');
        }
        if(empty($this->translations)){
            $translations = model(ProgressModel::class)->getTranslations($this->id);
            foreach ($translations as $translation){
                $this->translations[$translation->language]['title'] = $translation->title;
                $this->translations[$translation->language]['meta_title'] = $translation->meta_title;
                $this->translations[$translation->language]['description'] = $translation->description;
                $this->translations[$translation->language]['meta_description'] = $translation->meta_description;
            }
        }
        return $this;
    }
    
    public function getTranslations(): ?array{
        return $this->translations;
    }
    
    /**
     * find images for progress
     * @return self
     * @throws \RuntimeException
     */
    public function withImages(): self{
        if(empty($this->id)){
            throw new \RuntimeException('Progress must be created before getting images.');
        }
        if(empty($this->images)){
            $this->images = model(ProgressImagesModel::class)->getImages($this->id);
        }
        return $this;
    }
    
    /**
     * get images ogject array
     * @return array|null
     */
    public function getImages(): ?array{
        return $this->images;
    }
    
    /**
     * get main image
     * @return object|null
     */
    public function getImage(): ?object {
        if (!empty($this->image)) {
            return $this->image;
        }
        if (empty($this->images)) {
            $this->image = model(ProgressImagesModel::class)->getMainImage($this->id);
        }
        foreach ($this->images as $image) {
            if ($image->main == model(ProgressImagesModel::class)::MAIN) {
                $this->image = $image;
            }
        }
        return $this->image;
    }

    /**
     * format update link
     * @return string|null
     */
    public function getUpdateLink (): ?string
    {
        if(!$this->update_link){
            $this->update_link = '<a href="' . route_to('App\Controllers\Admin\ProgressController::update', $this->id). '"><i class="fas fa-edit"></i></a>';
        }
        return $this->update_link;
    }
    
    /**
     * format delete link
     * @return string|null
     */
    public function getDeleteLink (): ?string
    {
        if(!$this->delete_link){
            $this->delete_link = '<a href="' . route_to('App\Controllers\Admin\ProgressController::delete', $this->id). '"><i class="fas fa-trash"></i></a>';
        }
        return $this->delete_link;
    }

    
}
