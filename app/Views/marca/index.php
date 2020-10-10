<style>
    .cardNovaMarca {
        display: none;
    }

    .cardEditarMarca {
        display: none;
    }
</style>

<div class="row">
    <div class="col-sm text-left d-none d-md-block">
        <span class="h4 align-center">Marcas</span>
    </div>
    <?php if ($base->permissao('MarcaController/create')) : ?>
        <div class="col-sm text-md-center text-lg-right">
            <button class="btn btn-danger btn-md" id="btnNovaMarca">Nova Marca</button>
        </div>
    <?php endif; ?>
</div>
<hr>
<div class="card cardNovaMarca">
    <div class="card-body">
        <form class="form-inline" action="<?= base_url('marca/store') ?>" method="post">
            <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Nova Marca</label>
            <div class="col-md-9">
                <input type="text" class="form-control form-control-lg w-100" id="nome" name="nome" required>
            </div>
            <div class="col-md-1 text-right">
                <button type="submit" class="btn btn-success text-white" title="Salvar">
                    <i class="la la-check-square la-2x"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<hr class="cardNovaMarca">
<div class="card cardEditarMarca">
    <div class="card-body">
        <form class="form-inline" action="<?= base_url('marca/update') ?>" method="post">
            <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Editar Marca</label>
            <div class="col-md-9 inputsEditarMarca">
                <input type="text" class="form-control form-control-lg w-100" id="marcaNomeEdit" name="nome" required>
                <input type="hidden" class="form-control form-control-lg w-100" id="marcaId" name="marcaId" required>
            </div>
            <div class="col-md-1 text-right">
                <button class="btn btn-success text-white" title="Salvar">
                    <i class="la la-check-square la-2x"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<hr class="cardEditarMarca">
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="ativosTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Ativos <span class="badge badge-count"><?= count($marcasAtivo) ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos" aria-selected="false">Inativos <span class="badge badge-count"><?= count($marcasInativos) ?></span></a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
                <table class="table table-striped dataTable">
                    <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($marcasAtivo) : ?>
                            <?php foreach ($marcasAtivo as $marca) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $marca['marca_id'] ?></td>
                                    <td><?= $marca['nome'] ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('MarcaController/edit')) : ?>
                                            <button class="btn btn-primary text-white btnEditarMarca" marcaNome="<?= $marca['nome'] ?>" value="<?= $marca['marca_id'] ?>" title="Editar">
                                                <i class="la la-edit la-2x"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('MarcaController/desativarMarca')) : ?>
                                            <button class="btn btn-danger text-white desativarMarca" value="<?= $marca['marca_id'] ?>" title="Excluir">
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
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($marcasInativos) : ?>
                            <?php foreach ($marcasInativos as $marca) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $marca['marca_id'] ?></td>
                                    <td><?= $marca['nome'] ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('MarcaController/edit')) : ?>
                                            <button class="btn btn-primary text-white btnEditarMarca" value="<?= $marca['marca_id'] ?>" title="Editar">
                                                <i class="la la-edit la-2x"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('MarcaController/ativarMarca')) : ?>
                                            <button class="btn btn-success text-white ativarMarca" value="<?= $marca['marca_id'] ?>" title="Ativar">
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