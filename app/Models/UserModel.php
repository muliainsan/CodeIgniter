<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Framework\Constraint\IsNull;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';


    protected $allowedFields = [
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
    ];

    protected $useTimestamps = true;

    protected $validationRules = [
        'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        'username'      => 'required|alpha_numeric_punct|min_length[3]|is_unique[users.username,id,{id}]',
        'password_hash' => 'required',
    ];


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

    public function login($Email, $Password)
    {

        $array = array('Email' => $Email, 'Password' => $Password);

        return $this->where($array)->first();
    }
}
