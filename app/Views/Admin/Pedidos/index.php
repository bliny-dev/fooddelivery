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

  <link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>"/>

<?php echo $this->endSection(); ?>



<!-- Aqui enviamos para o template principal o conteúdo -->
<?php echo $this->section('conteudo'); ?>


  <!-- Novo card de pedidos -->
  <div class="card text-center mt-3">
      <div class="card-body">
        <h4 class="card-title"><?php echo $titulo ?></h4>
        
        <!-- search input -->
        <div class="ui-widget">
          <input id="query" name="query" placeholder="Pesquise por um pedido.." class="form-control bg-light mt-5 mb-3">
        </div>
        
        <!-- lista de erros de input -->
        <?php if (session()->has('errors_model')): ?>
          <ul>
            <?php foreach (session('errors_model') as $error): ?>

                <li class="text-danger"><?php echo $error; ?></li>

            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

      <?php if(empty($pedidos)): ?> 

        <p>Não há dados para serem exibidos</p> 

      <?php else: ?>

        <div class="container-fluid ">
          <div class="row d-flex col-12">

            <?php foreach ($pedidos as $pedido): ?>

              <div class="col-md-6 col-lg-4 col-xxl-3 col-sm-12 my-2 card-group">
                <div class="card shadow" >
                  
                  <div class="card-body p-2">

                    <div class="card-title d-flex justify-content-center fw-bold fs-5">
                      <?php echo $pedido->codigo; ?>
                    </div>

                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Código:</span>
                      <span  href="<?php echo site_url("admin/pedidos/show/$pedido->id"); ?>">
                        <?php echo $pedido->codigo; ?>
                      </span>
                    </div>

                    <div class="d-block">
                      <span class="col-6 fw-bold text-nowrap bd-highlight">Criado em:</span>
                      <span><?php echo $pedido->criado_em->humanize(); ?></span>
                    </div>


                    <div class="d-block">
                      <span class="col-6 fw-bold text-nowrap bd-highlight">Cliente:</span>
                      <span><?php echo $pedido->cliente; ?></span>
                    </div>
                  
                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Valor:</span>
                      <span>
                        R$&nbsp<?php echo esc(number_format($pedido->valor_pedido, 2)); ?>
                      </span>
                    </div>
                  
                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Situação:</span>
                      <span>
                        <?php $pedido->exibeSituacaoDoPedido(); ?>                      
                      </span>
                    </div>
                    
                    <div class="justify-content-center">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Ações:</span>
                    </div>
                    <!-- botões de modal -->
                    <div class="d-md-flex justify-content-center">                      
                          <button 
                              type="button" 
                              class="btn btn-primary btn-sm me-1 mb-1" 
                              data-bs-toggle="modal" 
                              href="#modalShow<?php echo $pedido->id; ?>"
                            >
                              Detalhes
                          </button>
                      
                        <?php if ($pedido->deletado_em != null): ?>

                            <a href="<?php echo site_url("admin/pedidos/desfazerExclusao/$pedido->id"); ?>" 
                              class=" btn btn-dark btn-sm me-1 mb-1">
                              <i class="mdi mdi-undo btn-icon-prepend"></i>
                              Ativar
                            </a>

                        <?php elseif($pedido->deletado_em == null):?>
                            <button type="button" class="btn btn-warning btn-sm me-1 mb-1" data-bs-target="#Modaledit<?php echo $pedido->id;?>" data-bs-toggle="modal" data-bs-dismiss="modal">
                              Editar
                            </button>
                        
                            <button type="button" class=" btn btn-danger btn-sm me-1 mb-1"  data-bs-target="#ModalDelete<?php echo $pedido->id;?>" data-bs-toggle="modal" data-bs-dismiss="modal">
                              Excluir
                            </button>
                        <?php endif; ?>
                    </div>

                  </div>
                </div>
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

                      
                        </div>

                      </div>

                      <div class="modal-footer">
                        <div class="mt-2">

                            <a 
                              href="<?php echo site_url("admin/pedidos/editar/$pedido->codigo"); ?>" 
                              class="btn btn-warning me-2"
                              data-bs-target="#Modaledit<?php echo $pedido->id;?>" 
                              data-bs-toggle="modal" 
                              data-bs-dismiss="modal"
                            >
                              <i class="mdi mdi-pencil btn-icon-prepend"></i>
                              Alterar situação
                            </a>
                            

                            <a 
                              href="<?php echo site_url("admin/pedidos/excluir/$pedido->codigo"); ?>" 
                              class="btn btn-danger mr-2" 
                              data-bs-target="#ModalDelete<?php echo $pedido->id;?>" 
                              data-bs-toggle="modal" 
                              data-bs-dismiss="modal"
                            >
                              <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                              Excluir pedido
                            </a>
                            <a href="<?php echo site_url("admin/pedidos"); ?>" class="btn btn-light fw-bold">
                              <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                              Voltar
                            </a>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

              <!-- modalEdit | edita pedido -->
              <div class="modal fade" id="Modaledit<?php echo $pedido->id;?>" aria-hidden="true" aria-labelledby="ModalEditar" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Editando o pedido: <?php echo $pedido->codigo; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body  justify-content-center">
                    
                    <div class="card-body text-center">

                        <?php if (session()->has('errors_model')): ?>
                        <ul>
                            <?php foreach (session('errors_model') as $error): ?>
                            <li class="text-danger"><?php echo $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php echo form_open("admin/pedidos/atualizar/$pedido->codigo"); ?>

                          <div class="form-check form-check-flat form-check-primary mb-4">
                            <label for="saiu_entrega" class="form-check-label">

                                <input id="saiu_entrega" type="radio" class="form-check-input situacao" name="situacao" value="1" <?php echo ($pedido->situacao == 1 ? 'checked' : ''); ?>>
                                Saiu para entrega
                            </label>
                          </div>
                          
                          <div id="box_entregador" class="form-group d-none">
                            <select name="entregador_id" class="form-control text-dark">
                                <option value="">Escolha o entregador...</option>
                                <?php foreach ($entregadores as $entregador): ?>
                                    <option value="<?php echo $entregador->id ?>" 
                                    <?php echo ($entregador->id == $pedido->entregador_id ? 'selected' : '') ?>> 
                                    <?php echo esc($entregador->nome); ?></option>
                                <?php endforeach; ?>
                            </select>
                          </div>
                          
                          <div class="form-check form-check-flat form-check-primary mb-4">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input situacao" name="situacao" value="2" <?php echo ($pedido->situacao == 2 ? 'checked' : ''); ?>>
                                Pedido entregue
                            </label>
                          </div>

                          <div class="form-check form-check-flat form-check-primary mb-4">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input situacao" name="situacao" value="3" <?php echo ($pedido->situacao == 3 ? 'checked' : ''); ?>>
                                Pedido cancelado
                            </label>
                          </div>

                    </div>


                    <div class="modal-footer d-flex justify-content-center">
                      
                          
                      <input id="btn_editar_pedido" type="submit" class="btn btn-success" value="Editar Pedido">
                      
                      <?php echo form_close(); ?>

                      <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button>

                    </div>


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
              
            <?php endforeach; ?>
                   

              <div class="mt-3">
                <?php echo $pager->links(); ?>
              </div>
                      
          </div>
        </div>


      <?php endif; ?>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>

            
  <script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js') ?>"></script>
  <!-- Mascaras de input -->
  <script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('admin/vendors/mask/app.js') ?>"></script>
  
  <!-- Script de search -->
  <script>
    $(function () {
      $( "#query" ).autocomplete({
        source: function (request, response) {
          $.ajax({
            url: "<?php echo site_url('admin/pedidos/procurar/') ?>",
            dataType: "json",
            data: {
              term: request.term,
            },
            success: function (data) {
              if (data.length < 1) {
                var data = [
                  {
                    label: 'Pedido não encontrado.',
                    value: -1
                  }
                ];
              }

              response(data); // Aqui temos valor no data
            },
          }); // Fim do ajax
        },
        minLength: 1,
        select: function (event, ui) {
          if (ui.item.value == -1) {
            $this.val("");
            return false;
          } else {
            console.log(ui.item);
            window.location.href = '<?php echo base_url('admin/pedidos/show'); ?>/' + ui.item.value;
          }
        }
      });
    });
  </script>

    
  <!-- Scripts de entregadores em editar e criar -->
  <script>


    $(document).ready(function () {

        var entregador_id = $("#saiu_entrega").prop('checked');


        if (entregador_id) {

            $("#box_entregador").removeClass('d-none');
        }


        $(".situacao").on('click', function () {

            var valor = $(this).val();

            if (valor == 1) {

                $("#box_entregador").removeClass('d-none');

            } else {

                $("#box_entregador").addClass('d-none');
            }

        });


      $("form").submit(function () {

          $(this).find(":submit").attr('disabled', 'disabled');

          $("#btn-editar-pedido").val('Editando o pedido...');

      });



    });



  </script>




<?php echo $this->endSection(); ?>