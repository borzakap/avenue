<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeFlat extends Migration {

    public function up() {
        
        /**
         * residentials
         * 
         * residentials table
         */
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'slug' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'residential_build_start' => ['type' => 'datetime', 'default' => null],
            'residential_build_end' => ['type' => 'datetime', 'default' => null],
            'latitude' => ['type' => 'float', 'constaint' => '13,10', 'null' => true, 'default' => true],
            'longitude' => ['type' => 'float', 'constaint' => '13,10', 'null' => true, 'default' => true],
            'ceil_height' => ['type' => 'float', 'unsigned' => true, 'constaint' => '2,2', 'null' => true],
            'publish' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('residentials', true);
        
        // residential translations
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'residential_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'language' => ['type' => 'varchar', 'constraint' => 2, 'null' => false],
            'title' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'meta_title' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'description' => ['type' => 'text', 'null' => true],
            'meta_description' => ['type' => 'text', 'null' => true],
            'address' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['language', 'residential_id']);
        $this->forge->addForeignKey('residential_id', 'residentials', 'id', false, 'CASCADE');
        $this->forge->createTable('residentials_translation', true);

        /**
         * sections
         * 
         * sections table
         */
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'section_code' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'slug' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'residential_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'section_build_start' => ['type' => 'datetime', 'default' => null],
            'section_build_end' => ['type' => 'datetime', 'default' => null],
            'publish' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addUniqueKey(['section_code', 'residential_id']);
        $this->forge->addForeignKey('residential_id', 'residentials', 'id', false, 'CASCADE');
        $this->forge->createTable('sections', true);
        
        // sections translates
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'section_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
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
        $this->forge->addUniqueKey(['language', 'section_id']);
        $this->forge->addForeignKey('section_id', 'sections', 'id', false, 'CASCADE');
        $this->forge->createTable('sections_translation', true);
        
        /**
         * layouts
         * 
         * layouts table
         */
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'code' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'slug' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'residential_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'section_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'image_2d' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'image_3d' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'image_other' => ['type' => 'text', 'null' => true],
            'file_to_upload' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'rooms' => ['type' => 'int', 'constaint' => 11, 'unsigned' => true, 'null' => true],
            'levels' => ['type' => 'int', 'constaint' => 11, 'unsigned' => true, 'null' => false, 'default' => 1],
            'ceil_height' => ['type' => 'float', 'unsigned' => true, 'constaint' => '2,2', 'null' => true],
            'all_area' => ['type' => 'float', 'unsigned' => true, 'constaint' => '2,2', 'null' => true],
            'live_area' => ['type' => 'float', 'unsigned' => true, 'constaint' => '2,2', 'null' => true],
            'kit_area' => ['type' => 'float', 'unsigned' => true, 'constaint' => '2,2', 'null' => true],
            'balcon' => ['type' => 'tinyint', 'constraint' => 1, 'null' => true,'default' => 0],
            'advertise' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'sold_out' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
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
        $this->forge->createTable('layouts', true);
        
        // layouts translates
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'layout_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
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
        $this->forge->addUniqueKey(['language', 'layout_id']);
        $this->forge->addForeignKey('layout_id', 'layouts', 'id', false, 'CASCADE');
        $this->forge->createTable('layouts_translation', true);
        
        /**
         * flats
         * 
         * flats table
         */
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'slug' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'residential_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'section_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'layout_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'advertise' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'sold_out' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
            'booked_for' => ['type' => 'datetime', 'null' => true],
            'price' => ['type' => 'float', 'unsigned' => true, 'constaint' => '10,2', 'null' => true],
            'floor' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'number' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'images' => ['type' => 'text', 'null' => true],
            'publish' => ['type' => 'tinyint', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addUniqueKey(['number','floor','layout_id', 'residential_id', 'section_id']);
        $this->forge->addForeignKey('residential_id', 'residentials', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('section_id', 'sections', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('layout_id', 'layouts', 'id', false, 'CASCADE');
        $this->forge->createTable('flats', true);

        // flats translate
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'flat_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
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
        $this->forge->addUniqueKey(['language', 'flat_id']);
        $this->forge->addForeignKey('flat_id', 'flats', 'id', false, 'CASCADE');
        $this->forge->createTable('flats_translation', true);

        /**
         * premises
         * 
         * premises table
         */
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
            'image_2d' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'image_3d' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'image_other' => ['type' => 'text', 'null' => true],
            'file_to_upload' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'type' => ['type' => 'enum', 'constraint' => ['pantry', 'commerce'], 'default' => 'commerce'],
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
        $this->forge->createTable('premises', true);

        // premises translates
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'premise_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
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
        $this->forge->addUniqueKey(['language', 'premise_id']);
        $this->forge->addForeignKey('premise_id', 'premises', 'id', false, 'CASCADE');
        $this->forge->createTable('premises_translation', true);
    }

    public function down() {
        // drop constraints first to prevent errors
        if ($this->db->DBDriver != 'SQLite3')
        {
            $this->forge->dropForeignKey('residentials_translation', 'residentials_translation_residential_id_foreign');
            $this->forge->dropForeignKey('sections', 'sections_residential_id_foreign');
            $this->forge->dropForeignKey('sections_translation', 'sections_translation_section_id_foreign');
            $this->forge->dropForeignKey('layouts', 'layouts_residential_id_foreign');
            $this->forge->dropForeignKey('layouts', 'layouts_section_id_foreign');
            $this->forge->dropForeignKey('layouts_translation', 'layouts_translation_layout_id_foreign');
            $this->forge->dropForeignKey('flats', 'flats_layout_id_foreign');
            $this->forge->dropForeignKey('flats', 'flats_section_id_foreign');
            $this->forge->dropForeignKey('flats', 'flats_residential_id_foreign');
            $this->forge->dropForeignKey('flats_translation', 'flats_translation_flat_id_foreign');
            $this->forge->dropForeignKey('premises', 'premises_residential_id_foreign');
            $this->forge->dropForeignKey('premises', 'premises_section_id_foreign');
            $this->forge->dropForeignKey('premises_translation', 'premises_translation_premise_id_foreign');
        }
        
        $this->forge->dropTable('residentials', true);
        $this->forge->dropTable('residentials_translation', true);
        $this->forge->dropTable('sections', true);
        $this->forge->dropTable('sections_translation', true);
        $this->forge->dropTable('layouts', true);
        $this->forge->dropTable('layouts_translation', true);
        $this->forge->dropTable('flats', true);
        $this->forge->dropTable('flats_translation', true);
        $this->forge->dropTable('premises', true);
        $this->forge->dropTable('premises_translation', true);
    }

}
