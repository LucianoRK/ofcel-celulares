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
                <div class="card-title text-light"><i class="la la-mobile"></i> O.S</div>
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
                            <td><strong class='text-success'>Vendas</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($venda['dinheiro']) ?></td>
                        </tr>
                        <tr>
                            <td><strong class='text-danger'>Ordem Serviço</strong> </td>
                            <td class="text-right">R$ <?= $base->sqlToReal($ordemServico['dinheiro']) ?></td>
                        </tr>
                        <tr>
                            <td><strong class=''>Lançamento A</strong> </td>
                            <td class="text-right">R$ 0,00</td>
                        </tr>
                        <tr>
                            <td><strong class=''>Lançamento B</strong> </td>
                            <td class="text-right">R$ 0,00</td>
                        </tr>
                        <tr>
                            <td><strong class='h3'></strong> </td>
                            <td class="text-right"><strong class='h3'>R$ 0,00</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
