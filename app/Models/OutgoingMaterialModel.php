<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class OutgoingMaterialModel extends Model
{
    protected $table = 'OutgoingMaterial';
    protected $useTimestamps = true;
    protected $allowedFields = ['MaterialName', 'WorkId', 'Evidence', 'Reason', 'Status', '_CreatedBy'];

    public function getOutgoingMaterial($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['Id' => $id])->first();
    }

    public function is_unique($OutgoingMaterialName)
    {
        $found = $this->where(['OutgoingMaterialName' => $OutgoingMaterialName])->first();
        var_dump($found);
        if (is_null($found)) {
            return true;
        }
        return false;
    }
};
