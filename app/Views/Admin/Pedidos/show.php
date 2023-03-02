<?php echo $this->extend('Admin/layout/principal'); ?>

<!-- Aqui enviamos para o template principal o título -->
<?php echo $this->section('titulo'); ?>

  <?php echo $titulo; ?>

<?php echo $this->endSection(); ?>

<!-- Aqui enviamos para o template principal o título -->
<?php echo $this->section('titulo_page'); ?>

  <?php echo $titulo_page; ?>

<?php echo $this->endSection(); ?>



<!-- Aqui enviamos para o template principal os estilos -->
<?php echo $this->section('estilos'); ?>



<?php echo $this->endSection(); ?>



<!-- Aqui enviamos para o template principal o conteúdo -->
<?php echo $this->section('conteudo'); ?>

    
    <div class="content-wrapper">

      <?php if (session()->has('sucesso')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Perfeito!</strong> <?php echo session('sucesso'); ?>
          <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if (session()->has('info')): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <strong>Inpedidoção!</strong> <?php echo session('info'); ?>
          <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if (session()->has('atencao')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Atenção!</strong> <?php echo session('atencao'); ?>
          <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <!-- Captura os erros de CSRF - Ação não permitida  -->
      <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Erro!</strong> <?php echo session('error'); ?>
          <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <!-- Essa section renderizará os conteúdos específicos da view que estender esse layout -->
      <?php echo $this->renderSection('conteudo'); ?>

    </div>

    <div class="row justify-content-center mt-5">
      <div class="col-lg-7 ">
        <div class="card">
          <div class="card-header bg-primary pb-0 pt-4">
            <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>
          </div>
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
                        
            <div class="mt-4">

              <?php if ($pedido->deletado_em == null): ?>
            
                <a 
                  href="<?php echo site_url("admin/pedidos/editar/$pedido->id"); ?>" 
                  class="btn btn-warning btn-sm mr-2"
                  data-bs-target="#Modaledit<?php echo $pedido->id; ?>" 
                  data-bs-toggle="modal" 
                  data-bs-dismiss="modal" 
                >
                  <i class="mdi mdi-pencil btn-icon-prepend"></i>
                  Editar
                </a>

                <a 
                  href="<?php echo site_url("admin/pedidos/excluir/$pedido->id"); ?>" 
                  class="btn btn-danger btn-sm mr-2"
                  data-bs-target="#ModalDelete<?php echo $pedido->id;?>" 
                  data-bs-toggle="modal" 
                  data-bs-dismiss="modal"
                >
                  <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                  Excluir
                </a>
            
                <a href="<?php echo site_url("admin/pedidos"); ?>" class="btn btn-light btn-sm">
                  <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                  Voltar
                </a>

              <?php else: ?>

                <a title="Desfazer exclusão" href="<?php echo site_url("admin/pedidos/desfazerexclusao/$pedido->id"); ?>" class="btn btn-dark btn-sm mr-2">
                  <i class="mdi mdi-undo btn-icon-prepend"></i>
                  Desfazer
                </a>

                <a href="<?php echo site_url("admin/pedidos"); ?>" class="btn btn-light btn-sm">
                  <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                  Voltar
                </a>

              <?php endif; ?>

            </div>
          </div>
        </div>

        
        <!-- modalEdit | edita pedido -->
        <div class="modal fade" id="Modaledit<?php echo $pedido->id; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Editar pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body  justify-content-center text-center">

                <?php echo form_open("admin/pedidos/atualizar/$pedido->id")?>


                <div class="form-check form-check-flat form-check-primary mb-4">
                  <label for="saiu_entrega" class="form-check-label">
                      <input type="radio" class="form-check-input situacao" name="situacao" id="saiu_entrega" value="1" <?php echo ($pedido->situacao == 1 ? 'checked=' : ''); ?> />
                      Saiu para entrega
                  </label>
                </div>

                <div class="form-check form-check-flat form-check-primary mb-4">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input situacao" name="situacao" value="2" <?php echo ($pedido->situacao == 2 ? 'checked' : ''); ?> />
                    Pedido entregue
                  </label>
                </div>

                <div class="form-check form-check-flat form-check-primary mb-4">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input situacao" name="situacao" value="3" <?php echo ($pedido->situacao == 3 ? 'checked' : ''); ?> />
                    Pedido cancelado
                  </label>
                </div>

              </div>

              <div class="modal-footer d-flex justify-content-center">
                
                <button type="submit" class="btn btn-success btn-sm mr-2 ">
                    <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>
                    Salvar
                </button>

                <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button> 
                                        
              </div>

                <?php echo form_close(); ?>

            </div>
          </div>
        </div>

        <!-- terceiro modal | exclui pedido -->
        <div class="modal fade" id="ModalDelete<?php echo $pedido->id;?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Excluindo pedido: <?php echo esc($pedido->codigo); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <h5 ><strong>Atenção!</strong>Tem certeza que deseja realizar a exclusão? </h5>
              <h6 ><strong >Obs:!</strong>Essa ação neste campo é reversivel </h6>

              </div>
              
              <div class="modal-footer d-flex justify-content-center">
                      <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button>

                      <?php echo form_open("admin/pedidos/excluir/$pedido->id"); ?>


                        <button type="submit" class="btn btn-danger btn-sm mr-2">
                            <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                            Excluir
                        </button>

                      <?php echo form_close(); ?>

                    </div>

            </div>
          </div>
        </div>

      </div>
    </div>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>


  <script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('admin/vendors/mask/app.js') ?>"></script>

<?php echo $this->endSection(); ?>