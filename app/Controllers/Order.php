<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\MenuModel;
use App\Models\OrderEntryModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use PHPUnit\Framework\Constraint\IsEmpty;


class Order extends BaseController
{
    protected $OrderModel;
    protected $OrderEntryModel;
    protected $MenuModel;
    protected $title = 'Orders';

    public function __construct()
    {
        if (!session('user')) {
            header('Location: /Login');
            exit();
        }
        $this->OrderModel = new OrderModel();
        $this->OrderEntryModel = new OrderEntryModel();
        $this->MenuModel = new MenuModel();
    }

    public function index()
    {

        $data = [
            'title' => $this->title,
            'OrderData' => $this->OrderModel->getOrder(),
        ];

        echo view('pages/Order/OrderView', $data);
    }

    //function with view
    public function detail($id)
    {
        $data = [
            'title' => $this->title,
            'OrderData' => $this->OrderModel->getOrder($id),
            'OrderEntryData' => $this->OrderEntryModel->getOrderEntryFromOrder($id),
            'MenuData' => $this->MenuModel->getMenu()
        ];

        echo view('pages/Order/OrderDetail', $data);
    }

    public function create()
    {
        $data = [
            'title' => $this->title,
            'OrderData' => $this->OrderModel->getOrder(),
            'MenuData' => $this->MenuModel->getMenu(),
            'validation' => \Config\Services::validation()
        ];

        echo view('pages/Order/OrderCreate', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'OrderData' => $this->OrderModel->getOrder($id),
            'OrderEntryData' => $this->OrderEntryModel->getOrderEntryFromOrder($id),
            'MenuData' => $this->MenuModel->getMenu(),
            'validation' => \Config\Services::validation()
        ];

        return view('pages/Order/OrderEdit', $data);
    }
    public function orderEntryInsert($Id, $Quant, $Price, $orderId)
    {
        $total = 0;
        foreach ($Quant as $i => $qty) {
            if ($qty == 0) {
                continue;
            }
            printf($orderId . "--" . $Id[$i] . "--" . $qty . "--" . $Price[$i] . "<br>");
            $this->OrderEntryModel->save([
                "OrderId" => $orderId,
                "MenuId" => $Id[$i],
                "Quantity" => $qty,
                "Price" => $Price[$i]
            ]);
            $total = $total + ($qty * $Price[$i]);
        }

        return $total;
    }

    //function  CRUD
    public function save()
    {

        $OrderName = $this->request->getVar('inputOrderName') != null ? $this->request->getVar('inputOrderName') : 'Customer';
        $Quants = $this->request->getVar('quant');
        $Ids = $this->request->getVar('id');
        $Prices = $this->request->getVar('price');

        $Total = 0;

        if ($this->is_array_empty($Quants)) {

            session()->setFlashdata('error', 'Order Can not be empty.');
            return redirect()->to('/Order/Create')->withInput();
        }

        $this->is_array_empty($Quants);

        $saveResult = $this->OrderModel->save([
            "OrderName" => $OrderName,
            "Total" => $Total,
        ]);


        if (!$saveResult) {
            session()->setFlashdata('pesan', 'Failed.');
        } else {
            $orderId = $this->OrderModel->getInsertID();
            $Total = $this->orderEntryInsert($Ids, $Quants, $Prices, $orderId);
            $saveResult = $this->OrderModel->save([
                "Id" => $orderId,
                "OrderName" => $OrderName,
                "Total" => $Total,
            ]);

            if (!$saveResult) {
                session()->setFlashdata('pesan', 'Failed.');
            } else {
                session()->setFlashdata('pesan', 'Data added successfully.');
            }
        }
        return redirect()->to('/Order')->withInput();
    }




    public function delete()
    {
        $orderId = $this->request->getVar('Id');

        $orderTmp = $this->OrderEntryModel->where(['OrderId' => $orderId]);
        foreach ($orderTmp as $o) {
            $this->OrderEntryModel->delete($o['Id']);
        }
        $this->OrderModel->delete($orderId);
        session()->setFlashdata('pesan', 'Data Deleted successfully.');
        return redirect()->to('/Order');
    }

    public function update()
    {
        $orderId = $this->request->getVar('Id');
        $OrderName = $this->request->getVar('inputOrderName');
        $Quants = $this->request->getVar('quant');
        $Ids = $this->request->getVar('id');
        $Prices = $this->request->getVar('price');
        $Total = 0;

        //Update function is same as Save
        $saveResult = $this->OrderModel->save([
            "Id" => $orderId,
            "OrderName" => $OrderName,
            "Total" => $Total,
        ]);


        if (!$saveResult) {
            session()->setFlashdata('pesan', 'Failed.');
        } else {

            $orderTmp = $this->OrderEntryModel->where(['OrderId' => $orderId]);
            foreach ($orderTmp as $o) {
                $this->OrderEntryModel->delete($o['Id']);
            }

            $Total = $this->orderEntryInsert($Ids, $Quants, $Prices, $orderId);
            $saveResult = $this->OrderModel->save([
                "Id" => $orderId,
                "OrderName" => $OrderName,
                "Total" => $Total,
            ]);

            if (!$saveResult) {
                session()->setFlashdata('pesan', 'Failed.');
            } else {
                session()->setFlashdata('pesan', 'Data added successfully.');
            }
        }
        return redirect()->to('/Order')->withInput();
    }



    function is_array_empty($arr)
    {
        if (is_array($arr)) {
            foreach ($arr as $value) {
                if (!empty($value)) {
                    return false;
                }
            }
        }
        return true;
    }


    public function _validationEdit($OrderName, $OrderDataOld)
    {
        $rules = 'required|is_unique[Order.OrderName]';

        if ($OrderName == $OrderDataOld['OrderName'] || $this->OrderModel->is_unique($OrderName)) {

            $rules = 'required';
        }

        $validate = [
            'inputOrder' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '"Order Name" can not be empty',
                    'is_unique' => '"Order Name" has been registered'
                ]
            ]
        ];

        if (!$this->validate($validate)) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Order/Edit/' . $OrderDataOld['Id'])->withInput()->with('validation', $validation);
        }
    }
}
