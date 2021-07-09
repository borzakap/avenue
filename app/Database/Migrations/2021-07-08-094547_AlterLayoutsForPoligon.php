<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterLayoutsForPoligon extends Migration {

    public function up() {
        // add column floor_images_id to layouts table
        $this->forge->addColumn('layouts',
                ['floor_images_id' => [
                        'type' => 'int', 
                        'constraint' => 11, 
                        'unsigned' => true,
                        'null' => true,
                    ],
                    // set foreign key
                    'CONSTRAINT layouts_floor_images_id_foreign FOREIGN KEY(`floor_images_id`) REFERENCES `floor_images`(`id`)',
                ]
        );
        // add column poligon to layouts table
        $this->forge->addColumn('layouts',
                ['poligon' => [
                        'type' => 'text', 
                        'null' => true,
                    ],
                ]
        );
    }

    public function down() {
        // drop constraints first to prevent errors
        if ($this->db->DBDriver != 'SQLite3') {
            $this->forge->dropForeignKey('layouts', 'layouts_floor_images_id_foreign');
        }
        $this->forge->dropColumn('layouts', 'floor_images_id');
        $this->forge->dropColumn('layouts', 'poligon');
    }

}
