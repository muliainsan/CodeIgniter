<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class OrderEntryModel extends Model
{
    protected $table = 'orderentry';
    protected $useTimestamps = true;
    protected $allowedFields = ['Id', 'OrderId', 'MenuId', 'Quantity', 'Price'];

    public function getOrderEntry($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['Id' => $id])->first();
    }

    public function getOrderEntryFromOrder($id)
    {
        return $this->where(['OrderId' => $id])->get()->getResultArray();
    }
};
