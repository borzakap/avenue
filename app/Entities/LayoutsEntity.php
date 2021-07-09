<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class LayoutsEntity extends Entity {

    protected $datamap = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [];
    // all languages variants
    protected $translations = [];
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
    
    public function getUpdateLink (): string{
        if(!$this->update_link){
            $this->update_link = '<a href="' . route_to('App\Controllers\Admin\LayoutsController::update', $this->id). '"><i class="fas fa-edit"></i></a>';
        }
        return $this->update_link;
    }
    
    public function getDeleteLink (): string{
        if(!$this->delete_link){
            $this->delete_link = '<a href="' . route_to('App\Controllers\Admin\LayoutsController::delete', $this->id). '"><i class="fas fa-trash"></i></a>';
        }
        return $this->delete_link;
    }

}
