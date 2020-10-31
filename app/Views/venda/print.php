<div class="widthPrint">
    <div class="text-center">
        <img width="200" src="<?= base_url('img/logo.png') ?>">
    </div>
    <table class="table">
        <tr>
            <td class="">CNPJ: <?= $empresa['cnpj'] ?></td>
        </tr>
        <tr>
            <td class="">FONE: <?= $empresa['telefone'] ?></td>
        </tr>
        <tr>
            <td class="">RUA: <?= $empresa['endereco'] ?></td>
        </tr>
    </table>
    <table class="table">
        <thead>
            <th colspan="2" class="text-center">
                <strong>VENDA <?= $venda['venda_id'] ?></strong>
            </th>
        </thead>
        <tr>
            <td><strong>Cliente:</strong></td>
            <td class="text-right"><?= $venda['cliente_nome'] ?></td>
        </tr>
        <tr>
            <td><strong>Vendedor:</strong></td>
            <td class="text-right"><?= $venda['usuario_nome'] ?></td>
        </tr>
        <tr>
            <td><strong>Data:</strong></td>
            <td class="text-right"><?= date('d/m/Y H:i',  strtotime($venda['data_venda'])) ?></td>
        </tr>
    </table>
    <?php if (!empty($vendaEstoque)) : ?>
        <table class="table">
            <thead>
                <th colspan="2" class="text-center">
                    <strong>PRODUTOS</strong>
                </th>
            </thead>
            <?php foreach ($vendaEstoque as $item) : ?>
                <?php
                $valorTotalProduto += $item['valor_venda'];
                ?>
                <tr>
                    <td><strong><?= $item['produtoNome'] ?> </strong> <small>[ <?= $item['marcaNome'] ?> - <?= $item['categoriaNome'] ?> - <?= $item['subcategoriaNome'] ?> ]</small></td>
                    <td class="text-right">R$ <?= $base->sqlToReal($item['valor_venda']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <?php if (!empty($vendaFormaPagamento)) : ?>
        <table class="table">
            <thead>
                <th colspan="2" class="text-center">
                    <strong>FORMA DE PAGAMENTO</strong>
                </th>
            </thead>
            <?php foreach ($vendaFormaPagamento as $pagamento) : ?>
                <?php
                $valorTotalFormaPag += $pagamento['valor'];
                ?>
                <tr>
                    <td><?= $pagamento['nome'] ?></td>
                    <td class="text-right">R$ <?= $base->sqlToReal($pagamento['valor']) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td><strong>Total</strong></td>
                <td class="text-right"><strong>R$ <?= $base->sqlToReal($valorTotalFormaPag) ?></strong></td>
            </tr>
        </table>
    <?php endif; ?>
    <?php if (!empty($venda['observacao'])) : ?>
        <p class="ml-2"><?= $venda['observacao']; ?></p>
    <?php endif; ?>
</div>
<script type="text/javascript">
    window.print()
</script>