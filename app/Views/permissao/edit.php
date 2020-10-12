<div class="row">
    <div class="col-sm text-left d-none d-md-block">
        <span class="h4 align-center">Permissões - Editar</span>
    </div>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="ativosTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Permissões <span class="badge badge-count"><?= count($permissoesSistema) ?></span></a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
                <table class="table table-striped dataTable w-100 ">
                    <thead>
                        <th class="d-none d-md-block">#</th>
                        <th>Permissões</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($permissoesSistema as $key => $permissaoSistema) : ?>
                            <tr class="linhaTabela">
                                <td class="d-none d-md-block"><?= $permissaoSistema['permissao_id'] ?></td>
                                <td><?= $permissaoSistema['nome'] ?></td>
                                <td class="text-right">
                                    <?php
                                    $checked = false;
                                    foreach ($permissoes as $permissao) {
                                        if ($permissao['rota'] == $permissaoSistema['rota']) {
                                            $checked = true;
                                        }
                                    }
                                    ?>
                                    <input type="checkbox" class="permissoes" name="permissoes[]" data-toggle="toggle" data-onstyle="danger" <?= $checked ? 'checked' : ''; ?> value="<?= $permissaoSistema['permissao_id'] ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <input type="hidden" name="usuarioTipo" id="usuarioTipo" value="<?= $usurioTipoId ?>">
            </div>
        </div>
    </div>
</div>