<?php echo $this->extend('layout/principal_web'); ?>

<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<!-- Aqui enviamos para o template principal os estilos -->

<?php echo $this->endSection(); ?>





<?php echo $this->section('conteudo'); ?>






<!-- Begin Sections-->

<!--    Menus   -->
<div class="categorias container-fluid mt-1 mb-3 pt-1 pb-5 section" id="menu" data-aos="fade-up" style="margin-top: 3em">
    <!-- <div class="title-block">
        <h1 class="text-primary mt-5">Conheça as nossas delícias</h1>
    </div>
    <div class="teste d-flex gap-5">
        <h1>teste 1</h1>
        <h1>teste 2</h1>
    </div> -->

    <!--    Menus filter    -->
    <div class="menu_filter text-center menu_scroll">
        <ul class="list-unstyled list-inline d-flex justify-content-center">

            <?php if (empty($categorias)): ?>

                <li class="item active">
                    <a href="javascript:;" class="filter-button text-nowrap bd-highlight btn btn-sm btn-transparent 
                        border border-2 border-warning text-danger fw-bold me-1 mb-1 ">Não há categorias para exibir</a>
                </li>

            <?php else: ?>

                <li id="todas" class="">
                    <a href="javascript:;" class="filter-button text-nowrap bd-highlight btn btn-sm btn-transparent 
                        border border-2 border-warning text-danger fw-bold me-1 mb-1" data-filter="todas">Todas</a>
                </li>


                <?php foreach ($categorias as $categoria): ?>

                    <li class="item">
                        <a href="javascript:;" class="filter-button text-nowrap bd-highlight btn btn-sm btn-transparent 
                        border border-2 border-warning text-danger fw-bold me-1 mb-1" data-filter="<?php echo $categoria->slug; ?>"><?php echo esc($categoria->nome); ?></a>
                    </li>

                <?php endforeach; ?>


            <?php endif; ?>





        </ul>
    </div> 

    <!--    Menus items     -->
    <div id="menu_items">


        <div class="row">


            <?php if (empty($produtos)): ?>


                <div class="title-block">
                    <h2 class="section-title">Não delícias para exibir no momento</h2>
                </div>



            <?php else: ?>


                <?php foreach ($produtos as $produto): ?>

                    <div class="card-produto d-flex shadow rounded-4 border border-warning m-2 filtr-item image filter active <?php echo $produto->categoria_slug; ?>">


                        <a href="<?php echo site_url("produto/detalhes/$produto->slug"); ?>" class="block fancybox" data-fancybox-group="fancybox">
                            <div class="content">
                                <div class="filter_item_img">
                                    <i class="fa fa-search-plus"></i>
                                    <img class="img-produto" src="<?php echo site_url("produto/imagem/$produto->imagem"); ?>" alt="<?php echo esc($produto->nome); ?>" />
                                </div>
                                <div class="info">
                                    <div class="name"><?php echo esc($produto->nome); ?></div>
                                    <div class="short"><?php echo word_limiter($produto->ingredientes, 5); ?></div>
                                    <span class="filter_item_price">A partir de R$&nbsp;<?php echo esc(number_format($produto->preco, 2)); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php endforeach; ?>


            <?php endif; ?>


        </div>


    </div>
</div>



<?php echo $this->endSection(); ?>




<?php echo $this->section('scripts'); ?>

<!-- Aqui enviamos para o template principal os scripts -->

<?php echo $this->endSection(); ?>








