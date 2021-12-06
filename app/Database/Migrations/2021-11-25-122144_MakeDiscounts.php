<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeDiscounts extends Migration {

    public function up() {
        // add discounts table
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'residential_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'image' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'publish' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('residential_id', 'residentials', 'id', false, 'CASCADE');
        $this->forge->createTable('discounts', true);

        // add discounts meta
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'discount_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'entity_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'entity_type' => ['type' => 'enum', 'constraint' => ['residential', 'section', 'layout', 'flat'], 'default' => 'residential'],
            'value_type' => ['type' => 'enum', 'constraint' => ['sum', 'perc', 'empty'], 'default' => 'empty'],
            'value' => ['type' => 'float', 'constaint' => '10,2', 'null' => true, 'default' => true],
            'date_to' => ['type' => 'datetime', 'null' => true],
            'date_from' => ['type' => 'datetime', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('discount_id', 'discounts', 'id', false, 'CASCADE');
        $this->forge->createTable('discounts_meta', true);
        
        // add discounts translates
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'discount_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'language' => ['type' => 'varchar', 'constraint' => 2, 'null' => false],
            'title' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'slogan' => ['type' => 'text', 'null' => true],
            'description' => ['type' => 'text', 'null' => true],
            'meta_title' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'meta_description' => ['type' => 'text', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['language', 'discount_id']);
        $this->forge->addForeignKey('discount_id', 'discounts', 'id', false, 'CASCADE');
        $this->forge->createTable('discounts_translation', true);
    }

    public function down() {
        if ($this->db->DBDriver != 'SQLite3') {
            $this->forge->dropForeignKey('discounts', 'discounts_residential_id_foreign');
            $this->forge->dropForeignKey('discounts_meta', 'discounts_meta_discount_id_foreign');
            $this->forge->dropForeignKey('discounts_translation', 'discounts_translation_discount_id_foreign');
        }
        $this->forge->dropTable('discounts', true);
        $this->forge->dropTable('discounts_meta', true);
        $this->forge->dropTable('discounts_translation', true);
    }

}
