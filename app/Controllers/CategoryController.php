<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    protected $CategoryModel;
    public function __construct()
    {
        $this->CategoryModel = new CategoryModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Menu Categories',
            'categoryData' => $this->CategoryModel->findAll(),
        ];

        echo view('category', $data);
    }


    public function detail($id)
    {
        $data = $this->CategoryModel->getCategory($id);
        var_dump($data);
    }
}
