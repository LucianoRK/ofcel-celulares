<style>
    .cardLancamento {
        display: none;
    }

    .cardRetirada {
        display: none;
    }
</style>
<div class="row">
    <div class="col-sm text-left d-none d-md-block">
        <span class="h4 align-center">Caixa</span>
    </div>
    <div class="col-sm text-md-center text-lg-right">
        <?php if ($base->permissao('CaixaController/lancamento')) : ?>
            <button class="btn btn-success btn-md" id="btnNovoLancamento">Novo Lançamento</button>
        <?php endif; ?>
        <?php if ($base->permissao('CaixaController/retirada')) : ?>
            <button class="btn btn-danger btn-md" id="btnNovaRetirada">Nova Retirada</button>
        <?php endif; ?>
    </div>
</div>
<hr>
<div class="card cardLancamento">
    <div class="card-body">
        <form class="form-inline" action="<?= base_url('CaixaController/store') ?>" method="post">
            <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Novo Lançamento</label>
            <div class="form-group col-md-5">
                <input type="text" class="form-control form-control-lg w-100" name="nome" required>
            </div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control form-control-lg w-100 dinheiro" id="valor" name="valor" value="0,00" required>
                <input type="hidden" name="tipo" value="1" required>
                <input type="hidden" name="caixaId" value="<?= $caixa['caixa_id'] ?>" required>
            </div>
            <div class="form-group col-md-1 text-right">
                <button type="submit" class="btn btn-success text-white" title="Salvar">
                    <i class="la la-plus-circle la-2x"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<div class="card cardRetirada">
    <div class="card-body">
        <form class="form-inline" action="<?= base_url('CaixaController/store') ?>" method="post">
            <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Nova Retirada</label>
            <div class="form-group col-md-5">
                <input type="text" class="form-control form-control-lg w-100" name="nome" required>
            </div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control form-control-lg w-100 dinheiro" id="valor" name="valor" value="0,00" required>
                <input type="hidden" name="tipo" value="0" required>
                <input type="hidden" name="caixaId" value="<?= $caixa['caixa_id'] ?>" required>
            </div>
            <div class="form-group col-md-1 text-right">
                <button type="submit" class="btn btn-danger text-white" title="Salvar">
                    <i class="la la-minus-circle la-2x"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-success">
                <div class="card-title text-light"> <i class="la la-cart-plus"></i> Vendas </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong class='text-success'>Dinheiro</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($venda['dinheiro']) ?></td>
                        </tr>
                        <tr>
                            <td><strong class='text-info'>Débito</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($venda['debito']) ?></td>
                        </tr>
                        <tr>
                            <td><strong class='text-warning'>Crédito</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($venda['credito']) ?></td>
                        </tr>
                        <tr>
                            <td><strong class='text-danger'>Outros</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($venda['outros']) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($venda['total']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-danger">
                <div class="card-title text-light"><i class="la la-mobile"></i>O.S</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong class='text-success'>Dinheiro</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($ordemServico['dinheiro']) ?></td>
                        </tr>
                        <tr>
                            <td><strong class='text-info'>Débito</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($ordemServico['debito']) ?></td>
                        </tr>
                        <tr>
                            <td><strong class='text-warning'>Crédito</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($ordemServico['credito']) ?></td>
                        </tr>
                        <tr>
                            <td><strong class='text-danger'>Outros</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($ordemServico['outros']) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($ordemServico['total']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-light"><i class="la la-money"></i> Total (Em dinheiro)</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong class='text-warning'>Ordem Serviço</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($ordemServico['dinheiro']) ?></td>
                        </tr>
                        <tr>
                            <td><strong class='text-success'>Vendas</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($venda['dinheiro']) ?></td>
                        </tr>
                        <?php foreach ($caixaLancamentos as $caixaLancamento) : ?>
                            <?php
                                if($caixaLancamento['tipo'] == 1){
                                    $classeIcon     = 'la-plus-circle';
                                    $classeCorTexto = 'text-success';
                                }else{
                                    $classeIcon     = 'la-minus-circle';
                                    $classeCorTexto = 'text-danger';
                                } 
                            ?>
                            <tr>
                                <td class="<?= $classeCorTexto?>"><?= $caixaLancamento['nome'] ?> </td>
                                <td class="text-right <?= $classeCorTexto?>"><i class="la <?= $classeIcon?> "></i> R$ <?= $base->sqlToReal($caixaLancamento['valor']) ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td><strong class='h3'></strong> </td>
                            <td class="text-right"><strong class='h3'>R$ <?= $base->sqlToReal($totalGeral) ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>