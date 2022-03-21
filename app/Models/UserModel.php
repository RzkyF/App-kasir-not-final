<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'username', 'password', 'id_level','gambar'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';  
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    public function getAllData()
    {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->join('level', 'level.id_level=user.id_level');
        $query = $builder->get()->getResult();

        return $query;
    }
}
