<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function register()
    {
        return view('auth/register');
    }

    public function storeRegister()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]|max_length[255]',
            'confirm_password' => 'required|matches[password]',
        ], [
            'username' => [
                'required' => 'Username wajib diisi.',
                'min_length' => 'Username minimal 3 karakter.',
                'max_length' => 'Username maksimal 20 karakter.',
                'is_unique' => 'Username sudah terdaftar.'
            ],
            'email' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique' => 'Email sudah terdaftar.'
            ],
            'password' => [
                'required' => 'Password wajib diisi.',
                'min_length' => 'Password minimal 6 karakter.',
                'max_length' => 'Password maksimal 255 karakter.'
            ],
            'confirm_password' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches' => 'Konfirmasi password tidak sesuai dengan password.'
            ]
        ]);

        if ($validation->withRequest($this->request)->run() == false) {
            log_message('error', 'Validasi gagal pada registrasi: ' . implode(", ", $validation->getErrors()));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $userModel->insert($data);

        return redirect()->to('auth/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function storeLogin()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required',
        ], [
            'email' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.'
            ],
            'password' => [
                'required' => 'Password wajib diisi.'
            ]
        ]);

        if ($validation->withRequest($this->request)->run() == false) {
            log_message('error', 'Validasi gagal pada login: ' . implode(", ", $validation->getErrors()));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            // Set session data after successful login
            $sessionData = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'logged_in' => true, // Use 'logged_in' for session check
            ];
            session()->set($sessionData);

            return redirect()->to('exam/index'); // Redirect ke halaman index ujian
        } else {
            log_message('error', 'Login gagal: Email atau password tidak valid.');
            return redirect()->back()->with('error', 'Email atau password tidak valid.');
        }
    }

    public function logout()
    {
        session()->destroy(); // Destroy session on logout
        return redirect()->to('auth/login');
    }
}
