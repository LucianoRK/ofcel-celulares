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
                <div class="container-fluid">
                    <!--
                    <form class="navbar-left navbar-form nav-search " action="">
                        <div class="input-group">
                            <input type="text" placeholder="Buscar ..." class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-search search-icon"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    -->
                    <div class="navbar-nav topbar-nav">
                        Nome da Empresa
                    </div>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="<?= base_url('img/profile.jpg') ?>" alt="user-img" width="36" class="img-circle"><span>Usuário</span></span>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img"><img src="<?= base_url('img/profile.jpg') ?>" alt="user"></div>
                                        <div class="u-text">
                                            <h4>Nome</h4>
                                            <p>Tipo usuário</p>
                                        </div>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="ti-user"></i> Meu perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="ti-settings"></i> Configurações</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fa fa-power-off"></i> Sair</a>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                    </ul>
                </div>
            </nav>
        </div>