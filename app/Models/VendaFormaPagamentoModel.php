<?php

namespace App\Models;

use CodeIgniter\Model;

class VendaFormaPagamentoModel extends Model
{
    protected $table      = 'venda_forma_pagamento';
    protected $primaryKey = 'venda_forma_pagamento_id';
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
            venda_forma_pagamento.valor,
            fp.nome
        ");

        $this->join('forma_pagamento as fp', 'fp.forma_pagamento_id = venda_forma_pagamento.forma_pagamento_id');

        $this->where($dados);

        if ($first) {
            return $this->first();
        } else {
            return $this->find();
        }
    }

    /**
     * get
     * 
     * @param array $dados Informação para a tela
     * @param bool  $first Se quiser so traser o primeniro registro
     */
    public function getValores($dados = [])
    {
        $this->select("
            SUM(CASE WHEN fp.forma_pagamento_id = 1 THEN venda_forma_pagamento.valor ELSE 0 END) AS dinheiro,
            SUM(CASE WHEN fp.forma_pagamento_id = 2 THEN venda_forma_pagamento.valor ELSE 0 END) AS debito,
            SUM(CASE WHEN fp.forma_pagamento_id = 3 THEN venda_forma_pagamento.valor ELSE 0 END) AS credito,
            SUM(CASE WHEN fp.forma_pagamento_id = 4 THEN venda_forma_pagamento.valor ELSE 0 END) AS outros
        ");
        $this->join('forma_pagamento as fp', 'fp.forma_pagamento_id = venda_forma_pagamento.forma_pagamento_id');
        $this->join('venda as v', 'v.venda_id = venda_forma_pagamento.venda_id');
        $this->where('v.deleted_at IS NULL');
        $this->where($dados);

        return $this->first();
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
