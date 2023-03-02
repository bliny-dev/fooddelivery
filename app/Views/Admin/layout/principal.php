<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Food Delivery | <?php echo $this->renderSection('titulo'); ?></title>

    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- CSS LOCAL -->
    <link rel="stylesheet" href="<?php echo site_url('admin/') ?>css/style.css">
    <!-- CDN BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <!-- Essa section renderizará os estilos específicos da view que estender esse layout -->
    <?php echo $this->renderSection('estilos'); ?>
    
  </head>
  <body class="bgBody">
    
  <input class="d-none" type="checkbox" name="" id="menu-toggle">
    <div class="overlay">
        <label class="menu-toggle">
        </label>
    </div>

    <div class="sidebar"> 
        <div class="sidebar-container">
            <div class="brand">
                <h3>
                    <span class="lab la-staylinked"></span>
                    Bliny software
                </h3>
            </div>


            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a class="active" href="<?php echo site_url('admin/home'); ?>">
                          <span class="las la-home"></span>                            
                          <span>Inicio</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('admin/pedidos'); ?>">
                          <span class="las la-shopping-bag"></span>
                            <span>Pedidos</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('admin/categorias'); ?>">
                            <span class="las la-hamburger"></span>
                            <span>Categoria</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('admin/extras'); ?>">
                            <span class="las la-bacon"></span>
                            <span>Extras</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('admin/medidas'); ?>">
                            <span class="las la-balance-scale-right"></span>
                            <span>Medidas</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('admin/produtos'); ?>">
                            <span class="las la-list"></span>
                            <span>Produtos</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('admin/formas'); ?>">
                            <span class="las la-money-bill-wave-alt"></span>
                            <span>Formas de pagamento</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('admin/entregadores'); ?>">
                            <span class="las la-biking"></span>
                            <span>Entregadores</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('admin/bairros'); ?>">
                            <span class="las la-city"></span>
                            <span>Bairros</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('admin/expedientes'); ?>">
                            <span class="las la-clock"></span>
                            <span>Expediente</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('admin/usuarios'); ?>">
                            <span class="las la-user"></span>
                            <span>Usuarios</span>
                        </a>
                    </li>

                </ul>
            </div>
         
        </div>
    </div>
    <div class="main-content">  

        <!-- Title page, dinamic -->
        <header>
            <div class="header-title-wrapper">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                <div class="header-title " >
                    <h1 ><?php echo $this->renderSection('titulo_page'); ?></h1>
                </div>
            </div>

            <div class="header-action">
                <button class="btnMy btnMy-main">
                    <span class="las la-video"></span>
                    Upload
                </button>
            </div>
        </header>

        <!-- Essa section renderizará os conteúdos específicos da view que estender esse layout -->
        <?php echo $this->renderSection('conteudo'); ?>
        
    </div>
    <!-- bundle js bootstrap5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- plugins:js -->
    <script src="<?php echo site_url('admin/') ?>vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="<?php echo site_url('admin/') ?>vendors/chart.js/Chart.min.js"></script>
    <script src="<?php echo site_url('admin/') ?>vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?php echo site_url('admin/') ?>vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?php echo site_url('admin/') ?>js/off-canvas.js"></script>
    <script src="<?php echo site_url('admin/') ?>js/hoverable-collapse.js"></script>
    <script src="<?php echo site_url('admin/') ?>js/template.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?php echo site_url('admin/') ?>js/dashboard.js"></script>
    <script src="<?php echo site_url('admin/') ?>js/data-table.js"></script>
    <script src="<?php echo site_url('admin/') ?>js/jquery.dataTables.js"></script>
    <script src="<?php echo site_url('admin/') ?>js/dataTables.bootstrap4.js"></script>
    <!-- End custom js for this page-->

    <script src="<?php echo site_url('admin/') ?>js/jquery.cookie.js" type="text/javascript"></script>

    <!-- Essa section renderizará os scripts específicos da view que estender esse layout -->
    <?php echo $this->renderSection('scripts'); ?>
  </body>

</html>