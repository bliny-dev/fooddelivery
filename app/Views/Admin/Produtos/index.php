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



  <!-- Novo card de produtos -->
  <div class="card text-center mt-3">
      <div class="card-body">
        <h4 class="card-title"><?php echo $titulo ?></h4>
        
        <!-- search input -->
        <div class="ui-widget">
          <input id="query" name="query" placeholder="Pesquise por um produto.." class="form-control bg-light mt-5 mb-3">
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
          <!-- href="<?php echo site_url("admin/produtos/criar"); ?>"  -->
          <button 
              class="btn btn-success mb-3" 
              data-bs-target="#ModalRegister" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
          >
              <span class="las la-plus"></span>
              Cadastrar
          </button>
        </div>


      <?php if(empty($produtos)): ?> 

        <p>Não há dados para serem exibidos</p> 

      <?php else: ?>

        <div class="container-fluid ">
          <div class="row d-flex col-12">

            <?php foreach ($produtos as $produto): ?>

              <div class="col-md-6 col-lg-4 col-xxl-3 col-sm-12 my-2 card-group">
                <div class=" shadow card " >
                  
                  <div class="card-body p-2">
                  <div class="card-title d-flex justify-content-center fw-bold fs-5">
                    <?php echo $produto->nome; ?>
                  </div>

                    <?php if ($produto->imagem): ?>
                      <a 
                        href="<?php echo site_url("admin/produtos/editarimagem/$produto->id"); ?>"
                        data-bs-target="#ModaleditImage<?php echo $produto->id; ?>" 
                        data-bs-toggle="modal" 
                        data-bs-dismiss="modal"
                      >
                        <img 
                          src="<?php echo site_url("admin/produtos/imagem/$produto->imagem"); ?>" 
                          class="foto-produto" 
                          alt="<?php echo esc($produto->nome) ?>"
                        />
                      </a>
                    
                    <?php else: ?>
                      <a 
                        href="<?php echo site_url("admin/produtos/editarimagem/$produto->id"); ?>"
                        data-bs-target="#ModaleditImage<?php echo $produto->id; ?>" 
                        data-bs-toggle="modal" 
                        data-bs-dismiss="modal"
                      >
                        <img 
                          src="<?php echo site_url('admin/images/produto-sem-imagem.jpg'); ?>" 
                          class="foto-produto" 
                          alt="Produto sem imagem"/>
                      </a>
                   

                    <?php endif; ?>

                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Nome:</span>
                      <span  href="<?php echo site_url("admin/produtos/show/$produto->id"); ?>">
                        <?php echo $produto->nome; ?>
                      </span>
                    </div>

                    <div class="d-block">
                      <span class="col-6 fw-bold text-nowrap bd-highlight">Categoria:</span>
                      <span><?php echo $produto->categoria; ?></span>
                    </div>


                    <!-- <div class="d-block">
                      <span class="col-6 fw-bold text-nowrap bd-highlight">Especificações:</span>
                        <?php foreach ($especificacoes as $especificacao): ?>
                          <span>

                            <?php if ($produto->id == $especificacoes->produto_id): ?>
                              <p><?php echo esc($especificacao->nome); ?></p> : R$&nbsp;<?php echo esc($especificacao->preco); ?>
                            <?php endif; ?>
                          </span>

                        <?php endforeach; ?>  
                    </div> -->

                    <div class="d-block">
                      <span class="col-6 fw-bold text-nowrap bd-highlight">Data de criação:</span>
                      <span><?php echo $produto->criado_em->humanize(); ?></span>
                    </div>
                  
                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Ativo:</span>
                      <span>
                        <?php echo ($produto->ativo && $produto->deletado_em == null) ? '<label class="badge bg-primary">Sim</label>' : '<label class="badge bg-danger">Não</label>' ?>
                      </span>
                    </div>
                  
                    <div class="d-block">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Situação:</span>
                      <span>
                        <?php echo ($produto->deletado_em == null) ? '<label class="badge bg-success">Disponível</label>' : '<label class="badge bg-danger">Excluído</label>' ?>
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
                          href="#modalShow<?php echo $produto->id; ?>"
                        >
                          Detalhes
                      </button>
                    
                      <?php if ($produto->deletado_em != null): ?>

                          <a href="<?php echo site_url("admin/produtos/desfazerExclusao/$produto->id"); ?>" 
                            class=" btn btn-dark btn-sm me-1 mb-1">
                            <i class="mdi mdi-undo btn-icon-prepend"></i>
                            Ativar
                          </a>

                      <?php elseif($produto->deletado_em == null):?>
                          <button type="button" class="btn btn-warning btn-sm me-1 mb-1" data-bs-target="#Modaledit<?php echo $produto->id; ?>" data-bs-toggle="modal" data-bs-dismiss="modal">
                            Editar
                          </button>
                      
                          <button type="button" class=" btn btn-danger btn-sm me-1 mb-1"  data-bs-target="#ModalDelete<?php echo $produto->id; ?>" data-bs-toggle="modal" data-bs-dismiss="modal">
                            Excluir
                          </button>
                      <?php endif; ?>
                    </div>
                    <!-- fim botões de modal -->

                    
                    <div class="justify-content-center">
                      <span class="col-4 fw-bold text-nowrap bd-highlight">Atribuições:</span>
                    </div>
                    
                    <!-- botões de modal -->
                    <div class="d-md-flex justify-content-center">                      
                      <a  
                        href="<?php echo site_url("admin/produtos/especificacoes/$produto->id"); ?>"
                        type="button" 
                        class="btn btn-dark btn-sm me-1 mb-1" 
                      >
                        <span class="las la-dollar-sign"></span>
                        Preços e extras
                      </a>

                    </div>
                    <!-- fim botões de modal  especificações e extras-->

                  </div>
                </div>
              </div>
                                        
              <!-- modal show 1 | mostra todos os detalhes da produto -->
              <div class="modal fade" id="modalShow<?php echo $produto->id; ?>" aria-hidden="true" aria-labelledby="ModalDeDetalhes" tabindex="-1" role="dialog">

                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalToggleLabel">Detalhes do produto</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <div class="card-body">
                        <div class="text-center">

                            <?php if ($produto->imagem && $produto->deletado_em == null): ?>
                              <img class="card-img-top w-75" src="<?php echo site_url("admin/produtos/imagem/$produto->imagem") ?>" alt="<?php echo esc($produto->nome) ?>">
                            <?php else: ?>
                              <img class="card-img-top w-75" src="<?php echo site_url('admin/images/produto-sem-imagem.png') ?>" alt="Produto sem imagem por enquanto..">
                            <?php endif; ?>

                        </div>

                        <?php if ($produto->deletado_em == null): ?>

                        <hr>
                          <a 
                          href="<?php echo site_url("admin/produtos/editarimagem/$produto->id"); ?>"
                          class="btn btn-outline-primary btn-sm mb-2 mt-3" 
                          data-bs-target="#ModaleditImage<?php echo $produto->id; ?>" 
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
                            <?php echo esc($produto->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Telefone:</span>
                            <?php echo ($produto->telefone); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Veículo:</span>
                            <?php echo ($produto->veiculo); ?> | <?php echo ($produto->placa); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Ativo:</span>
                            <?php echo ($produto->ativo ? 'Sim' : 'Não'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Criado:</span>
                            <?php echo $produto->criado_em->humanize(); ?>
                        </p>

                        <?php if ($produto->deletado_em == null): ?>

                          <p class="card-text">
                            <span class="font-weight-bold">Atualizado:</span>
                            <?php echo $produto->atualizado_em->humanize(); ?>
                          </p>

                        <?php else: ?>

                        <p class="card-text">
                          <span class="font-weight-bold text-danger">Excluído:</span>
                          <?php echo $produto->deletado_em->humanize(); ?>
                        </p>

                        <?php endif; ?>

                      </div>
                    </div>

                    <div class="modal-footer">
                      <div class="mt-4 ">

                          <?php if ($produto->deletado_em == null): ?>

                            <a 
                                href="<?php echo site_url("admin/produtos/editar/$produto->id"); ?>" 
                                class="btn btn-sm btn-warning mr-2" 
                                data-bs-target="#Modaledit<?php echo $produto->id; ?>" 
                                data-bs-toggle="modal" 
                                data-bs-dismiss="modal" >
                                <i class="mdi mdi-pencil btn-icon-prepend"></i>
                                Editar
                            </a>

                            <a 
                            href="<?php echo site_url("admin/produtos/excluir/$produto->id"); ?>" 
                            class="btn  btn-sm btn-danger mr-2" 
                            data-bs-target="#ModalDelete<?php echo $produto->id; ?>" 
                            data-bs-toggle="modal" 
                            data-bs-dismiss="modal"
                            >
                              <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                              Excluir
                            </a>

                            <a href="<?php echo site_url("admin/produtos"); ?>" class="btn  btn-sm btn-light fw-bold">
                                <i class="mdi mdi-arrow-left btn-icon-prepend"></i>  
                                Voltar
                            </a>

                          <?php else: ?>

                            <a title="Desfazer exclusão" href="<?php echo site_url("admin/produtos/desfazerexclusao/$produto->id"); ?>" class="btn  btn-sm btn-dark mr-2">
                                <i class="mdi mdi-undo btn-icon-prepend"></i>
                                Desfazer
                            </a>

                            <a href="<?php echo site_url("admin/produtos"); ?>" class="btn btn-light   btn-sm fw-bold">
                                <i class="mdi mdi-arrow-left btn-icon-prepend "></i>  
                                Voltar
                            </a>

                          <?php endif; ?>

                      </div>

                    </div>
                </div>
                </div>
              </div>

              <!-- modalEdit | edita produto -->
              <div class="modal fade" id="Modaledit<?php echo $produto->id; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalToggleLabel2">Editar produto</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body  justify-content-center">

                      <?php echo form_open("admin/produtos/atualizar/$produto->id")?>

                      <div class="form-row">

                          <div class="form-group col-md-12">
                              <label for="nome">Nome</label>
                              <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome', esc($produto->nome)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="cpf">CPF</label>
                              <input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?php echo old('cpf', esc($produto->cpf)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="cnh">CNH</label>
                              <input type="text" class="form-control cnh" name="cnh" id="cnh" value="<?php echo old('cnh', esc($produto->cnh)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="telefone">Telefone</label>
                              <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" value="<?php echo old('telefone', esc($produto->telefone)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="email">E-mail</label>
                              <input type="text" class="form-control" name="email" id="email" value="<?php echo old('email', esc($produto->email)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="veiculo">Veículo</label>
                              <input type="text" class="form-control" name="veiculo" id="veiculo" value="<?php echo old('veiculo', esc($produto->veiculo)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="placa">Placa</label>
                              <input type="text" class="form-control placa" name="placa" id="placa" value="<?php echo old('placa', esc($produto->placa)); ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label for="endereco">Endereço</label>
                              <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo old('endereco', esc($produto->endereco)); ?>">
                          </div>

                      </div>

                      <div class="form-check form-check-flat form-check-primary mb-4">
                          <label for="ativo" class="form-check-label">
                              <input type="hidden" name="ativo" value="0" />
                              <input type="checkbox" class="form-check-input" name="ativo" id="ativo" value="1" <?php if (old('ativo', $produto->ativo)): ?> checked="" <?php endif; ?> />
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

              <!-- modalEditImage | edita foto do produto -->
              <div class="modal fade" id="ModaleditImage<?php echo $produto->id; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalToggleLabel2">Editar foto do produto </h5>
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

                      <?php echo form_open_multipart("admin/produtos/upload/$produto->id"); ?>
                          <div class="card-body">

                              <div class="form-group mb-4">
                              <label>Upload de imagem</label>
                              <input type="file" name="foto_produto"  class="file-upload-default form-control">
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
                          <?php echo form_close(); ?>

                          <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button>

                                                  
                      </div>


                  </div>
                  </div>
              </div>

              <!-- terceiro modal | exclui produto -->
              <div class="modal fade" id="ModalDelete<?php echo $produto->id; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalToggleLabel2">Excluindo produto: <?php echo esc($produto->nome); ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <h5 ><strong>Atenção!</strong>Tem certeza que deseja realizar a exclusão? </h5>
                      <h6 ><strong >Obs:!</strong>Essa ação neste campo é reversivel </h6>

                      </div>
                      
                      <div class="modal-footer d-flex justify-content-center">
                              <button class="btn btn-light fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button>

                              <?php echo form_open("admin/produtos/excluir/$produto->id"); ?>


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


              <!-- quarto modal | cadastra produto -->
              <div class="modal fade" id="ModalRegister" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Cadastrar uma nova produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <?php echo form_open("admin/produtos/cadastrar"); ?>
                        
                      <div class="form-row">

                          <div class="form-group col-md-8">
                              <label for="nome">Nome</label>
                              <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome', esc($produto->nome)); ?>">
                          </div>

                          <div class="form-group col-md-4">
                              <label for="categoria">Categoria</label>
                              <select class="form-control" name="categoria_id">
                                  <option value="">Escolha uma categoria..</option>
                                  <?php foreach($categorias as $categoria): ?>
                                      <?php if ($produto->id): ?>
                                          <option value="<?php echo $categoria->id; ?>" <?php echo ($categoria->id == $produto->categoria_id ? 'selected' : '') ?>> <?php echo esc($categoria->nome); ?></option>
                                      <?php else: ?>
                                          <option value="<?php echo $categoria->id; ?>"> <?php echo esc($categoria->nome); ?></option>
                                      <?php endif; ?>
                                  <?php endforeach; ?>
                              </select>
                          </div>

                          <div class="form-group col-md-12">
                              <label for="ingredientes">Ingredientes</label>
                              <textarea type="text" class="form-control" name="ingredientes" id="ingredientes" rows="3" value="<?php echo old('ingredientes', esc($produto->ingredientes)); ?>"><?php echo old('ingredientes', esc($produto->ingredientes)); ?></textarea>
                          </div>
                                          
                      </div>

                      <div class="form-check form-check-flat form-check-primary mb-4">
                        <label for="ativo" class="form-check-label">
                            <input type="hidden" name="ativo" value="0" />
                            <input type="checkbox" class="form-check-input" name="ativo" id="ativo" value="1" <?php if (old('ativo', $produto->ativo)): ?> checked="" <?php endif; ?> />
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

  <script>
    $(function () {
      $( "#query" ).autocomplete({
        source: function (request, response) {
          $.ajax({
            url: "<?php echo site_url('admin/produtos/procurar/') ?>",
            dataType: "json",
            data: {
              term: request.term,
            },
            success: function (data) {
              if (data.length < 1) {
                var data = [
                  {
                    label: 'Produto não encontrado.',
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
            window.location.href = '<?php echo base_url('admin/produtos/show'); ?>/' + ui.item.id;
          }
        }
      });
    });
  </script>

<?php echo $this->endSection(); ?>