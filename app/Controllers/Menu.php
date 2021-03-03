<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Menu extends BaseController
{
    protected $MenuModel;
    protected $CategoryModel;
    protected $title = 'Menu';

    public function __construct()
    {
        $this->MenuModel = new MenuModel();
        $this->CategoryModel = new CategoryModel();
    }

    public function index()
    {

        $data = [
            'title' => $this->title,
            'MenuData' => $this->MenuModel->findAll(),
            'CategoryModel' => $this->CategoryModel,
        ];

        echo view('pages/Menu/MenuView', $data);
    }

    //function with view
    public function detail($id)
    {
        $data = $this->MenuModel->getMenu($id);
        var_dump($data);

        if (empty($data)) {
            throw new PageNotFoundException('Menu with Id ' . $id . 'not found');
        };
    }

    public function create()
    {
        $data = [
            'title' => $this->title,
            'MenuData' => $this->MenuModel->findAll(),
            'CategoryData' => $this->CategoryModel->findAll(),
            'validation' => \Config\Services::validation()

        ];

        echo view('pages/Menu/MenuCreate', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'MenuData' => $this->MenuModel->getMenu($id),
            'validation' => \Config\Services::validation()
        ];

        return view('pages/Menu/MenuEdit', $data);
    }


    //function  CRUD
    public function save()
    {

        $MenuName = $this->request->getVar('inputMenu');
        $Price = $this->request->getVar('inputPrice');
        $Categoryid = $this->request->getVar('inputCategory') == 'No Category' ? NULL : $this->request->getVar('inputCategory');

        //validation
        $validation = $this->_validationSave($MenuName);
        if (!is_null($validation)) {
            return $validation;
        }

        $this->MenuModel->save([
            'MenuName' => $MenuName,
            'Price' => $Price,
            'CategoryId' => $Categoryid,
        ]);

        session()->setFlashdata('pesan', 'Data added successfully.');

        return redirect()->to('/Menu')->withInput();
    }


    public function delete()
    {
        $id = $this->request->getVar('Id');
        $this->MenuModel->delete($id);
        session()->setFlashdata('pesan', 'Data Deleted successfully.');
        return redirect()->to('/Menu');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $MenuName = $this->request->getVar('inputMenu');
        $Price = $this->request->getVar('inputPrice');
        $Categoryid = $this->request->getVar('inputCategory') == 'No Category' ? NULL : $this->request->getVar('inputCategory');

        //validation
        $validation =

            $this->_validationEdit(
                $this->request->getVar('inputMenu'),
                $this->MenuModel->getMenu($id)

            );
        if (!is_null($validation)) {
            return $validation;
        }

        //Update function is same as Save
        $this->MenuModel->save([
            'Id' => $id,
            'MenuName' => $MenuName,
            'Price' => $Price,
            'CategoryId' => $Categoryid,
        ]);

        session()->setFlashdata('pesan', 'Data updated successfully.');

        return redirect()->to('/Menu')->withInput();
    }



    public function _validationSave($MenuName)
    {
        $rules = 'required|is_unique[Menu.MenuName]';
        if ($this->MenuModel->is_unique($MenuName)) {

            $rules = 'required';
        }

        $validate = [
            'inputMenu' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Menu Name" can not be empty',
                    'is_unique' => '"Menu Name" has been registered'
                ]
            ],
            'inputPrice' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '"Price" can not be empty',
                ]
            ]
        ];

        if (!$this->validate($validate)) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Menu/Create')->withInput()->with('validation', $validation);
        }
    }

    public function _validationEdit($MenuName, $MenuDataOld)
    {
        $rules = 'required|is_unique[Menu.MenuName]';

        if ($MenuName == $MenuDataOld['MenuName'] || $this->MenuModel->is_unique($MenuName)) {

            $rules = 'required';
        }

        $validate = [
            'inputMenu' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Menu Name" can not be empty',
                    'is_unique' => '"Menu Name" has been registered'
                ]
            ],
            'inputPrice' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '"Price" can not be empty',
                ]
            ]
        ];

        if (!$this->validate($validate)) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Menu/Edit/' . $MenuDataOld['Id'])->withInput()->with('validation', $validation);
        }
    }
}
