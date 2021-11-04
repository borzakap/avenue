<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeInfra extends Migration {

    public function up() {
        // add infrastructure table
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'residential_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'latitude' => ['type' => 'float', 'constaint' => '13,10', 'null' => true, 'default' => true],
            'longitude' => ['type' => 'float', 'constaint' => '13,10', 'null' => true, 'default' => true],
            'distance' => ['type' => 'int', 'constaint' => 11, 'unsigned' => true, 'null' => true],
            'image' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'type' => ['type' => 'enum', 'constraint' => ['services', 'medicine', 'sport', 'parks', 'transport', 'shops', 'entertainment', 'education', 'empty'], 'default' => 'empty'],
            'publish' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('residential_id', 'residentials', 'id', false, 'CASCADE');
        $this->forge->createTable('infrastructure', true);

        // add infrastructure translates
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'infrastructure_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'language' => ['type' => 'varchar', 'constraint' => 2, 'null' => false],
            'title' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'description' => ['type' => 'text', 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['language', 'infrastructure_id']);
        $this->forge->addForeignKey('infrastructure_id', 'infrastructure', 'id', false, 'CASCADE');
        $this->forge->createTable('infrastructure_translation', true);
    }

    public function down() {
        // drop constraints first for infrastructure to prevent errors
        if ($this->db->DBDriver != 'SQLite3') {
            $this->forge->dropForeignKey('infrastructure', 'infrastructure_residential_id_foreign');
            $this->forge->dropForeignKey('infrastructure_translation', 'infrastructure_translation_infrastructure_id_foreign');
        }
        // drop infrastructure table
        $this->forge->dropTable('infrastructure', true);
        // drop infrastructure translates table
        $this->forge->dropTable('infrastructure_translation', true);
    }

}
