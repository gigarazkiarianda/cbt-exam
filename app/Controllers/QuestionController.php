<?php

namespace App\Controllers;

use App\Models\QuestionModel;

class QuestionController extends BaseController
{
    public function index()
    {
        $model = new QuestionModel();
        $data['questions'] = $model->findAll();

        return view('exam/index', $data);
    }
}
