<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClientsRequests extends Migration {

    public function up() {
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'phone' => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
            'email' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'text' => ['type' => 'text', 'null' => true],
            'page' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'form' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'utm_source' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'utm_medium' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'utm_campaign' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'utm_term' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'utm_content' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'language' => ['type' => 'varchar', 'constraint' => 2, 'null' => true],
            'code' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'int', 'constraint' => 1, 'null' => false, 'default' => 0],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('clients_requests', true);
    }

    public function down() {
        $this->forge->dropTable('clients_requests', true);
    }

}
