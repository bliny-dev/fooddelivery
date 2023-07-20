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
       <div class="row gx-5">
        <div class="col-md-6">
            
            <h2> Realize o seu cadastro</h2>

            <?php if (session()->has('errors_model')): ?>


                <ul>

                    <?php foreach (session('errors_model') as $error): ?>

                        <li class="text-danger"><?php echo $error; ?></li>

                    <?php endforeach; ?>

                </ul>


            <?php endif; ?>

            <form>
                <?php echo form_open("registrar/criar"); ?>

                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            class="form-control" 
                            name="name"
                            value="<?php echo old('nome'); ?>"
                            id="name"                            
                            placeholder="Digite o seu nome"
                        >
                            <label for="name" class="form-label">Digite o seu nome</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input 
                            type="email" 
                            class="form-control" 
                            name="email"
                            value="<?php echo old('email'); ?>"
                            id="email"
                            placeholder="Digite o seu e-mail">
                            <label for="email" class="form-label">Digite o seu e-mail</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            class="form-control cpf" 
                            name="cpf"
                            value="<?php echo old('cpf'); ?>"
                            id="cpf"
                            placeholder="Digite o seu CPF">
                            <label for="cpf" class="form-label">Digite o seu cpf</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input 
                            type="password" 
                            class="form-control"
                            name="password"
                            id="password"
                            placeholder="Digite a sua senha">
                            <label for="password" class="form-label">Digite a sua senha</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input
                            type="password" 
                            class="form-control" 
                            name="password_confirmation" 
                            placeholder="Confirme sua senha"
                            id="confirmpassword"
                        >
                            <label for="confirmpassword" class="form-label"> Confirme sua senha </label>
                    </div>

                    <div class="mb-3">
                        
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="cadastrar" >
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
                    <a href="<?php echo site_url('login/')?>"> Eu já tenho uma conta </a>
                </div>
            </div>
        </div>
    </div>
   </div>
</body>
</html>