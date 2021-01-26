<?php

namespace App\Controllers;

class Migrate extends BaseController
{

    public function index()
    {
        $db = \Config\Database::connect();
        $test = $db->query("SELECT * FROM test");


        $data = [
            'title' => 'Halaman Menu 3',
            'isi' => 'menu3',
            'test' => $test
        ];

        echo view('menu3', $data);
    }

    public function menu3()
    {
    }
}
