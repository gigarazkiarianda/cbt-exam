<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateResultsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'exam_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'score' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2'
            ],
            'ranking' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('results');
    }

    public function down()
    {
        $this->forge->dropTable('results');
    }
}
