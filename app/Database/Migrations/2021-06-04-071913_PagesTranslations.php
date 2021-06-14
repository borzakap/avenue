<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PagesTranslations extends Migration {

    public function up() {
        // residential translations
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'slug' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'language' => ['type' => 'varchar', 'constraint' => 2, 'null' => false],
            'code' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'text' => ['type' => 'text', 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['slug', 'language', 'code']);
        $this->forge->createTable('static_pages_translation', true);
    }

    public function down() {
        $this->forge->dropTable('static_pages_translation', true);
    }

}
