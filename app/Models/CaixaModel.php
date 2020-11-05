<?php

namespace App\Models;

use CodeIgniter\Model;

class CaixaModel extends Model
{
    protected $table      = 'caixa';
    protected $primaryKey = 'caixa_id';
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
        $this->where($dados);
        
        if($first){
            return $this->first();
        }else{
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
        $this->where($dados);

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
