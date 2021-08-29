<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class IncomingMaterialModel extends Model
{
    protected $table = 'IncomingMaterial';
    protected $useTimestamps = true;
    protected $allowedFields = ['MaterialName', 'WorkId', 'Evidence', 'Status', '_CreatedBy'];

    public function getIncomingMaterial($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['Id' => $id])->first();
    }

    public function is_unique($IncomingMaterialName)
    {
        $found = $this->where(['IncomingMaterialName' => $IncomingMaterialName])->first();
        var_dump($found);
        if (is_null($found)) {
            return true;
        }
        return false;
    }
};
