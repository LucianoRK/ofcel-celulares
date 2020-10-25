<script>
    /**
     * Adiciona Item ao carrinho
     */
    function adicionarItemCarrinho() {
        $('#produtoSelect').on('change', function() {
            //Pega os atributos  
            let descricaoCompleta = $('option:selected', this).attr('descricaoCompleta')
            let valorUnidade = $('option:selected', this).attr('valorUnidade')
            let produtoId = $('option:selected', this).attr('produtoId')
            let produtoEstoqueId = $(this).val()
            //Verifica a quantidade de produto no estoque
            $.post(BASE_URL + "/produto/verificarQuantidadeProdutoEstoque",
                data = {
                    produtoId: produtoId
                }, (quantidadeEmEstoque) => {
                    //Verifico quanto itens tem na lista
                    quantidadeEmLista = $('.produtosLista').map(function(i, el) {
                        if (produtoId == $(el).val()) {
                            return $(el).val()
                        }
                    }).get()
                    //Adiciona na lista se aq quantidade for > 0
                    if ((quantidadeEmEstoque - quantidadeEmLista.length) > 0) {
                        //Monta a tr
                        let newRow = $("<tr>")
                        let cols = ""
                        cols += `<td>${descricaoCompleta}</td>`
                        cols += `<td class="text-center">${valorUnidade}</td>`
                        cols += '<td class="text-right">'
                        cols += `<input type="hidden" class="produtosLista" name="produtosEstoque[]" value="${produtoEstoqueId}">`
                        cols += `<input type="hidden" class="valores" name="valores[]" value="${valorUnidade}">`
                        cols += '<button class="btn btn-danger text-white removerItemCarrinho" title="Remover da lista" type="button"><i class="la la-trash la-2x"></i></button>'
                        cols += '</td>'
                        newRow.append(cols)
                        //Adiciona a linha na tabela
                        $("#tableCarrinho tbody").append(newRow)
                        //Mostra o carrinho
                        $('.rowCarrinho').show()
                        //Redeclara a função
                        removerItemCarrinho()
                    } else {
                        toast('error', 'Este produto está em falta em seu estoque')
                        if ($('#tableCarrinho tbody tr').length < 1) {
                            $('.rowCarrinho').hide()
                        }
                    }
                    //Reseta o select
                    $('select[name=produtoSelect]').val(0)
                    $('select[name=produtoSelect]').selectpicker('refresh')
                    //Atualiza o valor Total
                    atualizarValorTotal()
                })
        })
    }
    /**
     * Remove item do carrinho
     */
    function removerItemCarrinho() {
        $('.removerItemCarrinho').on('click', function() {
            let tr = $(this).parents('tr').closest('tr')
            tr.fadeOut(400, function() {
                tr.remove()
                if ($('#tableCarrinho tbody tr').length < 1) {
                    $('.rowCarrinho').hide()
                }
                //Atualiza o valor Total
                atualizarValorTotal()
            })
            return false
        })
    }
    /**
     * Adiciona Forma de pagamento
     */
    function adicionarFormaPagamento() {
        $('#btnAdicionarFormaPagamento').on('click', function() {
            let formaPagamentoId = $('#selectFormaPagamento').val();
            let formaPagamentoText = $('#selectFormaPagamento option:selected').text();
            let valorFormaPagamento = $('#valorFormaPagamento').val()
            //Verifico se o valor não está zerado
            if (valorFormaPagamento != '0,00') {
                //Verifico se a forma de pagamento já não foi usada
                formasPagamentoDuplicado = $('.formasPagamento').map(function(i, el) {
                    if (formaPagamentoId == $(el).val()) {
                        return $(el).val()
                    }
                }).get()
                //Verifico se a forma de pagamento já não foi usada
                if (formasPagamentoDuplicado.length == 0) {
                    //Monta a tr
                    let newRow = $("<tr>")
                    let cols = ""
                    cols += `<td>${formaPagamentoText}</td>`
                    cols += `<td class="text-center">R$ ${valorFormaPagamento}</td>`
                    cols += '<td class="text-right">'
                    cols += `<input type="hidden" class="formasPagamento" name="formasPagamento[]" value="${formaPagamentoId}">`
                    cols += `<input type="hidden" class="valoresPagamento" name="valoresPagamento[]" value="${valorFormaPagamento}">`
                    cols += '<button class="btn btn-danger text-white removerFormaPagamento" title="Remover da lista" type="button"><i class="la la-trash la-2x"></i></button>'
                    cols += '</td>'
                    newRow.append(cols)
                    //Adiciona a linha na tabela
                    $("#tableFormasPagamento tbody").append(newRow)
                    //Redeclara a função
                    removerFormaPagamento()
                    //Atualiza o valor Total
                    atualizarValorTotal()
                } else {
                    toast('error', 'Forma de pagamento já cadastrada nesta venda.')
                }
            } else {
                toast('error', 'O valor deve ser maior que R$0,00.')
            }
        })
    }
    /**
     * Remove forma de Pagamento
     */
    function removerFormaPagamento() {
        $('.removerFormaPagamento').on('click', function() {
            let tr = $(this).parents('tr').closest('tr')
            tr.fadeOut(400, function() {
                tr.remove()
                //Atualiza o valor Total
                atualizarValorTotal()
            })
            return false
        })
    }
    /**
     *  Atualizar valor total
     */
    function atualizarValorTotal() {
        //Pega os valores dos produtos
        valores = $('.valores').map(function(i, el) {
            //Transforma em inteiro e convete para valor sql
            return parseFloat(realToSql($(el).val()))
        }).get()
        //Pega os valores das formas de pagamento
        valoresPagamento = $('.valoresPagamento').map(function(i, el) {
            //Transforma em inteiro e convete para valor sql
            return parseFloat(realToSql($(el).val()))
        }).get()
        //Soma todos os valores das 2 listas
        totalVlores = valores.reduce((total, numero) => total + numero, 0)
        totalvaloresPagamento = valoresPagamento.reduce((total, numero) => total + numero, 0)
        //Faz o calculo para saber quanto falta para completar a venda
        valorToltal = totalVlores - totalvaloresPagamento;
        //Adiciona na tela o valorTotal
        return $('#valorFormaPagamento').val(sqlToReal(valorToltal))
    }
    /** 
     * Salva a venda
     */
    function finalizarVenda() {
        $('#salvar').on('click', function() {
            //Atualiza o valor final
            atualizarValorTotal();
            //Pega a lista de produto
            quantidadeEmLista = $('.produtosLista').map(function(i, el) {
                return $(el).val()
            }).get()
             //Pega a lista formas de pagamento
            formasPagamento = $('.formasPagamento').map(function(i, el) {
                return $(el).val()
            }).get()
            //Verifica se foi inserido produtos na lista
            if (!quantidadeEmLista.length) {
                toast('error', 'Insira produtos na venda.')
                return false
            }
            //Verifica se foi inserido forma de pagamento na lista
            if (!formasPagamento.length) {
                toast('error', 'Insira formas de pagamento na venda.')
                return false
            }
            if($('#valorFormaPagamento').val() != '0,00'){
                toast('error', 'O valor da forma de pagamento está diferente do valor dos produtos.')
                return false
            }
            //Vai para o controlador
            return true
        })
    }
    /** 
     *selectpicker
     */
    function selectpicker() {
        $('.selectpicker').selectpicker()
    }

    $(document).ready(() => {
        selectpicker()
        adicionarItemCarrinho()
        removerItemCarrinho()
        adicionarFormaPagamento()
        removerFormaPagamento()
        finalizarVenda()
    })
</script>