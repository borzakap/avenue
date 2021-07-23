<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of FloorsImagesEntity
 *
 * @author alexey
 */
class FloorsImagesEntity extends Entity {
    
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
     * get poligons\sections data for floor images
     * @return self
     * @throws \RuntimeException
     */
    public function withPoligons(): self{
        if(empty($this->id)){
            throw new \RuntimeException('Floor image must be created before getting poligons.');
        }
        if(empty($this->poligons)){
            $this->poligons = model(FloorsImagesModel::class)->getPoligons($this->id);
        }
        return $this;
    }

    protected function getPoligons(){
        return $this->poligons;
    }



    protected function getImageSrc(){
        return 'images/sections/' . $this->image_name;
    }

}
