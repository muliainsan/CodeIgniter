<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $useTimestamps = true;
    protected $allowedFields = ['Id', 'CategoryName'];




    public function getCategory($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['Id' => $id])->first();
    }

    public function is_unique($categoryName)
    {
        $found = $this->where(['CategoryName' => $categoryName])->first();
        var_dump($found);
        if (is_null($found)) {
            return true;
        }
        return false;
    }
};
