<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class UserModel extends Model
{
    protected $table = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = ['UserName', 'Password', 'Email', 'IdRole', 'Name'];

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['Id' => $id])->first();
    }

    public function is_unique($UserName)
    {
        $found = $this->where(['UserName' => $UserName])->first();
        var_dump($found);
        if (is_null($found)) {
            return true;
        }
        return false;
    }

    public function login($Username, $Password)
    {
        $dataUser = $this->where([
            'UserName' => $Username,
        ])->first();
        if ($dataUser) {
            if (password_verify($Password, $dataUser['Password'])) {
                return $dataUser;
            }
        }
    }
};
