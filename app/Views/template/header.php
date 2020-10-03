<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <title>Ofcel</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/dataTables.css') ?>">

    <script src="<?= base_url('js/core/jquery.3.2.1.min.js') ?>"></script>
    <script src="<?= base_url('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') ?>"></script>
    <script src="<?= base_url('js/core/popper.min.js') ?>"></script>
    <script src="<?= base_url('js/core/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('js/plugin/chartist/chartist.min.js') ?>"></script>
    <script src="<?= base_url('js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') ?>"></script>
    <script src="<?= base_url('js/plugin/bootstrap-notify/bootstrap-notify.min.js') ?>"></script>
    <script src="<?= base_url('js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') ?>"></script>
    <script src="<?= base_url('js/plugin/jquery-mapael/jquery.mapael.min.js') ?>"></script>
    <script src="<?= base_url('js/plugin/jquery-mapael/maps/world_countries.min.js') ?>"></script>
    <script src="<?= base_url('js/plugin/jquery-mask/jquery-mask.js') ?>"></script>
    <script src="<?= base_url('js/plugin/chart-circle/circles.min.js') ?>"></script>
    <script src="<?= base_url('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('js/plugin/sweetalert/sweetalert.js') ?>"></script>
    <script src="<?= base_url('js/plugin/dataTables/dataTables.js') ?>"></script>
    <script src="<?= base_url('js/ready.js') ?>"></script>
</head>

<script>
    var BASE_URL = '<?= base_url() ?>'

    function responseFlash() {
        responseFlashMensagem = '<?= $responseFlash['mensagem'] ?>'
        responseFlashTipo = '<?= $responseFlash['tipo'] ?>'

        if (responseFlashTipo && responseFlashMensagem) {
            toast(responseFlashTipo, responseFlashMensagem)
        }

    }

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

    $(document).ready(() => {
        responseFlash()
        dataTable()
    });
</script>