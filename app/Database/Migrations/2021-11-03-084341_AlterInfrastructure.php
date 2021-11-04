<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterInfrastructure extends Migration {

    public function up() {
        // add column meta_title and meta_description to infrastructure_translation
        $this->forge->addColumn('infrastructure_translation',
                ['meta_title' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => true,
                    ],
                ],
        );
        $this->forge->addColumn('infrastructure_translation',
                ['meta_description' => [
                        'type' => 'text',
                        'null' => true,
                    ],
                ],
        );
        // create slug
        $this->forge->addColumn('infrastructure',
                ['slug' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => false,
                        'unique' => true,
                    ],
                ],
        );
    }

    public function down() {
        $this->forge->dropColumn('infrastructure', 'slug');
        $this->forge->dropColumn('infrastructure_translation', 'meta_title');
        $this->forge->dropColumn('infrastructure_translation', 'meta_description');
    }

}
