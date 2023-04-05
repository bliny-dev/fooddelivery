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

</div>

  <!-- Novo card de categorias -->
  <div class="card text-center mt-3">
      <div class="card-body">
        <h4 class="card-title"><?php echo $titulo ?></h4>
        
        <div class="container-fluid ">
          <div class="row d-flex col-12">
            <?php echo form_open(site_url("admin/expedientes"), ['class' => 'form-row']) ?>

              <div class="accordion accordion-flush my-4" id="accordionFlushExample">
                
                <?php foreach ($expedientes as $dia): ?>
                  
                  <div class="accordion-item ">
                    <h2 class="accordion-header" id="flush-heading<?php echo $dia->id; ?>">
                      <button 
                        class="accordion-button collapsed" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#flush-collapse<?php echo $dia->id; ?>" 
                        aria-expanded="false" 
                        aria-controls="flush-collapse<?php echo $dia->id; ?>"
                      >
                        <strong>
                          <?php echo $dia->dia_descricao; ?>
                        </strong>
                      </button>
                    </h2>
                    <div id="flush-collapse<?php echo $dia->id; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $dia->id; ?>" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <div class="row">
                          <div class="col-12 d-md-flex justify-content-center">

                            <div class="form-group col-12 col-md-2 m-2 ">
                              <input type="text" name="dia_descricao[]", class="form-control" placeholder="" value="<?php echo esc($dia->dia_descricao); ?>" readonly=""/>
                            </div>

                            <div class="col-12 col-md-2 m-2">
                              <input type="time" name="abertura[]", class="form-control" placeholder="" value="<?php echo esc($dia->abertura); ?>" required/>
                            </div>

                            <div class="col-12 col-md-2 m-2">
                              <input type="time" name="fechamento[]", class="form-control" placeholder="" value="<?php echo esc($dia->fechamento); ?>" required/>
                            </div>

                            <div class="col-12 col-md-2 m-2">
                              <select class="form-control" name="situacao[]" required>
                                <option value="1" <?php echo ($dia->situacao == true ? 'selected' : ''); ?>>Aberto</option>
                                <option value="0" <?php echo ($dia->situacao == false ? 'selected' : ''); ?>>Fechado</option>
                              </select>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                <?php endforeach; ?>

              </div>

          </div>

          <div class="row">
            <!-- btn Save -->
            <div class="d-flex justify-content-center mb-2">
              <strong>
                <span class="text-danger"> OBS: </span> 
                Sempre que 
                <span class="text-danger">ALTERAR</span> 
                um expediente clique em salvar para a alteração ser realizada
              </strong>
            </div>
            <div class="d-flex justify-content-center mt-2">
              <button type="submit" class="btn btn-success">
                Salvar
              </button>
            </div>
          </div>

          <?php echo form_close(); ?>
        </div>

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
            url: "<?php echo site_url('admin/bairros/procurar/') ?>",
            dataType: "json",
            data: {
              term: request.term,
            },
            success: function (data) {
              if (data.length < 1) {
                var data = [
                  {
                    label: 'Bairro não encontrado.',
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
            window.location.href = '<?php echo base_url('admin/bairros/show'); ?>/' + ui.item.id;
          }
        }
      });
    });
  </script>

<?php echo $this->endSection(); ?>