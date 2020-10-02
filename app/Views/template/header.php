<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <title>Ofcel</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

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
    <script src="<?= base_url('js/ready.js') ?>"></script>
</head>

<?= csrf_field(); ?>

<script>

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

    function csrf() {
        let token = $('[name=csrf_name]').val()
        let data  = {<?= getenv('app.CSRFTokenName') ?> : token}
        
        return data;
    }


    $(document).ready(() => {
        responseFlash()
    });
</script>