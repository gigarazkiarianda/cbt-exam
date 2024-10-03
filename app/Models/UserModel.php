<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password']; // Hanya simpan kolom yang diizinkan
    protected $useTimestamps = false; // Sesuaikan jika tidak menggunakan created_at & updated_at
    
    // Tambahkan validasi pada model jika diperlukan
    protected $validationRules = [
        'username' => 'required|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username is required',
            'is_unique' => 'This username is already taken',
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Email must be valid',
            'is_unique' => 'This email is already registered',
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 6 characters',
        ],
    ];
}
