<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class RoleModel extends Model
{
    protected $table = 'role';
    protected $useTimestamps = true;
    protected $allowedFields = ['Role'];

    public function getRole($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['Id' => $id])->first();
    }

    public function is_unique($Role)
    {
        $found = $this->where(['Role' => $Role])->first();
        var_dump($found);
        if (is_null($found)) {
            return true;
        }
        return false;
    }
};
