<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterLayoutsGenplan extends Migration {

    public function up() {
        // add new column image_code for plans_images
        $this->forge->addColumn('plans_images',
                ['image_code' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => true,
                    ],
                ]
        );
        // add column plans_images_id to layouts table
        $this->forge->addColumn('layouts',
                ['plans_images_id' => [
                        'type' => 'int', 
                        'constraint' => 11, 
                        'unsigned' => true,
                        'null' => true,
                    ],
                    // set foreign key
                    'CONSTRAINT layouts_plans_images_id_foreign FOREIGN KEY(`plans_images_id`) REFERENCES `plans_images`(`id`)',
                ]
        );
        // add column plan_poligon to layouts table
        $this->forge->addColumn('layouts',
                ['plan_poligon' => [
                        'type' => 'text', 
                        'null' => true,
                    ],
                ]
        );
    }

    public function down() {
        // drop constraints first to prevent errors
        if ($this->db->DBDriver != 'SQLite3') {
            $this->forge->dropForeignKey('layouts', 'layouts_plans_images_id_foreign');
        }
        $this->forge->dropColumn('plans_images', 'image_code');
        $this->forge->dropColumn('layouts', 'plans_images_id');
        $this->forge->dropColumn('layouts', 'plan_poligon');
    }

}
