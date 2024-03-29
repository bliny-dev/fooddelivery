<?php

if (!function_exists('consultaCep')) {
    
    function consultaCep(string $cep) {

        $urlViaCep = "https://viacep.com.br/ws/{$cep}/json/";

        /* Abre a conexão */
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $urlViaCep);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* Executamos o POST */
        $json = curl_exec($ch);
        
        /* Decodificando o objeto JSON */
        $resultado = json_decode($json);

        /* Fechamos a conexão */
        return $resultado;
    }
}