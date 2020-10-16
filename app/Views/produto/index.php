<div class="row">
    <div class="col-sm text-left d-none d-md-block">
        <span class="h4 align-center">Produtos</span>
    </div>
    <?php if ($base->permissao('ProdutoController/create')) : ?>
        <div class="col-sm text-md-center text-lg-right">
            <a href="<?= base_url('produto/create') ?>">
                <button class="btn btn-danger btn-md">Novo Produto</button>
            </a>
        </div>
    <?php endif; ?>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="ativosTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Ativos <span class="badge badge-count"><?= count($produtosAtivo) ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos" aria-selected="false">Inativos <span class="badge badge-count"><?= count($produtosInativo) ?></span></a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
                <table class="table table-striped dataTable">
                    <thead>
                        <th>Marca</th>
                        <th>Categoria</th>
                        <th>Subcategoria</th>
                        <th>Descrição</th>
                        <th>Preço Venda</th>
                        <th>Quantidade</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($produtosAtivo) : ?>
                            <?php foreach ($produtosAtivo as $produto) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $produto['marcaNome'] ?></td>
                                    <td><?= $produto['categoriaNome'] ?></td>
                                    <td><?= $produto['subcategoriaNome'] ?></td>
                                    <td><?= $produto['descricao'] ?></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('ProdutoController/edit')) : ?>
                                            <a href="<?= base_url('/produto/edit/' . $produto['produto_id']) ?>">
                                                <button class="btn btn-primary text-white" title="Editar">
                                                    <i class="la la-edit la-2x"></i>
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('ProdutoController/desativarProduto')) : ?>
                                            <button class="btn btn-danger text-white desativarProduto" value="<?= $produto['produto_id'] ?>" title="Excluir">
                                                <i class="la la-trash la-2x"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="inativos" role="tabpanel" aria-labelledby="inativos-tab">
                <table class="table table-striped dataTable">
                    <thead>
                        <th>Marca</th>
                        <th>Categoria</th>
                        <th>Subcategoria</th>
                        <th>Descrição</th>
                        <th>Preço Venda</th>
                        <th>Quantidade</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($produtosInativo) : ?>
                            <?php foreach ($produtosInativo as $produto) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $produto['marcaNome'] ?></td>
                                    <td><?= $produto['categoriaNome'] ?></td>
                                    <td><?= $produto['subcategoriaNome'] ?></td>
                                    <td><?= $produto['descricao'] ?></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('ProdutoController/edit')) : ?>
                                            <a href="<?= base_url('/produto/edit/' . $produto['produto_id']) ?>">
                                                <button class="btn btn-primary text-white" title="Editar">
                                                    <i class="la la-edit la-2x"></i>
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('ProdutoController/ativarProduto')) : ?>
                                            <button class="btn btn-success text-white ativarProduto" value="<?= $produto['produto_id'] ?>" title="Ativar">
                                                <i class="la la-arrow-circle-o-up la-2x"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>