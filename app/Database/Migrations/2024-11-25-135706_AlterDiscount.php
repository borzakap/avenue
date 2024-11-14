<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterDiscount extends Migration {

    public function up() {
        $this->forge->addColumn('discounts',
                ['image_transparent' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => true,
                    ],
                ],
        );
    }

    public function down() {
        $this->forge->dropColumn('discounts', 'image_transparent');
    }
}
