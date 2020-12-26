<script>
    /**
     * Carregar o input de novoa marca
     */
    function mostrarCampoLancamento() {
        $('#btnNovoLancamento').on('click', function() {
            if ($('.cardLancamento').is(":visible")) {
                $('.cardLancamento').hide()
                $('.cardRetirada').hide()
            } else {
                $('.cardLancamento').show()
                $('.cardRetirada').hide()
            }
        });
    }

    /**
     * Mostra o campo de editar marca
     */
    function mostrarCampoRetirada() {
        $('#btnNovaRetirada').on('click', function() {
            if ($('.cardRetirada').is(":visible")) {
                $('.cardLancamento').hide()
                $('.cardRetirada').hide()
            } else {
                $('.cardLancamento').hide()
                $('.cardRetirada').show()
            }
        });
    }

    /**
     * Mostra o campo de editar marca
     */
    function fecharCaixa() {
        $('#fecharCaixa').on('click', function() {
            let valorTotal = `<?= !empty($totalGeral) ? $base->sqlToReal($totalGeral) : '' ?>`
            let caixaId = `<?= !empty($caixa['caixa_id']) ? $caixa['caixa_id'] : ''  ?>`
            if (caixaId) {
                Swal.fire({
                    icon: 'info',
                    title: `Deseja fechar o caixa no valor de R$ ${valorTotal}`,
                    showDenyButton: true,
                    confirmButtonText: 'Sim',
                    denyButtonText: 'Não',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(BASE_URL + "/caixa/fecharCaixa",
                            data = {
                                caixaId: caixaId
                            }, (resp) => {
                                if (resp) {
                                    toast('success', 'Caixa finalizado com sucesso')
                                    window.location.href = BASE_URL + "/caixa";
                                }
                            });
                    }
                })
            }
        });
    }

    $(document).ready(() => {
        mostrarCampoLancamento()
        mostrarCampoRetirada()
        fecharCaixa()
    })
</script>