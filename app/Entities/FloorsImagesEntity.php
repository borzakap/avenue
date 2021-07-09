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
    
    protected function getImageSrc(){
        return 'images/sections/' . $this->image_name;
    }

}
