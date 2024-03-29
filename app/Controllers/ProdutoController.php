<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\EmpresaModel;
use App\Models\EstoqueModel;
use App\Models\MarcaModel;
use App\Models\ProdutoModel;
use App\Models\SubcategoriaModel;

class ProdutoController extends BaseController
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
        $produtoModel  = new ProdutoModel();

        //Sessão
        $empresaSessao = $this->session->get('empresa');

        //Carrega as variáveis
        $dados['produtosAtivo']    = $produtoModel->get(['e.empresa_id' => $empresaSessao['empresa_id']]);
        $dados['produtosInativo']  = $produtoModel->getDeleted(['e.empresa_id' => $empresaSessao['empresa_id']]);

        return $this->template('produto', 'index', $dados);
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
        //Carrega os modelos
        $empresaModel   = new EmpresaModel();
        $marcaModel     = new MarcaModel();
        $categoriaModel = new CategoriaModel();

        //Carrega as variáveis
        $dados['marcas']      = $marcaModel->get();
        $dados['categorias']  = $categoriaModel->get();
        $dados['empresas']    = $empresaModel->get();

        return $this->template('produto', 'create', $dados);
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
            'marca'        => 'required',
            'categoria'    => 'required',
            'subcategoria' => 'required',
            'descricao'    => 'required'
        ];

        if ($this->validate($rules)) {
            //Carrega os modelos
            $produtoModel  = new ProdutoModel();
            $estoqueModel  = new EstoqueModel();

            //Prepara os dados do Usuário
            $dadosProduto = [
                'marca_id'          => !empty($request['marca'])        ? $request['marca']         : null,
                'categoria_id'      => !empty($request['categoria'])    ? $request['categoria']     : null,
                'subcategoria_id'   => !empty($request['subcategoria']) ? $request['subcategoria']  : null,
                'codigo'            => !empty($request['codigo'])       ? $request['codigo']        : null,
                'descricao'         => !empty($request['descricao'])    ? $request['descricao']     : null
            ];
            //Salva o cliente
            $produtoModel->save($dadosProduto);
            //Pega o id inserido			
            $produtoId = $produtoModel->getInsertID();
            //Estoque
            if (!empty($request['empresas'])) {
                foreach ($request['empresas'] as $key => $empresa) {
                    //Prepara os dados da empresa
                    $dadosEstoque = [
                        'empresa_id'    => !empty($empresa)                      ? $empresa                                      : null,
                        'produto_id'    => !empty($produtoId)                    ? $produtoId                                    : null,
                        'quantidade'    => !empty($request['quantidades'][$key]) ? $request['quantidades'][$key]                 : 0,
                        'valor_venda'   => !empty($request['valores'][$key])     ? $this->realToSql($request['valores'][$key])   : 0.00,
                    ];

                    //Salva as empresas do usuário
                    $estoqueModel->save($dadosEstoque);
                }
            }

            //Mensagem de retorno
            $this->setFlashdata('Produto cadastrado com sucesso !', 'success');

            return redirect()->to('/produto');
        } else {
            //Mensagem de retorno
            $this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

            return redirect()->to('/produto/create');
        }
    }

    /**
     * Retorna a View para edição do dado
     */
    public function edit($id)
    {
        //Carrega os modelos
        $empresaModel       = new EmpresaModel();
        $produtoModel       = new ProdutoModel();
        $marcaModel         = new MarcaModel();
        $categoriaModel     = new CategoriaModel();
        $subcategoriaModel  = new SubcategoriaModel();
        $estoqueModel       = new EstoqueModel();

        //Carrega as variáveis
        $dados['empresas']      = $empresaModel->get();
        $dados['produto']       = $produtoModel->getById($id);
        $dados['marcas']        = $marcaModel->get();
        $dados['categorias']    = $categoriaModel->get();
        $dados['subcategorias'] = $subcategoriaModel->get(['subcategoria.categoria_id' => $dados['produto']['categoria_id']]);
        $dados['estoque']       = $estoqueModel->get(['produto_id' => $dados['produto']['produto_id']]);

        return $this->template('produto', 'edit', $dados);
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
            'marca'        => 'required',
            'categoria'    => 'required',
            'subcategoria' => 'required',
            'descricao'    => 'required'
        ];

        if ($this->validate($rules)) {
            //Carrega os modelos
            $produtoModel = new ProdutoModel();
            $estoqueModel = new EstoqueModel();

            //Prepara os dados do Usuário
            $dadosCliente = [
                'produto_id'        => $id,
                'marca_id'          => !empty($request['marca'])        ? $request['marca']         : null,
                'categoria_id'      => !empty($request['categoria'])    ? $request['categoria']     : null,
                'subcategoria_id'   => !empty($request['subcategoria']) ? $request['subcategoria']  : null,
                'codigo'            => !empty($request['codigo'])       ? $request['codigo']        : null,
                'descricao'         => !empty($request['descricao'])    ? $request['descricao']     : null
            ];
            //Salva o cliente
            $produtoModel->save($dadosCliente);

            //Estoque
            if (!empty($request['empresas'])) {
                foreach ($request['empresas'] as $key => $empresa) {
                    //Prepara os dados da empresa

                    $dadosEstoque = [
                        'estoque_id'    => $request['estoque'][$key],
                        'empresa_id'    => !empty($empresa)                      ? $empresa                       : null,
                        'produto_id'    => !empty($id)                           ? $id                            : null,
                        'quantidade'    => !empty($request['quantidades'][$key]) ? $request['quantidades'][$key]  : 0,
                        'valor_venda'   => !empty($request['valores'][$key])     ? $this->realToSql($request['valores'][$key])      : 0.00,
                    ];

                    //Salva as empresas do usuário
                    $estoqueModel->save($dadosEstoque);
                }
            }

            //Mensagem de retorno
            $this->setFlashdata('Produto alterado com sucesso !', 'success');

            return redirect()->to('/produto');
        } else {
            //Mensagem de retorno
            $this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

            return redirect()->to('/produto/edit/' . $id);
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

    /**
     * Remove ou desabilita o dado
     */
    public function desativarProduto()
    {
        //Get request
        $request = $this->request->getVar();

        //Carrega os modelos
        $produtoModel  = new ProdutoModel();

        //deleta (safe mode)
        $dados = $produtoModel->delete($request['produtoId']);

        return $this->response->setJSON($dados);
    }

    /**
     * Reativa o dado
     */
    public function ativarProduto()
    {
        //Get request
        $request = $this->request->getVar();

        //Carrega os modelos
        $produtoModel  = new ProdutoModel();

        //Reativa o dado
        $dados = $produtoModel->update($request['produtoId'], ['deleted_at' => null]);

        return $this->response->setJSON($dados);
    }

    public function verificarQuantidadeProdutoEstoque()
    {
        //Get request
        $request = $this->request->getVar();
        //Carrega os modelos
        $produtoModel  = new ProdutoModel();
        //Sessão
        $empresaSessao = $this->session->get('empresa');
        //parametros
        $parametros = [
            'e.empresa_id' => $empresaSessao['empresa_id'],
            'produto.produto_id' => $request['produtoId']
        ];
        //Faz a busca no db
        $produto = $produtoModel->get($parametros, true);

        return $this->response->setJSON($produto['quantidade']);
    }
}
