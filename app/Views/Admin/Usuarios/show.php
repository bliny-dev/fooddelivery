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

            <p class="card-text">
              <span class="font-weight-bold">Nome:</span>
              <?php echo esc($usuario->nome); ?>
            </p>
            <p class="card-text">
              <span class="font-weight-bold">Email:</span>
              <?php echo esc($usuario->email); ?>
            </p>
            <p class="card-text">
              <span class="font-weight-bold">Ativo:</span>
              <?php echo ($usuario->ativo ? 'Sim' : 'Não'); ?>
            </p>
            <p class="card-text">
              <span class="font-weight-bold">Perfil:</span>
              <?php echo esc($usuario->is_admin ? 'Administrador' : 'Cliente'); ?>
            </p>
            <p class="card-text">
              <span class="font-weight-bold">Criado:</span>
              <?php echo $usuario->criado_em->humanize(); ?>
            </p>

            <?php if ($usuario->deletado_em == null): ?>

              <p class="card-text">
                <span class="font-weight-bold">Atualizado:</span>
                <?php echo $usuario->atualizado_em->humanize(); ?>
              </p>

            <?php else: ?>

              <p class="card-text">
                <span class="font-weight-bold text-danger">Excluído:</span>
                <?php echo $usuario->deletado_em->humanize(); ?>
              </p>

            <?php endif; ?>

            <div class="mt-4">

              <?php if ($usuario->deletado_em == null): ?>

                <button 
                  href="<?php echo site_url("admin/usuarios/editar/$usuario->id"); ?>" 
                  class="btn btn-warning btn-sm mr-2"
                  data-bs-target="#Modaledit" 
                  data-bs-toggle="modal" 
                  data-bs-dismiss="modal" 
                >
                  <i class="mdi mdi-pencil btn-icon-prepend"></i>
                  Editar
              </button>

                <a 
                  href="<?php echo site_url("admin/usuarios/excluir/$usuario->id"); ?>" 
                  class="btn btn-danger btn-sm mr-2"
                  data-bs-target="#ModalDelete" 
                  data-bs-toggle="modal" 
                  data-bs-dismiss="modal" 
                >
                  <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                  Excluir
                </a>

                <a href="<?php echo site_url("admin/usuarios"); ?>" class="btn btn-light btn-sm">
                  <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                  Voltar
                </a>

              <?php else: ?>

                <a title="Desfazer exclusão" href="<?php echo site_url("admin/usuarios/desfazerExclusao/$usuario->id"); ?>" class="btn btn-dark btn-sm mr-2">
                  <i class="mdi mdi-undo btn-icon-prepend"></i>
                  Desfazer
                </a>

                <a href="<?php echo site_url("admin/usuarios"); ?>" class="btn btn-light btn-sm">
                  <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                  Voltar
                </a>

              <?php endif; ?>

            </div>

            <!-- modalEdit | edita usuario -->
            <div class="modal fade" id="Modaledit" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Editar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body  justify-content-center text-center">

                    <?php echo form_open("admin/usuarios/atualizar/$usuario->id")?>
                    <div class="form-row">

                      <div class="form-group col-md-12">
                          <label for="nome" class="col-form-label fs-5 text-dark">Nome</label>
                          <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome', esc($usuario->nome)); ?>">
                      </div>

                      <div class="form-group col-md-12">
                          <label for="cpf" class="col-form-label fs-5 text-dark">CPF</label>
                          <input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?php echo old('cpf', esc($usuario->cpf)); ?>">
                      </div>

                      <div class="form-group col-md-12">
                          <label for="telefone" class="col-form-label fs-5 text-dark">Telefone</label>
                          <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" value="<?php echo old('telefone', esc($usuario->telefone)); ?>">
                      </div>

                      <div class="form-group col-md-12">
                          <label for="email" class="col-form-label fs-5 text-dark">E-mail</label>
                          <input type="text" class="form-control" name="email" id="email" value="<?php echo old('email', esc($usuario->email)); ?>">
                      </div>

                    </div>

                    <div class="form-row">

                      <div class="form-group col-md-12">
                          <label for="password" class="col-form-label fs-5 text-dark">Senha</label>
                          <input type="password" class="form-control" name="password" id="password">
                      </div>

                      <div class="form-group col-md-12">
                          <label for="password_confirmation" class="col-form-label fs-5 text-dark">Confirmação de senha</label>
                          <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                      </div>

                    </div>

                    <?php if ($usuario->id != usuarioLogado()->id): ?>

                      <div class="form-check form-check-flat form-check-primary mb-2">
                          <label for="ativo" class="form-check-label">
                              <input type="hidden" name="ativo" value="0" />
                              <input type="checkbox" class="form-check-input" name="ativo" id="ativo" value="1" <?php if (old('ativo', $usuario->ativo)): ?> checked="" <?php endif; ?> />
                              Ativo
                          </label>
                      </div>

                      <div class="form-check form-check-flat form-check-primary mb-4">
                          <label for="is_admin" class="form-check-label">
                              <input type="hidden" name="is_admin" value="0" />
                              <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin" value="1" <?php if (old('is_admin', $usuario->is_admin)): ?> checked="" <?php endif; ?> />
                              Administrador
                          </label>
                      </div>

                    <?php endif; ?>

                  </div>

                  <div class="modal-footer d-flex justify-content-center">
                    
                    <button type="submit" class="btn btn-success btn-sm mr-2 ">
                        <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>
                        Salvar
                    </button>

                    <button class="btn btn-light fw-bold" >Voltar</button>
                    
                  </div>

                  <?php echo form_close(); ?>

                </div>
              </div>
            </div>

            <!-- terceiro modal | exclui usuario -->
            <div class="modal fade" id="ModalDelete" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Excluindo usuario: <?php echo esc($usuario->nome); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <h5 ><strong>Atenção!</strong>Tem certeza que deseja realizar a exclusão? </h5>
                  <h6 ><strong >Obs:!</strong>Essa ação neste campo é reversivel </h6>

                  </div>
                  
                  <div class="modal-footer d-flex justify-content-center">
                          <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button>

                          <?php echo form_open("admin/usuarios/excluir/$usuario->id"); ?>


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
      </div>
    </div>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>

  <script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('admin/vendors/mask/app.js') ?>"></script>

<?php echo $this->endSection(); ?>

