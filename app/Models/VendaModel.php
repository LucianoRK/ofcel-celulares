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
        $this->select("
            venda.venda_id,
            venda.observacao,
            DATE_FORMAT(venda.created_at, '%d/%m/%Y %H:%i') as venda_data,
            u.nome as usuario_nome,
            c.nome as cliente_nome,
            SUM(ve.valor_venda) as valor_venda
        ");

        $this->join('cliente as c', 'c.cliente_id = venda.cliente_id');
        $this->join('usuario as u', 'u.usuario_id = venda.usuario_id');
        $this->join('venda_estoque as ve', 've.venda_id = venda.venda_id');
        $this->where($dados);

        $this->groupBy("venda.venda_id");

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
        $this->select("
            venda.venda_id,
            venda.observacao,
            DATE_FORMAT(venda.created_at, '%d/%m/%Y %H:%i') as venda_data,
            u.nome as usuario_nome,
            c.nome as cliente_nome,
            SUM(ve.valor_venda) as valor_venda
        ");
        $this->join('cliente as c', 'c.cliente_id = venda.cliente_id');
        $this->join('usuario as u', 'u.usuario_id = venda.usuario_id');
        $this->join('venda_estoque as ve', 've.venda_id = venda.venda_id');
        $this->where($dados);

        $this->groupBy("venda.venda_id");

        return $this->onlyDeleted()->find();
    }
}
