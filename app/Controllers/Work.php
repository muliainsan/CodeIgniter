<?php

namespace App\Controllers;

use App\Models\WorkModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Work extends BaseController
{
    protected $WorkModel;
    protected $title = 'Work';

    public function __construct()
    {
        if (!session('email')) {
            header('Location: /Login');
            exit();
        }
        $this->WorkModel = new WorkModel();
    }

    public function index()
    {

        $data = [
            'title' => $this->title,
            'WorkData' => $this->WorkModel->findAll(),
        ];

        echo view('pages/Work/WorkView', $data);
    }

    //function with view
    public function detail($id)
    {
        $data = $this->WorkModel->getWork($id);
        var_dump($data);

        if (empty($data)) {
            throw new PageNotFoundException('Work with Id ' . $id . 'not found');
        };
    }

    public function create()
    {
        $data = [
            'title' => $this->title,
            'WorkData' => $this->WorkModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        echo view('pages/Work/WorkCreate', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'WorkData' => $this->WorkModel->getWork($id),
            'validation' => \Config\Services::validation()
        ];

        return view('pages/Work/WorkEdit', $data);
    }


    //function  CRUD
    public function save()
    {
        //validation
        $WorkName = $this->request->getVar('inputWorkname');

        $validation = $this->_validationSave();
        if (!is_null($validation)) {
            return $validation;
        }
        $saveResult = $this->WorkModel->save([
            "WorkName" => $WorkName,
            "_CreatedBy" => session("email")
        ]);

        if (!$saveResult) {
            session()->setFlashdata('pesan', 'Failed');
        } else {
            session()->setFlashdata('pesan', 'Data added successfully.');
        }
        return redirect()->to('/Work')->withInput();
    }


    public function delete()
    {
        $id = $this->request->getVar('Id');
        $this->WorkModel->delete($id);
        session()->setFlashdata('pesan', 'Data Deleted successfully.');
        return redirect()->to('/Work');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $WorkName = $this->request->getVar('inputWorkname');
        //validation
        $validation =

            $this->_validationEdit(
                $this->request->getVar('inputWork'),
                $this->WorkModel->getWork($id)

            );
        if (!is_null($validation)) {

            return $validation;
        }

        //Update function is same as Save
        $this->WorkModel->save([
            'Id' => $id,
            "WorkName" => $WorkName,
        ]);

        session()->setFlashdata('pesan', 'Data updated successfully.');

        return redirect()->to('/Work')->withInput();
    }



    public function _validationSave()
    {
        $rules = 'required';

        $validate = [
            'inputWorkname' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Work Name" can not be empty',
                    'is_unique' => '"Work Name" has been registered'
                ]
            ],
        ];

        if (!$this->validate($validate)) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Work/Create')->withInput()->with('validation', $validation);
        }
    }

    public function _validationEdit($WorkName, $WorkDataOld)
    {
        $rules = 'required';



        $validate = [

            'inputWorkname' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Work Name" can not be empty',
                    'is_unique' => '"Work Name" has been registered'
                ]
            ]
        ];

        if (!$this->validate($validate)) {
            var_dump($validate);
            $validation = \Config\Services::validation();
            return redirect()->to('/Work/Edit/' . $WorkDataOld['Id'])->withInput()->with('validation', $validation);
        }
    }
}
