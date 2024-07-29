<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
    public function login()
    {
        echo view('login', [
            'status' => session()->getFlashdata('status'),
            'error' => session()->getFlashdata('error'),
        ]);
    }

    public function signup()
    {
        return view('signup');
    }

    public function menu()
    {
        $model = new UserModel();
        $users = $model->findAll();
        
        return view('menu', [ 'users' => $users ]);
    }

    public function authenticate()
    {
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            return redirect()->to('/menu'); 
        } else {
            return redirect()->back()->with('error', 'Invalid login credentials');
        }
    }


    public function register()
    {
        $request = service('request');

        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|string|max_length[255]',
            'phone' => 'required|string|max_length[20]',
            'email' => 'required|string|valid_email|max_length[255]|is_unique[users.email]',
            'password' => 'required|string|min_length[8]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $name = $request->getPost('name');
        $phone = $request->getPost('phone');
        $email = $request->getPost('email');
        $password = password_hash($request->getPost('password'), PASSWORD_DEFAULT);

        $userModel = new UserModel();

        try {
            $userModel->insert([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'password' => $password,
            ]);

            return redirect()->to('/login')->with('status', 'User registered successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

}
