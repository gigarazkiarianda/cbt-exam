<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    /**
     * Validation rules for the user registration.
     *
     * @var array
     */
    public array $register = [
        'username' => [
            'label' => 'Username',
            'rules' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
            'errors' => [
                'required' => 'Username is required.',
                'min_length' => 'Username must be at least 3 characters long.',
                'max_length' => 'Username cannot exceed 20 characters.',
                'is_unique' => 'This username is already taken.',
            ],
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[users.email]',
            'errors' => [
                'required' => 'Email is required.',
                'valid_email' => 'You must provide a valid email address.',
                'is_unique' => 'This email is already registered.',
            ],
        ],
        'password' => [
            'label' => 'Password',
            'rules' => 'required|min_length[6]|max_length[255]',
            'errors' => [
                'required' => 'Password is required.',
                'min_length' => 'Password must be at least 6 characters long.',
                'max_length' => 'Password cannot exceed 255 characters.',
            ],
        ],
        'confirm_password' => [
            'label' => 'Confirm Password',
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Confirm password is required.',
                'matches' => 'Password confirmation does not match the password.',
            ],
        ],
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}
