<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

/**
 * Description of DiscountsEntity
 *
 * @author alexey
 */
class DiscountsEntity extends Entity{
    // attributes
    protected $attributes = [
        'title' => null,
        'meta_title' => null,
        'description' => null,
        'meta_description' => null,
        'language' => null,
        'slogan' => null,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_to',
        'date_from',
    ];
    // all languages variants
    protected $translations = [];
    // update and delete links
    protected $update_link = '';
    protected $delete_link = '';
    protected $date_to_stirng = '';


    /**
     * get translations
     * @return self
     * @throws \RuntimeException
     */
    public function withTranslations(): self{
        if(empty($this->id)){
            throw new \RuntimeException('Discount must be created before getting translations.');
        }
        if(empty($this->translations)){
            $translations = model(DiscountsModel::class)->getTranslations($this->id);
            foreach ($translations as $translation){
                $this->translations[$translation->language]['title'] = $translation->title;
                $this->translations[$translation->language]['meta_title'] = $translation->meta_title;
                $this->translations[$translation->language]['description'] = $translation->description;
                $this->translations[$translation->language]['meta_description'] = $translation->meta_description;
                $this->translations[$translation->language]['slogan'] = $translation->slogan;
                $this->translations[$translation->language]['info'] = $translation->info;
            }
        }
        return $this;
    }
    
    public function getTranslations(): array{
        return $this->translations;
    }
    
    public function getDateToString(): ?string
    {
        $this->date_to_stirng  = lang('Site.Discounts.Complated');
        $now = Time::now();
        if($now->isBefore($this->date_to)){
            $this->date_to_stirng = lang('Site.Discounts.DateTo', ['date' => $this->date_to->toLocalizedString('d MMMM yyyy')]);
        }
        return $this->date_to_stirng;
    }

    /**
     * format update link
     * @return string|null
     */
    public function getUpdateLink (): ?string
    {
        if(!$this->update_link){
            $this->update_link = '<a href="' . route_to('App\Controllers\Admin\DiscountsController::update', $this->id). '"><i class="fas fa-edit"></i></a>';
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
            $this->delete_link = '<a href="' . route_to('App\Controllers\Admin\DiscountsController::delete', $this->id). '"><i class="fas fa-trash"></i></a>';
        }
        return $this->delete_link;
    }

    
}
