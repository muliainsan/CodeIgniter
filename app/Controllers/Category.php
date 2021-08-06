<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\MenuModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Category extends BaseController
{
    protected $CategoryModel;
    protected $MenuModel;
    protected $title = 'Categories';

    public function __construct()
    {
        if (!session('user')) {
            header('Location: /Login');
            exit();
        }
        $this->CategoryModel = new CategoryModel();
        $this->MenuModel = new MenuModel();
    }

    public function index()
    {

        $data = [
            'title' => $this->title,
            'categoryData' => $this->CategoryModel->findAll(),
            'menuTotal' => $this->MenuModel->getMenuCategory()
        ];

        echo view('pages/category/CategoryView', $data);
    }

    //function with view
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
            'title' => $this->title,
            'categoryData' => $this->CategoryModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        echo view('pages/category/CategoryCreate', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'categoryData' => $this->CategoryModel->getCategory($id),
            'validation' => \Config\Services::validation()
        ];

        return view('pages/Category/CategoryEdit', $data);
    }


    //function  CRUD
    public function save()
    {
        //validation
        $categoryName = $this->request->getVar('inputCategory');
        $validation = $this->_validationSave($categoryName);
        if (!is_null($validation)) {
            return $validation;
        }
        $saveResult = $this->CategoryModel->save([
            "CategoryName" => $categoryName
        ]);

        if (!$saveResult) {
            session()->setFlashdata('pesan', 'Failed.');
        } else {
            session()->setFlashdata('pesan', 'Data added successfully.');
        }
        return redirect()->to('/Category')->withInput();
    }


    public function delete()
    {
        $id = $this->request->getVar('Id');
        $this->CategoryModel->delete($id);
        session()->setFlashdata('pesan', 'Data Deleted successfully.');
        return redirect()->to('/Category');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $categoryName = $this->request->getVar('inputCategory');
        var_dump($id);
        var_dump($categoryName);

        //validation
        $validation =

            $this->_validationEdit(
                $this->request->getVar('inputCategory'),
                $this->CategoryModel->getCategory($id)

            );
        if (!is_null($validation)) {
            return $validation;
        }

        //Update function is same as Save
        $this->CategoryModel->save([
            'Id' => $id,
            'CategoryName' => $categoryName
        ]);

        session()->setFlashdata('pesan', 'Data updated successfully.');

        return redirect()->to('/Category')->withInput();
    }



    public function _validationSave($categoryName)
    {
        $rules = 'required|is_unique[Category.CategoryName]';
        if ($this->CategoryModel->is_unique($categoryName)) {

            $rules = 'required';
        }

        $validate = [
            'inputCategory' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Category Name" can not be empty',
                    'is_unique' => '"Category Name" has been registered'
                ]
            ]
        ];

        if (!$this->validate($validate)) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Category/Create')->withInput()->with('validation', $validation);
        }
    }

    public function _validationEdit($categoryName, $categoryDataOld)
    {
        $rules = 'required|is_unique[Category.CategoryName]';

        if ($categoryName == $categoryDataOld['CategoryName'] || $this->CategoryModel->is_unique($categoryName)) {

            $rules = 'required';
        }

        $validate = [
            'inputCategory' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Category Name" can not be empty',
                    'is_unique' => '"Category Name" has been registered'
                ]
            ]
        ];

        if (!$this->validate($validate)) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Category/Edit/' . $categoryDataOld['Id'])->withInput()->with('validation', $validation);
        }
    }
}
