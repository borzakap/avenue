<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class LayoutsEntity extends Entity {

    // attributes
    protected $attributes = [
        'title' => null,
        'meta_title' => null,
        'description' => null,
        'meta_description' => null,
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
            throw new \RuntimeException('Layout must be created before getting translations.');
        }
        if(empty($this->translations)){
            $translations = model(LayoutsModel::class)->getTranslations($this->id);
            foreach ($translations as $translation){
                $this->translations[$translation->language]['title'] = $translation->title;
                $this->translations[$translation->language]['meta_title'] = $translation->meta_title;
                $this->translations[$translation->language]['description'] = $translation->description;
                $this->translations[$translation->language]['meta_description'] = $translation->meta_description;
            }
        }
        return $this;
    }
    
    public function getTranslations(): array{
        return $this->translations;
    }
    
    /**
     * get layout floor image
     * @return self
     * @throws \RuntimeException
     */
    public function withFloorImage(): self{
        if(empty($this->id)){
            throw new \RuntimeException('Layout must be created before getting layout image.');
        }
        if(empty($this->floor_image)){
            $this->floor_image = model(LayoutsModel::class)->getImageFloor($this->floor_images_id);
        }
        return $this;
    }

    public function getFloorImage(): object{
        return $this->floor_image;
    }

    /**
     * format update link
     * @return string
     */
    public function getUpdateLink (): string{
        if(!$this->update_link){
            $this->update_link = '<a href="' . route_to('App\Controllers\Admin\LayoutsController::update', $this->id). '"><i class="fas fa-edit"></i></a>';
        }
        return $this->update_link;
    }
    
    /**
     * format delete link
     * @return string
     */
    public function getDeleteLink (): string{
        if(!$this->delete_link){
            $this->delete_link = '<a href="' . route_to('App\Controllers\Admin\LayoutsController::delete', $this->id). '"><i class="fas fa-trash"></i></a>';
        }
        return $this->delete_link;
    }

}
