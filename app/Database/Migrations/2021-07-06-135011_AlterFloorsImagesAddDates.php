<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterFloorsImagesAddDates extends Migration {

    public function up() {
        // add column created_at to floor_images table
        $this->forge->addColumn('floor_images',
                ['created_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        // add column updated_at to floor_images table
        $this->forge->addColumn('floor_images',
                ['updated_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        // add column deleted_at to floor_images table
        $this->forge->addColumn('floor_images',
                ['deleted_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
    }

    public function down() {
        $this->forge->dropColumn('floor_images', 'created_at');
        $this->forge->dropColumn('floor_images', 'updated_at');
        $this->forge->dropColumn('floor_images', 'deleted_at');
    }

}
