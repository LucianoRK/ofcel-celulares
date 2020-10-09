<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="/" class="logo">
                    <img width="120" src="<?= base_url('img/logo.png') ?>">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
               
                    <div class="navbar-nav topbar-nav">
                        <i class="la la-university la-2x"></i> <span style="font-size: 20px;"> <?= $session->get('empresa')['nome'] ?></span>
                    </div>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="<?= base_url('img/profile.jpg') ?>" alt="user-img" width="36" class="img-circle"><span><?= $session->get('usuario')['nome'] ?></span></span>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img"><img src="<?= base_url('img/profile.jpg') ?>" alt="user"></div>
                                        <div class="u-text">
                                            <h4><?= $session->get('usuario')['nome'] ?></h4>
                                            <p>Tipo usuário</p>
                                        </div>
                                    </div>
                                </li>
                                <?php if (count($session->get('empresas')) > 1) : ?>
                                    <div class="dropdown-divider"></div>
                                    <?php foreach ($session->get('empresas') as $empresaSelect) : ?>
                                        <?php if ($session->get('empresa')['empresa_id'] != $empresaSelect['empresa_id']) : ?>
                                            <a class="dropdown-item" href="<?= base_url('empresa/trocarEmpresa/'.$empresaSelect['empresa_id'])?>">
                                                <i class="la la-university"></i> <?= $empresaSelect['nome'] ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="ti-user"></i> Meu perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="ti-settings"></i> Configurações</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('logout')?>"><i class="fa fa-power-off"></i> Sair</a>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                    </ul>
            </nav>
        </div>