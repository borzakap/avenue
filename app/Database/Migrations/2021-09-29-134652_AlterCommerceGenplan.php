<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCommerceGenplan extends Migration {

    public function up() {
        // add column plans_images_id to layouts table
        $this->forge->addColumn('commerce',
                ['plans_images_id' => [
                        'type' => 'int',
                        'constraint' => 11,
                        'unsigned' => true,
                        'null' => true,
                    ],
                    // set foreign key
                    'CONSTRAINT commerce_plans_images_id_foreign FOREIGN KEY(`plans_images_id`) REFERENCES `plans_images`(`id`)',
                ]
        );
        // add column plan_poligon to layouts table
        $this->forge->addColumn('commerce',
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
            $this->forge->dropForeignKey('commerce', 'commerce_plans_images_id_foreign');
        }
        $this->forge->dropColumn('commerce', 'plans_images_id');
        $this->forge->dropColumn('commerce', 'plan_poligon');
    }

}
