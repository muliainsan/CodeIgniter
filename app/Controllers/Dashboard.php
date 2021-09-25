<?php


namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Dashboard extends BaseController
{
    protected $UserModel;
    protected $title = 'Dashboard';

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }
    function index()
    {
        if (!session('user')) {
            header('Location: /Login');
            exit();
        } elseif (!session('role')) {
            header('Location: /Category');
            exit();
        }
        echo view('pages/Dashboard');
    }
}
