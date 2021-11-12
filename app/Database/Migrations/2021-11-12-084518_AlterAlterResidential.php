<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterAlterResidential extends Migration {

    public function up() {
        $this->forge->addColumn('residentials',
                ['link_instagram' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => true,
                    ],
                ],
        );
        $this->forge->addColumn('residentials',
                ['link_fasebook' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => true,
                    ],
                ],
        );
        $this->forge->addColumn('residentials',
                ['link_youtube' => [
                        'type' => 'varchar',
                        'constraint' => 255,
                        'null' => true,
                    ],
                ],
        );
        $this->forge->addColumn('residentials_translation',
                ['conditions' => [
                        'type' => 'text',
                        'null' => true,
                    ],
                ],
        );
    }

    public function down() {
        $this->forge->dropColumn('residentials_translation', 'conditions');
        $this->forge->dropColumn('residentials', 'link_fasebook');
        $this->forge->dropColumn('residentials', 'link_youtube');
        $this->forge->dropColumn('residentials', 'link_instagram');
    }

}
