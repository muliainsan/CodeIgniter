<?php


namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Login extends BaseController
{
    protected $UserModel;
    protected $title = 'Login';

    public function __construct()
    {
        if (session('email')) {
            header('Location: /User');
            exit();
        }

        $this->UserModel = new UserModel();
    }
    function index()
    {
        $data = [
            'title' => $this->title,
            'validation' => \Config\Services::validation()
        ];

        echo view('pages/login', $data);
    }

    function auth()
    {
        $session = session();
        $email = $this->request->getVar('inputEmail');
        $password = $this->request->getVar('inputPassword');

        var_dump($email);
        var_dump($password);
        $cek = $this->UserModel->login($email, $password);

        if ($cek) {

            $data_session = array(
                'email' => $email,
                'status' => "userlogin",
                'validation' => \Config\Services::validation()
            );
            $session->set($data_session);
            return redirect()->to('/User');
        } else {
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login')->withInput();
        }
        var_dump($email);
        var_dump($password);
    }

    function logout()
    {

        session()->destroy();
        return redirect()->to('/login');
        echo view('pages/login');
    }
}
