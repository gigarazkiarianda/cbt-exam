<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserToExamsTable extends Migration
{
    public function up()
    {
        // Check if columns exist before adding them
        if (!$this->db->fieldExists('user_id', 'exams')) {
            $this->forge->addColumn('exams', [
                'user_id' => [
                    'type' => 'INT',
                    'unsigned' => true,
                    'null' => true,
                    'after' => 'id'
                ],
            ]);
        }

        if (!$this->db->fieldExists('created_at', 'exams')) {
            $this->forge->addColumn('exams', [
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => false
                ],
            ]);
        }

        if (!$this->db->fieldExists('updated_at', 'exams')) {
            $this->forge->addColumn('exams', [
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('user_id', 'exams')) {
            $this->forge->dropColumn('exams', 'user_id');
        }

        if ($this->db->fieldExists('created_at', 'exams')) {
            $this->forge->dropColumn('exams', 'created_at');
        }

        if ($this->db->fieldExists('updated_at', 'exams')) {
            $this->forge->dropColumn('exams', 'updated_at');
        }
    }
}
