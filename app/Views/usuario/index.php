<div class="row">
    <div class="col-sm text-left d-none d-md-block">
        <span class="h4 align-center">Usuários</span>
    </div>
    <?php if ($base->permissao('UsuarioController/create')) : ?>
        <div class="col-sm text-md-center text-lg-right">
            <a href="<?= base_url('usuario/create') ?>">
                <button class="btn btn-danger btn-md">Novo Usuário</button>
            </a>
        </div>
    <?php endif; ?>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="ativosTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Ativos <span class="badge badge-count"><?= count($usuariosAtivo) ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos" aria-selected="false">Inativos <span class="badge badge-count"><?= count($usuariosInativos) ?></span></a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
                <table class="table table-striped dataTable">
                    <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($usuariosAtivo) : ?>
                            <?php foreach ($usuariosAtivo as $usuario) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $usuario['usuario_id'] ?></td>
                                    <td><?= $usuario['nome'] ?></td>
                                    <td><?= $usuario['telefone'] ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('UsuarioController/edit')) : ?>
                                            <a href="<?= base_url('/usuario/edit/' . $usuario['usuario_id']) ?>">
                                                <button class="btn btn-primary text-white" title="Editar">
                                                    <i class="la la-edit la-2x"></i>
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('UsuarioController/desativarUsuario')) : ?>
                                            <button class="btn btn-danger text-white desativarUsuario" value="<?= $usuario['usuario_id'] ?>" title="Excluir">
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
                        <?php if ($usuariosInativos) : ?>
                            <?php foreach ($usuariosInativos as $usuario) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $usuario['usuario_id'] ?></td>
                                    <td><?= $usuario['nome'] ?></td>
                                    <td><?= $usuario['telefone'] ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('UsuarioController/ativarUsuario')) : ?>
                                            <button class="btn btn-success text-white ativarUsuario" value="<?= $usuario['usuario_id'] ?>" title="Ativar">
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