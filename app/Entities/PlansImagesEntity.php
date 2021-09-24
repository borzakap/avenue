<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of FloorsImagesEntity
 *
 * @author alexey
 */
class PlansImagesEntity extends Entity {
    
    protected $attributes = [
        'image_src' => null,
    ];
    
    protected $datamap = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [];
    
    protected $poligons = [];

    /**
     * get poligons\sections data for leaving layouts floor images
     * @return self
     * @throws \RuntimeException
     */
    public function withLayoutsPoligons(): self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Floor image must be created before getting poligons.');
        }
        if(empty($this->poligons)){
            $this->poligons = model(LayoutsModel::class)->getPoligons($this->id);
        }
        return $this;
    }

    /**
     * get poligons\sections data for commerce layouts floor images
     * @return self
     * @throws \RuntimeException
     */
    public function withCommercePoligons(): self
    {
        if(empty($this->id)){
            throw new \RuntimeException('Floor image must be created before getting poligons.');
        }
        if(empty($this->poligons)){
            $this->poligons = model(CommerceModel::class)->getPoligons($this->id);
        }
        return $this;
    }
    
    /**
     * retrun poligon
     * @return array
     */
    protected function getPoligons() :array
    {
        return $this->poligons;
    }



    protected function getImageSrc(){
        return 'images/sections/' . $this->image_name;
    }

}
