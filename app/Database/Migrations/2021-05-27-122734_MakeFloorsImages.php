<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeFloorsImages extends Migration {

    public function up() {
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'image_code' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'image_name' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'image_mime' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'section_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('section_id', 'sections', 'id', false, 'CASCADE');
        $this->forge->createTable('floor_images', true);
    }

    public function down() {
        // drop constraints first to prevent errors
        if ($this->db->DBDriver != 'SQLite3')
        {
            $this->forge->dropForeignKey('floor_images', 'floor_images_section_id_foreign');
        }
        $this->forge->dropTable('floor_images', true);
        
    }

}
