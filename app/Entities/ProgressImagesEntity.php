<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of ProgressImagesEntity
 *
 * @author alexey
 */
class ProgressImagesEntity extends Entity{
    
    protected $attributes = [
        'image_name' => null,
        'image_width' => null,
        'image_height' => null,
        'progress_id' => null,
        'main' => null,
        'order' => null,
    ];
    
    protected $datamap = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [];
}
