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

    <div class="row justify-content-center mt-5">
      <div class="col-lg-7 ">
        <div class="card">
          <div class="card-header bg-primary pb-0 pt-4">
            <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>
          </div>
          <div class="card-body">

            <div class="text-center">

              <?php if ($entregador->imagem && $entregador->deletado_em == null): ?>
                <img class="card-img-top w-50" src="<?php echo site_url("admin/entregadores/imagem/$entregador->imagem") ?>" alt="<?php echo esc($entregador->nome) ?>">
              <?php else: ?>
                <img class="card-img-top w-50" src="<?php echo site_url('admin/images/entregador-sem-imagem.png') ?>" alt="Produto sem imagem por enquanto..">
              <?php endif; ?>

            </div>

            <?php if ($entregador->deletado_em == null): ?>

              <hr>
                <a 
                  href="<?php echo site_url("admin/entregadores/editarimagem/$entregador->id"); ?>"
                  class="btn btn-outline-primary btn-sm mb-2 mt-3" 
                  data-bs-target="#ModaleditImage<?php echo $entregador->id; ?>" 
                  data-bs-toggle="modal" 
                  data-bs-dismiss="modal" >
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
        
            <div class="mt-4">

              <?php if ($entregador->deletado_em == null): ?>
            
                <a 
                  href="<?php echo site_url("admin/entregadores/editar/$entregador->id"); ?>" 
                  class="btn btn-warning btn-sm mr-2"
                  data-bs-target="#Modaledit<?php echo $entregador->id; ?>" 
                  data-bs-toggle="modal" 
                  data-bs-dismiss="modal" 
                >
                  <i class="mdi mdi-pencil btn-icon-prepend"></i>
                  Editar
                </a>

                <a 
                  href="<?php echo site_url("admin/entregadores/excluir/$entregador->id"); ?>" 
                  class="btn btn-danger btn-sm mr-2"
                  data-bs-target="#ModalDelete" 
                  data-bs-toggle="modal" 
                  data-bs-dismiss="modal"
                >
                  <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                  Excluir
                </a>
            
                <a href="<?php echo site_url("admin/entregadores"); ?>" class="btn btn-light btn-sm">
                  <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                  Voltar
                </a>

              <?php else: ?>

                <a title="Desfazer exclusão" href="<?php echo site_url("admin/entregadores/desfazerexclusao/$entregador->id"); ?>" class="btn btn-dark btn-sm mr-2">
                  <i class="mdi mdi-undo btn-icon-prepend"></i>
                  Desfazer
                </a>

                <a href="<?php echo site_url("admin/entregadores"); ?>" class="btn btn-light btn-sm">
                  <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                  Voltar
                </a>

              <?php endif; ?>

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
                  
                  <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button> 

                                          
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

                  <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button> 


                                          
                </div>

              <?php echo form_close(); ?>

            </div>
          </div>
        </div>

        <!-- terceiro modal | exclui entregador -->
        <div class="modal fade" id="ModalDelete" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
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

      </div>
    </div>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>


  <script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('admin/vendors/mask/app.js') ?>"></script>

<?php echo $this->endSection(); ?>