<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTranslations extends Migration {

    public function up() {
        // residentials_translation
        $this->forge->dropColumn('residentials_translation', 'created_at');
        $this->forge->dropColumn('residentials_translation', 'updated_at');
        $this->forge->dropColumn('residentials_translation', 'deleted_at');
        // residentials_translation
        $this->forge->dropColumn('sections_translation', 'created_at');
        $this->forge->dropColumn('sections_translation', 'updated_at');
        $this->forge->dropColumn('sections_translation', 'deleted_at');
        // residentials_translation
        $this->forge->dropColumn('layouts_translation', 'created_at');
        $this->forge->dropColumn('layouts_translation', 'updated_at');
        $this->forge->dropColumn('layouts_translation', 'deleted_at');
        // residentials_translation
        $this->forge->dropColumn('flats_translation', 'created_at');
        $this->forge->dropColumn('flats_translation', 'updated_at');
        $this->forge->dropColumn('flats_translation', 'deleted_at');
        // residentials_translation
        $this->forge->dropColumn('premises_translation', 'created_at');
        $this->forge->dropColumn('premises_translation', 'updated_at');
        $this->forge->dropColumn('premises_translation', 'deleted_at');
    }

    public function down() {
        // residentials_translation
        $this->forge->addColumn('residentials_translation',
                ['created_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('residentials_translation',
                ['updated_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('residentials_translation',
                ['deleted_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        // sections_translation
        $this->forge->addColumn('sections_translation',
                ['created_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('sections_translation',
                ['updated_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('sections_translation',
                ['deleted_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        // layouts_translation
        $this->forge->addColumn('layouts_translation',
                ['created_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('layouts_translation',
                ['updated_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('layouts_translation',
                ['deleted_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        // flats_translation
        $this->forge->addColumn('flats_translation',
                ['created_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('flats_translation',
                ['updated_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('flats_translation',
                ['deleted_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        // premises_translation
        $this->forge->addColumn('premises_translation',
                ['created_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('premises_translation',
                ['updated_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
        $this->forge->addColumn('premises_translation',
                ['deleted_at' => [
                    'type' => 'datetime',
                    'null' => true,
                    ],
                ]
        );
    }

}
