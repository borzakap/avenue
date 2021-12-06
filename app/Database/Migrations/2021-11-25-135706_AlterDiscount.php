<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterDiscount extends Migration {

    public function up() {
        $this->forge->addColumn('discounts',
                ['rules' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => true,
                    ],
                ],
        );
        $this->forge->addColumn('discounts_translation',
                ['info' => [
                        'type' => 'text',
                        'null' => true,
                    ],
                ],
        );
    }

    public function down() {
        $this->forge->dropColumn('discounts', 'rules');
        $this->forge->dropColumn('discounts_translation', 'info');
    }
}
