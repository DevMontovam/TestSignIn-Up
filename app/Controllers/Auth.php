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
        // Obter instância da requisição
        $request = service('request');

        // Validação dos dados do formulário
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

        // Capturar os dados do formulário
        $name = $request->getPost('name');
        $phone = $request->getPost('phone');
        $email = $request->getPost('email');
        $password = password_hash($request->getPost('password'), PASSWORD_DEFAULT);

        // Instanciar o modelo
        $userModel = new UserModel();

        try {
            // Inserir os dados na tabela users usando o modelo
            $userModel->insert([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'password' => $password,
            ]);

            // Redirecionar para a tela de login com uma mensagem de sucesso
            return redirect()->to('/login')->with('status', 'User registered successfully!');
        } catch (\Exception $e) {
            // Exibir erro detalhado para depuração
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

}
