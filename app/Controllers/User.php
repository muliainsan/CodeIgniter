<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class User extends BaseController
{
    protected $UserModel;
    protected $title = 'User';

    public function __construct()
    {
        if (!session('email')) {
            header('Location: /Login');
            exit();
        }
        $this->UserModel = new UserModel();
    }

    public function index()
    {

        $data = [
            'title' => $this->title,
            'UserData' => $this->UserModel->findAll(),
        ];

        echo view('pages/User/UserView', $data);
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
            'UserData' => $this->UserModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        echo view('pages/User/UserCreate', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'UserData' => $this->UserModel->getUser($id),
            'validation' => \Config\Services::validation()
        ];

        return view('pages/User/UserEdit', $data);
    }


    //function  CRUD
    public function save()
    {
        //validation
        $UserName = $this->request->getVar('inputUsername');
        $Password = $this->request->getVar('inputPassword');
        $ContractorName = $this->request->getVar('inputContractorname');
        $Email = $this->request->getVar('inputEmail');
        $Position = $this->request->getVar('inputPosition');


        $validation = $this->_validationSave();
        if (!is_null($validation)) {
            return $validation;
        }
        $saveResult = $this->UserModel->save([
            "UserName" => $UserName,
            "Password" => $Password,
            "ContractorName" => $ContractorName,
            "Email" => $Email,
            "Position" => $Position,
            "_CreatedBy" => session("email")
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
        $ContractorName = $this->request->getVar('inputContractorname');
        $Email = $this->request->getVar('inputEmail');
        $Position = $this->request->getVar('inputPosition');


        //validation
        $validation =

            $this->_validationEdit(
                $this->request->getVar('inputUser'),
                $this->UserModel->getUser($id)

            );
        if (!is_null($validation)) {

            return $validation;
        }

        //Update function is same as Save
        $this->UserModel->save([
            'Id' => $id,
            "UserName" => $UserName,
            "Password" => $Password,
            "ContractorName" => $ContractorName,
            "Email" => $Email,
            "Position" => $Position,
        ]);

        session()->setFlashdata('pesan', 'Data updated successfully.');

        return redirect()->to('/User')->withInput();
    }



    public function _validationSave()
    {
        $rules = 'required';

        $validate = [
            'inputUsername' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"User Name" can not be empty',
                    'is_unique' => '"User Name" has been registered'
                ]
            ],
            'inputPassword' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Password" can not be empty',
                    'is_unique' => '"Password" has been registered'
                ]
            ],
            'inputContractorname' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Contractor Name" can not be empty',
                    'is_unique' => '"Contractor Name" has been registered'
                ]
            ],
            'inputEmail' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '"Email" can not be empty',
                    'is_unique' => '"Email" has been registered'
                ]
            ],
        ];

        if (!$this->validate($validate)) {
            $validation = \Config\Services::validation();
            return redirect()->to('/User/Create')->withInput()->with('validation', $validation);
        }
    }

    public function _validationEdit($UserName, $UserDataOld)
    {
        $rules = 'required';



        $validate = [

            'inputUsername' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"User Name" can not be empty',
                    'is_unique' => '"User Name" has been registered'
                ]
            ],
            'inputPassword' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Password" can not be empty',
                    'is_unique' => '"Password" has been registered'
                ]
            ],
            'inputContractorname' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Contractor Name" can not be empty',
                    'is_unique' => '"Contractor Name" has been registered'
                ]
            ],
            'inputEmail' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '"Email" can not be empty',
                    'is_unique' => '"Email" has been registered'
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
