<div class="row">
    <div class="col-sm text-left">
        <span class="page-title h4">Produtos</span>
    </div>
</div>
<hr>
<form action="<?= base_url('produto/update/' . $produto['produto_id']) ?>" method="post">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Editar <?= $produto['descricao'] ?></div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="marca">Marca</label>
                    <select class="form-control form-control-lg" id="marca" name="marca" required>
                        <option></option>
                        <?php foreach ($marcas as $marca) : ?>
                            <option value="<?= $marca['marca_id'] ?>" <?= $produto['marca_id'] == $marca['marca_id'] ? 'selected' : ''; ?>><?= $marca['nome'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="marca">Categoria</label>
                    <select class="form-control form-control-lg" id="categoria" name="categoria" required>
                        <option></option>
                        <?php foreach ($categorias as $categoria) : ?>
                            <option value="<?= $categoria['categoria_id'] ?>" <?= $produto['categoria_id'] == $categoria['categoria_id'] ? 'selected' : ''; ?>><?= $categoria['nome'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="marca">Subcategoria</label>
                    <select class="form-control form-control-lg" id="subcategoria" name="subcategoria" required>
                        <option></option>
                        <?php foreach ($subcategorias as $subcategoria) : ?>
                            <option value="<?= $subcategoria['subcategoria_id'] ?>" <?= $produto['subcategoria_id'] == $subcategoria['subcategoria_id'] ? 'selected' : ''; ?>><?= $subcategoria['nome'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="descricao">Descrição (Nome do produto)</label>
                    <input type="text" class="form-control form-control-lg" id="descricao" name="descricao" required value="<?= $produto['descricao'] ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Estoque</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <table class="table table-striped">
                    <thead>
                        <th class="d-none d-md-block">#</th>
                        <th>Empresa</th>
                        <th class="text-center">Valor de venda</th>
                        <th class="text-center">Quantidade</th>
                    </thead>
                    <tbody>
                        <?php foreach ($empresas as $empresa) : ?>
                            <tr class="linhaTabela">
                                <td class="d-none d-md-block"><?= $empresa['empresa_id'] ?></td>
                                <td><?= $empresa['nome'] ?></td>
                                <?php
                                //Inicia os valores zerados
                                $valor = '0,00';
                                $quantidade = 0;
                                $estoqueId = 0;
                                //Percorre os estoques desse produto
                                foreach ($estoque as $item) {
                                    //Se o estoque for desta empresa
                                    if ($item['empresa_id'] == $empresa['empresa_id']) {
                                        //Atualiza os valores
                                        $valor      = $item['valor_venda'];
                                        $quantidade = $item['quantidade'];
                                        $estoqueId  = $item['estoque_id'];
                                    }
                                }
                                ?>
                                <td class="text-center">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg text-center valor dinheiro" value="<?= $base->sqlToReal($valor) ?>" name="valores[]" required>
                                        <div class="input-group-prepend copiarValor">
                                            <div class="input-group-text" title="Usar este valor nos demais campos"><i class="la la-copy"></i></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><input type="text" class="form-control form-control-lg text-center quantidade numero" disabled="disabled" value="<?= $quantidade ?>" name="quantidades[]" required></td>
                                <input type="hidden" class="form-control form-control-lg text-center" value="<?= $empresa['empresa_id'] ?>" name="empresas[]" required>
                                <input type="hidden" class="form-control form-control-lg text-center" value="<?= $estoqueId ?>" name="estoque[]" required>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-right mb-2">
        <button class="btn btn-danger btn-lg" type="submit">Salvar</button>
        <?= csrf_field(); ?>
    </div>
</form>