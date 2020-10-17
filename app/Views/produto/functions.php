<script>
    /**
     * Ativa o produto
     */
    function ativarProduto() {
        $('.dataTable').on("click", ".ativarProduto", function() {
            let produtoId = $(this).val();
            Swal.fire({
                icon: 'info',
                title: 'Deseja realmente ativar este produto ?',
                showDenyButton: true,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(BASE_URL + "/produto/ativarProduto",
                        data = {
                            produtoId: produtoId
                        }, (resp) => {
                            if (resp) {
                                toast('success', 'Produto ativado com sucesso !')
                                window.location.href = BASE_URL + "/produto";
                            }
                        });
                }
            })

        })
    }

    /**
     * Desativa o produto
     */
    function desativarProduto() {
        $('.dataTable').on("click", ".desativarProduto", function() {
            let produtoId = $(this).val();
            Swal.fire({
                icon: 'info',
                title: 'Deseja realmente desativar este produto ?',
                showDenyButton: true,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(BASE_URL + "/produto/desativarProduto",
                        data = {
                            produtoId: produtoId
                        }, (resp) => {
                            if (resp) {
                                toast('success', 'Produto desativado com sucesso !')
                                window.location.href = BASE_URL + "/produto";
                            }
                        });
                }
            })
        })
    }

    /**
     * Busca as subcategorias
     */
    function buscaSubCategorias() {
        $("#categoria").on("change", function() {
            $("#subcategoria").html('')
            let categoria = $(this).val()
            if (categoria > 0) {
                $.post(BASE_URL + "/subcategoria/getByCategoria",
                    data = {
                        categoria: categoria
                    }, (subCategorias) => {
                        if (subCategorias) {
                            //Habilita o campo
                            $("#subcategoria").removeAttr('disabled')
                            //Percorre as respostas
                            $.each(subCategorias, function(index, subcategoria) {
                                //Adiciona os options no select
                                $("#subcategoria").append('<option value="' + subcategoria.subcategoria_id + '">' + subcategoria.nome + '</option>')
                            });
                        }
                    });
            } else {
                $("#subcategoria").html('')
                $("#subcategoria").attr('disabled', 'disabled')
            }
        })
    }

    /**
     * scripts do campo quantidade
     */
    function quantidadeScripts() {
        $(".quantidade").on("focus", function() {
            if($(this).val() == 0){
                $(this).val('')
            }
        })
        $(".quantidade").on("blur", function() {
            if($(this).val() == ''){
                $(this).val(0)
            }
        })
    }

    /**
     * scripts do campo valor
     */
    function valorScripts() {
        $(".copiarValor").on("click", function() {
            let valorCopiado = $(this).parent().find('.valor').val()
            $('.valor').val(valorCopiado)
        })
    }

    $(document).ready(() => {
        valorScripts()
        quantidadeScripts()
        buscaSubCategorias()
        desativarProduto()
        ativarProduto()
    })
</script>