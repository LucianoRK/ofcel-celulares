<?php

namespace App\Models;

use CodeIgniter\Model;

class SubcategoriaModel extends Model
{
    protected $table      = 'subcategoria';
    protected $primaryKey = 'subcategoria_id';
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
     * Pega todos ativos
     * 
     * @param array $dados Informação para a tela
     * @param bool  $first Se quiser so traser o primeniro registro
     */
    public function get($dados = [], $first = false)
    {
        $this->select("
            subcategoria.*, 
            c.nome as categoriaNome
        ");
        $this->where($dados);
        $this->join('categoria as c', 'c.categoria_id = subcategoria.categoria_id');

        if ($first) {
            return $this->first();
        } else {
            return $this->find();
        }
    }

    /**
     * Pega todos os  desativados
     * 
     * @param array $dados Informação para a tela
     */
    public function getDeleted($dados = [])
    {
        $this->select("
            subcategoria.*, 
            c.nome as categoriaNome
        ");
        $this->where($dados);
        $this->join('categoria as c', 'c.categoria_id = subcategoria.categoria_id');

        return $this->onlyDeleted()->find();
    }

    /**
     * Get por id
     * 
     * @param string $escopo caminho da view
     * @param string $arquivo caminho da view
     * @param array  $dados Informação para a tela
     */
    public function getById($id, $dados = [])
    {
        return $this->where($dados)->find($id);
    }
}
