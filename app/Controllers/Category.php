<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Category extends BaseController
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

        echo view('pages/category/CategoryView', $data);
    }


    public function detail($id)
    {
        $data = $this->CategoryModel->getCategory($id);
        var_dump($data);

        if (empty($data)) {
            throw new PageNotFoundException('Category with Id ' . $id . 'not found');
        };
    }

    public function create()
    {
        $data = [
            'title' => 'Add Category',
            'categoryData' => $this->CategoryModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        echo view('pages/category/CategoryCreate', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'inputCategory' => [
                'rules' => 'required|is_unique[Category.CategoryName]',
                'errors' => [
                    'required' => '"Category Name" can not be empty',
                    'is_unique' => '"Category Name" has been registered'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Category/Create')->withInput()->with('validation', $validation);
        }

        $this->CategoryModel->save([
            'CategoryName' => $this->request->getVar('inputCategory'),
        ]);

        session()->setFlashdata('pesan', 'Data added successfully.');

        return redirect()->to('/Category')->withInput();
    }
}
