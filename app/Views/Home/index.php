<?php echo $this->extend('layout/principal_web'); ?>

<!-- Aqui enviamos para o template principal o título -->
<?php echo $this->section('titulo'); ?>

  <?php echo $titulo; ?>

<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os estilos -->
<?php echo $this->section('estilos'); ?>


<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->
<?php echo $this->section('conteudo'); ?>  

  <!-- Titulo da pagina -->
  <div class='container p-3'>
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <h2 class='text-danger border-bottom border-5 border-warning'>Pedido</h2>
            <button  
              class='btn btn-transparent border border-2 border-warning d-flex align-items-center'
              data-bs-target="#ModalCarrinho" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              <span class="las la-shopping-cart fs-1 text-danger"></span>
              <span class='fs-4' >0</span>
            </button>
        </div>
    </div>
  </div>

  <!-- Menu de categorias -->
  <div class='container-fluid mt-1 my-5 pt-1'>

    <div class="d-flex justify-content-center">
      <h4 class='py-2 px-4 bg-danger text-white rounded-pill' >Categorias</h4>
    </div>

    <div class='d-flex justify-content-center'>
      <div class="d-flex menu ms-md-5">
        <?php if (empty($categorias)): ?>
          
          <p href="#categoria" class="filter-button text-center">Não há categorias para exibir</p>
          
        <?php else: ?>

          <a  
            href="#categoria" 
            data-filter="todas"
            class="text-nowrap bd-highlight btn btn-sm bg-white border border-2 border-warning text-danger fw-bold me-1 mb-1"
          >
            Todas
          </a>

          <?php foreach ($categorias as $categoria): ?>

            <a 
              href="#categoria" 
              data-filter="<?php echo $categoria->slug; ?>"
              class="text-nowrap bd-highlight btn btn-sm bg-white border border-2 border-warning text-danger fw-bold me-1 mb-1"
            >
              <?php echo esc($categoria->nome); ?>
            </a>

          <?php endforeach; ?>


        <?php endif; ?>

       
      </div>
    </div> 

  </div>

  <!-- New menu produtos -->
  <div class="container mt-5">
    
    <div class='d-flex justify-content-center'>
      <h3 id="categoria" class='p-1 px-3 bg-danger text-white rounded-pill'>Pizzas</h3>
    </div>

  </div>

  <div class="container margin-produto">
    <div class="row d-flex justify-content-center align-items-center">
             
        <?php if (empty($produtos)): ?>

          <div class="text-center">
              <h2 class="section-title">Não delícias para exibir no momento</h2>
          </div>

        <?php else: ?>
          <?php foreach ($produtos as $produto): ?>
            <!-- Cada card -->
            <div class="col-sm-12 col-md-6 col-lg-4 d-flex p-2 justify-content-center">
              <div id="<?php echo $produto->categoria_slug; ?>" class="custom-card p-2 d-flex border border-warning shadow-sm rounded-4 bg-white <?php echo $produto->categoria_slug; ?>">

                <div class="">
                  <img 
                    src="<?php echo site_url("produto/imagem/$produto->imagem"); ?>" 
                    class="img-produto" 
                    alt="<?php echo esc($produto->nome); ?>" 
                  />
                </div>

                <!-- texts card  -->
                <div class="textos-produto d-block justify-content-center ms-2">
                  <div class='fw-bold bg-danger rounded text-white px-1 text-center'>
                    <span><?php echo esc($produto->nome); ?></span>
                  </div>
                  <div>
                    <div>
                      <span class='fs-6 '>A partir de&nbsp;
                        <span class='border-bottom border-3 border-success'>R$ <?php echo esc(number_format($produto->preco, 2)); ?></span>
                      </span>
                    </div>
                  </div>
                  <!-- icon -->
                  <div class='d-flex justify-content-center'>
                    <button 
                      class='btn rounded-circle btn-success m-1'
                      data-bs-target="#ModalRegister" 
                      data-bs-toggle="modal" 
                      data-bs-dismiss="modal"
                    >
                      <i class="las la-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>    
          <?php endforeach; ?>
        <?php endif; ?>
      
    </div>

    <!-- Modal de abrir produto -->
    <div class="modal fade" id="ModalRegister" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">Produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <h5>Produto</h5>
          </div>
          <!-- end modal body -->
          
          <div class="modal-footer d-flex justify-content-center">
            
            <button 
              class="btn btn-sm btn-danger fw-bold" 
              data-bs-target="#exampleModalToggle" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              Voltar
            </button>
            
            <button 
              class="btn btn-sm btn-primary fw-bold" 
              data-bs-target="#ModalDoisSabores" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              Dois sabores
            </button>

            <button type="submit" class="btn btn-success btn-sm mr-2 ">
              adicionar
              <i class="las la-plus"></i>
            </button>
            
          </div>



        </div>
      </div>
    </div>

     <!-- Modal abrir dois sabores -->
     <div class="modal fade" id="ModalDoisSabores" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">Dois sabores</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <h5>Dois sabores</h5>
          </div>
          <!-- end modal body -->
          
          <div class="modal-footer d-flex justify-content-center">
            
            <button 
              class="btn btn-sm btn-danger " 
              data-bs-target="#ModalRegister" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              Voltar
            </button>
            
            <button type="submit" class="btn btn-success btn-sm mr-2 ">
              adicionar
              <i class="las la-plus"></i>
            </button>
            
          </div>



        </div>
      </div>
    </div>

     <!-- Modal abrir carrinho -->
     <div class="modal fade" id="ModalCarrinho" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">Carrinho</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <h5>Carrinho</h5>
          </div>
          <!-- end modal body -->
          
          <div class="modal-footer d-flex justify-content-center">
            
            <button 
              class="btn btn-sm btn-danger " 
              data-bs-target="#" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              Sair
            </button>
            
            <button 
              type="submit" 
              class="btn btn-success btn-sm mr-2 "
              data-bs-target="#ModalFinalizarProduto" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              Finalizar
              <i class="las la-plus"></i>
            </button>
            
          </div>



        </div>
      </div>
    </div>

     <!-- Modal abrir editar produto -->
     <div class="modal fade" id="ModalEditaProduto" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">Edita produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <h5>Edita produto</h5>
          </div>
          <!-- end modal body -->
          
          <div class="modal-footer d-flex justify-content-center">
            
            <button 
              class="btn btn-sm btn-danger " 
              data-bs-target="#" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              Voltar
            </button>
            
            <button type="submit" class="btn btn-success btn-sm mr-2 ">
              Finalizar
              <i class="las la-plus"></i>
            </button>
            
          </div>



        </div>
      </div>
    </div>

     <!-- Modal abrir finalizar produto -->
     <div class="modal fade" id="ModalFinalizarProduto" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">Finalizar produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <h5>Finalizar produto</h5>
          </div>
          <!-- end modal body -->
          
          <div class="modal-footer d-flex justify-content-center">
            
            <button 
              class="btn btn-sm btn-danger " 
              data-bs-target="#ModalCarrinho" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              voltar
            </button>
            
            <button type="submit" class="btn btn-success btn-sm mr-2 ">
              Enviar pedido
              <i class="las la-plus"></i>
            </button>
            
          </div>



        </div>
      </div>
    </div>

  </div>



<?php echo $this->endSection(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php echo $this->section('scripts'); ?>


<?php echo $this->endSection(); ?>