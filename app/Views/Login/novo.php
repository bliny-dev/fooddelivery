<?php echo $this->extend('layout/principal_web'); ?>

<!-- Aqui enviamos para o template principal o título -->
<?php echo $this->section('titulo'); ?>

  <?php echo $titulo; ?>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os estilos -->
<?php echo $this->section('estilos'); ?>

    <link rel="stylesheet" href="<?php echo site_url('web/src/assets/css/auth.css'); ?>"/>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->
<?php echo $this->section('conteudo'); ?>

    <div class="container">

        <div class="row bg-white shadow-sm rounded-3 py-5 px-2" style="margin-top: 40px;">            

            <div class="order-1 order-md-2 col-md-6 col-sm-12 p-2 d-flex justify-content-center align-items-center">
                <div class="justify-content-center text-center">
                    <h4>Faça login para continuar</h4>
                            
                    <?php echo form_open('login/criar'); ?>
                        <div class="form-group px-2">
                            <input 
                                type="email" 
                                name="email" 
                                value="<?php echo old('email'); ?>" 
                                class="form-control m-3" 
                                id="email" 
                                placeholder="Digite o seu e-mail."
                            >
                        </div>

                        <div class="form-group px-2">
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control m-3" 
                                id="password" 
                                placeholder="Digite a sua senha."
                            >
                        </div>
                            
                        <div class="text-center mt-3">
                            <button 
                                type="submit" 
                                class="btn btn-success btn-sm text-white "
                            >
                                Entrar
                            </button>
                        </div>

                        <div class="mt-3 d-block align-items-center">
                            <div class="form-check mb-2">
                                <label class="form-check-label text-muted">
                                    <input type="checkbox" class="form-check-input">
                                    Me mantenha logado.
                                </label>
                            </div>
                            <a href="<?php echo site_url('password/esqueci') ?>" class="auth-link text-black">Esqueci a minha senha.</a>
                        </div>
                            
                        <div class="text-center mt-4 font-weight-light">
                            Ainda não tem uma conta? <a href="<?php echo site_url('registrar'); ?>" class="text-primary">Criar conta</a>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

            <div class="order-2 order-md-1 col-md-6 col-sm-12 p-2 d-flex justify-content-center align-items-center " >
                <div class="d-block text-center">
                    <img 
                    src="data:image/png;base64,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" 
                    alt=""
                    class="img-fluid"
                    >
                    <h4>Ainda não tenho</h4>
                    <a href="<?php echo site_url('registrar'); ?>" class="text-decoration-none text-primary">
                        <h4>Cadastro</h4>
                    </a>
                </div>
            </div>

        </div>

    </div>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>



<?php echo $this->endSection(); ?><!-- Begin Sections-->