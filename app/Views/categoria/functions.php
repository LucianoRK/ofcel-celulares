<script>
    /**
     * Carregar o input de novoa categoria
     */
    function mostrarCampoNovaCategoria() {
        $('#btnNovaCategoria').on('click', function() {
            if ($('.cardNovaCategoria').is(":visible")) {
                $('.cardNovaCategoria').hide()
                $('.cardEditarCategoria').hide()
            } else {
                $('.cardNovaCategoria').show()
                $('.cardEditarCategoria').hide()
            }
        });
    }

    /**
     * Mostra o campo de editar categoria
     */
    function mostrarCampoEditarCategoria() {
        $('.dataTable').on('click', '.btnEditarCategoria', function() {
            targetOffset = $('.cardEditarCategoria').offset().top;
            $('html, body').animate({
                scrollTop: targetOffset - 100
            }, 500);
            $('#categoriaNomeEdit').val($(this).attr('categoriaNome'))
            $('#categoriaId').val($(this).val())
            $('.cardEditarCategoria').show()
            $('.cardNovaCategoria').hide()
        });
    }

    /**
     * Ativa a categoria
     */
    function ativarCategoria() {
        $('.dataTable').on("click", ".ativarCategoria", function() {
            let categoriaId = $(this).val();
            Swal.fire({
                icon: 'info',
                title: 'Deseja realmente ativar esta categoria ?',
                showDenyButton: true,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(BASE_URL + "/categoria/ativarCategoria",
                        data = {
                            categoriaId: categoriaId
                        }, (resp) => {
                            if (resp) {
                                toast('success', 'Categoria ativada com sucesso !')
                                window.location.href = BASE_URL + "/categoria";
                            }
                        });
                }
            })

        })
    }

    /**
     * Desativa o categoria
     */
    function desativarCategoria() {
        $('.dataTable').on("click", ".desativarCategoria", function() {
            let categoriaId = $(this).val();
            Swal.fire({
                icon: 'info',
                title: 'Deseja realmente desativar esta categoria ?',
                showDenyButton: true,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(BASE_URL + "/categoria/desativarCategoria",
                        data = {
                            categoriaId: categoriaId
                        }, (resp) => {
                            if (resp) {
                                toast('success', 'Usuário desativado com sucesso !')
                                window.location.href = BASE_URL + "/categoria";
                            }
                        });
                }
            })
        })
    }

    $(document).ready(() => {
        mostrarCampoNovaCategoria()
        mostrarCampoEditarCategoria()
        desativarCategoria()
        ativarCategoria()
    })
</script>