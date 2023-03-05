<?php echo $this->extend('Admin/layout/principal'); ?>

<!-- Aqui enviamos para o template principal o título -->
<?php echo $this->section('titulo'); ?>

  <?php echo $titulo; ?>

<?php echo $this->endSection(); ?>

<!-- Aqui enviamos para o template principal o título da page -->
<?php echo $this->section('titulo_page'); ?>

  <?php echo $titulo_page; ?>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os estilos -->
<?php echo $this->section('estilos'); ?>


<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->
<?php echo $this->section('conteudo'); ?>

  <main>
    <section class="mb-4">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12 d-lg-flex" >

                    <div class="col-lg-3 col-sm-12 col-xs-12 border border-2 rounded-3 shadow me-1 mb-2 p-2">
                        <div class="d-flex">
                            <div class="col-2 d-flex align-items-center justify-content-center px-2">
                                <span class="fs-1 las la-dollar-sign text-primary"></span>
                            </div>

                            <div class="col-10 px-3 d-lg-block d-md-flex justify-content-between" >
                                
                                <div class="d-md-flex">
                                    <span class="me-2">Pedidos entregues: </span>
                                    <span class="text-primary fw-bold  rounded-circle">2</span>
                                </div>

                                <h4> <strong>R$</strong> 10.30</h4>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12 col-xs-12 border border-2 rounded-3 shadow me-1 mb-2 p-2">
                        <div class="d-flex">
                            <div class="col-2 d-flex align-items-center justify-content-center px-2">
                                <span class="fs-1 las la-dollar-sign text-danger"></span>
                            </div>

                            <div class="col-10 px-3 d-lg-block d-md-flex justify-content-between" >
                                
                                <div class="d-md-flex">
                                    <span class="me-2">Pedidos cancelados: </span>
                                    <span class="text-danger fw-bold  rounded-circle">2</span>
                                </div>

                                <h4> <strong>R$</strong> 10.30</h4>

                            </div>

                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-sm-12 col-xs-12 border border-2 rounded-3 shadow me-1 mb-2 p-2">
                        <div class="d-flex">
                            <div class="col-2 d-flex align-items-center justify-content-center px-2">
                                <span class="fs-1 las la-users text-success"></span>
                            </div>

                            <div class="col-10 px-3 d-lg-block d-md-flex justify-content-between" >
                                
                                <div class="d-md-flex">
                                    <span class="me-2">Clientes ativos: </span>
                                </div>

                                <h4>0</h4>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12 col-xs-12 border border-2 rounded-3 shadow me-1 mb-2 p-2">
                        <div class="d-flex">
                            <div class="col-2 d-flex align-items-center justify-content-center px-2">
                                <span class="fs-1 las la-motorcycle text-warning"></span>
                            </div>

                            <div class="col-10 px-3 d-lg-block d-md-flex justify-content-between" >
                                
                                <div class="d-md-flex">
                                    <span class="me-2">Entregadores ativos: </span>
                                </div>

                                <h4>0</h4>

                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    
    </section>

    <section class="mb-4">

        <div class="container-fluid">

            <div class="row border border-2 rounded-3 shadow  p-3">
                <div class="col-12 d-flex justify-content-center">
                    <h5>Listando últimos pedidos</h5>
                </div>

                <div class="col-12 mb-2">
                    <div class="col-12 border border-2 rounded-3  me-1 p-2 d-flex justify-content-between">
                        <span class="fs-5 me-1">23459</span>
                        <span class="fs-5 me-1">23459</span>
                        <span class="fs-5 me-1">23459</span>
                    </div>
                </div> 
                
            </div>
        </div>
    
    </section>

    <section class="mb-4">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12 d-lg-flex" >

                    <div class="col-lg-4 col-sm-12 col-xs-12 border border-2 rounded-3 shadow me-1 mb-2 p-2">
                        <div class="d-flex justify-content-center">
                            <h5>Produtos + vendidos</h5>
                        </div>
                    </div> 

                    <div class="col-lg-4 col-sm-12 col-xs-12 border border-2 rounded-3 shadow me-1 mb-2 p-2">
                        <div class="d-flex justify-content-center">
                            <h5>Clientes ativos</h5>
                        </div>
                    </div> 

                    <div class="col-lg-4 col-sm-12 col-xs-12 border border-2 rounded-3 shadow me-1 mb-2 p-2">
                        <div class="d-flex justify-content-center">
                            <h5>Entregadores ativos</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    
    </section>

  </main>


<?php echo $this->endSection(); ?>

<!-- testando commit  -->
<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>

<script>

  setInterval("atualiza()", 120000); // 120.000 milisegundos = 2 minutos

  function atualiza() {
    // $("#atualiza").toggleClass('bg-info');

    $("#atualiza").load('<?php echo site_url('admin/home'); ?>' + ' #atualiza');
  }

</script>

<?php echo $this->endSection(); ?>