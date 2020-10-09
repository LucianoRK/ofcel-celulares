<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class ClienteController extends BaseController
{
    public function __construct()
    {
    }

    /////////////////////////////
    //                         //
    //	        CRUD           //
    //                         //
    /////////////////////////////

    /**
     * Pagina inicial do módulo
     */
    public function index()
    {
        //Carrega os modelos
        $cliente  = new ClienteModel();

        //Carrega as variáveis
        $dados['clientes']   = $cliente->get();

        return $this->template('cliente', 'index', $dados);
    }

    /**
     * Mostra um item específico
     */
    public function show()
    {
        //
    }

    /**
     * Retorna a View para criar um item da tabela
     */
    public function create()
    {
        return $this->template('cliente', 'create');
    }

    /**
     * Salva o novo item na tabela
     */
    public function store()
    {
        //Get request
        $request = $this->request->getVar();

        //Rules
        $rules = [
            'nome' => 'required'
        ];

        if ($this->validate($rules)) {
            //Carrega os modelos
            $clienteModel         = new ClienteModel();
        
            //Prepara os dados do Usuário
            $dadosUsuario = [
                'nome'             => !empty($request['nome'])           ? $request['nome']                        : null,
                'documento'        => !empty($request['documento'])      ? $request['documento']                   : null,
                'telefone'         => !empty($request['telefone'])       ? $request['telefone']                    : null,
                'email'            => !empty($request['email'])          ? $request['email']                       : null,
                'data_nascimento'  => !empty($request['dataNascimento']) ? $request['dataNascimento']              : null,
                'observacao'       => !empty($request['observacao'])     ? $request['observacao']                  : null,
                'cep'              => !empty($request['cep'])            ? $request['cep']                         : null,
                'cidade'           => !empty($request['cidade'])         ? $request['cidade']                      : null,
                'uf'               => !empty($request['uf'])             ? $request['uf']                          : null,
                'bairro'           => !empty($request['bairro'])         ? $request['bairro']                      : null,
                'rua'              => !empty($request['rua'])            ? $request['rua']                         : null,
                'numero'           => !empty($request['numero'])         ? $request['numero']                      : null,
                'complemento'      => !empty($request['complemento'])    ? $request['complemento']                 : null
            ];
            //Salva o cliente
            $clienteModel ->save($dadosUsuario);
 
            //Mensagem de retorno
            $this->setFlashdata('Cliente cadastrado com sucesso !', 'success');

            return redirect()->to('/cliente');
        } else {
            //Mensagem de retorno
            $this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

            return redirect()->to('/cliente/create');
        }
    }

    /**
     * Retorna a View para edição do dado
     */
    public function edit($id)
    {
        //Carrega os modelos
        $clienteModel  = new ClienteModel();

        //Carrega as variáveis
        $dados['cliente']  = $clienteModel->getById($id);

        return $this->template('cliente', 'edit', $dados);
    }

    /**
     * Salva a atualização de permissões do usuário
     */
    public function update($id)
    {
        //Get request
        $request = $this->request->getVar();

        //Rules
        $rules = [
            'nome' => 'required'
        ];

        if ($this->validate($rules)) {
            //Carrega os modelos
            $clienteModel = new ClienteModel();
        
            //Prepara os dados do Usuário
            $dadosUsuario = [
                'cliente_id'       => $id,
                'nome'             => !empty($request['nome'])           ? $request['nome']                        : null,
                'documento'        => !empty($request['documento'])      ? $request['documento']                   : null,
                'telefone'         => !empty($request['telefone'])       ? $request['telefone']                    : null,
                'email'            => !empty($request['email'])          ? $request['email']                       : null,
                'data_nascimento'  => !empty($request['dataNascimento']) ? $request['dataNascimento']              : null,
                'observacao'       => !empty($request['observacao'])     ? $request['observacao']                  : null,
                'cep'              => !empty($request['cep'])            ? $request['cep']                         : null,
                'cidade'           => !empty($request['cidade'])         ? $request['cidade']                      : null,
                'uf'               => !empty($request['uf'])             ? $request['uf']                          : null,
                'bairro'           => !empty($request['bairro'])         ? $request['bairro']                      : null,
                'rua'              => !empty($request['rua'])            ? $request['rua']                         : null,
                'numero'           => !empty($request['numero'])         ? $request['numero']                      : null,
                'complemento'      => !empty($request['complemento'])    ? $request['complemento']                 : null
            ];
            //Salva o cliente
            $clienteModel ->save($dadosUsuario);
 
            //Mensagem de retorno
            $this->setFlashdata('Cliente alterado com sucesso !', 'success');

            return redirect()->to('/cliente');
        } else {
            //Mensagem de retorno
            $this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

            return redirect()->to('/cliente/edit/'.$id);
        }
    }

    /**
     * Remove ou desabilita o dado
     */
    public function destroy()
    {
        //
    }

    /////////////////////////////
    //                         //
    //	   Outras funções      //
    //                         //
    /////////////////////////////


}
