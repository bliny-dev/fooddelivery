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

                        <!-- Primeiro -->
                        <div class="col-lg-3 col-sm-12 col-xs-12 border border-2 rounded-4 shadow me-1 mb-2 p-2">
                            <div class="d-flex">
                                <div class="col-2 d-flex align-items-center justify-content-center px-2">
                                    <span class="fs-1 las la-dollar-sign text-primary"></span>
                                </div>

                                <div class="col-10 px-3 d-lg-block d-md-flex justify-content-between" >
                                    
                                    <div class="d-md-flex">
                                        <span class="me-2">Pedidos entregues: </span>
                                        <span class="text-primary fw-bold  rounded-circle"><?php echo $valorPedidosEntregues->total; ?></span>
                                    </div>

                                    <h5> <strong>R$</strong>&nbsp;<?php echo number_format($valorPedidosEntregues->valor_pedido, 2); ?></h5>

                                </div>

                            </div>
                        </div>

                        <!-- Segundo -->
                        <div class="col-lg-3 col-sm-12 col-xs-12 border border-2 rounded-4 shadow me-1 mb-2 p-2">
                            <div class="d-flex">
                                <div class="col-2 d-flex align-items-center justify-content-center px-2">
                                    <span class="fs-1 las la-dollar-sign text-danger"></span>
                                </div>

                                <div class="col-10 px-3 d-lg-block d-md-flex justify-content-between" >
                                    
                                    <div class="d-md-flex">
                                        <span class="me-2">Pedidos cancelados: </span>
                                        <span class="text-danger fw-bold  rounded-circle"><?php echo $valorPedidosCancelados->total; ?></span>
                                    </div>

                                    <h5> <strong>-R$</strong>&nbsp;<?php echo number_format($valorPedidosCancelados->valor_pedido, 2); ?></h5>

                                </div>

                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-sm-12 col-xs-12 border border-2 rounded-4 shadow me-1 mb-2 p-2 px-3">
                            <div class="d-flex">
                                <div class="col-2 d-flex align-items-center justify-content-center px-2 ">
                                    <span class="fs-1 las la-users text-success"></span>
                                </div>

                                <div class="col-10 px-3 d-lg-block d-md-flex justify-content-between" >
                                    
                                    <div class="d-md-flex">
                                        <span class="me-2">Clientes ativos: </span>
                                    </div>

                                    <h4 class="float-end"><?php echo $totalClientesAtivos; ?></h4>

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-12 col-xs-12 border border-2 rounded-4 shadow me-1 mb-2 p-2 px-3">
                            <div class="d-flex">
                                <div class="col-2 d-flex align-items-center justify-content-center px-2">
                                    <span class="fs-1 las la-motorcycle text-warning"></span>
                                </div>

                                <div class="col-10 px-3 d-lg-block d-md-flex justify-content-between" >
                                    
                                    <div class="d-md-flex">
                                        <span class="me-2">Entregadores ativos: </span>
                                    </div>

                                    <h4 class="float-end"><?php echo $totalEntregadoresAtivos; ?></h4>

                                </div>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        
        </section>
        
        <section class="mb-4">

            <div class="container-fluid">

                <div class="row border border-2 rounded-4 shadow  p-3">
                    <div class="col-12 d-flex justify-content-center">
                        <h5>Listando últimos pedidos</h5>
                    </div>
                    
                    <div class="col-12 m-2 ">
                        <div class="col-12 border-bottom border-3 border-info me-1">
                        </div>
                    </div> 

                    <?php if (!isset($novosPedidos)): ?>

                        <h5 class="text-info text-center">Não há novos pedidos no momento <?php echo date('d/m/Y H:i:s'); ?></h5>
                    
                    <?php else: ?>

                        <?php foreach ($novosPedidos as $pedido): ?> 

                            <div class="col-md-6 col-lg-4 col-xxl-3 col-sm-12 my-2 card-group">
                                <div class="card shadow" >
                                    <div class="card-body p-2">

                                        
                                        <div class="card-title d-flex justify-content-center fw-bold fs-4">
                                            <a href="<?php echo site_url("admin/pedidos/show/$pedido->codigo"); ?>">
                                                <span class="fs-5 me-1"><?php echo $pedido->codigo; ?></span>
                                            </a>
                                        </div>

                                        <div class="d-block">
                                            <span class="col-6 fw-bold text-nowrap bd-highlight">Valor:</span>
                                            <span class="fs-5 me-1">R$&nbsp;<?php echo esc(number_format($pedido->valor_pedido, 2)); ?></span>
                                        </div>
                                        
                                        <div class="d-block">
                                            <span class="col-6 fw-bold text-nowrap bd-highlight">Data de criação:</span>
                                            <span><?php echo $pedido->criado_em->humanize(); ?></span>
                                        </div>
                                        
                                        <div class="d-block">
                                            <span class="col-4 fw-bold text-nowrap bd-highlight">Situação:</span>
                                            <span>
                                                <span class="fs-5 me-1"><?php $pedido->exibeSituacaoDoPedido(); ?></span>
                                            </span>  
                                        </div>
                                        
                                        <div class="d-flex justify-content-center">
                                            <span class="col-4 fw-bold text-nowrap bd-highlight">Ações:</span>
                                        </div>

                                        <!-- botões de modal -->
                                        <div class="d-flex  justify-content-center">
                                            <div class="d-md-flex justify-content-center">                      
                                                <button 
                                                    type="button" 
                                                    class="btn btn-primary btn-sm me-1 mb-1" 
                                                    data-bs-toggle="modal" 
                                                >
                                                    <i class="las la-print"></i>
                                                    Imprimir
                                                </button>

                                                <button
                                                    class=" btn btn-dark btn-sm me-1 mb-1"
                                                    data-bs-target="#modalShow<?php echo $pedido->id; ?>" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-dismiss="modal"
                                                >
                                                    <i class="las la-list"></i>
                                                    Detalhes
                                                </button>
                                            </div>
                                        </div>
                                        <!-- fim botões de modal -->

                                    </div>
                                </div>
                            </div>

                            <!-- modal show 1 | mostra todos os detalhes da pedido -->
                            <div class="modal fade" id="modalShow<?php echo $pedido->id; ?>" aria-hidden="true" aria-labelledby="ModalDeDetalhes" tabindex="-1" role="dialog">

                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalToggleLabel">Detalhes do produto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="card-body">
                                                    
                                            <p class="card-text">
                                                <span class="font-weight-bold">Situação:</span>
                                                <?php $pedido->exibeSituacaoDoPedido(); ?>
                                            </p>
                                            <p class="card-text">
                                                <span class="font-weight-bold">Criado:</span>
                                                <?php echo $pedido->criado_em->humanize(); ?>
                                            </p>
                                            <p class="card-text">
                                                <span class="font-weight-bold">Atualizado:</span>
                                                <?php echo $pedido->atualizado_em->humanize(); ?>
                                            </p>
                                            <p class="card-text">
                                                <span class="font-weight-bold">Forma de pagamento:</span>
                                                <?php echo esc($pedido->forma_pagamento); ?>
                                            </p>
                                            <p class="card-text">
                                                <span class="font-weight-bold">Valor dos produtos:</span>
                                                R$&nbsp;<?php echo esc(number_format($pedido->valor_produtos, 2)); ?>
                                            </p>
                                            <p class="card-text">
                                                <span class="font-weight-bold">Valor de entrega:</span>
                                                R$&nbsp;<?php echo esc(number_format($pedido->valor_entrega, 2)); ?>
                                            </p>
                                            <p class="card-text">
                                                <span class="font-weight-bold">Valor do pedido:</span>
                                                R$&nbsp;<?php echo esc(number_format($pedido->valor_pedido, 2)); ?>
                                            </p>
                                            <p class="card-text">
                                                <span class="font-weight-bold">Endereço de entrega:</span>
                                                <?php echo esc($pedido->endereco_entrega); ?>
                                            </p>
                                            <p class="card-text">
                                                <span class="font-weight-bold">Observações do pedido:</span>
                                                <?php echo esc($pedido->observacoes); ?>
                                            </p>

                                            <ul class="list-group">

                                                <?php $produtos = unserialize($pedido->produtos); ?>

                                                <?php foreach($produtos as $produto): ?>
                                    
                                                    <li class="list-group-item">
                                                    
                                                        <p><strong>Produto:&nbsp;</strong><?php echo $produto['nome']; ?></p>
                                                        <p><strong>Quantidade:&nbsp;</strong><?php echo $produto['quantidade']; ?></p>
                                                        <p><strong>Preço:&nbsp;</strong>R$&nbsp;<?php echo number_format($produto['preco'], 2); ?></p>

                                                    </li>

                                                <?php endforeach; ?>

                                            </ul>
                                
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                            
                                        <div class="mt-4 d-flex">

                                            <a href="" 
                                                class=" btn btn-warning btn-sm me-1 mb-1 d-flex align-items-center">
                                                <span class=" fs-5 las la-print"></span>                                
                                                Imprimir
                                            </a>

                                            <a href="<?php echo site_url("admin/pedidos"); ?>" class="btn  btn-sm btn-light fw-bold">
                                                Voltar
                                            </a>

                                        </div>

                                    </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    
                    <?php endif; ?>
                    
                </div>
            </div>
        
        </section>

        <section class="mb-4">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 d-lg-flex" >

                        <div class="col-lg-4 col-sm-12 col-xs-12 border border-2 rounded-4 shadow me-1 mb-2 p-2">
                            <div class="d-flex justify-content-center">
                                <h5>Produtos + vendidos</h5>
                            </div>
                            <ul class="list-arrow">
                                <?php if (!isset($produtosMaisVendidos)): ?>

                                    <p class="card-title">Não há dados para exibir no momento</p>

                                <?php else: ?>
                                    <?php foreach ($produtosMaisVendidos as $produto): ?>

                                        <li class="mb-2">
                                            <?php echo word_limiter($produto->produto, 5); ?>
                                            <span class="badge badge-pill badge-primary float-end"><?php echo esc($produto->quantidade); ?></span>
                                        </li>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div> 

                        <div class="col-lg-4 col-sm-12 col-xs-12 border border-2 rounded-4 shadow me-1 mb-2 p-2">
                            <div class="d-flex justify-content-center">
                                <h5>Top clientes</h5>
                            </div>
                                                    

                            <ul class="list-arrow">
                                <?php if (!isset($clintesMaisAssiduos)): ?>

                                    <p class="card-title">Não há dados para exibir no momento</p>

                                <?php else: ?>

                                    <?php foreach ($clintesMaisAssiduos as $cliente): ?>

                                        <li class="mb-2">
                                            <?php echo esc($cliente->nome); ?>
                                            <span class="badge badge-pill badge-success float-right"><?php echo esc($cliente->pedidos); ?></span>
                                        </li>

                                    <?php endforeach; ?>


                                <?php endif; ?>
                            </ul>
                        </div> 

                        <div class="col-lg-4 col-sm-12 col-xs-12 border border-2 rounded-4 shadow me-1 mb-2 p-2">
                            <div class="d-flex justify-content-center">
                                <h5>Top entregadores</h5>
                            </div>
                            
                            <ul class="list-unstyled">
                                <?php if (!isset($entregadoresMaisAssiduos)): ?>

                                    <p class="card-title text-info">Não há dados para exibir no momento</p>

                                <?php else: ?>

                                    <?php foreach ($entregadoresMaisAssiduos as $entregador): ?>

                                        <li class="mb-2">
                                            <img class="rounded-circle" width="40" src="<?php echo site_url("admin/entregadores/imagem/$entregador->imagem"); ?>" alt="alt"/>
                                            <?php echo esc($entregador->nome); ?>
                                            <span class="badge badge-pill badge-warning float-right"><?php echo esc($entregador->entregas); ?></span>
                                        </li>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>

                        </div>

                    </div>
                </div>
            </dv>
        
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