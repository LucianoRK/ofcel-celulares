<?php

namespace App\Models;

use CodeIgniter\Model;

class VendaModel extends Model
{
    protected $table      = 'venda';
    protected $primaryKey = 'venda_id';
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

    /**
     * get
     * 
     * @param array $dados Informação para a tela
     * @param bool  $first Se quiser so traser o primeniro registro
     */
    public function get($dados = [], $first = false)
    {
        
        $this->where($dados);

        if ($first) {
            return $this->first();
        } else {
            return $this->find();
        }
    }

    /**
     * Get de dados
     * 
     * @param int $id 
     * @param array $dados 
     */
    public function getById($id, $dados = [])
    {
        return $this->where($dados)->find($id);
    }

    /**
     * Pega todos os desativados
     * 
     * @param array $dados Informação para a tela
     */
    public function getDeleted($dados = [])
    {
        $this->where($dados);

        return $this->onlyDeleted()->find();
    }
}
