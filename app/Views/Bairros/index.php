<?php echo $this->extend('layout/principal_web'); ?>

<!-- Aqui enviamos para o template principal o título -->
<?php echo $this->section('titulo'); ?>

  <?php echo $titulo; ?>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os estilos -->
<?php echo $this->section('estilos'); ?>

    <link rel="stylesheet" href="<?php echo site_url('web/src/assets/css/produto.css'); ?>"/>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->
<?php echo $this->section('conteudo'); ?>

    <div class="container mt-5" id="menu" data-aos="fade-up">

        <div class="col-12">
            <!-- product -->
            <div class="row">

                <?php if (empty($bairros)): ?>

                    <div class="col-12">
            
                        <h2 >Não há dados para exibir.</h2>

                    </div>

                <?php else: ?>

                    <div class="col-12 text-center">
            
                        <h2 class="section-title"><?php echo esc($titulo); ?></h2>

                    </div>

                    <?php foreach($bairros as $bairro): ?>

                        <div class="col-md-4 col-sm-12 mt-4">
                            <div class="card p-2 m-1 bg-white shadow size-custom d-grid align-items-center">
                                <div class="text-center">
                                    <div class="border-bottom border-3 border-danger">
                                        <span class="fw-bold ">
                                            <?php echo esc($bairro->nome); ?> - <?php echo esc($bairro->cidade); ?> - CE
                                        </span>
                                    </div>
                                    <div>
                                        <p>
                                            Taxa de entrega: R$&nbsp<?php echo esc(number_format($bairro->valor_entrega, 2)); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>
            <!-- end product -->
        </div>
        
    </div>
<!-- End Sections -->

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>

<script>

    $(document).ready(function() {

        var especificacao_id;

        if (!especificacao_id) {

            $('#btn-adiciona').prop('disabled', true);
            $('#btn-adiciona').prop('value', 'Selecione um valor');
        }

        $(".especificacao").on('click', function () {

            especificacao_id = $(this).attr('data-especificacao');

            $("#especificacao_id").val(especificacao_id);

            $('#btn-adiciona').prop('disabled', false);
            $('#btn-adiciona').prop('value', 'Adicionar');

        });

        $(".extra").on('click', function () {

            var extra_id = $(this).attr('data-extra');

            $("#extra_id").val(extra_id);

        });

    });

</script>

<?php echo $this->endSection(); ?>