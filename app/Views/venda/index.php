<div class="row">
    <div class="col-sm text-left d-none d-md-block">
        <span class="h4 align-center">Vendas</span>
    </div>
    <?php if ($base->permissao('VendaController/create')) : ?>
        <div class="col-sm text-md-center text-lg-right">
            <a href="<?= base_url('venda/create') ?>">
                <button class="btn btn-danger btn-md">Nova Venda</button>
            </a>
        </div>
    <?php endif; ?>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="ativosTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Vendas <span class="badge badge-count"><?= count($vendasAtiva) ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos" aria-selected="false">Extornadas <span class="badge badge-count"><?= count($vendasInativa) ?></span></a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
                <table class="table table-striped dataTable">
                    <thead>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($vendasAtiva) : ?>
                            <?php foreach ($vendasAtiva as $venda) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $venda['venda_id'] ?></td>
                                    <td>teste</td>
                                    <td>teste</td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('VendaController/edit')) : ?>
                                            <a href="<?= base_url('/venda/edit/' . $venda['venda_id']) ?>">
                                                <button class="btn btn-primary text-white" title="Editar">
                                                    <i class="la la-edit la-2x"></i>
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('VendaController/desativarVenda')) : ?>
                                            <button class="btn btn-danger text-white desativarVenda" value="<?= $venda['venda_id'] ?>" title="Excluir">
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
                        <th>#</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($vendasInativa) : ?>
                            <?php foreach ($vendasInativa as $venda) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $venda['venda_id'] ?></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('VendaController/ativarVenda')) : ?>
                                            <button class="btn btn-success text-white ativarVenda" value="<?= $venda['venda_id'] ?>" title="Ativar">
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