<?php

namespace App\Controllers;

use App\Models\OutgoingMaterialModel;
use App\Models\WorkModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class OutgoingMaterial extends BaseController
{
    protected $OutgoingMaterialModel;
    protected $WorkModel;
    protected $title = 'Material Keluar';

    public function __construct()
    {
        if (!session('email')) {
            header('Location: /Login');
            exit();
        }
        $this->OutgoingMaterialModel = new OutgoingMaterialModel();
        $this->WorkModel = new WorkModel();
    }

    public function index()
    {

        $data = [
            'title' => $this->title,
            'OutgoingMaterialData' => $this->OutgoingMaterialModel->findAll(),
            'WorkModel' => $this->WorkModel,
        ];

        echo view('pages/OutgoingMaterial/OutgoingMaterialView', $data);
    }

    //function with view
    public function detail($id)
    {
        $data = $this->OutgoingMaterialModel->getOutgoingMaterial($id);
        var_dump($data);

        if (empty($data)) {
            throw new PageNotFoundException('OutgoingMaterial with Id ' . $id . 'not found');
        };
    }

    public function create()
    {
        $data = [
            'title' => $this->title,
            'OutgoingMaterialData' => $this->OutgoingMaterialModel->findAll(),
            'validation' => \Config\Services::validation(),
            'WorkData' => $this->WorkModel->findAll(),
        ];

        echo view('pages/OutgoingMaterial/OutgoingMaterialCreate', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'MaterialData' => $this->OutgoingMaterialModel->getOutgoingMaterial($id),
            'validation' => \Config\Services::validation(),
            'WorkData' => $this->WorkModel->findAll(),

        ];

        return view('pages/OutgoingMaterial/OutgoingMaterialEdit', $data);
    }


    //function  CRUD
    public function save()
    {
        //validation
        $MaterialName = $this->request->getVar('inputMaterialname');
        $Work = $this->request->getVar('inputWork');
        $Reason = $this->request->getVar('inputReason');
        $EvidenceFile = $this->request->getFile('inputEvidence');



        $validation = $this->_validationSave();
        if (!is_null($validation)) {
            return $validation;
        }

        $Evidence = $EvidenceFile->getRandomName();
        $EvidenceFile->move('img', $Evidence);

        $saveResult = $this->OutgoingMaterialModel->save([
            "MaterialName" => $MaterialName,
            "WorkId" => $Work,
            "Reason" => $Reason,
            "Evidence" => $Evidence,
            "_CreatedBy" => session("email")
        ]);

        if (!$saveResult) {
            session()->setFlashdata('pesan', 'Failed');
            unlink('img/' . $Evidence);
        } else {
            session()->setFlashdata('pesan', 'Data added successfully.');
        }
        return redirect()->to('/OutgoingMaterial')->withInput();
    }


    public function delete()
    {
        $id = $this->request->getVar('Id');
        $temp = $this->OutgoingMaterialModel->find($id);
        unlink('img/' . $temp['Evidence']);

        $this->OutgoingMaterialModel->delete($id);
        session()->setFlashdata('pesan', 'Data Deleted successfully.');
        return redirect()->to('/OutgoingMaterial');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $MaterialName = $this->request->getVar('inputMaterialname');
        $Work = $this->request->getVar('inputWork');
        $Reason = $this->request->getVar('inputReason');
        $EvidenceFile = $this->request->getFile('inputEvidence');
        $OldEvidence = $this->request->getVar('oldEvidence');

        if ($EvidenceFile->getError() == 4) {
            $EvidenceName = $OldEvidence;
        } else {
            $EvidenceName = $EvidenceFile->getRandomName();
            $EvidenceFile->move('img', $EvidenceName);
            unlink('img/' . $OldEvidence);
        }

        //validation
        $validation =

            $this->_validationEdit(
                $this->request->getVar('inputMaterialname'),
                $this->OutgoingMaterialModel->getOutgoingMaterial($id)

            );

        if (!is_null($validation)) {

            return $validation;
        }

        //Update function is same as Save
        $this->OutgoingMaterialModel->save([
            "Id" => $id,
            "MaterialName" => $MaterialName,
            "WorkId" => $Work,
            "Reason" => $Reason,
            "Evidence" => $EvidenceName,
        ]);

        session()->setFlashdata('pesan', 'Data updated successfully.');

        return redirect()->to('/OutgoingMaterial')->withInput();
    }

    public function updateStatus()
    {

        $id = $this->request->getVar('Id');
        $status = $this->request->getVar('Status');

        $this->OutgoingMaterialModel->save([
            "Id" => $id,
            "Status" => $status
        ]);
        session()->setFlashdata('pesan', 'Data Updated successfully.');
        return redirect()->to('/OutgoingMaterial');
    }



    public function _validationSave()
    {
        $rules = 'required';

        $validate = [
            'inputMaterialname' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Material Name" can not be empty',
                    'is_unique' => '"Material Name" has been registered'
                ]
            ],
            'inputWork' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Work" can not be empty',
                    'is_unique' => '"Work" has been registered'
                ]
            ],
            'inputEvidence' => 'uploaded[inputEvidence]'


        ];

        if (!$this->validate($validate)) {
            return redirect()->to('/OutgoingMaterial/Create')->withInput();
        }
    }

    public function _validationEdit($OutgoingMaterialName, $OutgoingMaterialDataOld)
    {
        $rules = 'required';



        $validate = [

            'inputMaterialname' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Material Name" can not be empty',
                    'is_unique' => '"Material Name" has been registered'
                ]
            ],
            'inputWork' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Work" can not be empty',
                    'is_unique' => '"Work" has been registered'
                ]
            ],

        ];

        if (!$this->validate($validate)) {
            var_dump($validate);

            return redirect()->to('/OutgoingMaterial/Edit/' . $OutgoingMaterialDataOld['Id'])->withInput();
        }
    }
}
