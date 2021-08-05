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
        // if (session('user')) {
        //     header('Location: /Category');
        //     exit();
        // }

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
        $username = $this->request->getVar('inputUsername');
        $password = $this->request->getVar('inputPassword');


        $cek = $this->UserModel->login($username, $password);

        if ($cek) {

            $data_session = array(
                'user' => $username,
                'status' => "userlogin",
                'validation' => \Config\Services::validation()
            );
            printf($username);
            printf($password);
            //die;
            $session->set($data_session);
            return redirect()->to('/Category');
        } else {
            $session->setFlashdata('msg', 'Username not Found');
            return redirect()->to('/login')->withInput();
        }
        var_dump($username);
        var_dump($password);
    }

    function logout()
    {

        session()->destroy();
        return redirect()->to('/login');
        echo view('pages/login');
    }
}
