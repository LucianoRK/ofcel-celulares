<style>
    a:hover {
        text-decoration: none;
    }
</style>
<div class="row">
    <div class="col-sm-4">
        <a href="<?= base_url('/venda/create') ?>">
            <div class="card card-stats card-success">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-cart-plus"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <h4 class="card-title">Nova Venda</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4">
        <a href="#">
            <div class="card card-stats card-danger">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-mobile"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <h4 class="card-title">Nova O.S</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4">
        <a href="<?= base_url('/caixa') ?>">
            <div class="card card-stats card-primary">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-money"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <h4 class="card-title">Caixa</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-success">
                <div class="card-title text-light"> <i class="la la-cart-plus"></i> Vendas <?= $session->get('empresa')['nome'] ?> ( Hoje ) </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <?php foreach ($empresas as $empresa) : ?>
                            <?php if ($empresa['empresa_id'] == $session->get('empresa')['empresa_id']) : ?>
                                <tr>
                                    <td><strong>Quantidade</strong> </td>
                                    <td class="text-right"><?= $empresa['vendasQtd'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Valor</strong> </td>
                                    <td class="text-right">R$ <?= $base->sqlToReal($empresa['vendasValorTotal']) ?></td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-success">
                <div class="card-title text-light"><i class="la la-cart-plus"></i> Todas as vendas ( Hoje )</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <?php
                        $vendasTotalQuantidade = 0;
                        $vendasTotalValor = 0.00;
                        ?>
                        <?php foreach ($empresas as $empresa) : ?>
                            <tr>
                                <td><strong><?= $empresa['nome'] ?> </strong> </td>
                                <td class="text-enter" title="Quantidade"><?= $empresa['vendasQtd'] ?></td>
                                <td class="text-right" title="Valor">R$ <?= $base->sqlToReal($empresa['vendasValorTotal']) ?></td>
                            </tr>
                            <?php
                            $vendasTotalQuantidade += $empresa['vendasQtd'];
                            $vendasTotalValor += $empresa['vendasValorTotal'];
                            ?>
                        <?php endforeach ?>
                    <tfoot>
                        <td><strong>Total </strong> </td>
                        <td class="text-enter" title="Quantidade">
                            <strong><?= $vendasTotalQuantidade ?></strong>
                        </td>
                        <td class="text-right" title="Valor">
                            <strong>R$ <?= $base->sqlToReal($vendasTotalValor) ?></strong>
                        </td>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-danger">
                <div class="card-title text-light"><i class="la la-mobile"></i> O.S <?= $session->get('empresa')['nome'] ?> ( Hoje )</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Abertas</strong> </td>
                            <td class="text-right">0</td>
                        </tr>
                        <tr>
                            <td><strong>Entregues</strong> </td>
                            <td class="text-right">0</td>
                        </tr>
                        <tr>
                            <td><strong>Valor</strong> </td>
                            <td class="text-right">R$ 0,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-danger">
                <div class="card-title text-light"><i class="la la-mobile"></i> Todas as O.S ( Hoje )</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <?php foreach ($empresas as $empresa) : ?>
                            <tr>
                                <td><strong><?= $empresa['nome'] ?> </strong> </td>
                                <td class="text-enter" title="Aberta">0</td>
                                <td class="text-right" title="Entregue">0</td>
                                <td class="text-right" title="Valor">R$ 0,00</td>
                            </tr>
                        <?php endforeach ?>
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
                <div class="card-title text-light"><i class="la la-money"></i> Caixa <?= $session->get('empresa')['nome'] ?> ( Hoje )</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <?php foreach ($empresas as $empresa) : ?>
                            <?php if ($empresa['empresa_id'] == $session->get('empresa')['empresa_id']) : ?>
                                <tr>
                                    <td><strong class='text-success'>Dinheiro</strong> ( <strong class='text-success'> R$ <?= $base->sqlToReal($empresa['vendas']['dinheiro'] + $empresa['caixaLancamentos']) ?> </strong> - <strong class='text-danger'> R$ <?= $base->sqlToReal($empresa['caixaRetiradas']) ?> </strong>)</td>
                                    <td class="text-right"><strong>R$ <?= $base->sqlToReal(($empresa['vendas']['dinheiro'] + $empresa['caixaLancamentos']) - $empresa['caixaRetiradas']) ?></strong></td>
                                </tr>
                                <tr>
                                    <td><strong class='text-info'>Débito</strong></td>
                                    <td class="text-right">R$ <?= $base->sqlToReal($empresa['vendas']['debito']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong class='text-warning'>Crédito</strong></td>
                                    <td class="text-right">R$ <?= $base->sqlToReal($empresa['vendas']['credito']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong class=''>Outros</strong></td>
                                    <td class="text-right">R$ <?= $base->sqlToReal($empresa['vendas']['outros']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong class='text-danger'>Desconto</strong></td>
                                    <td class="text-right text-danger">R$ <?= $base->sqlToReal($empresa['vendas']['desconto']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td class="text-right">R$ <?= $base->sqlToReal(array_sum($empresa['vendas']) + $empresa['caixaLancamentos'] - $empresa['caixaRetiradas'] - $empresa['vendas']['desconto']) ?></td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-light"><i class="la la-money"></i> Todos os caixas ( Hoje )</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <?php
                        $totalDinheiro  = 0.00;
                        $totalDebito    = 0.00;
                        $totalCredito   = 0.00;
                        $totalOutros    = 0.00;
                        $totalDescontos = 0.00;
                        ?>
                        <?php foreach ($empresas as $empresa) : ?>
                            <tr>
                                <td><strong><?= $empresa['nome'] ?> </strong> </td>
                                <td class="text-enter" title="Em dinheiro">( <strong class='text-success'> R$ <?= $base->sqlToReal($empresa['vendas']['dinheiro'] + $empresa['caixaLancamentos']) ?> </strong> - <strong class='text-danger'> R$ <?= $base->sqlToReal($empresa['caixaRetiradas']) ?> </strong>)</td>
                                <td class="text-right text-info" title="Débito">R$ <?= $base->sqlToReal($empresa['vendas']['debito']) ?></td>
                                <td class="text-right text-warning" title="Crédito">R$ <?= $base->sqlToReal($empresa['vendas']['credito']) ?></td>
                                <td class="text-right" title="Outros">R$ <?= $base->sqlToReal($empresa['vendas']['outros']) ?></td>
                                <td class="text-right text-danger" title="Descontos">R$ <?= $base->sqlToReal($empresa['vendas']['desconto']) ?></td>
                                <td class="text-right" title="Total <?= $empresa['nome'] ?>">R$ <?= $base->sqlToReal(array_sum($empresa['vendas']) + $empresa['caixaLancamentos'] - $empresa['caixaRetiradas'] - $empresa['vendas']['desconto']) ?></td>
                            </tr>
                            <?php
                            $totalDinheiro += ($empresa['vendas']['dinheiro'] + $empresa['caixaLancamentos']) - $empresa['caixaRetiradas'];
                            $totalDebito += $empresa['vendas']['debito'];
                            $totalCredito += $empresa['vendas']['credito'];
                            $totalOutros += $empresa['vendas']['outros'];
                            $totalDescontos += $empresa['vendas']['desconto'];
                            ?>
                        <?php endforeach ?>
                        <?php
                        $totalGeral  = $totalDinheiro + $totalDebito + $totalCredito + $totalOutros;
                        ?>
                        <tr>
                            <td><strong>Total</strong> </td>
                            <td class="text-enter text-success" title="Em dinheiro"><strong>R$ <?= $base->sqlToReal($totalDinheiro) ?></strong></td>
                            <td class="text-right text-info" title="Débito"><strong>R$ <?= $base->sqlToReal($totalDebito) ?></strong></td>
                            <td class="text-right text-warning" title="Crédito"><strong>R$ <?= $base->sqlToReal($totalCredito) ?></strong></td>
                            <td class="text-right" title="Outros"><strong>R$ <?= $base->sqlToReal($totalOutros) ?></strong></td>
                            <td class="text-right text-danger" title="Descontos"><strong>R$ <?= $base->sqlToReal($totalDescontos) ?></strong></td>
                            <td class="text-right" title="Total"><strong class="h6">R$ <?= $base->sqlToReal($totalGeral) ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>