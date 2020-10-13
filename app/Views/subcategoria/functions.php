<script>
    /**
     * Carregar o input de novoa subcategoria
     */
    function mostrarCampoNovaSubcategoria() {
        $('#btnNovaSubcategoria').on('click', function() {
            if ($('.cardNovaSubcategoria').is(":visible")) {
                $('.cardNovaSubcategoria').hide()
                $('.cardEditarSubcategoria').hide()
            } else {
                $('.cardNovaSubcategoria').show()
                $('.cardEditarSubcategoria').hide()
            }
        });
    }

    /**
     * Mostra o campo de editar subcategoria
     */
    function mostrarCampoEditarSubcategoria() {
        $('.dataTable').on('click', '.btnEditarSubcategoria', function() {
            targetOffset = $('.cardEditarSubcategoria').offset().top;
            $('html, body').animate({
                scrollTop: targetOffset - 100
            }, 500);
            $('#subcategoriaNomeEdit').val($(this).attr('subcategorianome'))
            $('#subcategoriaId').val($(this).val())
            $('#OptionCategoria').val($(this).attr('categoriaId'))
            $('#OptionCategoria').text($(this).attr('categoriaNome'))
            $('#OptionCategoria').attr('selected')
            $('.cardEditarSubcategoria').show()
            $('.cardNovaSubcategoria').hide()
        });
    }

    /**
     * Ativa a subcategoria
     */
    function ativarSubcategoria() {
        $('.dataTable').on("click", ".ativarSubcategoria", function() {
            let subcategoriaId = $(this).val();
            Swal.fire({
                icon: 'info',
                title: 'Deseja realmente ativar esta subcategoria ?',
                showDenyButton: true,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(BASE_URL + "/subcategoria/ativarSubcategoria",
                        data = {
                            subcategoriaId: subcategoriaId
                        }, (resp) => {
                            if (resp) {
                                toast('success', 'Subcategoria ativada com sucesso !')
                                window.location.href = BASE_URL + "/subcategoria";
                            }
                        });
                }
            })

        })
    }

    /**
     * Desativa a subcategoria
     */
    function desativarSubcategoria() {
        $('.dataTable').on("click", ".desativarSubcategoria", function() {
            let subcategoriaId = $(this).val();
            Swal.fire({
                icon: 'info',
                title: 'Deseja realmente desativar esta subcategoria ?',
                showDenyButton: true,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(BASE_URL + "/subcategoria/desativarSubcategoria",
                        data = {
                            subcategoriaId: subcategoriaId
                        }, (resp) => {
                            if (resp) {
                                toast('success', 'Subcategoria desativada com sucesso !')
                                window.location.href = BASE_URL + "/subcategoria";
                            }
                        });
                }
            })
        })
    }

    $(document).ready(() => {
        mostrarCampoNovaSubcategoria()
        mostrarCampoEditarSubcategoria()
        desativarSubcategoria()
        ativarSubcategoria()
    })
</script>