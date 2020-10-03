<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissaoUsuarioTipoModel extends Model
{
    protected $table      = 'permissao_usuario_tipo';
    protected $primaryKey = 'permissao_usuario_tipo_id';
    protected $protectFields = false;
    //protected $allowedFields = ['name', 'email'];

    protected $returnType = 'array';

    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
    protected $dateFormat = 'datetime';

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //protected $validationRules    = [];
    //protected $validationMessages = [];
    //protected $skipValidation     = false;

    /**
     * get
     * 
     * @param array $dados Informação para a tela
     * @param bool  $first Se quiser so traser o primeniro registro
     */
    public function get($dados = [], $first = false)
    {
        $this->where($dados);
        $this->join('permissao as p', 'p.permissao_id = permissao_usuario_tipo.permissao_id');

        if ($first) {
            return $this->first();
        } else {
            return $this->find();
        }
    }

    /**
     * Get de usuários
     * 
     * @param int $id 
     * @param array $dados 
     */
    public function getById($id, $dados = [])
    {
        return $this->where($dados)->find($id);
    }
}
