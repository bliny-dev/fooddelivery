<?php echo $this->extend('layout/principal_web'); ?>

<!-- Aqui enviamos para o template principal o título -->
<?php echo $this->section('titulo'); ?>

  <?php echo $titulo; ?>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os estilos -->
<?php echo $this->section('estilos'); ?>

    <link rel="stylesheet" href="<?php echo site_url('web/src/assets/css/conta.css'); ?>"/>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->
<?php echo $this->section('conteudo'); ?>

    <div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em; margin-height: 300px">

        <?php echo $this->include('Conta/sidebar'); ?>

        <div class="row" style="margin-top: 2em">

            <div class="col-12 text-center">
                <h2 ><?php echo esc($titulo); ?></h2>
            </div>

            <div class="col-md-12">
                
                <?php if (empty($pedidos)): ?>
                    <h4 class="text-danger text-center">Nessa área aparecerá o seu histórico de pedidos realizados.</h4>
                <?php else: ?>

                    <div class="row d-flex">
                        <?php foreach($pedidos as $key => $pedido): ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 my-2 card-group">
                                <div class="card shadow" >
                                
                                    <div class="card-body p-2 text-center">

                                        <div class="card-title d-flex justify-content-center fw-bold fs-5">
                                            <a data-toggle="collapse" href="#collapse<?php echo $key; ?>">
                                                <h6 class="fw-bold">
                                                    Pedido <?php echo $pedido->codigo; ?> - Realizado <?php echo $pedido->criado_em->humanize(); ?>
                                                </h6>
                                            </a>
                                        </div>

                                        <div class="d-block">
                                            <span class="col-4 fw-bold text-nowrap bd-highlight">Situação:</span>
                                            <span>
                                                <?php $pedido->exibeSituacaoDoPedido(); ?>                      
                                            </span>
                                        </div>
                                        
                                        <!-- botões de modal -->
                                        <div class="text-center mt-2">                      
                                            <button 
                                                type="button" 
                                                class="btn btn-primary btn-sm me-1 mb-1" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalShow<?php echo $pedido->id;?>" 
                                                data-bs-dismiss="modal"
                                            >
                                                Detalhes
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div> 
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>


            </div>
    
                                        
            <!-- modal show 1 | mostra todos os detalhes da pedido -->
            <div class="modal fade" id="modalShow<?php echo $pedido->id;?>" aria-hidden="true" aria-labelledby="ModalDeDetalhes" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Detalhes do produto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="card-body">

                                <h5>Situação do pedido: <?php echo $pedido->exibeSituacaoDoPedido(); ?></h5>
                                <ul class="list-group">

                                    <?php $produtos = unserialize($pedido->produtos); ?>

                                    <?php foreach ($produtos as $produto): ?>

                                        <li class="list-group-item">
                                            <div>
                                                <h4><?php echo ellipsize($produto['nome'], 100); ?></h4>
                                                <p class="text-muted">Quantidade: <?php echo $produto['quantidade']; ?></p>
                                                <p class="text-muted">Preço: R$ <?php echo $produto['preco']; ?></p>
                                            </div>
                                        </li>

                                    <?php endforeach; ?>

                                    <li class="list-group-item">
                                        <span>Data do pedido:</span>
                                        <strong><?php echo $pedido->criado_em->humanize(); ?></strong>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Total de produtos:</span>
                                        <strong><?php echo 'R$&nbsp;' . esc(number_format($pedido->valor_produtos, 2)); ?></strong>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Taxa de entrega:</span>
                                        <strong><?php echo 'R$&nbsp;' . esc(number_format($pedido->valor_entrega, 2)); ?></strong>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Valor final do pedido:</span>
                                        <strong><?php echo 'R$&nbsp;' . esc(number_format($pedido->valor_pedido, 2)); ?></strong>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Endereço de entrega:</span>
                                        <strong><?php echo esc($pedido->endereco_entrega); ?></strong>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Forma de pagamento na entrega:</span>
                                        <strong><?php echo esc($pedido->forma_pagamento); ?></strong>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Observações do pedido:</span>
                                        <strong><?php echo esc($pedido->observacoes); ?></strong>
                                    </li>

                                </ul>

                                <?php if ($pedido->entregador_id != null): ?>

                                    <p class="card-text">
                                        <span class="font-weight-bold">Entregador:</span>
                                        <?php echo esc($pedido->entregador); ?>
                                    </p>
                                
                                <?php endif; ?>
                            
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

                    </div>
                </div>
            </div>

            
        </div>

    </div>

<!-- End Sections -->

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>

<script>

    /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
    function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    }

    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    }

</script>

<?php echo $this->endSection(); ?>