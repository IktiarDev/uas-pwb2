<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('books'));
        }

        if (strtolower($this->request->getMethod()) === 'post') {
            $userModel = new UserModel();
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $userModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'name'      => $user['name'],
                    'role'      => $user['role'],
                    'logged_in' => true,
                ]);
                return redirect()->to(base_url('books'));
            }

            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }

        return view('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil logout.');
    }
}
