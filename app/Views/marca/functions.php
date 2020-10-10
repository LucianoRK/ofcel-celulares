<script>
    /**
     * Carregar o input de novoa marca
     */
    function mostrarCampoNovaMarca() {
        $('#btnNovaMarca').on('click', function() {
            if ($('.cardNovaMarca').is(":visible")) {
                $('.cardNovaMarca').hide()
                $('.cardEditarMarca').hide()
            } else {
                $('.cardNovaMarca').show()
                $('.cardEditarMarca').hide()
            }
        });
    }

    function mostrarCampoEditarMarca() {
        $('.dataTable').on('click', '.btnEditarMarca', function() {
            targetOffset = $('.cardEditarMarca').offset().top;
            
            $('html, body').animate({
                scrollTop: targetOffset - 100
            }, 500);
            $('#marcaNomeEdit').val($(this).attr('marcanome'))
            $('#marcaId').val($(this).val())
            $('.cardEditarMarca').show()
            $('.cardNovaMarca').hide()
        });
    }

    /**
     * Ativa a marca
     */
    function ativarMarca() {
        $('.dataTable').on("click", ".ativarMarca", function() {
            let marcaId = $(this).val();
            Swal.fire({
                icon: 'info',
                title: 'Deseja realmente ativar esta marca ?',
                showDenyButton: true,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(BASE_URL + "/marca/ativarMarca",
                        data = {
                            marcaId: marcaId
                        }, (resp) => {
                            if (resp) {
                                toast('success', 'Marca ativada com sucesso !')
                                window.location.href = BASE_URL + "/marca";
                            }
                        });
                }
            })

        })
    }

    /**
     * Desativa o marca
     */
    function desativarMarca() {
        $('.dataTable').on("click", ".desativarMarca", function() {
            let marcaId = $(this).val();
            Swal.fire({
                icon: 'info',
                title: 'Deseja realmente desativar esta marca ?',
                showDenyButton: true,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(BASE_URL + "/marca/desativarMarca",
                        data = {
                            marcaId: marcaId
                        }, (resp) => {
                            if (resp) {
                                toast('success', 'Usuário desativado com sucesso !')
                                window.location.href = BASE_URL + "/marca";
                            }
                        });
                }
            })
        })
    }

    $(document).ready(() => {
        mostrarCampoNovaMarca()
        mostrarCampoEditarMarca()
        desativarMarca()
        ativarMarca()
    })
</script>