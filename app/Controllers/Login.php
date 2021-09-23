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
        $this->UserModel = new UserModel();
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
        // $data_session = array(
        //     'user' => "qwe",
        //     'role' => "Admin"
        // );
        // session()->set($data_session);
        // return redirect()->to('/Category');

        $username = $this->request->getVar('inputUsername');
        $password = $this->request->getVar('inputPassword');

        $cek = $this->UserModel->login($username, $password);
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
            session()->set($data_session);
            return redirect()->to('/Category');
        } else {
            session()->setFlashdata('pesan', 'Username & Password not found');
            return redirect()->to('/Login')->withInput();
        }
    }

    function logout()
    {
        print(session_destroy());
        return redirect()->to('/Login');
        echo view('pages/Login');
    }
}
