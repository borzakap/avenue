<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterDiscount extends Migration {

    public function up() {
        $this->forge->addColumn('discounts',
                ['slug' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => false,
                    ],
                ],
        );
    }

    public function down() {
        $this->forge->dropColumn('discounts', 'slug');
    }

}
