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

          <!-- lista de erros de input -->
          <?php if (session()->has('errors_model')): ?>
            <ul>
              <?php foreach (session('errors_model') as $error): ?>

                  <li class="text-danger"><?php echo $error; ?></li>

              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <p class="card-text">
            <span class="font-weight-bold">Nome:</span>
            <?php echo esc($medida->nome); ?>
          </p>
          <p class="card-text">
            <span class="font-weight-bold">Ativo:</span>
            <?php echo ($medida->ativo ? 'Sim' : 'Não'); ?>
          </p>
          <p class="card-text">
            <span class="font-weight-bold">Criado:</span>
            <?php echo $medida->criado_em->humanize(); ?>
          </p>

          <?php if ($medida->deletado_em == null): ?>

            <p class="card-text">
              <span class="font-weight-bold">Atualizado:</span>
              <?php echo $medida->atualizado_em->humanize(); ?>
            </p>

          <?php else: ?>

            <p class="card-text">
              <span class="font-weight-bold text-danger">Excluído:</span>
              <?php echo $medida->deletado_em->humanize(); ?>
            </p>

          <?php endif; ?>

                        
            <div class="mt-4">

              <?php if ($medida->deletado_em == null): ?>
            
                <a 
                  href="<?php echo site_url("admin/medidas/editar/$medida->id"); ?>" 
                  class="btn btn-warning btn-sm mr-2"
                  data-bs-target="#Modaledit" 
                  data-bs-toggle="modal" 
                  data-bs-dismiss="modal" 
                >
                  <i class="mdi mdi-pencil btn-icon-prepend"></i>
                  Editar
                </a>

                <a 
                  href="<?php echo site_url("admin/medidas/excluir/$medida->id"); ?>" 
                  class="btn btn-danger btn-sm mr-2"
                  data-bs-target="#ModalDelete" 
                  data-bs-toggle="modal" 
                  data-bs-dismiss="modal"
                >
                  <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                  Excluir
                </a>
            
                <a href="<?php echo site_url("admin/medidas"); ?>" class="btn btn-light btn-sm">
                  <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                  Voltar
                </a>

              <?php else: ?>

                <a title="Desfazer exclusão" href="<?php echo site_url("admin/medidas/desfazerexclusao/$medida->id"); ?>" class="btn btn-dark btn-sm mr-2">
                  <i class="mdi mdi-undo btn-icon-prepend"></i>
                  Desfazer
                </a>

                <a href="<?php echo site_url("admin/medidas"); ?>" class="btn btn-light btn-sm">
                  <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                  Voltar
                </a>

              <?php endif; ?>

            </div>
          </div>
        </div>

        
        <!-- modalEdit | edita medida -->
        <div class="modal fade" id="Modaledit" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Editar medida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body  justify-content-center text-center">

                <?php echo form_open("admin/medidas/atualizar/$medida->id")?>

                <div class="form-row">

                  <div class="form-group col-md-12">
                      <label for="nome">Nome</label>
                      <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome', esc($medida->nome)); ?>">
                  </div>

                  <div class="form-group col-md-12">
                      <label for="descricao">Descrição</label>
                      <textarea type="text" class="form-control" name="descricao" id="descricao" rows="2" value="<?php echo old('descricao', esc($medida->descricao)); ?>"><?php echo old('descricao', esc($medida->descricao)); ?></textarea>
                  </div>

                </div>

                <div class="form-check form-check-flat form-check-primary mb-4">
                  <label for="ativo" class="form-check-label">
                      <input type="hidden" name="ativo" value="0" />
                      <input type="checkbox" class="form-check-input" name="ativo" id="ativo" value="1" <?php if (old('ativo', $medida->ativo)): ?> checked="" <?php endif; ?> />
                      Ativo
                  </label>
                </div>

              </div>

                <div class="modal-footer d-flex justify-content-center">
                  
                  <button type="submit" class="btn btn-success btn-sm mr-2 ">
                      <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>
                      Salvar
                  </button>
                  <?php echo form_close(); ?>

                  <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button> 
                                          
                </div>


            </div>
          </div>
        </div>

        <!-- terceiro modal | exclui medida -->
        <div class="modal fade" id="ModalDelete" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Excluindo medida: <?php echo esc($medida->nome); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <h5 ><strong>Atenção!</strong>Tem certeza que deseja realizar a exclusão? </h5>
              <h6 ><strong >Obs:!</strong>Essa ação neste campo é reversivel </h6>

              </div>
              
              <div class="modal-footer d-flex justify-content-center">
                      <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button>

                      <?php echo form_open("admin/medidas/excluir/$medida->id"); ?>


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