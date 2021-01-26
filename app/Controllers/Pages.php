<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Menu Koepinang',
        ];

        echo view('menu', $data);
    }

    public function menu()
    {
        $data = [
            'title' => 'Menu Koepinang',
        ];

        echo view('menu', $data);
    }

    public function order()
    {
        $data = [
            'title' => 'Order List',
        ];

        echo view('order', $data);
    }
}
