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

              <?php if (session()->has('carrinho') && count(session()->get('carrinho')) > 0): ?>
                <span class='fs-4'><?php echo count(session()->get('carrinho')); ?></span>
              <?php else: ?>
                <span class='fs-4'>0</span>
              <?php endif; ?>
              
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
                      data-bs-target="#ModalDetalheProduto<?php echo esc($produto->id); ?>" 
                      data-bs-toggle="modal" 
                      data-bs-dismiss="modal"
                    >
                      <i class="las la-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>    
            
            <!-- Modal de abrir produto -->
            <div class="modal fade" id="ModalDetalheProduto<?php echo esc($produto->id); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Produto <?php echo esc($produto->categoria); ?> de <?php echo esc($produto->nome); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">

                    <div class="row d-flex">

                    </div>

                    <div class='text-center'>
                      <img 
                        src="<?php echo site_url("produto/imagem/$produto->imagem"); ?>"
                        class="fotoModalProduto border border-3 border-danger" 
                        alt="Nome do produto" 
                      />
                    </div>
                    <div class='d-flex justify-content-center'>
                      <h5 class='border-bottom border-3 border-danger'><?php echo esc($produto->nome); ?></h5>
                    </div> 

                    <!-- ingredientes -->
                    <div class="d-flex justify-content-center">
                      <h5 class='fs-6 ms-3'>
                      <?php echo esc($produto->ingredientes); ?>
                      </h5>   
                    </div>

                    <!-- Medidas -->
                    <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>

                      <div class='d-flex justify-content-center border-bottom border-2 border-danger'>
                        <h5>Medidas:</h5>
                      </div>

                      <?php foreach ($especificacoes as $especificacao): ?>
                        <?php foreach ($especificacao as $esp): ?>

                        <?php if ($esp->produto_id == $produto->id): ?>
                        <div class="form-check  mt-2">
                          <input 
                            type="radio" 
                            class="form-check-input"
                            data-especificacao="<?php echo $esp->especificacao_id; ?>"
                            name="produto[preco]" 
                            value="<?php echo $esp->preco; ?>"
                          />
                          <label class="form-check-label" htmlFor="flexRadioDefault1">
                            <?php echo esc($esp->nome); ?> 
                            R$&nbsp;<?php echo esc(number_format($esp->preco, 2)); ?>
                          </label>
                        </div>
                      <?php endif; ?>
                      <?php endforeach; ?>
                      <?php endforeach; ?>
                    </div>

                    <!-- Extras -->
                    <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>
                      
                      <div class='d-flex mb-2 justify-content-center border-bottom border-2 border-danger'>
                        <h5>Extras:</h5>
                      </div>
                    <?php if (isset($extras)): ?>

                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                        <label class="form-check-label" htmlFor="flexCheckDefault">
                          Sem extra
                        </label>
                      </div>
                      <?php foreach ($extras as $extra): ?>
                        <div class="form-check">
                          <input 
                            type="checkbox" 
                            class="form-check-input"
                            data-extra="<?php echo $extra->id; ?>" 
                            name="extra" 
                            value="<?php echo $extra->preco; ?>" 
                          />
                          <label class="form-check-label" htmlFor="flexCheckDefault">
                            <?php echo esc($extra->nome); ?>
                            R$&nbsp;<?php echo esc(number_format($extra->preco, 2)); ?>
                          </label>
                        </div>
                      <?php endforeach; ?>

                    <?php endif; ?>

                    </div>

                    <!-- Quantidade -->
                    <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>

                      <div class='d-flex justify-content-center border-bottom border-2 border-danger mb-2'>
                        <h5>Quantidade:</h5>
                      </div>

                      <div class='d-flex justify-content-center'>
                        <div class=" d-flex align-items-center">

                          <div class="btn clicked p-2 bg-danger text-white rounded me-1">
                            <i class='las la-arrow-down'></i>
                          </div>

                            <input type="number"  class=' inputNumber' />

                          <div class="btn clicked p-2 bg-danger text-white rounded ms-1">
                            <i  class='las la-arrow-up'></i>
                          </div>
                          
                        </div>
                      </div>
                      
                    </div>

                    <!-- Observações é uma sugestão -->
                    <!-- <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>

                      <div class='d-flex justify-content-center border-bottom border-2 border-danger mb-2'>
                        <h5>Observações:</h5>
                      </div>

                      <div class='d-flex justify-content-center'>
                        <textarea class='form-control' name="" id=""></textarea>
                      </div>
                    </div> -->

                    </div>

                  <!-- end modal body -->
                  
                  <div class="modal-footer d-flex justify-content-center">
                    
                    <button 
                      class="btn btn-sm btn-danger" 
                      data-bs-target="#exampleModalToggle" 
                      data-bs-toggle="modal" 
                      data-bs-dismiss="modal"
                    >
                      Voltar
                    </button>

                    <?php foreach ($especificacoes as $especificacao): ?>

                      <?php if ($especificacao->customizavel): ?>

                        <a href="<?php echo site_url("produto/customizar/$produto->slug"); ?>" class="btn btn-sm btn-primary">Dois sabores</a>

                        <?php break; ?>

                      <?php endif; ?>

                    <?php endforeach; ?>

                    <!-- <button 
                      class="btn btn-sm btn-primary" 
                      data-bs-target="#ModalDoisSabores" 
                      data-bs-toggle="modal" 
                      data-bs-dismiss="modal"
                    >
                      Dois sabores
                    </button> -->

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

                    <!-- Medida -->
                    <?php echo form_open("carrinho/especial"); ?>
                      
                      <div class='border border-2 border-danger rounded-4 py-2 my-1'>
                        <div class='d-flex justify-content-center'>
                          <h5>Medida</h5>
                        </div>
                        
                        <div class='d-flex justify-content-center align-items-center px-1'>
                          <div class='ms-1'>
                            <select class="form-select" aria-label="Default select example">
                              <option >Pequena</option>
                              <option >Média</option>
                              <option >Grande</option>
                              <option >Extra grande</option>
                            </select>
                          </div>
                        </div>

                      </div>

                      <!-- Primeiro sabor -->
                      <div class='border border-2 border-danger rounded-4 py-2 my-1'>
                        
                        <div class='d-flex justify-content-center'>
                          <h5>Primeiro sabor</h5>
                        </div>

                        <div class='mb-2 d-flex justify-content-center'>
                          <img src="<?php echo site_url("produto/imagem/$produto->imagem"); ?>" class="img-custom" alt="Logo da empresa" />
                        </div>

                        <div class='px-2'>
                          <select class="form-select" aria-label="Default select example">
                            <option >calabresa</option>
                            <option >4 queijos</option>
                            <option >Portuguesa</option>
                            <option >Frango com catupyri</option>
                          </select>
                        </div>
                      </div>

                      <!-- Segundo sabor -->
                      <div class='border border-2 border-danger rounded-4 py-2 my-1'>
                        
                        <div class='d-flex justify-content-center'>
                          <h5>Segundo sabor</h5>
                        </div>

                        <div class='mb-2 d-flex justify-content-center'>
                          <img src="<?php echo site_url("produto/imagem/$produto->imagem"); ?>" class="img-custom" alt="Logo da empresa" />
                        </div>

                        <div class='px-2'>
                          <select class="form-select" aria-label="Default select example">
                            <option >calabresa</option>
                            <option >4 queijos</option>
                            <option >Portuguesa</option>
                            <option >Frango com catupyri</option>
                          </select>
                        </div>
                      </div>

                      <!-- Extras -->
                      <div class='border border-2 border-danger rounded-4 py-2 my-1'>
                        
                        <div class='d-flex justify-content-center'>
                          <h5>Extras</h5>
                        </div>

                        <div class='px-4'>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault"/>
                            <label class="form-check-label" htmlFor="flexCheckDefault">
                              Sem extra
                            </label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" id="flexCheckDefault"/>
                            <label class="form-check-label" htmlFor="flexCheckDefault">
                              Cheddar
                            </label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" id="flexCheckDefault"/>
                            <label class="form-check-label" htmlFor="flexCheckDefault">
                              Catupiry
                            </label>
                          </div>
                        </div>

                      </div>

                      <!-- Quantidade -->
                      <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>

                        <div class='d-flex justify-content-center border-bottom border-2 border-danger mb-2'>
                          <h5>Quantidade:</h5>
                        </div>

                        <div class='d-flex justify-content-center'>
                          <div class="inputNumber d-flex align-items-center">

                            <i class='btn clicked p-2 bg-danger text-white rounded me-1'></i>
                              <input type="number"  class='form-control' />
                            <i class='btn clicked p-2 bg-danger text-white rounded ms-1'></i>

                          </div>
                        </div>
                        
                      </div>


                  </div>
                  <!-- end modal body -->
                  
                  <div class="modal-footer d-flex justify-content-center">
                  
                    <button 
                      class="btn btn-sm btn-danger " 
                      data-bs-target="#ModalDetalheProduto" 
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

                    <?php echo form_close(); ?>

                </div>
              </div>
            </div>

          <?php endforeach; ?>
          

        <?php endif; ?>
      
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
                
            <!-- Botão voltar ao cardapio -->
            <div class='text-center mb-2'>
              <a 
                class='btn btn-sm btn-primary' 
                data-bs-target="#" 
                data-bs-toggle="modal" 
                data-bs-dismiss="modal" 
              >
                <i  class="me-1"></i>
                voltar ao cardápio
              </a>
            </div>

            <!-- Produto -->
            <div class="border  border-3  rounded-4 border-danger py-1">
              <div class='d-flex justify-content-center border-bottom border-danger border-3'>
                <h6>Pizza de calabresa</h6>
              </div>
              <div class="d-flex justify-content-between align-items-center px-3 py-1 ">
                <div class='d-flex align-items-center'>
                  <img src="#" class="produtoCart rounded-4" alt="" />
                  <div class=' ms-3'>
                    <h6 class='me-2'>Qtd:5</h6>
                    <span class='span-card me-2'>pequena com extra de bacon</span>
                  </div>       
                </div>
              </div>    
              <div class="ms-2 d-flex">
                <h6>Preço:&nbsp;&nbsp;</h6>
                <h6> R$ 35.00 </h6>
              </div>
              <div class="ms-2 d-flex">
                <h6>soma Parcial:&nbsp;&nbsp;</h6>
                <h6> R$ 175.00 </h6>
              </div>
              <div class='d-flex justify-content-center'>
                <button 
                  class='btn btn-warning rounded-circle me-1'
                  data-bs-target="#ModalEditaProduto" 
                  data-bs-toggle="modal" 
                  data-bs-dismiss="modal"                
                >
                  <i ></i>
                </button>
                <button class='btn btn-danger rounded-circle'>
                  <i ></i>
                </button>
              </div>
            </div>
          
          </div>
          <!-- end modal body -->
          
          <div class="modal-footer d-flex justify-content-center">
            
            <button 
              class="btn btn-sm btn-danger " 
              data-bs-target="#" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              Limpar carrinho
            </button>

            <button 
              class="btn btn-sm btn-primary " 
              data-bs-target="#" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              Voltar ao cardapio
            </button>
            
            <button 
              type="submit" 
              class="btn btn-success btn-sm mr-2 "
              data-bs-target="#ModalFinalizarProduto" 
              data-bs-toggle="modal" 
              data-bs-dismiss="modal"
            >
              Finalizar Pedido
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

            <div class='text-center'>
              <img  class='fotoModalProduto' src="#" alt="" />
            </div>
            <div class='text-center'>
              <h5 class='border-bottom border-3 border-danger'>Pizza de calabresa</h5>
            </div> 

            <!-- Ingredientes -->
            <div class="d-flex justify-content-center">
              <h5 class='fs-6 ms-3'>
                calabresa, cebola, queijo, tomate, milho, azeitona, salsicha
              </h5>   
            </div>

            <!-- Medidas -->
            <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>

              <div class='d-flex justify-content-center border-bottom border-2 border-danger'>
                <h5>Medidas:</h5>
              </div>

              <div class="form-check  mt-2">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"/>
                <label class="form-check-label" htmlFor="flexRadioDefault1">
                  Pequena R$ 25.00
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"/>
                <label class="form-check-label" htmlFor="flexRadioDefault2">
                  Grande R$ 50.00
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"/>
                <label class="form-check-label" htmlFor="flexRadioDefault2">
                  Extra grande R$ 50.00
                </label>
              </div>

            </div>

            <!-- Extras -->
            <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>

              <div class='d-flex mb-2 justify-content-center border-bottom border-2 border-danger'>
                <h5>Extras:</h5>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                <label class="form-check-label" htmlFor="flexCheckDefault">
                  Sem extra
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                <label class="form-check-label" htmlFor="flexCheckDefault">
                  Cheddar
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                <label class="form-check-label" htmlFor="flexCheckDefault">
                  Catupiry
                </label>
              </div>

            </div>

            <!-- Quantidade -->
            <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>

              <div class='d-flex justify-content-center border-bottom border-2 border-danger mb-2'>
                <h5>Quantidade:</h5>
              </div>

              <div class='d-flex justify-content-center'>
                <div class="inputNumber d-flex align-items-center">
                  <i class='btn clicked p-2 bg-danger text-white rounded me-1'></i>
                    <input type="number" class='form-control' />
                  <i class='btn clicked p-2 bg-danger text-white rounded ms-1'></i>
                </div>
              </div>
            </div>

            <!-- Observações é uma sugestão -->
            <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>

              <div class='d-flex justify-content-center border-bottom border-2 border-danger mb-2'>
                <h5>Observações:</h5>
              </div>

              <div class='d-flex justify-content-center'>
                <textarea class='form-control' name="" id=""></textarea>
              </div>
            </div>


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

            <div class='d-flex justify-content-center'>
              <h5 class='border-bottom border-3 border-danger'>Finalizar o pedido:</h5>
            </div> 

            <!-- Pagamento -->
            <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>
              <div class='d-flex justify-content-center border-bottom border-2 border-danger'>
                <h5>Pagamento:</h5>
              </div>

              <div class="form-check  mt-2">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"/>
                <label class="form-check-label" htmlFor="flexRadioDefault1">
                  Dinheiro
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"/>
                <label class="form-check-label" htmlFor="flexRadioDefault2">
                  Credito visa
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"/>
                <label class="form-check-label" htmlFor="flexRadioDefault2">
                  Credito mastercard
                </label>
              </div>
            </div>

            <!-- Select entrega -->
            <div class='d-flex justify-content-center'>
              <h5 class='border-bottom border-3 border-danger'>Entrega:</h5>
            </div>   
            <!-- Select entrega -->
            <div class='d-flex justify-content-center'>
              <select class="form-select" aria-label="Default select example">
                <option value="">Escolha</option>
                <option value="opcao1">Endereço</option>
                <option value="opcao2">Retirada Local</option>
                <option value="opcao3">Mesa</option>
              </select>            
            </div> 

            <!-- Entrega -->
            <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>
              <!-- {endereco && <Endereco/>}
              {retiradaLocal && <RetiradaNoLocal/>}
              {mesa && <NumeroMesa/>} -->
              <!-- Aqui entra um if para mudar a forma de finalizar o pedido -->
              <div>
        
                <div class='d-flex mb-2 justify-content-center border-bottom border-2 border-danger'>
                  <h5>Endereço:</h5>
                </div>
          
                <div class='d-flex justify-content-center'>
                  <h6>CEP da rua</h6>
                </div>
                <form >
                  <input type="text" class="form-control border-bottom border-2 border-danger"/>
                </form>
                
                <div class='d-flex justify-content-center'>
                  <h6>Rua</h6>
                </div>
                <form >
                  <input type="text" class="form-control border-bottom border-2 border-danger"/>
                </form>
                      
                <div class='d-flex justify-content-center'>
                  <h6>N° da casa</h6>
                </div>
                <form >
                  <input type="number" class="form-control border-bottom border-2 border-danger"/>
                </form>
          
                <div class='d-flex justify-content-center'>
                  <h6>Ponto de referência</h6>
                </div>
                <form >
                  <textarea class='form-control border-bottom border-2 border-danger' name="" id=""></textarea>
                </form>
  
              </div>
            </div>
                            
            <!--Resumo do valor -->
            <div class='border border-2 border-danger rounded-4 py-2 px-2 mb-2'>

              <div class='d-flex mb-2 justify-content-center border-bottom border-2 border-danger'>
                <h5>Resumo da conta:</h5>
              </div>

              <div class="d-flex justify-content-center">
                <h6>Total de produtos:</h6>
              </div>
              <div class="d-flex justify-content-center border-bottom border-2 border-danger mb-2">
                <h6 class=''>R$ 27.00</h6>
              </div>
              
              <div class="d-flex justify-content-center">
                <h6>Taxa de entrega:</h6>
              </div>
              <div class="d-flex justify-content-center border-bottom border-2 border-danger mb-2">
                <h6>Obrigatorio</h6>
                <h6 class=''>R$ 27.00</h6>
              </div>
              
              <div class="d-flex justify-content-center">
                <h6>Valor total:</h6>
              </div>
              <div class="d-flex justify-content-center">
                <h6 class=''>R$ 27.00</h6>
              </div>              
            </div>

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