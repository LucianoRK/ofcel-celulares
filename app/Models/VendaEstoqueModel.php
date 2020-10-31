<?php

namespace App\Models;

use CodeIgniter\Model;

class VendaEstoqueModel extends Model
{
    protected $table      = 'venda_estoque';
    protected $primaryKey = 'venda_estoque_id';
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
        $this->select("
            venda_estoque.valor_venda as valor_venda,
            venda_estoque.estoque_id,
            p.descricao as produtoNome,
            m.nome as marcaNome,
            c.nome as categoriaNome,
            sc.nome as subcategoriaNome
        ");
        $this->join('estoque as e', 'e.estoque_id = venda_estoque.estoque_id');
        $this->join('produto as p', 'p.produto_id = e.produto_id');
        $this->join('marca as m', 'm.marca_id = p.marca_id');
        $this->join('categoria as c', 'c.categoria_id = p.categoria_id');
        $this->join('subcategoria as sc', 'sc.subcategoria_id = p.subcategoria_id');
        
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
