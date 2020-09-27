<style>
    :root {
        --input-padding-x: 1.5rem;
        --input-padding-y: .75rem;
    }

    body {
        background: linear-gradient(to right, #FE4164, #ff646d);
    }

    .card-signin {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.2);

    }

    .card-signin .card-title {
        margin-bottom: 2rem;
        font-weight: 300;
        font-size: 1.5rem;
    }

    .card-signin .card-body {
        padding: 2rem;
    }

    .form-signin {
        width: 100%;
    }

    .form-signin .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        transition: all 0.2s;
    }

    .form-label-group {
        margin-bottom: 1rem;
    }

    .form-label-group input {
        height: auto;
        border-radius: 2rem;
    }

    .form-label-group>input {
        padding: var(--input-padding-y) var(--input-padding-x);
    }

    .wrapper {
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        min-height: 100%;
        padding: 20px;
        margin-top: -20px;
    }

    .wrapper>div {
        max-width: 470px;
    }
</style>
<div class="wrapper">
    <div class="col-sm-9 col-md-7 col-lg-5">
        <div class="card card-signin ">
            <div class="card-body">
                <div class="logo-header text-center mb-4">
                    <img width="200" src="<?= base_url('img/logo.png') ?>">
                </div>
                <form class="form-signin" action="<?= base_url('login') ?>" method="post" >
                    <div class="form-label-group">
                        <input type="text" id="login" class="form-control" placeholder="Digite seu login" autocomplete="false" required autofocus>
                    </div>
                    <div class="form-label-group">
                        <input type="password" id="senha" class="form-control" placeholder="Digite sua senha" autocomplete="false" required>
                    </div>
                    <?= csrf_field(); ?>
                    <button class="btn btn-lg btn-danger btn-block text-uppercase" type="submit">Entrar</button>
                    <hr class="my-4">
                </form>
            </div>
        </div>
    </div>
</div>