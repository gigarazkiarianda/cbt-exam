<?php 

namespace App\Controllers;

use App\Models\ExamModel;
use App\Models\QuestionModel;

class ExamController extends BaseController
{
    public function start()
    {
        $model = new QuestionModel();
        
      
        $data['questions'] = $model->paginate(1); 
        $data['pager'] = $model->pager; 
        
        
        $data['answered'] = session()->get('answered') ?? [];

        return view('exam/start', $data); 
    }

    public function submit()
    {
        
        $answers = $this->request->getPost('answer'); 

        
        $answered = session()->get('answered') ?? [];
        foreach ($answers as $questionId => $answer) {
            $answered[$questionId] = $answer; 
        }
        session()->set('answered', $answered); 

        $score = 0;

        
        $model = new QuestionModel();
        $totalQuestions = $model->countAll(); 

        foreach ($answers as $questionId => $answer) {
            
            $question = $model->find($questionId);
            if ($question && $question['correct_answer'] == $answer) { 
                $score++;
            }
        }

        
        $finalScore = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;

        
        $examModel = new ExamModel();
        $examModel->save([
            'score' => round($finalScore)
        ]);

        
        session()->remove('answered');

        
        return redirect()->to('/exam/result');
    }

    public function result()
    {
        
        $examModel = new ExamModel();
        $data['results'] = $examModel->paginate(10); 
        $data['pager'] = $examModel->pager; 

       
        $lastScore = end($data['results'])['score'] ?? 0; 

        
        if ($lastScore === 100) {
            $data['message'] = 'Selamat! Nilai Anda di atas KKM.';
        } elseif ($lastScore < 75) {
            $data['message'] = 'Anda harus mengikuti remedial, karena nilai Anda di bawah KKM.';
        } else {
            $data['message'] = 'Nilai Anda cukup baik.';
        }

        return view('exam/result', $data); 
    }

    public function navigate($page)
    {
        $model = new QuestionModel();

        
        $data['questions'] = $model->paginate(1, 'default', $page); 
        $data['pager'] = $model->pager; 
        
        
        $data['answered'] = session()->get('answered') ?? [];

        return view('exam/start', $data); 
    }
}
