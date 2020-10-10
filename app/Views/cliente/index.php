<div class="row">
    <div class="col-sm text-left d-none d-md-block">
        <span class="h4 align-center">Clientes</span>
    </div>
    <?php if ($base->permissao('ClienteController/create')) : ?>
        <div class="col-sm text-md-center text-lg-right">
            <a href="<?= base_url('cliente/create') ?>">
                <button class="btn btn-danger btn-md">Novo Cliente</button>
            </a>
        </div>
    <?php endif; ?>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="ativosTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Ativos <span class="badge badge-count"><?= count($clientes) ?></span></a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
                <table class="table table-striped dataTable">
                    <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Documento</th>
                        <th>Telefone</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($clientes) : ?>
                            <?php foreach ($clientes as $cliente) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $cliente['cliente_id'] ?></td>
                                    <td><?= $cliente['nome'] ?></td>
                                    <td><?= $cliente['documento'] ?></td>
                                    <td><?= $cliente['telefone'] ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('ClienteController/edit')) : ?>
                                            <a href="<?= base_url('/cliente/edit/' . $cliente['cliente_id']) ?>">
                                                <button class="btn btn-primary text-white" title="Editar">
                                                    <i class="la la-edit la-2x"></i>
                                                </button>
                                            </a>
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