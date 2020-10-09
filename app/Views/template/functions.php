<script>
    var BASE_URL = '<?= base_url() ?>'

    /**
     * Retorna o toast de resposta
     */
    function responseFlash() {
        responseFlashMensagem = '<?= $responseFlash['mensagem'] ?>'
        responseFlashTipo = '<?= $responseFlash['tipo'] ?>'

        if (responseFlashTipo && responseFlashMensagem) {
            toast(responseFlashTipo, responseFlashMensagem)
        }
    }

    /**
     * toast
     */
    function toast(tipo, mensagem) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: tipo,
            title: mensagem
        })
    }

    /**
     * DataTable
     */
    function dataTable() {
        $('.dataTable').DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                "select": {
                    "rows": {
                        "_": "Selecionado %d linhas",
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha"
                    }
                },
                "buttons": {
                    "copy": "Copiar para a área de transferência",
                    "copyTitle": "Cópia bem sucedida",
                    "copySuccess": {
                        "1": "Uma linha copiada com sucesso",
                        "_": "%d linhas copiadas com sucesso"
                    }
                }
            }
        });
    }

    /**
     * Template
     */
    function template() {
        jQuery('.scrollbar-inner').scrollbar();
        $('[data-toggle="tooltip"]').tooltip()

        var toggle_sidebar = false,
            toggle_topbar = false,
            nav_open = 0,
            topbar_open = 0;

        if (!toggle_sidebar) {
            $toggle = $('.sidenav-toggler');

            $toggle.click(function() {
                if (nav_open == 1) {
                    $('html').removeClass('nav_open');
                    $toggle.removeClass('toggled');
                    nav_open = 0;
                } else {
                    $('html').addClass('nav_open');
                    $toggle.addClass('toggled');
                    nav_open = 1;
                }
            });
            toggle_sidebar = true;
        }

        if (!toggle_topbar) {
            $topbar = $('.topbar-toggler');

            $topbar.click(function() {
                if (topbar_open == 1) {
                    $('html').removeClass('topbar_open');
                    $topbar.removeClass('toggled');
                    topbar_open = 0;
                } else {
                    $('html').addClass('topbar_open');
                    $topbar.addClass('toggled');
                    topbar_open = 1;
                }
            });
            toggle_topbar = true;
        }

        //select all
        $('[data-select="checkbox"]').change(function() {
            $target = $(this).attr('data-target');
            $($target).prop('checked', $(this).prop("checked"));
        })
    }

    /**
     * Mascaras
     */
    function mask() {
        $('.maskDate').mask('11/11/1111');
        $('.maskTime').mask('00:00:00');
        $('.maskDateTime').mask('99/99/9999 00:00:00');
        $('.maskCep').mask('99999-999');

        $('.maskTelefone').mask("(99) 9999-9999#").focusout(function(event) {
            if ($(this).val().length == 15) {
                $(this).unmask();
                $(this).mask('(99) 99999-9999');
            } else {
                $(this).unmask();
                $(this).mask('(99) 9999-9999');
            }
        })

        //Função que alterna entre cpf e cnpj
        $('.cpfCnpjTroca').on('click', function() {
            let cpfCnpj = $(this).parent().find('.cpfCnpj')
            $('.cpfCnpj').unmask()
            if (cpfCnpj.hasClass('cpf')) {
                $('.cpfCnpj').removeClass('cpf');
                $('.cpfCnpj').addClass('cnpj');
                $(this).text('CNPJ')
                $('.cpfCnpj').val('')
                maskCnpj()
            } else {
                $('.cpfCnpj').removeClass('cnpj');
                $('.cpfCnpj').addClass('cpf');
                $(this).text('CPF')
                $('.cpfCnpj').val('')
                maskCpf()
            }
        })
    }

    /**
     * Mascara de cpf
     */
    function maskCpf() {
        $('.cpf').mask('999.999.999-99').blur(function(event) {
            if ($(this).val() != '' && $(this).val().length < 15) {
                if (!validarCpf($(this).val())) {
                    toast('error', 'CPF inválido !');
                    $(this).focus()
                }
            }
        })
    }

    /**
     * Mascara de Cnpj
     */
    function maskCnpj() {
        $('.cnpj').mask('99.999.999/9999-99').blur(function(event) {
            if ($(this).val() != '' && $(this).val().length > 15) {
                if (!validarCnpj($(this).val())) {
                    toast('error', 'CNPJ inválido !');
                    $(this).focus()
                }
            }
        })
    }

    /**
     * Mascara de Cnpj
     */
    function validaNumero() {
        $('.numero').on('keypress', function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                e.preventDefault();
            }
        });
    }

    /**
     * Validador de cpf
     */
    function validarCpf(cpf) {
        cpf = cpf.replaceAll('.', '').replaceAll('-', '');
        var soma = 0;
        var resto;
        if (cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999") {
            return false;
        }
        for (i = 1; i <= 9; i++) {
            soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
        }
        resto = (soma * 10) % 11;
        if ((resto == 10) || (resto == 11)) {
            resto = 0;
        }
        if (resto != parseInt(cpf.substring(9, 10))) {
            return false;
        }
        soma = 0;
        for (i = 1; i <= 10; i++) {
            soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
        }
        resto = (soma * 10) % 11;
        if ((resto == 10) || (resto == 11)) {
            resto = 0;
        }
        if (resto != parseInt(cpf.substring(10, 11))) {
            return false;
        }
        return true;
    }

    /**
     * Validador de Cnpj
     */
    function validarCnpj(cnpj) {
        cnpj = cnpj.replace(/[^\d]+/g, '');
        if (cnpj == '') return false;
        if (cnpj.length != 14) return false;
        if (cnpj == "00000000000000" || cnpj == "11111111111111" || cnpj == "22222222222222" || cnpj == "33333333333333" || cnpj == "44444444444444" || cnpj == "55555555555555" || cnpj == "66666666666666" || cnpj == "77777777777777" || cnpj == "88888888888888" || cnpj == "99999999999999") return false;
        tamanho = cnpj.length - 2;
        numeros = cnpj.substring(0, tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)) return false;
        tamanho = tamanho + 1;
        numeros = cnpj.substring(0, tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)) return false;
        return true;
    }

    $(document).ready(function() {
        template()
        mask()
        responseFlash()
        dataTable()
        maskCnpj()
        maskCpf()
        validaNumero()
    });
</script>