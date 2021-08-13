<?php


namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Login extends BaseController
{
    protected $UserModel;
    protected $title = 'Login';
    protected $session;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->session = session();
    }
    function index()
    {
        if (session('user')) {
            header('Location: /Category');
            exit();
        }
        $data = [
            'title' => $this->title,
            'validation' => \Config\Services::validation()
        ];

        echo view('pages/Login', $data);
    }

    function auth()
    {

        $username = $this->request->getVar('inputUsername');
        $password = $this->request->getVar('inputPassword');


        $cek = $this->UserModel->login($username, $password);
        // printf($cek['IdRole']);
        // die;
        if ($cek) {
            if ($cek['IdRole'] == 1) {
                $data_session = array(
                    'user' => $cek['Name'],
                    'role' => "Admin"
                );
            } else {
                $data_session = array(
                    'user' => $cek['Name']
                );
            }
            $this->session->set($data_session);
            return redirect()->to('/Category');
        } else {
            $this->session->setFlashdata('msg', 'Username not Found');
            return redirect()->to('/login')->withInput();
        }
        var_dump($username);
        var_dump($password);
    }

    function logout()
    {
        print(session_destroy());

        return redirect()->to('/login');
        echo view('pages/login');
    }
}
