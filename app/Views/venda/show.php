<div class="card">
    <div class="card-header">
        <div class="card-title">Vendedor e Cliente</div>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <td><strong>Vendedor</strong></td>
                <td><?= $venda['usuario_nome'] ?></td>
            </tr>
            <tr>
                <td><strong>Cliente</strong></td>
                <td><?= $venda['cliente_nome'] ?></td>
            </tr>
            <?php if (!empty($venda['cliente_telefone'])) : ?>
                <tr>
                    <td><strong>Telefone</strong></td>
                    <td><?= $venda['cliente_telefone'] ?></td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>
<?php if (!empty($vendaEstoque)) : ?>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Produtos</div>
        </div>
        <div class="card-body">
            <table class="table">
                <?php foreach ($vendaEstoque as $item) : ?>
                    <?php
                    $valorTotalProduto += $item['valor_venda'];
                    ?>
                    <tr>
                        <td><strong><?= $item['produtoNome'] ?> </strong> <small>[ <?= $item['marcaNome'] ?> - <?= $item['categoriaNome'] ?> - <?= $item['subcategoriaNome'] ?> ]</small></td>
                        <td class="text-right">R$ <?= $base->sqlToReal($item['valor_venda']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><strong>Total</strong></td>
                    <td class="text-right"><strong>R$ <?= $base->sqlToReal($valorTotalProduto); ?></strong></td>
                </tr>
            </table>
        </div>
    </div>
<?php endif; ?>
<?php if (!empty($vendaFormaPagamento)) : ?>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Forma de pagamento</div>
        </div>
        <div class="card-body">
            <table class="table">
                <?php foreach ($vendaFormaPagamento as $pagamento) : ?>
                    <?php
                    $valorTotalFormaPag += $pagamento['valor'];
                    ?>
                    <tr>
                        <td><strong><?= $pagamento['nome'] ?></strong></td>
                        <td class="text-right">R$ <?= $base->sqlToReal($pagamento['valor']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><strong>Total</strong></td>
                    <td class="text-right"><strong>R$ <?= $base->sqlToReal($valorTotalFormaPag) ?></strong></td>
                </tr>
            </table>
        </div>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Observações</div>
    </div>
    <div class="card-body">
        <textarea class="form-control" id="observacaoText"><?= $venda['observacao']; ?></textarea>
        <div class="col text-center mt-2">
            <button class="btn btn-success" idVenda="<?= $venda['venda_id']; ?>" id="editarObservacao">Salvar observação</button>
        </div>
    </div>
</div>