<div class="row">
    <div class="col-sm text-left">
        <span class="page-title h4">Iniciar Caixa</span>
    </div>
</div>
<hr>
<div class="card cardLancamento">
    <div class="card-body">
        <form class="form-inline" action="<?= base_url('caixa/store') ?>" method="post">
            <label for="valor" class="col-sm-4 col-form-label col-form-label-lg">Valor inicial do caixa da  <?= $session->get('empresa')['nome'].' ('.date('d/m/Y').')' ?></label>
            <div class="form-group col-md-7">
                <input type="text" class="form-control form-control-lg w-100 dinheiro" id="valor" name="valor" value="0,00" required>
                <input type="hidden" name="tipo" value="1" required>
            </div>
            <input type="hidden" class="form-control form-control-lg w-100" name="nome" required>
            <div class="form-group col-md-1 text-right">
                <button type="submit" class="btn btn-success text-white" title="Salvar">
                    <i class="la la-plus-circle la-2x"></i>
                </button>
            </div>
        </form>
    </div>
</div>