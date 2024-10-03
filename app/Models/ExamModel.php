<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamModel extends Model
{
    protected $table = 'exams'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'category_id', 'score'];
}
