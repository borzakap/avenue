<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProgressMake extends Migration {

    public function up() {
        // add progress table
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'slug' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'residential_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'video' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'progressed_at' => ['type' => 'datetime', 'null' => true],
            'publish' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addForeignKey('residential_id', 'residentials', 'id', false, 'CASCADE');
        $this->forge->createTable('progress', true);

        // add progress translates
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'progress_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'language' => ['type' => 'varchar', 'constraint' => 2, 'null' => false],
            'title' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'meta_title' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'description' => ['type' => 'text', 'null' => true],
            'meta_description' => ['type' => 'text', 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['language', 'progress_id']);
        $this->forge->addForeignKey('progress_id', 'progress', 'id', false, 'CASCADE');
        $this->forge->createTable('progress_translation', true);

        // create progress images table
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'image_name' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'image_width' => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'image_height' => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'progress_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'main' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'order' => ['type' => 'int', 'unsigned' => true, 'constraint' => 11, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('progress_id', 'progress', 'id', false, 'CASCADE');
        $this->forge->createTable('progress_images', true);
    }

    public function down() {
        // drop constraints first for progress to prevent errors
        if ($this->db->DBDriver != 'SQLite3') {
            $this->forge->dropForeignKey('progress', 'progress_residential_id_foreign');
            $this->forge->dropForeignKey('progress_images', 'progress_images_progress_id_foreign');
            $this->forge->dropForeignKey('progress_translation', 'progress_translation_progress_id_foreign');
        }
        // drop progress table
        $this->forge->dropTable('progress', true);
        // drop progress translates table
        $this->forge->dropTable('progress_translation', true);
        // drop progress images table
        $this->forge->dropTable('progress_images', true);
    }

}
