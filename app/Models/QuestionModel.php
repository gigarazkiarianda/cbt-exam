<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = 'questions'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer'];
}
