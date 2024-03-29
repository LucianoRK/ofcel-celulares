<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table      = 'empresa';
    protected $primaryKey = 'empresa_id';
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
	 *  get
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
	 * getById
	 * 
	 * @param string $escopo caminho da view
	 * @param string $arquivo caminho da view
	 * @param array  $dados Informação para a tela
	 */
    public function getById($id, $dados = [])
    {
        return $this->where($dados)->find($id);
    } 

	/**
	 * getEmpresasUsuario 
	 * 
	 * @param int $usuario_id 
	 */
    public function getEmpresasUsuario($usuario_id)
    {
        $this->select('
            empresa.empresa_id,
            empresa.nome,
            empresa.telefone,
            ue.principal
        ');
        $this->where('ue.usuario_id', $usuario_id);
        $this->join('usuario_empresa ue', 'ue.empresa_id = empresa.empresa_id');
        
        return $this->find();
    }  
}
