<?php

namespace App\Models;

use App\Controllers\Menu;
use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class MenuModel extends Model
{
    protected $table = 'menu';
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

    public function getMenuCategory($categoryId = false)
    {
        if ($categoryId == false) {
            return $this->db->table('Menu')->select('CategoryId, COUNT(Id) as Total')->where(['CategoryId' != 0])->groupBy('CategoryId')->get()->getResultArray();
        }
        return $this->db->table('Menu')->where(['CategoryId' => $categoryId])->get()->getResultArray();
    }
};
