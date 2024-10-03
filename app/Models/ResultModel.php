<?php

namespace App\Models;

use CodeIgniter\Model;

class ResultModel extends Model
{
    protected $table = 'results';
    protected $primaryKey = 'id';
    protected $allowedFields = ['exam_id', 'score', 'ranking'];
    protected $useTimestamps = true;
}
