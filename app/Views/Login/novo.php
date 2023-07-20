<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS DO PROJETO-->
    <link rel="stylesheet" href="<?php echo site_url('auth/') ?>css/styles.css">
    
    <!-- CSS ONLY -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" 
        crossorigin="anonymous"
    >

    <!-- JavaScript Bundle with Popper -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" 
        crossorigin="anonymous" 
        defer
    ></script>
    
    <title>Login</title>
</head>
<body>
    <div class="container mt-3">

        <?php if(session()->has('sucesso')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo session('sucesso'); ?></strong>. 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if(session()->has('info')): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong><?php echo session('info'); ?></strong>. 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
        <?php if(session()->has('atencao')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo session('atencao'); ?></strong>. 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
        <?php if(session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo session('error'); ?></strong>. 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>

        
    <div class="container col-11 col-md-9" id="form-container">
        <div class="row align-items-center gx-5">
            <!-- Formulario e botão de login -->
            <div class="col-md-6 order-md-2">
                <h2> Faça o login para continuar </h2>
                
                <?php echo form_open('login/criar'); ?>

                    <div class="form-floating mb-3">
                        <input 
                            type="email" 
                            class="form-control" 
                            id="email"
                            name="email"
                            placeholder="Digite o seu email"
                            value="<?php echo old('email')?>"
                        >
                        <label for="email" class="form-label"> Digite o seu e-mail </label>
                    </div>

                    <div class="form-floating mb-3">
                        
                        <input 
                            type="password" 
                            class="form-control" 
                            id="password"
                            name="password"
                            placeholder="Digite a sua senha"
                        >

                        <label for="password" class="form-label"> Digite a  sua senha </label>
                    </div>
                    
                    <div class="text-center">
                        <span class="">
                            Esqueceu a senha? 
                            <a href="<?php echo site_url('password/esqueci') ?>" class="text-primary">CLIQUE AQUI</a>
                        </span>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" >Entrar</button>
                    </div>

                <?php echo form_close() ?>

            </div>

            <!-- final do formulario de login e botão -->
            <!-- Inicio de order, o login em desktop começa trazendo no grid
                 primeiro a imagem e depois o formulario e no mobile ele traz o 
                 formulario primeiro deixando a imagem abaixo dos campos a serem preenchidos 
            -->
            <div class="col-md-6 order-md-1">
                <div class="col-12">
                    <img src="<?php echo site_url('auth/') ?>img/garcom7.jpg" alt="Entrar no sistema" class="img-fluid">
                </div>
                <div class="col-12" id="link-container">
                    <a href="<?php echo site_url('registrar/')?>"> Ainda não tenho cadastro </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>