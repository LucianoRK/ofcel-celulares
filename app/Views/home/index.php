<style>
    a:hover {
        text-decoration: none;
    }
</style>
<div class="row">
    <div class="col-sm-4">
        <a href="#">
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
        <a href="#">
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
                        <tr>
                            <td><strong>Quantidade</strong> </td>
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
            <div class="card-header bg-success">
                <div class="card-title text-light"><i class="la la-cart-plus"></i> Todas as vendas ( Hoje )</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <?php foreach ($empresas as $empresa) : ?>
                            <tr>
                                <td><strong><?= $empresa['nome'] ?> </strong> </td>
                                <td class="text-enter" title="Quantidade">0</td>
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
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-danger">
                <div class="card-title text-light">O.S <?= $session->get('empresa')['nome'] ?> ( Hoje )</div>
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
                <div class="card-title text-light">Todas as O.S ( Hoje )</div>
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
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-light">Caixa <?= $session->get('empresa')['nome'] ?> ( Hoje )</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong class='text-success'>Dinheiro</strong> </td>
                            <td class="text-right">R$ 0,00</td>
                        </tr>
                        <tr>
                            <td><strong class='text-danger'>Outros</strong> </td>
                            <td class="text-right">R$ 0,00</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong> </td>
                            <td class="text-right">R$ 0,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-light">Todos os caixas ( Hoje )</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <?php foreach ($empresas as $empresa) : ?>
                            <tr>
                                <td><strong><?= $empresa['nome'] ?> </strong> </td>
                                <td class="text-enter text-success" title="Em dinheiro">R$ 0,00</td>
                                <td class="text-right text-danger" title="Outros">R$ 0,00</td>
                                <td class="text-right" title="Total <?= $empresa['nome'] ?>">R$ 0,00</td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td><strong>Total</strong> </td>
                            <td class="text-enter text-success" title="Em dinheiro"><strong>R$ 0,00</strong></td>
                            <td class="text-right text-danger" title="Outros"><strong>R$ 0,00</strong></td>
                            <td class="text-right" title="Total"><strong class="h6">R$ 0,00</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>