<style>
    .cardNovaCategoria {
        display: none;
    }

    .cardEditarCategoria {
        display: none;
    }
</style>
<div class="row">
    <div class="col-sm text-left d-none d-md-block">
        <span class="h4 align-center">Categorias</span>
    </div>
    <?php if ($base->permissao('CategoriaController/create')) : ?>
        <div class="col-sm text-md-center text-lg-right">
            <button class="btn btn-danger btn-md" id="btnNovaCategoria">Nova Categoria</button>
        </div>
    <?php endif; ?>
</div>
<hr>
<div class="card cardNovaCategoria">
    <div class="card-body">
        <form class="form-inline" action="<?= base_url('categoria/store') ?>" method="post">
            <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Nova Categoria</label>
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
<hr class="cardNovaCategoria">
<div class="card cardEditarCategoria">
    <div class="card-body">
        <form class="form-inline" action="<?= base_url('categoria/update') ?>" method="post">
            <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Editar Categoria</label>
            <div class="col-md-9 inputsEditarCategoria">
                <input type="text" class="form-control form-control-lg w-100" id="categoriaNomeEdit" name="nome" required>
                <input type="hidden" class="form-control form-control-lg w-100" id="categoriaId" name="categoriaId" required>
            </div>
            <div class="col-md-1 text-right">
                <button class="btn btn-success text-white" title="Salvar">
                    <i class="la la-check-square la-2x"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<hr class="cardEditarCategoria">
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="ativosTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Ativos <span class="badge badge-count"><?= count($categoriasAtiva) ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos" aria-selected="false">Inativos <span class="badge badge-count"><?= count($categoriasInativa) ?></span></a>
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
                        <?php if ($categoriasAtiva) : ?>
                            <?php foreach ($categoriasAtiva as $categoria) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $categoria['categoria_id'] ?></td>
                                    <td><?= $categoria['nome'] ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('CategoriaController/edit')) : ?>
                                            <button class="btn btn-primary text-white btnEditarCategoria" categoriaNome="<?= $categoria['nome'] ?>" value="<?= $categoria['categoria_id'] ?>" title="Editar">
                                                <i class="la la-edit la-2x"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('CategoriaController/desativarCategoria')) : ?>
                                            <button class="btn btn-danger text-white desativarCategoria" value="<?= $categoria['categoria_id'] ?>" title="Excluir">
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
                        <?php if ($categoriasInativa) : ?>
                            <?php foreach ($categoriasInativa as $categoria) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $categoria['categoria_id'] ?></td>
                                    <td><?= $categoria['nome'] ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('CategoriaController/edit')) : ?>
                                            <button class="btn btn-primary text-white btnEditarCategoria" categoriaNome="<?= $categoria['nome'] ?>" value="<?= $categoria['categoria_id'] ?>" title="Editar">
                                                <i class="la la-edit la-2x"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('CategoriaController/ativarCategoria')) : ?>
                                            <button class="btn btn-success text-white ativarCategoria" value="<?= $categoria['categoria_id'] ?>" title="Ativar">
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