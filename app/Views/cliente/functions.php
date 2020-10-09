<script>
    /**
     * Verifica se existe o login já cadastrado 
     */
    function verificarLoginRepetido() {
        $("#login").focusout(function() {
            let login = $(this).val();
            let loginAtual = $("#loginAtual").val();
            if (login && login != loginAtual) {
                $.post(BASE_URL + "/usuario/verificarLoginRepetido",
                    data = {
                        login: login
                    }, (resp) => {
                        if (resp) {
                            $(this).val('');
                            $(this).focus();
                            toast('error', 'Usuário já cadastrado !');
                        }
                    });
            }
        })
    }

    /**
     * Ativa o usuário
     */
    function ativarUsuario() {
        $(".ativarUsuario").on("click", function() {
            let usuarioId = $(this).val();
            Swal.fire({
                icon: 'info',
                title: 'Deseja realmente ativar este usuário ?',
                showDenyButton: true,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(BASE_URL + "/usuario/ativarUsuario",
                        data = {
                            usuarioId: usuarioId
                        }, (resp) => {
                            if (resp) {
                                toast('success', 'Usuário ativado com sucesso !')
                                window.location.href = BASE_URL + "/usuario";
                            }
                        });
                }
            })

        })
    }

    /**
     * Desativa o usuário
     */
    function desativarUsuario() {
        $(".desativarUsuario").on("click", function() {
            let usuarioId = $(this).val();
            let usuarioSessao = '<?= $session->get('usuario')['usuario_id'] ?>'
            //Verifica se o usuário a ser desativado é != do usuárioda sessão
            if (usuarioId != usuarioSessao) {
                Swal.fire({
                    icon: 'info',
                    title: 'Deseja realmente desativar este usuário ?',
                    showDenyButton: true,
                    confirmButtonText: 'Sim',
                    denyButtonText: 'Não',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(BASE_URL + "/usuario/desativarUsuario",
                            data = {
                                usuarioId: usuarioId
                            }, (resp) => {
                                if (resp) {
                                    toast('success', 'Usuário desativado com sucesso !')
                                    window.location.href = BASE_URL + "/usuario";
                                }
                            });
                    }
                })
            } else {
                toast('error', 'Não é possivél desativar seu própio usuário !');
            }
        })
    }

    /**
     * Desativa o usuário
     */
    function buscaCep() {
        $("#cep").on("blur", function() {
            let cep = $(this).val().replaceAll('.', '').replaceAll('-', '');
            let cepOriginal = $('#cepOriginal').val();
            if (cep.length > 0 && cep != cepOriginal) {
                //Verifica se o usuário a ser desativado é != do usuárioda sessão
                $.post(BASE_URL + "/buscaCep",
                    data = {
                        cep: cep
                    }, (resp) => {
                        //Verifica se veio a informação da api
                        if (resp && resp.cep != undefined) {
                            $("#cidade").val(resp.localidade)
                            $("#uf").val(resp.uf)
                            $("#bairro").val(resp.bairro)
                            $("#rua").val(resp.logradouro)
                            $("#complemento").val('')
                            $("#numero").val('')
                            toast('success', 'Informações completada com sucesso !')
                        } else {
                            $("#cidade").val('')
                            $("#uf").val('')
                            $("#bairro").val('')
                            $("#rua").val('')
                            $("#complemento").val('')
                            $("#numero").val('')
                            toast('error', 'Não foi possível completar os campos de endereço !')
                        }
                    });
            }
        })
    }

    $(document).ready(() => {
        verificarLoginRepetido()
        ativarUsuario()
        desativarUsuario()
        buscaCep()
    })
</script>