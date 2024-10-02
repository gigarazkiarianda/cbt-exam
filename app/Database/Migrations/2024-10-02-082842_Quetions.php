<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'question' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'option_a' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'option_b' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'option_c' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'option_d' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'correct_answer' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('questions');
    }

    public function down()
    {
        $this->forge->dropTable('questions');
    }
}

