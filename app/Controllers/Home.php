<?php 

namespace App\Controllers;

use App\Models\CategoryModel;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login'); 
        }

       
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        
        return view('exam/index', [
            'categories' => $categories,
            'username' => $session->get('username') 
        ]);
    }
}
