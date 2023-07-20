<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS ONLY -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" 
        crossorigin="anonymous"
    >
    <!-- CSS DO PROJETO-->
    <link rel="stylesheet" href="<?php echo site_url('auth/') ?>css/styles.css">

    <!-- JavaScript Bundle with Popper -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" 
        crossorigin="anonymous" defer>
    </script>
    
    <title>Cadastrar-se</title>
</head>
<body>
   <div class="container col-11 col-md-9" id="form-container">

        <div>
                
            <?php if (session()->has('sucesso')): ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Pefeito!</strong> <?php echo session('sucesso'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <?php endif; ?>

            <?php if (session()->has('info')): ?>

                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Informação!</strong> <?php echo session('info'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <?php endif; ?>

            <?php if (session()->has('atencao')): ?>

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Informação!</strong> <?php echo session('atencao'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <?php endif; ?>

            <!-- Captura os erros de CSRF - Ação não permitida -->
            <?php if (session()->has('error')): ?>

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erro!</strong> <?php echo session('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <?php endif; ?>
        </div>

        <div class="row gx-5">
            <div class="col-md-6">
            
                <h2> Recuperando a senha</h2>

                <?php if (session()->has('errors_model')): ?>


                    <ul>

                        <?php foreach (session('errors_model') as $error): ?>

                            <li class="text-danger"><?php echo $error; ?></li>

                        <?php endforeach; ?>

                    </ul>


                <?php endif; ?>

                <form>
                    <?php echo form_open("password/processaesqueci"); ?>

                        <div class="form-floating mb-3">
                            <input 
                                type="email" 
                                name="email" 
                                value="<?php echo old('email'); ?>"
                                class="form-control" 
                                id="exampleInputEmail1"
                                placeholder="Digite o seu email">
                                <label for="exampleInputEmail1" class="form-label">Digite o seu email</label>
                        </div>


                        <div class="mb-3">
                            
                            <div class="text-center">
                                <input id="btn-reset-senha" type="submit" class="btn btn-primary" value="recuperar senha" >
                            </div>
                            
                        </div>

                    <?php echo form_close(); ?>
                </form>

        </div>

        <div class="col-md-6">
            <div class="row align-items-center">
                <div class="col-12">
                    <img src="<?php echo site_url('auth/') ?>img/garcom7.jpg" alt="Tela de registro" class="img-fluid">
                </div>
                <div class="col-12" id="link-container">
                    <a href="<?php echo site_url('login/')?>"> Lembrei da minha senha </a>
                </div>
            </div>
        </div>
    </div>
   </div>
</body>
</html>