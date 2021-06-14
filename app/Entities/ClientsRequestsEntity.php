<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of ClientsRequestsEntity
 *
 * @author alexey
 */
class ClientsRequestsEntity extends Entity {

    protected $datamap = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [];

}
