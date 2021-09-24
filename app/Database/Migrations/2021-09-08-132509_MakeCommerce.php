<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeCommerce extends Migration {

    public function up() {
        // add column floor_type to floor_images
        $this->forge->addColumn('floor_images',
                ['floor_type' => [
                        'type' => 'enum',
                        'constraint' => ['leaving', 'commerce', 'pantry'],
                        'default' => 'leaving',
                    ],
                ]
        );

        // drop column type from premises
        $this->forge->dropColumn('premises', 'type');
        
        // add commerce table
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'slug' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'residential_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'section_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'code' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'advertise' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'sold_out' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
            'booked_for' => ['type' => 'datetime', 'null' => true],
            'price' => ['type' => 'float', 'unsigned' => true, 'constaint' => '10,2', 'null' => true],
            'floor' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'ceil_height' => ['type' => 'float', 'unsigned' => true, 'constaint' => '2,2', 'null' => true],
            'all_area' => ['type' => 'float', 'unsigned' => true, 'constaint' => '2,2', 'null' => true],
            'levels' => ['type' => 'int', 'constaint' => 11, 'unsigned' => true, 'null' => false, 'default' => 1],
            'image_2d' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'image_3d' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'file_to_upload' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'floor_images_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true,],
            'poligon' => ['type' => 'text', 'null' => true],
            'publish' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addUniqueKey(['code', 'residential_id', 'section_id']);
        $this->forge->addForeignKey('residential_id', 'residentials', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('section_id', 'sections', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('floor_images_id', 'floor_images', 'id', false, 'CASCADE');
        $this->forge->createTable('commerce', true);
        
        // add commerce translates
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'commerce_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
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
        $this->forge->addUniqueKey(['language', 'commerce_id']);
        $this->forge->addForeignKey('commerce_id', 'commerce', 'id', false, 'CASCADE');
        $this->forge->createTable('commerce_translation', true);
    }

    public function down() {
        // drop column floor_type from floor_images
        $this->forge->dropColumn('floor_images', 'floor_type');

        // add column type to premises
        $this->forge->addColumn('premises',
                ['type' => [
                        'type' => 'enum',
                        'constraint' => ['pantry', 'commerce'],
                        'default' => 'commerce'
                    ],
                ]
        );
        
        // drop constraints first for commerce to prevent errors
        if ($this->db->DBDriver != 'SQLite3') {
            $this->forge->dropForeignKey('commerce', 'commerce_residential_id_foreign');
            $this->forge->dropForeignKey('commerce', 'commerce_section_id_foreign');
            $this->forge->dropForeignKey('commerce', 'commerce_floor_images_id_foreign');
            $this->forge->dropForeignKey('commerce_translation', 'commerce_translation_commerce_id_foreign');
        }
        // drop commerce table
        $this->forge->dropTable('commerce', true);
        // drop commerce translates table
        $this->forge->dropTable('commerce_translation', true);
    }

}
