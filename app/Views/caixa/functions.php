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

    $(document).ready(() => {
        mostrarCampoLancamento()
        mostrarCampoRetirada()
    })
</script>