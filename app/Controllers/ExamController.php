<?php 

namespace App\Controllers;

use App\Models\ExamModel;
use App\Models\QuestionModel;
use App\Models\CategoryModel;

class ExamController extends BaseController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        return view('exam/index', [
            'categories' => $categories
        ]);
    }

    public function start($categoryId)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $questionModel = new QuestionModel();
        $categoryModel = new CategoryModel();

        $data['category'] = $categoryModel->find($categoryId);
        if (!$data['category']) {
            return redirect()->to('/exam/index');
        }

       
        $data['questions'] = $questionModel->where('category_id', $categoryId)->findAll();

        return view('exam/start', [
            'category' => $data['category'],
            'questions' => $data['questions'],
            'answered' => $data['answered'] ?? [], 
        ]);
    }

    public function submit($categoryId)
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        
        $answers = $this->request->getPost('answer');

        $score = 0;
        $questionModel = new QuestionModel();

        
        $totalQuestions = $questionModel->where('category_id', $categoryId)->countAllResults();

        
        foreach ($answers as $questionId => $answer) {
            $question = $questionModel->find($questionId);
            if ($question && $question['correct_answer'] === $answer) {
                $score++;
            }
        }

        
        $finalScore = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;

        
        $examModel = new ExamModel();
        $examModel->save([
            'user_id' => $session->get('id'),
            'category_id' => $categoryId,
            'score' => round($finalScore),
        ]);

        
        return redirect()->to('/exam/result');
    }

    public function result()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $examModel = new ExamModel();
        $userModel = new \App\Models\UserModel();
        $categoryModel = new \App\Models\CategoryModel();

        $data['results'] = $examModel
            ->where('user_id', $session->get('id'))
            ->findAll(); 

        $data['examDetails'] = [];
        foreach ($data['results'] as $result) {
            $user = $userModel->find($result['user_id']);
            $category = $categoryModel->find($result['category_id']);

            $data['examDetails'][] = [
                'user_id' => $result['user_id'],
                'username' => $user ? $user['username'] : 'Tidak Diketahui',
                'category_id' => $result['category_id'],
                'category_name' => $category ? $category['category_name'] : 'Tidak Diketahui',
                'score' => $result['score'],
            ];
        }

        return view('exam/result', $data);
    }
}
