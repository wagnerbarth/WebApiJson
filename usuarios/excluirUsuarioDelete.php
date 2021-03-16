<?php

// headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// inclui banco de dados e objetos
include_once '../config/database.php';
include_once '../objects/usuario.php';

// obtem a conexão com banco de dados
$database = new Database();
$db = $database->getConnection();
 
// cria o objeto usuario
$usuario = new Usuario($db);
 
// define a propriedade a ser verificada
$usuario->email = isset($_GET['email']) ? $_GET['email'] : die();

// exclui o registro 
if($usuario->deleteEmail($usuario->email)){

    // define o código de resposta com 200 ok
    http_response_code(200);
 
    // transforma o array $usuario_arr em json
    echo json_encode(array("message" => "Usuário excluído com sucesso."));
}else{
    // avisa que o usuário não esta cadastrado
    echo json_encode(array("message" => "Usuário não pode ser excluído."));
    
    // define o código de resposta como 404 not found
    //http_response_code(404);
}

