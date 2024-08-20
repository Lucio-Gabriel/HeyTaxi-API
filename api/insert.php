<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if( $method === 'post' ) {

    $nome = filter_input(INPUT_POST, 'nome');
    $cpf = filter_input(INPUT_POST, 'cpf');
    $numeroTelefone = filter_input(INPUT_POST, 'numeroTelefone');
    $modeloCarro = filter_input(INPUT_POST, 'modeloCarro');
    $placaCarro = filter_input(INPUT_POST, 'placaCarro');

    if( $nome && $cpf && $numeroTelefone && $modeloCarro && $placaCarro ){

        $sql = $pdo->prepare("INSERT INTO taxistas (nome, cpf, numeroTelefone, modeloCarro, placaCarro) VALUES (:nome, :cpf, :numeroTelefone, :modeloCarro, :placaCarro)");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':cpf', $cpf);
        $sql->bindValue(':numeroTelefone', $numeroTelefone);
        $sql->bindValue(':modeloCarro', $modeloCarro);
        $sql->bindValue(':placaCarro', $placaCarro);
        $sql->execute();

        // retornando os objetos
        $id = $pdo->lastInsertId();

        $array['result'] = [
            'id' => $id,
            'nome' => $nome,
            'cpf' => $cpf,
            'numeroTelefone' => $numeroTelefone,
            'modeloCarro' => $modeloCarro,
            'placaCarro' => $placaCarro
        ];
    }
    else{
        $array['error'] = 'Algum dos campos não foram preenchidos';
    }
}
else{
    $array['error'] = 'Método não permitido (apenas POST)';
}

require('../return.php');