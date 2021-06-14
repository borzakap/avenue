<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterMakeFlat extends Migration {

    public function up() {
        // add columnt floor_number to residentials
        $this->forge->addColumn('residentials',
                ['floors_number' => [
                    'type' => 'INT',
                    'unsigned' => true,
                    'constraint' => 11,
                    ],
                ]
        );
        // add columnt floor_number to sections
        $this->forge->addColumn('sections',
                ['floors_number' => [
                    'type' => 'INT',
                    'unsigned' => true,
                    'constraint' => 11,
                    ],
                ]
        );
        // add columnt ceil_height to sectins
        $this->forge->addColumn('sections',
                ['ceil_height' => [
                    'type' => 'float',
                    'unsigned' => true,
                    'constraint' => '2,2',
                    'null' => true,
                    ],
                ]
        );
        // add columnt price to layouts
        $this->forge->addColumn('sections',
                ['price' => [
                    'type' => 'float',
                    'unsigned' => true,
                    'constraint' => '10,2',
                    'null' => true,
                    ],
                ]
        );
    }

    public function down() {
        $this->forge->dropColumn('residentials', 'floors_number');
        $this->forge->dropColumn('sections', 'floors_number');
        $this->forge->dropColumn('sections', 'ceil_height');
        $this->forge->dropColumn('sections', 'price');
    }

}
