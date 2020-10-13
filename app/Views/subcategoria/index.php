<style>
    .cardNovaSubcategoria {
        display: none;
    }

    .cardEditarSubcategoria {
        display: none;
    }
</style>

<div class="row">
    <div class="col-sm text-left d-none d-md-block">
        <span class="h4 align-center">Subcategorias</span>
    </div>
    <?php if ($base->permissao('SubcategoriaController/create')) : ?>
        <div class="col-sm text-md-center text-lg-right">
            <button class="btn btn-danger btn-md" id="btnNovaSubcategoria">Nova Subcategoria</button>
        </div>
    <?php endif; ?>
</div>
<hr>
<div class="card cardNovaSubcategoria">
    <div class="card-body">
        <form class="form-inline" action="<?= base_url('subcategoria/store') ?>" method="post">
            <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Nova Subcategoria</label>
            <div class="form-group col-md-5">
                <input type="text" class="form-control form-control-lg w-100" id="nome" name="nome" required>
            </div>
            <div class="form-group col-md-4 inputsEditarSubcategoria">
                <select class="form-control form-control-lg" id="categoria" name="categoria" required>
                    <option></option>
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?= $categoria['categoria_id'] ?>"><?= $categoria['nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group col-md-1 text-right">
                <button type="submit" class="btn btn-success text-white" title="Salvar">
                    <i class="la la-check-square la-2x"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<hr class="cardNovaSubcategoria">
<div class="card cardEditarSubcategoria">
    <div class="card-body">
        <form class="form-inline" action="<?= base_url('subcategoria/update') ?>" method="post">
            <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Editar Subcategoria</label>
            <div class="form-group col-md-5 inputsEditarSubcategoria">
                <input type="text" class="form-control form-control-lg w-100" id="subcategoriaNomeEdit" name="nome" required>
                <input type="hidden" class="form-control form-control-lg" id="subcategoriaId" name="subcategoriaId" required>
            </div>
            <div class="form-group col-md-4 inputsEditarSubcategoria">
                <select class="form-control form-control-lg" id="categoria" name="categoria" required>
                    <option id="OptionCategoria"></option>
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?= $categoria['categoria_id'] ?>"><?= $categoria['nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group col-md-1 text-right">
                <button class="btn btn-success text-white" title="Salvar">
                    <i class="la la-check-square la-2x"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<hr class="cardEditarSubcategoria">
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="ativosTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Ativos <span class="badge badge-count"><?= count($subcategoriasAtivo) ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos" aria-selected="false">Inativos <span class="badge badge-count"><?= count($subcategoriasInativo) ?></span></a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
                <table class="table table-striped dataTable">
                    <thead>
                        <th>#</th>
                        <th>Categoria</th>
                        <th>Subcategoria</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($subcategoriasAtivo) : ?>
                            <?php foreach ($subcategoriasAtivo as $subcategoria) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $subcategoria['subcategoria_id'] ?></td>
                                    <td><?= $subcategoria['categoriaNome'] ?></td>
                                    <td><?= $subcategoria['nome'] ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('SubcategoriaController/edit')) : ?>
                                            <button class="btn btn-primary text-white btnEditarSubcategoria" categoriaId="<?= $subcategoria['categoria_id'] ?>"  categoriaNome="<?= $subcategoria['categoriaNome'] ?>"  subcategoriaNome="<?= $subcategoria['nome'] ?>" value="<?= $subcategoria['subcategoria_id'] ?>" title="Editar">
                                                <i class="la la-edit la-2x"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('SubcategoriaController/desativarSubcategoria')) : ?>
                                            <button class="btn btn-danger text-white desativarSubcategoria" value="<?= $subcategoria['subcategoria_id'] ?>" title="Excluir">
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
                        <th>Categoria</th>
                        <th>Subcategoria</th>
                        <th class="text-center"></th>
                    </thead>
                    <tbody>
                        <?php if ($subcategoriasInativo) : ?>
                            <?php foreach ($subcategoriasInativo as $subcategoria) : ?>
                                <tr class="linhaTabela">
                                    <td><?= $subcategoria['subcategoria_id'] ?></td>
                                    <td><?= $subcategoria['categoriaNome'] ?></td>
                                    <td><?= $subcategoria['nome'] ?></td>
                                    <td class="text-right">
                                        <?php if ($base->permissao('SubcategoriaController/edit')) : ?>
                                            <button class="btn btn-primary text-white btnEditarSubcategoria" categoriaId="<?= $subcategoria['categoria_id'] ?>"  categoriaNome="<?= $subcategoria['categoriaNome'] ?>" subcategoriaNome="<?= $subcategoria['nome'] ?>" value="<?= $subcategoria['subcategoria_id'] ?>" title="Editar">
                                                <i class="la la-edit la-2x"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($base->permissao('SubcategoriaController/ativarSubcategoria')) : ?>
                                            <button class="btn btn-success text-white ativarSubcategoria" value="<?= $subcategoria['subcategoria_id'] ?>" title="Ativar">
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