<div class="row">
    <div class="col-sm text-left">
        <span class="page-title h4">Nova Venda</span>
    </div>
</div>
<hr>
<form action="<?= base_url('venda/store') ?>" method="post">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Cliente e Vendedor</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cliente">Cliente <a href="<?= base_url('cliente/create') ?>" title="Novo Cliente"><i class="la la-plus-circle"></i></a></label>
                    <select class="form-control form-control-lg selectpicker" data-live-search="true" name="cliente" required>
                        <?php foreach ($clientes as $cliente) : ?>
                            <option value="<?= $cliente['cliente_id'] ?>" data-subtext="<?= $cliente['documento'] ?>"><?= $cliente['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="vendedor">Vendedor</label>
                    <select class="form-control form-control-lg selectpicker" data-live-search="true" name="vendedor" placeholder="Selecione um vendedor" required>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <option value="<?= $usuario['usuario_id'] ?>" <?php $usuario['usuario_id'] == $session->get('usuario_id') ? 'selected="selected"' : '' ?>> <?= $usuario['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Produtos</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="produtoSelect">Produto</label>
                    <select class="form-control form-control-lg selectpicker" data-live-search="true" id="produtoSelect" name="produtoSelect">
                        <option value=""></option>
                        <?php foreach ($produtos as $produto) : ?>
                            <?php
                            //Monta a descrição completa
                            $descricaoCompleta =  $produto['marcaNome'] . ' - ' . $produto['categoriaNome'] . ' - ' . $produto['subcategoriaNome'];
                            //Converte para Real
                            $valorUnidade = $base->sqlToReal($produto['valor_venda']);
                            //Desabilita o option caso não tenha o item no estoque
                            $validadorQuantidade = $produto['quantidade'] < 1 ? 'disabled' : '';
                            ?>
                            <option valorUnidade="<?= $valorUnidade ?>" descricaoCompleta="<?= $descricaoCompleta ?>" produtoId="<?= $produto['produto_id'] ?>" value="<?= $produto['estoque_id'] ?>" <?= $validadorQuantidade ?>> [ <?= $produto['codigo'] ?> ] - <?= $produto['descricao'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row" class="rowCarrinho">
                <table class="table rowCarrinho" style="display: none" id="tableCarrinho">
                    <thead>
                        <th class="">Descrição</th>
                        <th class="text-center">Valor Unid.</th>
                        <th class=""></th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Forma de pagamento</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="w-50">
                                <label for="selectFormaPagamento">Tipo</label>
                                <select class="form-control form-control-lg selectpicker" id="selectFormaPagamento">
                                    <?php foreach ($formasPagamento as $formaPagamento) : ?>
                                        <option texto="<?= $formaPagamento['nome'] ?>" value="<?= $formaPagamento['forma_pagamento_id'] ?>"><?= $formaPagamento['nome'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="w-50">
                                <label for="valorFormaPagamento">Valor</label>
                                <input type="text" class="form-control form-control-lg dinheiro" id="valorFormaPagamento" value="0,00">
                            </td>
                            <td class="text-right">
                                <label for="btnAdicionarFormaPagamento"></label>
                                <button class="btn btn-success text-white" id="btnAdicionarFormaPagamento" title="Adicionar forma de pagamento" type="button"><i class="la la-plus-circle la-2x"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tableFormasPagamento w-100" id="tableFormasPagamento">
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Desconto</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="w-50">
                                <label for="selectFormaPagamento">Tipo</label>
                                <select class="form-control form-control-lg selectpicker" id="selectFormaPagamento">
                                    <?php foreach ($formasPagamento as $formaPagamento) : ?>
                                        <option texto="<?= $formaPagamento['nome'] ?>" value="<?= $formaPagamento['forma_pagamento_id'] ?>"><?= $formaPagamento['nome'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="w-100">
                                <label for="desconto">Valor</label>
                                <input type="text" class="form-control form-control-lg dinheiro" id="desconto" value="0,00">
                            </td>
                            <td class="text-right">
                                <label for="btnAdicionarFormaPagamento"></label>
                                <button class="btn btn-success text-white" id="btnAdicionarFormaPagamento" title="Adicionar forma de pagamento" type="button"><i class="la la-plus-circle la-2x"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Observações</div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="tipoUsuario">Observações da venda</label>
                    <textarea class="form-control" name="observacao"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mb-2">
        <button class="btn btn-danger btn-lg" id="salvar">Salvar</button>
        <?= csrf_field(); ?>
    </div>
</form>