<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'usuario_id';
    protected $protectFields = false;
    //protected $allowedFields = ['name', 'email'];

    protected $returnType = 'array';

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $dateFormat = 'datetime';

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //protected $validationRules    = [];
    //protected $validationMessages = [];
    //protected $skipValidation     = false;

    public function getAll($dados = [])
    {
        $this->where($dados);
        return $this->find();
    }

    public function get($id, $dados = [])
    {
        return $this->where($dados)->find($id);
    }

    public function login($dados)
    {
        $this->select('usuario_id');
        $this->where($dados);

        return $this->find();
    }
}
