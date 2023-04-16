<?php echo $this->extend('Admin/layout/principal'); ?>

<!-- Aqui enviamos para o template principal o título -->
<?php echo $this->section('titulo'); ?>

  <?php echo $titulo; ?>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os estilos -->
<?php echo $this->section('estilos'); ?>

  <link rel="stylesheet" href="<?php echo site_url('admin/vendors/select2/select2.min.css'); ?>"/>

  <style>

  .select2-container .select2-selection--single {
    display: block;
    width: 100%;
    height: 2.875rem;
    padding: 0.875rem 1.375rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #495057;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 2px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 18px;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow b {
    top: 80%;
  }

  </style>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->
<?php echo $this->section('conteudo'); ?>

<div class="row">

  <div class="col-lg-6 col-md-12 p-2">
    <div class="card">

      <div class="card-header bg-primary pb-0 pt-4">
        <h6 class="card-title text-white"><?php echo esc($titulo); ?></h6>
      </div>
      
      <div class="card-body">

        <?php if (session()->has('errors_model')): ?>
          <ul>
            <?php foreach (session('errors_model') as $error): ?>
              <li class="text-danger"><?php echo $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php echo form_open("admin/produtos/cadastrarespecificacoes/$produto->id"); ?>

          <div class="form-row">

            <div class="form-group ">
              
              <label>Escolha a medida do produto 
                <a 
                  href="javascrip:void" 
                  class="" 
                  role="button" 
                  data-toggle="popover" 
                  data-trigger="focus" 
                  title="Medida do produto" 
                  data-content="Exemplo de uso para pizza:<br>Pizza Grande, <br>Pizza Média, <br>Pizza Família."
                >
                  Entenda
                </a>
              </label>

              <select class="form-control js-example-basic-single-medida" name="medida_id">

                <option value="">Escolha..</option>

                <?php foreach ($medidas as $medida): ?>

                  <option value="<?php echo $medida->id; ?>"><?php echo $medida->nome; ?></option>

                <?php endforeach; ?>
              
              </select>

            </div>

            <div class="form-group">
              <label for="preco">Preço</label>
              <input type="text" class="money form-control" name="preco" id="preco" value="<?php echo old('preco'); ?>">
            </div>

            <div class="form-group">
              
              <label>Produto customizável 
                <a 
                  href="javascrip:void" 
                  class="" 
                  role="button" 
                  data-toggle="popover" 
                  data-trigger="focus" 
                  title="Produto meio a meio" 
                  data-content="Exemplo de uso para pizza:<br>Metade calabresa e metade bacon."
                >
                  Entenda
                </a>
              </label>

              <select class="form-control" name="customizavel">

                <option value="">Escolha..</option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
              
              </select>

            </div>

          </div>
          
          <div class="text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-4 mr-2">
              <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>
              Inserir especificação
            </button>

            <a href="<?php echo site_url("admin/produtos/show/$produto->id"); ?>" class="btn btn-light text-dark btn-sm mt-4">
              <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
              Voltar
            </a>
          </div>

        <?php echo form_close(); ?>
        
        <hr class="mt-5 mb-3">

        <div class="form-row">

          <div class="">
            
            <?php if (empty($produtoEspecificacoes)): ?>

              <div class="alert alert-warning mt-4" role="alert">
                <h4 class="alert-heading">Atenção!</h4>
                <p>Esse produto não possui especificações até o momento. Portanto, ele <strong>não será exibido</strong> como opção de compra na área pública.</p>
                <hr>
                <p class="mb-0">Aproveite para cadastrar pelo menos uma especificação para o produto <strong><?php echo esc($produto->nome); ?></strong>.</p>
              </div>
            
            <?php else: ?>
              
              <h4 class="card-title text-center">Especificações do produto</h4>
              <p class="card-description text-center">
                <code>Aproveite para gerenciar as especificações.</code>
              </p>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Medida</th>
                      <th>Preço</th>
                      <th>Customizável</th>
                      <th class="text-center">Remover</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($produtoEspecificacoes as $especificacao): ?>
                      <tr>
                        <td><?php echo esc($especificacao->medida); ?></td>
                        <td>R$&nbsp;<?php echo esc(number_format($especificacao->preco, 2, ',', '.')); ?></td>
                        <td><?php echo ($especificacao->customizavel ? '<label class="badge bg-success">Sim</label>' : '<label class="badge bg-danger">Não</label>'); ?></td>
                        <td class="text-center">
                          <a href="<?php echo site_url("admin/produtos/excluirespecificacao/$especificacao->id/$especificacao->produto_id"); ?>" class="btn btn-danger btn-sm">
                            &nbsp;X&nbsp;
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>

                  </tbody>
                </table>

                <div class="mt-3">
                  <?php echo $pager->links(); ?>
                </div>

              </div>

            <?php endif; ?>

          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="col-lg-6 col-md-12 p-2">
    <div class="card">
      <div class="card-header bg-primary pb-0 pt-4">
        <h6 class="card-title text-white"><?php echo esc($titulo); ?></h6>
      </div>
      <div class="card-body">

        <?php if (session()->has('errors_model')): ?>
          <ul>
            <?php foreach (session('errors_model') as $error): ?>
              <li class="text-danger"><?php echo $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php echo form_open("admin/produtos/cadastrarextras/$produto->id"); ?>

          <div class="form-row">
            <div class="form-group col-12">
              
              <label>Escolha o extra do produto (opcional)</label>

              <select class="form-control js-example-basic-single-extra" name="extra_id">

                <option value="">Escolha..</option>

                <?php foreach ($extras as $extra): ?>

                  <option value="<?php echo $extra->id; ?>"><?php echo $extra->nome; ?></option>

                <?php endforeach; ?>
              
              </select>

            </div>

          </div>

          <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-sm mr-2">
              <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>
              Inserir extra
            </button>

            <a href="<?php echo site_url("admin/produtos/show/$produto->id"); ?>" class="btn btn-light text-dark btn-sm">
              <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
              Voltar
            </a>
          </div>

        <?php echo form_close(); ?>
        
        <hr class="mt-5 mb-3">

        <div class="form-row">

          <div class="col-12">
            
            <?php if (empty($produtoExtras)): ?>
              <div class="text-center" >
                <p>Esse produto não possui extras até o momento.</p>
              </div>

            <?php else: ?>
              <h4 class="card-title">Extras do produto</h4>
              <p class="card-description">
                <code>Aproveite para gerenciar os extras.</code>
              </p>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Extra</th>
                      <th>Preço</th>
                      <th class="text-center">Remover</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($produtoExtras as $exxtraProduto): ?>
                      <tr>
                        <td><?php echo esc($exxtraProduto->extra); ?></td>
                        <td>R$&nbsp;<?php echo esc(number_format($exxtraProduto->preco, 2)); ?></td>
                        <td class="text-center">
                          <?php echo form_open(site_url("admin/produtos/excluirextra/$exxtraProduto->id/$exxtraProduto->produto_id")) ?>

                            <button type="submit" class="btn btn-sm badge badge-danger">&nbsp;X&nbsp;</button>
                          
                          <?php echo form_close(); ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>

                  </tbody>
                </table>

                <div class="mt-3">
                  <?php echo $pager->links(); ?>
                </div>

              </div>
            <?php endif; ?>

          </div>
        </div>

      </div>
    </div>
  </div>

</div>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>

  <script src="<?php echo site_url('admin/vendors/select2/select2.min.js') ?>"></script>
  <script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('admin/vendors/mask/app.js') ?>"></script>

  <script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {

      $(function () {
        $('[data-toggle="popover"]').popover({
          placement: 'top',
          html: true,
        })
      })

      $('.js-example-basic-single-medida').select2({

        placeholder: 'Digite o nome da medida..',
        allowClear: false,

        "language": {

          "noResults": function() {
            return "Medida não encontrada&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='<?php echo site_url('admin/medidas') ?>'>Cadastrar</a>";
          }

        },
        escapeMarkup: function(markup) {
          return markup;
        }

      });
    });
  </script>

  <script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single-extra').select2({

          placeholder: 'Digite o nome do extra..',
          allowClear: false,

          "language": {

            "noResults": function() {
              return "Extra não encontrado&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='<?php echo site_url('admin/extras') ?>'>Cadastrar</a>";
            }

          },
          escapeMarkup: function(markup) {
            return markup;
          }

        });
    });
  </script>

<?php echo $this->endSection(); ?>