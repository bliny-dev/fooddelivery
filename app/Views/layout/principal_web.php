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
    <link rel="stylesheet" href="<?php echo site_url('web/') ?>src/assets/css/style.css">
    <!-- CDN BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <!-- Essa section renderizará os estilos específicos da view que estender esse layout -->
    <?php echo $this->renderSection('estilos'); ?>
    
  </head>
  <body class="bgBody">

    <nav class="navbar navbar-expand-lg navbar-danger bg-danger border-bottom border-3 border-warning" aria-label="Tenth navbar example">
        <div class="container-fluid">
            
            <div>
                <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-white text-decoration-none">
                    bliny
                </a>
            </div>
            
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                <i class="las la-bars fs-2 fw-bold text-white"></i>  
            </button>

            <div class="navbar-collapse justify-content-md-end collapse" id="navbarsExample08" style="">
                <ul class="navbar-nav">
                    
                    <li class="nav-item ">
                        <a class="nav-link text-white" href="<?php echo site_url('/'); ?>">
                            <span class="las la-home"></span>
                            Cardápio
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link text-white" href="<?php echo site_url('bairros'); ?>">
                            <span class="las la-city"></span>
                            Bairros atendidos
                        </a>
                    </li>
                    
                    <li class="nav-item ">
                        <a class="nav-link text-white" href="<?php echo site_url('admin/home'); ?>">
                            <span class="las la-city"></span>
                            Dashboard
                        </a>
                    </li>



                    <?php if (usuarioLogado()): ?>

                        <li class="nav-item ">
                            <a class="nav-link text-white" href="<?php echo site_url('conta'); ?>">
                                <span class="las la-user"></span>
                                Minha conta
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white" href="<?php echo site_url('login/logout'); ?>">
                                <span class="las la-door-closed"></span>
                                Sair
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item ">
                            <a class="nav-link text-white" href="<?php echo site_url('login'); ?>">Entrar</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white" href="<?php echo site_url('registrar'); ?>">Cadastrar-se</a>
                        </li>

                    <?php endif; ?>

                </ul>
            </div>

        </div>
    </nav>
    
    <div class='col-12 image-relative'>
    
        <img 
            class=" border-bottom border-3 border-warning"
            id="capa-empresa" 
            src="https://cozil.com.br/wp-content/uploads/2019/05/restaurant-237060_1920-1920x960.jpg" 
            alt="capa da empresa" 
        />

        <div class='container image-absolute'>

            <div class="d-flex justify-content-center me-2 align-items-center">
                <div> 
                    <img 
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkU1RzU7YYdBnMouQL4dmYt745zaw526mirQ&usqp=CAU"
                        class="logo-empresa" 
                        alt="Logo da empresa" 
                    />
                </div>   
                                            
                <div>
                    <button 
                        id="btnimg-empresa" 
                        class="btn btn-warning bg-gradient ms-1 rounded-circle"
                    > 
                        <i class="las la-pen fs-3 fw-bold"></i>  
                    </button>
                </div>
            </div> 

            <div class="col-12 d-flex justify-content-center my-1">
                <span class="fs-1 bg-white rounded-pill px-4">
                    Birosca 
                </span>
            </div>  
            <div class="col-12 d-flex justify-content-center">
                <span class='bg-white p-1 px-4 rounded-pill'>
                    Juazeiro do norte 
                </span>
            </div>  
            <div class="col-12 d-flex justify-content-center">
                <span class='bg-white p-1 px-4 rounded-pill'>
                    Avenida Ernesto Geisel, N°1617
                </span>
            </div>  
            <div class="col-12 d-flex justify-content-center mb-1">
                <span  class='bg-white p-1 px-4 rounded-pill'>
                    Funcionamos de 17:00 Hr as 23:00 Hr
                </span>
            </div>
            <div class="col-12 d-flex justify-content-center ">
                <span class='btn btn-success bg-gradient'>Aberto</span>
            </div>
        </div>
        
    </div>    
    
   
        
    <div class="main-content">  

        <!-- Essa section renderizará os conteúdos específicos da view que estender esse layout -->
        <?php echo $this->renderSection('conteudo'); ?>

    </div>
    
<!--     
    <footer className="container-fluid border-top border-3 border-warning">
        <div className="row">
            <div className="col-12 d-flex justify-content-center">
                <div>
                    <p className='fw-bold'>&#169; Desenvolvido por Bliny Software</p>
                </div> 
            </div>
        </div>
    </footer> -->

    <!-- bundle js bootstrap5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- scripts referentes ao navbar -->
    <script src="<?php echo site_url('web/') ?>src/assets/js/navbar.js"></script>
    <!-- Essa section renderizará os scripts específicos da view que estender esse layout -->
    <?php echo $this->renderSection('scripts'); ?>
  </body>

</html>

