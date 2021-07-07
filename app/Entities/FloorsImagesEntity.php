<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of FloorsImagesEntity
 *
 * @author alexey
 */
class FloorsImagesEntity extends Entity {
    
    protected $datamap = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [];

}
