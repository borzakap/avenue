<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterSections extends Migration {

    public function up() {
        // add new columns leaving_poligon
        $this->forge->addColumn('sections',
                ['leaving_poligon' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => true,
                    ],
                ]
        );
        // add new columns commerce_poligon
        $this->forge->addColumn('sections',
                ['commerce_poligon' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => true,
                    ],
                ]
        );
        // add new columns commerce_poligon
        $this->forge->addColumn('sections',
                ['pantry_poligon' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => true,
                    ],
                ]
        );
    }

    public function down() {
        $this->forge->dropColumn('sections', 'leaving_poligon');
        $this->forge->dropColumn('sections', 'commerce_poligon');
        $this->forge->dropColumn('sections', 'pantry_poligon');
    }

}
