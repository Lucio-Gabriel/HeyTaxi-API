<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if( $method === 'get' ){

    $id = filter_input(INPUT_GET, 'id');

    if($id){
        $sql = $pdo->prepare("SELECT * FROM taxistas WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){

            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [
                'id' => $data['id'],
                'nome' => $data['nome'], 
                'cpf' => $data['cpf'],
                'numeroTelefone' => $data['numeroTelefone'],
                'modeloCarro' => $data['modeloCarro'],
                'placaCarro' => $data['placaCarro']
            ];
        }
        else{
            $array['error'] = 'ID inexistente';
        }
    }
    else {
        $array['error'] = 'ID não enviado';
    }
}
else{
    $array['error'] = 'Método não permitido (apenas GET)';
}

require('../return.php');
