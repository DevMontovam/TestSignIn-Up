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

    public function menu($userId)
    {
        $model = new UserModel();
        // Ordena os usuários pelo campo 'id' em ordem crescente ( em decrescente é 'DESC')
        $users = $model->orderBy('id', 'ASC')->findAll();

        return view('menu', [
            'users' => $users,
            'currentUserId' => $userId,
        ]);    }

    public function authenticate()
    {
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            return redirect()->to('/menu/' .$user['id']); 
        } else {
            return redirect()->back()->with('error', 'Invalid login credentials');
        }
    }

    public function register()
    {
        $request = service('request');
        $redirect = $request->getPost('redirect');

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

            // Verifica o valor do parâmetro 'redirect' e redireciona para a rota correspondente
            if ($redirect === 'menu') {
                return redirect()->to('/menu')->with('status', 'User registered successfully!');
            }

            // Redireciona para o login se o parâmetro 'redirect' estiver vazio ou não existir
            return redirect()->to('/login')->with('status', 'User registered successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function update()
    {
        $request = service('request');

        // Validação
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|string|max_length[255]',
            'phone' => 'required|string|max_length[20]',
            'email' => 'required|string|valid_email|max_length[255]',
            'password' => 'permit_empty|string|min_length[8]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $id = $this->request->getPost('id');
        $email = $this->request->getPost('email');
        $name = $this->request->getPost('name');
        $phone = $this->request->getPost('phone');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();

        // Verifica se o id existe no banco de dados
        $user = $userModel->where('id', $id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $data = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
        ];

        // Atualiza a senha somente se ela não estiver vazia
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        try {
            $userModel->update($user['id'], $data); // Usa o ID do usuário encontrado

            return redirect()->to('/menu')->with('status', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $userModel = new UserModel();

        // Verifica se o usuário existe no banco de dados
        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->to('/menu')->with('error', 'User not found');
        }

        try {
            // Exclui o usuário
            $userModel->delete($id);
            return redirect()->to('/menu')->with('status', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->to('/menu')->with('error', 'Error: ' . $e->getMessage());
        }
    }

}
