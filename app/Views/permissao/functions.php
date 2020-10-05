<script>
    /**
    * Atualiza as permissões do usuário
    *
     */
    function updatePermissoies() {
        //Aplica o evento em todos os botões do datatables
        $('.dataTable').on("click", ".toggle-group", function() {
            let permissaoId = $(this).parent().find('.permissoes').val()
            let usuarioTipo = $('#usuarioTipo').val()
            let checked
            //Verifica o status do botão
            if ($(this).parent().hasClass('off')) {
                checked = true
            } else {
                checked = false
            }
            //Dispara o post
            $.post(BASE_URL + "/permissao/update",
                data = {
                    permissaoId :  permissaoId,
                    usuarioTipo : usuarioTipo,
                    checked : checked
                }, (resp) => {
                    if (resp) {
                        toast('success', 'Permissão alterada com sucesso')
                    }
                });
        });
    }

    $(document).ready(() => {
        updatePermissoies()
    })
</script>