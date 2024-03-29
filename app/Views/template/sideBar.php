<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item <?= $base->addActiveMenu(['LoginController', 'HomeController']); ?>">
                <a href="/">
                    <i class="la la-home"></i>
                    <p>HOME</p>
                    <!--<span class="badge badge-count">5</span> -->
                </a>
            </li>
            <?php if ($base->permissao('VendaController/index')) : ?>
                <li class="nav-item <?= $base->addActiveMenu('VendaController'); ?>">
                    <a href="<?= base_url('venda') ?>">
                        <i class="la la-cart-plus"></i>
                        <p>VENDAS</p>
                        <!--<span class="badge badge-count">5</span> -->
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($base->permissao('OrdemServicoController/index')) : ?>
                <li class="nav-item <?= $base->addActiveMenu('OrdemServicoController'); ?>">
                    <a href="">
                        <i class="la la-mobile"></i>
                        <p>O.S</p>
                        <!--<span class="badge badge-count">5</span> -->
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($base->permissao('CaixaController/index')) : ?>
                <li class="nav-item <?= $base->addActiveMenu('CaixaController'); ?>">
                    <a href="<?= base_url('caixa') ?>">
                        <i class="la la-money"></i>
                        <p>CAIXA</p>
                        <!--<span class="badge badge-count">5</span> -->
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($base->permissao('ClienteController/index')) : ?>
                <li class="nav-item <?= $base->addActiveMenu('ClienteController'); ?>">
                    <a href="<?= base_url('cliente') ?>">
                        <i class="la la-group"></i>
                        <p>CLIENTES</p>
                        <!--<span class="badge badge-count">5</span> -->
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($base->permissao('EstoqueController/index')) : ?>
                <li class="nav-item <?= $base->addActiveMenu(['EstoqueController', 'ProdutoController', 'MarcaController', 'CategoriaController', 'SubCategoriaController']); ?>">
                    <a class="" data-toggle="collapse" href="#collapseProdutos" aria-expanded="true">
                        <i class="la la-dropbox"></i>
                        <p>CADASTROS</p>
                        <!--<span class="badge badge-count">5</span> -->
                    </a>
                    <div class="collapse in" id="collapseProdutos">
                        <ul class="nav">
                            <?php if ($base->permissao('ProdutoController/index')) : ?>
                                <li>
                                    <a href="<?= base_url('produto') ?>">
                                        <span class="link-collapse">PRODUTOS</span>
                                    </a>
                                </li>
                            <?php endif ?>
                            <?php if ($base->permissao('MarcaController/index')) : ?>
                                <li>
                                    <a href="<?= base_url('marca') ?>">
                                        <span class="link-collapse">MARCAS</span>
                                    </a>
                                </li>
                            <?php endif ?>
                            <?php if ($base->permissao('CategoriaController/index')) : ?>
                                <li>
                                    <a href="<?= base_url('categoria') ?>">
                                        <span class="link-collapse">CATEGORIAS</span>
                                    </a>
                                </li>
                            <?php endif ?>
                            <?php if ($base->permissao('SubcategoriaController/index')) : ?>
                                <li>
                                    <a href="<?= base_url('subcategoria') ?>">
                                        <span class="link-collapse">SUBCATEGORIAS</span>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if ($base->permissao('UsuarioController/index')) : ?>
                <li class="nav-item <?= $base->addActiveMenu('UsuarioController'); ?>">
                    <a href="<?= base_url('usuario') ?>">
                        <i class="la la-user"></i>
                        <p>USUÁRIOS</p>
                        <!--<span class="badge badge-count">5</span> -->
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($base->permissao('PermissaoController/index')) : ?>
                <li class="nav-item <?= $base->addActiveMenu('PermissaoController'); ?>">
                    <a href="<?= base_url('permissao') ?>">
                        <i class="la la-unlock"></i>
                        <p>PERMISSÕES</p>
                        <!--<span class="badge badge-count">5</span> -->
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($base->permissao('RelatorioController/index')) : ?>
                <li class="nav-item <?= $base->addActiveMenu('RelatorioController'); ?>">
                    <a class="" data-toggle="collapse" href="#collapseRelatorios" aria-expanded="true">
                        <i class="la la-pie-chart"></i>
                        <p>RELATÓRIOS</p>
                        <!--<span class="badge badge-count">5</span> -->
                    </a>
                    <div class="collapse in" id="collapseRelatorios">
                        <ul class="nav">
                            <li>
                                <a href="#">
                                    <span class="link-collapse">RELATÓRIOS A</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="link-collapse">RELATÓRIOS B</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="link-collapse">RELATÓRIOS C</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div class="main-panel">
    <div class="content">