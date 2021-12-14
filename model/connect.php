<?php

include "../config/config.php";

//Criar um objeto  de conexão (instância)
$conn = new mysqli($hostName, $userName, $password, $database);

//testar a conexão
if ($conn->connect_error){
    die("Erro de conexão: " . $conn->connect_error);
}

//exibir mensagem
if($flag_exibir){
    echo "<br> Conexão bem sucedida";
}
