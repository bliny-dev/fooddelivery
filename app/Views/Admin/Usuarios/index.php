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


  <!-- Novo card de usuarios -->
    <div class="card text-center mt-3">
      <div class="card-body">
        <h4 class="card-title"><?php echo $titulo ?></h4>
        
        <!-- search input -->
        <div class="ui-widget">
          <input id="query" name="query" placeholder="Pesquise por um usuário.." class="form-control bg-light mb-5">
        </div>

        <!-- lista de erros de input -->
        <?php if (session()->has('errors_model')): ?>
          <ul>
            <?php foreach (session('errors_model') as $error): ?>

                <li class="text-danger"><?php echo $error; ?></li>

            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <!-- btn cadastrar -->
        <div class="d-flex justify-content-center ">
              
          <a 
            href="<?php echo site_url("admin/usuarios/criar"); ?>" 
            class="btn btn-success mb-5" 
            data-bs-target="#ModalRegister" 
            data-bs-toggle="modal" 
            data-bs-dismiss="modal"
          >
            <span class="las la-plus"></span>
            Cadastrar
          </a>
        
        </div>


      <?php if(empty($usuarios)): ?> 

        <p>Não há dados para serem exibidos</p> 

      <?php else: ?>

        <div class="container-fluid ">
          <div class="row d-flex col-12">

            <?php foreach ($usuarios as $usuario): ?>

              <div class="col-md-6 col-lg-4 col-xxl-3 col-sm-12 my-2 card-group">
                <div class="card shadow" >
                  
                  <div class="card-body p-2">
                    <div class="card-title d-flex justify-content-center fw-bold fs-5">
                      <?php echo $usuario->nome; ?>
                    </div>
                    
                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Nome:</span>
                      <span  href="<?php echo site_url("admin/usuarios/show/$usuario->id"); ?>">
                        <?php echo $usuario->nome; ?>
                      </span>
                    </div>

                    <div class="d-block">
                      <span class="col-6 fw-bold text-nowrap bd-highlight">E-mail</span>
                      <span><?php echo $usuario->email; ?></span>
                    </div>
                  
                    <div class="d-block">
                      <span class="col-6 fw-bold text-nowrap bd-highlight">CPF</span>
                      <span><?php echo $usuario->cpf; ?></span>
                    </div>
                  
                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Ativo:</span>
                      <span><?php echo ($usuario->ativo && $usuario->deletado_em == null) ? '<label class="badge bg-primary">Sim</label>' : '<label class="badge bg-danger">Não</label>' ?></span>
                    </div>
                  
                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Situação:</span>
                      <span>
                        <?php echo ($usuario->deletado_em == null) ? '<label class="badge bg-success">Disponível</label>' : '<label class="badge bg-danger">Excluído</label>' ?>
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
                              href="#modalShow<?php echo $usuario->id; ?>"
                            >
                              Detalhes
                          </button>
                      
                        <?php if ($usuario->deletado_em != null): ?>

                            <a href="<?php echo site_url("admin/usuarios/desfazerExclusao/$usuario->id"); ?>" 
                              class=" btn btn-dark btn-sm me-1 mb-1">
                              <i class="mdi mdi-undo btn-icon-prepend"></i>
                              Ativar
                            </a>

                        <?php elseif($usuario->deletado_em == null):?>
                            <button 
                              type="button" 
                              class="btn btn-warning btn-sm me-1 mb-1" 
                              data-bs-target="#Modaledit<?php echo $usuario->id; ?>" 
                              data-bs-toggle="modal" 
                              data-bs-dismiss="modal"
                            >
                              Editar
                            </button>
                        
                            <button 
                              type="button" 
                              class=" btn btn-danger btn-sm me-1 mb-1"  
                              data-bs-target="#ModalDelete<?php echo $usuario->id; ?>" 
                              data-bs-toggle="modal" 
                              data-bs-dismiss="modal"
                            >
                              Excluir
                            </button>
                        <?php endif; ?>
                    </div>

                  </div>
                </div>
              </div>
                                            
              <!-- modal show 1 | mostra todos os detalhes da usuario -->
              <div class="modal fade" id="modalShow<?php echo $usuario->id; ?>" aria-hidden="true" aria-labelledby="ModalDeDetalhes" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                  
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Detalhes do Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
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

                    </div>

                  </div>
                  <div class="modal-footer">
                    <div class="mt-4">

                      <?php if ($usuario->deletado_em == null): ?>

                        <a 
                          href="<?php echo site_url("admin/usuarios/editar/$usuario->id"); ?>" 
                          class="btn btn-warning btn-sm mr-2"
                          data-bs-target="#Modaledit<?php echo $usuario->id; ?>" 
                          data-bs-toggle="modal" 
                          data-bs-dismiss="modal" 
                        >
                          <i class="mdi mdi-pencil btn-icon-prepend"></i>
                          Editar
                        </a>

                        <a 
                          href="<?php echo site_url("admin/usuarios/excluir/$usuario->id"); ?>" 
                          class="btn btn-danger btn-sm mr-2"
                          data-bs-target="#ModalDelete<?php echo $usuario->id; ?>" 
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
                    </div>
                  </div>
                </div>
              </div>

              <!-- modalEdit | edita usuario -->
              <div class="modal fade" id="Modaledit<?php echo $usuario->id; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalToggleLabel2">Editar usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body  justify-content-center">

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
                      <?php echo form_close(); ?>

                      <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button>
                      
                    </div>


                  </div>
                </div>
              </div>

              <!-- terceiro modal | exclui usuario -->
              <div class="modal fade" id="ModalDelete<?php echo $usuario->id; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
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

            <?php endforeach; ?>
                
            <!-- quarto modal | cadastra usuario -->
            <div class="modal fade" id="ModalRegister" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Cadastrar uma nova usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <?php echo form_open("admin/usuarios/cadastrar"); ?>
                    
                      <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="nome" class="col-form-label fs-5 text-dark">Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="cpf" class="col-form-label fs-5 text-dark">CPF</label>
                            <input type="text" class="form-control cpf" name="cpf" id="cpf">
                        </div>

                        <div class="form-group col-md-12">
                          <label for="telefone" class="col-form-label fs-5 text-dark">Telefone</label>
                          <input type="text" class="form-control sp_celphones" name="telefone" id="telefone">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="email" class="col-form-label fs-5 text-dark">E-mail</label>
                            <input type="text" class="form-control" name="email" id="email">
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
                  <!-- end modal body -->
                      
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
            url: "<?php echo site_url('admin/usuarios/procurar/') ?>",
            dataType: "json",
            data: {
              term: request.term,
            },
            success: function (data) {
              if (data.length < 1) {
                var data = [
                  {
                    label: 'Usuário não encontrado.',
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
            window.location.href = '<?php echo base_url('admin/usuarios/show'); ?>/' + ui.item.id;
          }
        }
      });
    });
  </script>


<?php echo $this->endSection(); ?>