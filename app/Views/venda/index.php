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
                        <th>Data / Hora</th>
                        <th>Vendedor</th>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($vendasAtiva) : ?>
                            <?php foreach ($vendasAtiva as $venda) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $venda['venda_id'] ?></td>
                                    <td><?= $venda['venda_data'] ?></td>
                                    <td><?= $venda['usuario_nome'] ?></td>
                                    <td><?= $venda['cliente_nome'] ?></td>
                                    <td><?= $base->sqlToReal($venda['valor_venda']) ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('VendaController/desativarVenda')) : ?>
                                            <button class="btn btn-danger text-white desativarVenda" value="<?= $venda['venda_id'] ?>" title="Excluir">
                                                <i class="la la-trash la-2x"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('VendaController/imprimir')) : ?>
                                            <button type="button" class="btn btn-default text-white ImprimirVenda" title="Imprimir" value="<?= $venda['venda_id'] ?>">
                                                <i class="la la-print la-2x"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('VendaController/visualizar')) : ?>
                                            <button type="button" class="btn btn-primary text-white detalheVenda" title="Mais detalhes" value="<?= $venda['venda_id'] ?>">
                                                <i class="la la-eye la-2x"></i>
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
                        <th>Data / Hora</th>
                        <th>Vendedor</th>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($vendasInativa) : ?>
                            <?php foreach ($vendasInativa as $venda) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $venda['venda_id'] ?></td>
                                    <td><?= $venda['venda_data'] ?></td>
                                    <td><?= $venda['usuario_nome'] ?></td>
                                    <td><?= $venda['cliente_nome'] ?></td>
                                    <td><?= $base->sqlToReal($venda['valor_venda']) ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('VendaController/visualizar')) : ?>
                                            <button type="button" class="btn btn-primary text-white detalheVenda" title="Mais detalhes" value="<?= $venda['venda_id'] ?>">
                                                <i class="la la-eye la-2x"></i>
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
<!-- Modal -->
<div class="modal" id="detalheVenda" tabindex="-1" role="dialog" aria-labelledby="detalheVenda" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detalhes da venda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detalheVendaBody">

            </div>
        </div>
    </div>
</div>