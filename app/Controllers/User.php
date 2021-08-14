<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class User extends BaseController
{
    protected $UserModel;
    protected $RoleModel;
    protected $title = 'User';

    public function __construct()
    {
        if (!session('user')) {
            header('Location: /Login');
            exit();
        } elseif (!session('role')) {
            header('Location: /Category');
            exit();
        }
        $this->UserModel = new UserModel();
        $this->RoleModel = new RoleModel();
    }

    public function index()
    {

        $data = [
            'title' => $this->title,
            'UserData' => $this->UserModel->getUser(),
        ];

        echo view('pages/user/UserView', $data);
    }

    //function with view
    public function detail($id)
    {
        $data = $this->UserModel->getUser($id);
        var_dump($data);

        if (empty($data)) {
            throw new PageNotFoundException('User with Id ' . $id . 'not found');
        };
    }

    public function create()
    {
        $data = [
            'title' => $this->title,
            'UserData' => $this->UserModel->getUser(),
            'RoleData' => $this->RoleModel->getRole(),
            'validation' => \Config\Services::validation()
        ];

        echo view('pages/user/UserCreate', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'UserData' => $this->UserModel->getUser($id),
            'RoleData' => $this->RoleModel->getRole(),
            'validation' => \Config\Services::validation()
        ];

        return view('pages/user/UserEdit', $data);
    }


    //function  CRUD
    public function save()
    {
        //validation
        $UserName = $this->request->getVar('inputUsername');
        $Password = $this->request->getVar('inputPassword');
        $Name = $this->request->getVar('inputName');
        $Email = $this->request->getVar('inputEmail');
        $IdRole = $this->request->getVar('inputRole');


        $validation = $this->_validationSave();
        if (!is_null($validation)) {
            return $validation;
        }
        $saveResult = $this->UserModel->save([
            "UserName" => $UserName,
            "Password" => $Password,
            "Name" => $Name,
            "Email" => $Email,
            "IdRole" => $IdRole
        ]);

        if (!$saveResult) {
            session()->setFlashdata('pesan', 'Failed');
        } else {
            session()->setFlashdata('pesan', 'Data added successfully.');
        }
        return redirect()->to('/User')->withInput();
    }


    public function delete()
    {
        $id = $this->request->getVar('Id');
        $this->UserModel->delete($id);
        session()->setFlashdata('pesan', 'Data Deleted successfully.');
        return redirect()->to('/User');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $UserName = $this->request->getVar('inputUsername');
        $Password = $this->request->getVar('inputPassword');
        $Name = $this->request->getVar('inputName');
        $Email = $this->request->getVar('inputEmail');
        $IdRole = $this->request->getVar('inputRole');

        //validation
        $validation =

            $this->_validationEdit(
                $this->UserModel->getUser($id)
            );
        if (!is_null($validation)) {

            return $validation;
        }

        //Update function is same as Save
        $this->UserModel->save([
            "Id" => $id,
            "UserName" => $UserName,
            "Password" => $Password,
            "Name" => $Name,
            "Email" => $Email,
            "IdRole" => $IdRole
        ]);

        session()->setFlashdata('pesan', 'Data updated successfully.');

        return redirect()->to('/User')->withInput();
    }



    public function _validationSave()
    {
        $validate = [

            'inputUsername' => [
                'rules' => 'required|is_unique[user.UserName]',
                'errors' => [
                    'required' => '"User Name" can not be empty',
                    'is_unique' => '"User Name" has been registered'
                ]
            ],
            'inputPassword' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '"Password" can not be empty',
                ]
            ],
            'inputName' => [
                'rules' => 'required|is_unique[user.Name]',
                'errors' => [
                    'required' => '" Name" can not be empty',
                    'is_unique' => '" Name" has been registered'
                ]
            ],
        ];

        if (!$this->validate($validate)) {
            $validation = \Config\Services::validation();
            return redirect()->to('/User/Create')->withInput()->with('validation', $validation);
        }
    }

    public function _validationEdit($UserDataOld)
    {
        $validate = [

            'inputUsername' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '"User Name" can not be empty',
                    'is_unique' => '"User Name" has been registered'
                ]
            ],
            'inputPassword' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '"Password" can not be empty',
                ]
            ],
            'inputName' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '" Name" can not be empty',
                    'is_unique' => '" Name" has been registered'
                ]
            ],
        ];

        if (!$this->validate($validate)) {
            var_dump($validate);
            $validation = \Config\Services::validation();
            return redirect()->to('/User/Edit/' . $UserDataOld['Id'])->withInput()->with('validation', $validation);
        }
    }
}
