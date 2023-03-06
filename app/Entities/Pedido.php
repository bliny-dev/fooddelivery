<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Pedido extends Entity
{
    protected $dates   = [
        'criado_em', 
        'atualizado_em', 
        'deletado_em'
    ];

    public function exibeSituacaoDoPedido() {

        switch ($this->situacao) {
            case 0:
                echo "<span class='fs-4 las la-concierge-bell text-warning'></span>&nbsp;Em espera";
                break;
            case 1:
                echo "<span class='fs-4 las la-motorcycle text-info'></span>&nbsp;Em rota";
                break;
            case 2:
                echo "<span class='fs-4 las la-money-bill-wave text-success'></span>&nbsp;Entregue";
                break;
            case 3:
                echo "<span class='fs-4 las la-la-exclamation-triangle text-danger'></span>&nbsp;cancelado";
                break;
        }
    }
}
