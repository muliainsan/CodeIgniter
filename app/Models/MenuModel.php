<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class MenuModel extends Model
{
    protected $table = 'Menu';
    protected $useTimestamps = true;
    protected $allowedFields = ['MenuName', 'Price', 'CategoryId'];




    public function getMenu($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['Id' => $id])->first();
    }

    public function is_unique($MenuName)
    {
        $found = $this->where(['MenuName' => $MenuName])->first();
        var_dump($found);
        if (is_null($found)) {
            return true;
        }
        return false;
    }
};
