<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWidthHeightToFloorImages extends Migration {

    public function up() {
        // delete unused columns
        $this->forge->dropColumn('floor_images', 'image_mime');
        $this->forge->dropColumn('floor_images', 'image_size');
        // add new columns
        $this->forge->addColumn('floor_images',
                ['image_width' => [
                    'type' => 'int',
                    'constraint' => 11,
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('floor_images',
                ['image_height' => [
                    'type' => 'int',
                    'constraint' => 11,
                    'null' => true,
                    ],
                ]
        );
        
    }

    public function down() {
        
        $this->forge->dropColumn('floor_images', 'image_width');
        $this->forge->dropColumn('floor_images', 'image_height');
        
        $this->forge->addColumn('floor_images',
                ['image_mime' => [
                    'type' => 'varchar',
                    'constraint' => '255',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('floor_images',
                ['image_size' => [
                    'type' => 'int',
                    'constraint' => 11,
                    'null' => true,
                    ],
                ]
        );
    }

}
