<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategoryToQuestionsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('questions', [
            'category_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                'after' => 'id'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('questions', 'category_id');
    }
}
