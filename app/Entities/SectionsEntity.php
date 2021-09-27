<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class SectionsEntity extends Entity {

    protected $datamap = [];
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
        'section_build_start',
        'section_build_end',
    ];
    protected $casts = [];
    // all languages variants
    protected $translations = [];
    // all genplans for section
    protected $plans;
    // data about current plan
    protected $leaving_plan;
    protected $commerce_plan;
    protected $pantry_plan;
    // commerces data
    protected $commerces;


    // update and delete links
    protected $update_link = '';
    protected $delete_link = '';


    public function withTranslations(): self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Section must be created before getting translations.');
        }
        if(empty($this->translations)){
            $translations = model(SectionsModel::class)->getTranslations($this->id);
            foreach ($translations as $translation){
                $this->translations[$translation->language]['title'] = $translation->title;
                $this->translations[$translation->language]['meta_title'] = $translation->meta_title;
                $this->translations[$translation->language]['description'] = $translation->description;
                $this->translations[$translation->language]['meta_description'] = $translation->meta_description;
            }
        }
        return $this;
    }
    
    public function getTranslations(): array
    {
        return $this->translations;
    }
    
    public function withPlans(): ?self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Section must be created before getting translations.');
        }
        
        if(empty($this->plans)){
            $this->plans = model(PlansImagesModel::class)->getImages($this->residential_id);
        }
        
        foreach($this->plans as $plan){
            switch ($plan->plan_type) {
                case model(PlansImagesModel::class)::TYPE_LEAVING:
                    $this->leaving_plan = $plan;
                    break;
                case model(PlansImagesModel::class)::TYPE_COMMERCE:
                    $this->commerce_plan = $plan;
                    break;
                case model(PlansImagesModel::class)::TYPE_PANTRY:
                    $this->pantry_plan = $plan;
                    break;
            }
        }
        
        return $this;
    }

    public function getPlans(): ?array
    {
        return $this->plans;
    }

    public function getLeavingPlan(): ?object
    {
        return $this->leaving_plan;
    }

    public function getPantryPlan(): ?object
    {
        return $this->pantry_plan;
    }

    public function getCommercePlan(): ?object
    {
        return $this->commerce_plan;
    }

    /**
     * retraive the all commerces for section
     * @return self
     * @throws \RuntimeException
     */
    public function withCommerces(): self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Section must be created before getting translations.');
        }
        if(empty($this->commerces)){
            $this->commerces = model(CommerceModel::class)->findItemsByFloors($this->id);
        }
        return $this;
    }

    /**
     * return the commerces
     * @return array|null
     */
    public function getCommerces(): ?array
    {
        return $this->commerces;
    }




    public function getUpdateLink (): string
    {
        if(!$this->update_link){
            $this->update_link = '<a href="' . route_to('App\Controllers\Admin\SectionsController::update', $this->id). '"><i class="fas fa-edit"></i></a>';
        }
        return $this->update_link;
    }
    
    public function getDeleteLink (): string
    {
        if(!$this->delete_link){
            $this->delete_link = '<a href="' . route_to('App\Controllers\Admin\SectionsController::delete', $this->id). '"><i class="fas fa-trash"></i></a>';
        }
        return $this->delete_link;
    }

}
