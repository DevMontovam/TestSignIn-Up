<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function signup()
    {
        return view('signup');
    }

    public function authenticate()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('name', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Autenticação bem-sucedida
            return redirect()->to('/dashboard'); // Redirecionar para o painel
        } else {
            // Falha na autenticação
            return redirect()->back()->with('error', 'Invalid login credentials');
        }
    }

    public function register()
    {
        $model = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $model->insert($data);

        return redirect()->to('/login');
    }
}
