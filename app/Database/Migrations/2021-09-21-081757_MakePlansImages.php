<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakePlansImages extends Migration {

    public function up() {
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'image_name' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'image_width' => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'image_height' => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'residential_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'plan_type' => ['type' => 'enum', 'constraint' => ['leaving', 'commerce', 'pantry'], 'default' => 'leaving'],
            'order' => ['type' => 'int', 'unsigned' => true, 'constraint' => 11, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('residential_id', 'residentials', 'id', false, 'CASCADE');
        $this->forge->createTable('plans_images', true);
    }

    public function down() {
        if ($this->db->DBDriver != 'SQLite3') {
            $this->forge->dropForeignKey('plans_images', 'plans_images_residential_id_foreign');
        }
        $this->forge->dropTable('plans_images', true);
    }

}
