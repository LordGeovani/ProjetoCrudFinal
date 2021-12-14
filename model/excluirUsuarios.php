<?php

    //Processo de exclusão
    //Recuperar dado por GET
    $id = $_GET['id_usuario'];
    
    include "connect.php";
    
    $avatar = "";
    $pasta = "../assets/avatar/"; 

    $sql = "DELETE FROM usuario WHERE id='$id'";

    //Deletar avatar
    $consult = "SELECT * FROM usuario WHERE id='$id'";

    //Executar a query
    $result = $conn->query($consult);
    if($linha = $result->fetch_array()){
        $avatar = $linha['avatar'];
    }
    

    if($conn->query($sql)) {
        if($avatar != null){
            unlink($pasta.$avatar);
        }
        $conn->close();
        require_once "../view/exibirUsuarios.php";
    }else{
        echo "Error: " . $conn->error;
    }
