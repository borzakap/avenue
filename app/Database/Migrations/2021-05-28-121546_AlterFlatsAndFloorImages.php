<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterFlatsAndFloorImages extends Migration {

    public function up() {
        //drop excidental column in sections table
        $this->forge->dropColumn('sections', 'price');
        // add this column to layout table
        $this->forge->addColumn('layouts',
                ['price' => [
                    'type' => 'float',
                    'unsigned' => true,
                    'constraint' => '10,2',
                    'null' => true,
                    ],
                ]
        );
        // add column for ordering to floor_images table
        $this->forge->addColumn('floor_images',
                ['order' => [
                    'type' => 'int',
                    'unsigned' => true,
                    'constraint' => '11',
                    'null' => true,
                    ],
                ]
        );
        
        // add column for image size to floor_images table
        $this->forge->addColumn('floor_images',
                ['image_size' => [
                    'type' => 'int',
                    'unsigned' => true,
                    'constraint' => '11',
                    'null' => true,
                    ],
                ]
        );
        
    }

    public function down() {
        $this->forge->addColumn('sections',
                ['price' => [
                    'type' => 'float',
                    'unsigned' => true,
                    'constraint' => '10,2',
                    'null' => true,
                    ],
                ]
        );
        
        $this->forge->dropColumn('layouts', 'price');
        $this->forge->dropColumn('floor_images', 'order');
        $this->forge->dropColumn('floor_images', 'image_size');
        
    }

}
