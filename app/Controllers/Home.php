<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $categoriaModel;
    private $produtoModel;
    private $produtoEspecificacaoModel;

    public function __construct() {
        $this->categoriaModel = new \App\Models\CategoriaModel();
        $this->produtoModel = new \App\Models\ProdutoModel();
        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
    }

    public function index()
    {
        $produtos = $this->produtoModel->buscaProdutosWebHome();
        $especificacoes = array();
        foreach ($produtos as $key => $produto) {
            $especificacoes[$key] = $this->produtoEspecificacaoModel->buscaEspecificacoesDoProdutoDetalhes($produto->id);
        }
        // dd($especificacoes);
        $data = [
            'titulo' => 'Seja bem vindo(a)!',
            'categorias' => $this->categoriaModel->buscaCategoriasWebHome(),
            'produtos' => $this->produtoModel->buscaProdutosWebHome(),
            'especificacoes' => $especificacoes,
        ];
        
        return view('Home/index', $data);
    }

    // public function email()
    // {
    //     $email = \Config\Services::email();

    //     $email->setFrom('your@example.com', 'Your Name');
    //     $email->setTo('sowadok608@chokxus.com');
    //     // $email->setCC('another@another-example.com');
    //     // $email->setBCC('them@their-example.com');

    //     $email->setSubject('Email Test');
    //     $email->setMessage('Testing the email class.');

    //     if ($email->send()) {
    //         echo 'Email sent successfully';
    //     } else {
    //         echo $email->printDebugger();
    //     }
    // }
}
