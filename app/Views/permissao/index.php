<div class="row">
    <div class="col-sm text-left">
        <span class="h4 align-center">Permissões</span>
    </div>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="ativosTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Tipo <span class="badge badge-count"><?= count($usuarioTipo) ?></span></a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
                <table class="table table-striped dataTable">
                    <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th class="text-center">Ações</th>
                    </thead>
                    <tbody>
                        <?php if ($usuarioTipo) : ?>
                            <?php foreach ($usuarioTipo as $usuario) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $usuario['usuario_tipo_id'] ?></td>
                                    <td><?= $usuario['nome'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('/permissao/edit/' . $usuario['usuario_tipo_id']) ?>">
                                            <button class="btn btn-primary text-white" title="Editar">
                                                <i class="la la-edit la-2x"></i>
                                            </button>
                                        </a>
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