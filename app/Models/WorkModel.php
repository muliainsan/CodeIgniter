<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class WorkModel extends Model
{
    protected $table = 'Work';
    protected $useTimestamps = true;
    protected $allowedFields = ['WorkName', '_CreatedBy'];

    public function getWork($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['Id' => $id])->first();
    }

    public function is_unique($WorkName)
    {
        $found = $this->where(['WorkName' => $WorkName])->first();
        var_dump($found);
        if (is_null($found)) {
            return true;
        }
        return false;
    }
};
