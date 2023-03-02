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
          <strong>Informação!</strong> <?php echo session('info'); ?>
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


  <!-- Novo card de entregadores -->
    <div class="card text-center mt-3">
      <div class="card-body">
        <h4 class="card-title"><?php echo $titulo ?></h4>
        
        <!-- search input -->
        <div class="ui-widget">
          <input id="query" name="query" placeholder="Pesquise por um entregador.." class="form-control bg-light mt-5 mb-3">
        </div>
        
        <!-- btn cadastrar -->
        <div class="d-flex justify-content-center ">
          <a 
              href="<?php echo site_url("admin/entregadores/criar"); ?>" 
              class="btn btn-success mb-3" 
              data-bs-target="#ModalRegister" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
          >
              <span class="las la-plus"></span>
              Cadastrar
          </a>
        </div>


      <?php if(empty($entregadores)): ?> 

        <p>Não há dados para serem exibidos</p> 

      <?php else: ?>

        <div class="container-fluid ">
          <div class="row d-flex col-12">

            <?php foreach ($entregadores as $entregador): ?>

              <div class="col-md-6 col-lg-4 col-xxl-3 col-sm-12 my-2">
                <div class="card shadow" >
                  
                  <div class="card-body p-2">
                  <div class="card-title d-flex justify-content-center fw-bold fs-4">
                    <?php echo $entregador->nome; ?>
                  </div>

                    <?php if ($entregador->imagem): ?>

                      <img src="<?php echo site_url("admin/entregadores/imagem/$entregador->imagem"); ?>"  class="image-fluid  perfil-entregador" alt="<?php echo esc($entregador->nome) ?>"/>

                    <?php else: ?>
                      <img src="<?php echo site_url('admin/images/entregador-sem-imagem.png'); ?>" class="image-fluid perfil-entregador" alt="Entregador sem imagem"/>
                    <?php endif; ?>

                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Nome:</span>
                      <span  href="<?php echo site_url("admin/entregadores/show/$entregador->id"); ?>">
                        <?php echo $entregador->nome; ?>
                      </span>
                    </div>

                    <div class="d-block">
                      <span class="col-6 fw-bold text-nowrap bd-highlight">E-mail:</span>
                      <span><?php echo $entregador->email; ?></span>
                    </div>


                    <div class="d-block">
                      <span class="col-6 fw-bold text-nowrap bd-highlight">Placa:</span>
                      <span><?php echo $entregador->placa; ?></span>
                    </div>
                  
                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Ativo:</span>
                      <span>
                        <?php echo ($entregador->ativo && $entregador->deletado_em == null) ? '<label class="badge bg-primary">Sim</label>' : '<label class="badge bg-danger">Não</label>' ?>
                      </span>
                    </div>
                  
                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Situação:</span>
                      <span>
                        <?php echo ($entregador->deletado_em == null) ? '<label class="badge bg-success">Disponível</label>' : '<label class="badge bg-danger">Excluído</label>' ?>
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
                              href="#modalShow<?php echo $entregador->id; ?>"
                            >
                              Detalhes
                          </button>
                      
                        <?php if ($entregador->deletado_em != null): ?>

                            <a href="<?php echo site_url("admin/entregadores/desfazerExclusao/$entregador->id"); ?>" 
                              class=" btn btn-dark btn-sm me-1 mb-1">
                              <i class="mdi mdi-undo btn-icon-prepend"></i>
                              Ativar
                            </a>

                        <?php elseif($entregador->deletado_em == null):?>
                            <button type="button" class="btn btn-warning btn-sm me-1 mb-1" data-bs-target="#Modaledit<?php echo $entregador->id; ?>" data-bs-toggle="modal" data-bs-dismiss="modal">
                              Editar
                            </button>
                        
                            <button type="button" class=" btn btn-danger btn-sm me-1 mb-1"  data-bs-target="#ModalDelete<?php echo $entregador->id; ?>" data-bs-toggle="modal" data-bs-dismiss="modal">
                              Excluir
                            </button>
                        <?php endif; ?>
                    </div>

                  </div>
                </div>
              </div>
                                        
              <!-- modal show 1 | mostra todos os detalhes da entregador -->
              <div class="modal fade" id="modalShow<?php echo $entregador->id; ?>" aria-hidden="true" aria-labelledby="ModalDeDetalhes" tabindex="-1" role="dialog">

                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalToggleLabel">Detalhes do entregador</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <div class="card-body">
                        <div class="text-center">

                            <?php if ($entregador->imagem && $entregador->deletado_em == null): ?>
                              <img class="card-img-top w-75" src="<?php echo site_url("admin/entregadores/imagem/$entregador->imagem") ?>" alt="<?php echo esc($entregador->nome) ?>">
                            <?php else: ?>
                              <img class="card-img-top w-75" src="<?php echo site_url('admin/images/entregador-sem-imagem.png') ?>" alt="Produto sem imagem por enquanto..">
                            <?php endif; ?>

                        </div>

                        <?php if ($entregador->deletado_em == null): ?>

                        <hr>
                          <a 
                          href="<?php echo site_url("admin/entregadores/editarimagem/$entregador->id"); ?>"
                          class="btn btn-outline-primary btn-sm mb-2 mt-3" 
                          data-bs-target="#ModaleditImage<?php echo $entregador->id; ?>" 
                          data-bs-toggle="modal" 
                          data-bs-dismiss="modal"
                          >
                            <i class="mdi mdi-pencil btn-icon-prepend"></i>
                            Editar Imagem
                          </a>
                        <hr>

                        <?php endif; ?>

                        <p class="card-text mt-3">
                            <span class="font-weight-bold">Nome:</span>
                            <?php echo esc($entregador->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Telefone:</span>
                            <?php echo ($entregador->telefone); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Veículo:</span>
                            <?php echo ($entregador->veiculo); ?> | <?php echo ($entregador->placa); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Ativo:</span>
                            <?php echo ($entregador->ativo ? 'Sim' : 'Não'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Criado:</span>
                            <?php echo $entregador->criado_em->humanize(); ?>
                        </p>

                        <?php if ($entregador->deletado_em == null): ?>

                          <p class="card-text">
                            <span class="font-weight-bold">Atualizado:</span>
                            <?php echo $entregador->atualizado_em->humanize(); ?>
                          </p>

                        <?php else: ?>

                        <p class="card-text">
                          <span class="font-weight-bold text-danger">Excluído:</span>
                          <?php echo $entregador->deletado_em->humanize(); ?>
                        </p>

                        <?php endif; ?>

                      </div>
                    </div>

                    <div class="modal-footer">
                      <div class="mt-4 ">

                          <?php if ($entregador->deletado_em == null): ?>

                            <a 
                                href="<?php echo site_url("admin/entregadores/editar/$entregador->id"); ?>" 
                                class="btn btn-sm btn-warning mr-2" 
                                data-bs-target="#Modaledit<?php echo $entregador->id; ?>" 
                                data-bs-toggle="modal" 
                                data-bs-dismiss="modal" >
                                <i class="mdi mdi-pencil btn-icon-prepend"></i>
                                Editar
                            </a>

                            <a 
                            href="<?php echo site_url("admin/entregadores/excluir/$entregador->id"); ?>" 
                            class="btn  btn-sm btn-danger mr-2" 
                            data-bs-target="#ModalDelete<?php echo $entregador->id; ?>" 
                            data-bs-toggle="modal" 
                            data-bs-dismiss="modal"
                            >
                              <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                              Excluir
                            </a>

                            <a href="<?php echo site_url("admin/entregadores"); ?>" class="btn  btn-sm btn-light fw-bold">
                                <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                                Voltar
                            </a>

                          <?php else: ?>

                            <a title="Desfazer exclusão" href="<?php echo site_url("admin/entregadores/desfazerexclusao/$entregador->id"); ?>" class="btn  btn-sm btn-dark mr-2">
                                <i class="mdi mdi-undo btn-icon-prepend"></i>
                                Desfazer
                            </a>

                            <a href="<?php echo site_url("admin/entregadores"); ?>" class="btn btn-light   btn-sm fw-bold">
                                <i class="mdi mdi-arrow-left btn-icon-prepend "></i>  
                                Voltar
                            </a>

                          <?php endif; ?>

                      </div>

                    </div>
                </div>
                </div>
              </div>

              <!-- modalEdit | edita entregador -->
              <div class="modal fade" id="Modaledit<?php echo $entregador->id; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalToggleLabel2">Editar entregador</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body  justify-content-center">

                      <?php echo form_open("admin/entregadores/atualizar/$entregador->id")?>

                      <div class="form-row">

                          <div class="form-group col-md-12">
                              <label for="nome">Nome</label>
                              <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome', esc($entregador->nome)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="cpf">CPF</label>
                              <input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?php echo old('cpf', esc($entregador->cpf)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="cnh">CNH</label>
                              <input type="text" class="form-control cnh" name="cnh" id="cnh" value="<?php echo old('cnh', esc($entregador->cnh)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="telefone">Telefone</label>
                              <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" value="<?php echo old('telefone', esc($entregador->telefone)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="email">E-mail</label>
                              <input type="text" class="form-control" name="email" id="email" value="<?php echo old('email', esc($entregador->email)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="veiculo">Veículo</label>
                              <input type="text" class="form-control" name="veiculo" id="veiculo" value="<?php echo old('veiculo', esc($entregador->veiculo)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="placa">Placa</label>
                              <input type="text" class="form-control placa" name="placa" id="placa" value="<?php echo old('placa', esc($entregador->placa)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="endereco">Endereço</label>
                              <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo old('endereco', esc($entregador->endereco)); ?>">
                          </div>

                      </div>

                      <div class="form-check form-check-flat form-check-primary mb-4">
                          <label for="ativo" class="form-check-label">
                              <input type="hidden" name="ativo" value="0" />
                              <input type="checkbox" class="form-check-input" name="ativo" id="ativo" value="1" <?php if (old('ativo', $entregador->ativo)): ?> checked="" <?php endif; ?> />
                              Ativo
                          </label>
                      </div>

                      </div>

                      <div class="modal-footer d-flex justify-content-center">
                          
                          <button type="submit" class="btn btn-success btn-sm mr-2 ">
                              <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>
                              Salvar
                          </button>

                          <a href="<?php echo site_url("admin/entregadores"); ?>" class="btn btn-light   btn-sm fw-bold">
                          <i class="mdi mdi-arrow-left btn-icon-prepend "></i>  
                          Voltar
                          </a>  
                                                  
                      </div>

                      <?php echo form_close(); ?>

                  </div>
                  </div>
              </div>

              <!-- modalEditImage | edita foto do entregador -->
              <div class="modal fade" id="ModaleditImage<?php echo $entregador->id; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalToggleLabel2">Editar foto do entregador </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body  justify-content-center">

                          <?php if (session()->has('errors_model')): ?>
                              <ul>
                              <?php foreach (session('errors_model') as $error): ?>
                                  <li class="text-danger"><?php echo $error ?></li>
                              <?php endforeach; ?>
                              </ul>
                          <?php endif; ?>

                      <?php echo form_open_multipart("admin/entregadores/upload/$entregador->id"); ?>
                          <div class="card-body">

                              <div class="form-group mb-4">
                              <label>Upload de imagem</label>
                              <input type="file" name="foto_entregador"  class="file-upload-default form-control">
                              <!-- <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" disabled placeholder="Escolha uma imagem..">
                                  <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-danger" type="button">Escolher</button>
                                  </span>
                              </div> -->
                              </div>

                          </div>

                      </div>

                      <div class="modal-footer d-flex justify-content-center">
                          
                          <button type="submit" class="btn btn-success btn-sm mr-2 ">
                              <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>
                              Salvar
                          </button>

                          <a href="<?php echo site_url("admin/entregadores"); ?>" class="btn btn-light   btn-sm fw-bold">
                          <i class="mdi mdi-arrow-left btn-icon-prepend "></i>  
                          Voltar
                          </a>  
                                                  
                      </div>

                      <?php echo form_close(); ?>

                  </div>
                  </div>
              </div>

              <!-- terceiro modal | exclui entregador -->
              <div class="modal fade" id="ModalDelete<?php echo $entregador->id; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalToggleLabel2">Excluindo entregador: <?php echo esc($entregador->nome); ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <h5 ><strong>Atenção!</strong>Tem certeza que deseja realizar a exclusão? </h5>
                      <h6 ><strong >Obs:!</strong>Essa ação neste campo é reversivel </h6>

                      </div>
                      
                      <div class="modal-footer d-flex justify-content-center">
                              <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button>

                              <?php echo form_open("admin/entregadores/excluir/$entregador->id"); ?>


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


              <!-- quarto modal | cadastra entregador -->
              <div class="modal fade" id="ModalRegister" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Cadastrar uma nova entregador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <?php echo form_open("admin/entregadores/cadastrar"); ?>
                        
                        <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control cpf" name="cpf" id="cpf">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="cnh">CNH</label>
                            <input type="text" class="form-control cnh" name="cnh" id="cnh">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control sp_celphones" name="telefone" id="telefone">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="veiculo">Veículo</label>
                            <input type="text" class="form-control" name="veiculo" id="veiculo">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="placa">Placa</label>
                            <input type="text" class="form-control placa" name="placa" id="placa">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="endereco">Endereço</label>
                            <input type="text" class="form-control" name="endereco" id="endereco">
                        </div>

                        </div>

                        <div class="form-check form-check-flat form-check-primary mb-4">
                        <label for="ativo" class="form-check-label">
                            <input type="hidden" name="ativo" value="0" />
                            <input type="checkbox" class="form-check-input" name="ativo" id="ativo" value="1" <?php if (old('ativo', $entregador->ativo)): ?> checked="" <?php endif; ?> />
                            Ativo
                        </label>
                        </div>

                    </div>
                    <!-- end modal body -->
                    
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

              <div class="mt-3">
                <?php echo $pager->links(); ?>
              </div>
                      
          </div>
        </div>


      <?php endif; ?>


      </div>
    </div> 


<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>

  <script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js') ?>"></script>
  
  <!-- script de search de dados -->
  <script>
    $(function () {
      $( "#query" ).autocomplete({
        source: function (request, response) {
          $.ajax({
            url: "<?php echo site_url('admin/entregadores/procurar/') ?>",
            dataType: "json",
            data: {
              term: request.term,
            },
            success: function (data) {
              if (data.length < 1) {
                var data = [
                  {
                    label: 'entregador não encontrado.',
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
            window.location.href = '<?php echo base_url('admin/entregadores/show'); ?>/' + ui.item.id;
          }
        }
      });
    });
  </script>

  <script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('admin/vendors/mask/app.js') ?>"></script>


<?php echo $this->endSection(); ?>

