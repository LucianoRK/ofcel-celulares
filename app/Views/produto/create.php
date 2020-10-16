<div class="row">
    <div class="col-sm text-left">
        <span class="page-title h4">Produtos</span>
    </div>
</div>
<hr>
<form action="<?= base_url('produto/store') ?>" method="post">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Cadastre um produto</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="marca">Marca</label>
                    <select class="form-control form-control-lg" id="marca" name="marca" required>
                        <option></option>
                        <?php foreach ($marcas as $marca) : ?>
                            <option value="<?= $marca['marca_id'] ?>"><?= $marca['nome'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="marca">Categoria</label>
                    <select class="form-control form-control-lg" id="categoria" name="categoria" required>
                        <option></option>
                        <?php foreach ($categorias as $categoria) : ?>
                            <option value="<?= $categoria['categoria_id'] ?>"><?= $categoria['nome'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="marca">Subcategoria</label>
                    <select class="form-control form-control-lg" id="subcategoria" name="subcategoria" required disabled>
                        
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="descricao">Descrição (Nome do produto)</label>
                    <input type="text" class="form-control form-control-lg" id="descricao" name="descricao" required>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mb-2">
        <button class="btn btn-danger btn-lg" type="submit">Salvar</button>
        <?= csrf_field(); ?>
    </div>
</form>