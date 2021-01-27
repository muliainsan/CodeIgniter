<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Menu Koepinang',
        ];

        echo view('menu/MenuView', $data);
    }

    public function menu()
    {
        $data = [
            'title' => 'Menu Koepinang',
        ];

        echo view('pages/menu/MenuView', $data);
    }

    public function order()
    {
        $data = [
            'title' => 'Order List',
        ];

        echo view('OrderView', $data);
    }
}
