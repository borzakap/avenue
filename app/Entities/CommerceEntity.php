<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class CommerceEntity extends Entity {

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
    ];
    
    protected $casts = [];
    
    // all languages variants
    protected $translations = [];
    // floor image
    protected $floor_image;
    // section
    protected $section;
    // update and delete links
    protected $update_link = '';
    protected $delete_link = '';
    
    /**
     * get translations for layouts
     * @return self
     * @throws \RuntimeException
     */
    public function withTranslations(): self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Layout must be created before getting translations.');
        }
        if(empty($this->translations)){
            $translations = model(CommerceModel::class)->getTranslations($this->id);
            foreach ($translations as $translation){
                $this->translations[$translation->language]['title'] = $translation->title;
                $this->translations[$translation->language]['meta_title'] = $translation->meta_title;
                $this->translations[$translation->language]['description'] = $translation->description;
                $this->translations[$translation->language]['meta_description'] = $translation->meta_description;
            }
        }
        return $this;
    }
    
    /**
     * get the translations
     * @return array
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }
    
    /**
     * get layout floor image
     * @return self
     * @throws \RuntimeException
     */
    public function withFloorImage(): self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Commerce must be created before getting layout image.');
        }
        if(empty($this->floor_image)){
            $this->floor_image = model(FloorsImagesModel::class)->getImageFloor($this->floor_images_id);
        }
        return $this;
    }

    /**
     * get the floor image
     * @return object
     */
    public function getFloorImage(): object
    {
        return $this->floor_image;
    }

    /**
     * get layout`s section data
     * @return self
     * @throws \RuntimeException
     */
    public function withSection(): self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Layout must be created before getting layout`s section.');
        }
        if(empty($this->section)){
            $this->section = model(SectionsModel::class)->findSection($this->section_id, $this->language);
        }
        return $this;
    }

    public function getSection(): object
    {
        return $this->section;
    }

    /**
     * format the update link
     * @return string|null
     */
    public function getUpdateLink (): ?string
    {
        if(!$this->update_link){
            $this->update_link = '<a href="' . route_to('App\Controllers\Admin\CommerceController::update', $this->id). '"><i class="fas fa-edit"></i></a>';
        }
        return $this->update_link;
    }

    /**
     * format the delete link
     * @return string|null
     */
    public function getDeleteLink (): ?string
    {
        if(!$this->delete_link){
            $this->delete_link = '<a href="' . route_to('App\Controllers\Admin\CommerceController::delete', $this->id). '"><i class="fas fa-trash"></i></a>';
        }
        return $this->delete_link;
    }

}