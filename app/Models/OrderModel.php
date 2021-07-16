<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class OrderModel extends Model
{
    protected $table = 'order';
    protected $useTimestamps = true;
    protected $allowedFields = ['Id', 'OrderName', 'Total'];


    public function getOrder($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['Id' => $id])->first();
    }

    public function getLast()
    {
        $this->findAll();
        return $this->order_by('Id', 'DESC')->first();
    }
};
