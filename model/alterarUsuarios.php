<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>Noticias Cidade - Cadastro de Usuário</title>
    </head>
    <body>
        <?php

            if(session_status() != PHP_SESSION_ACTIVE){
                session_start();
            }

            if(isset($_SESSION['email'])){
                
            }else{
                unset($_SESSION['email']);
                header("Location: ../index.php");
            }
        ?>
        <main class="pt-6 container">

            <div class="pt-2">

                <div class="card">
                    <div class="card-header bg-dark text-light d-flex justify-content-center">
                    <h1>Alteração de dados do usuário</h1>
                    </div>
                    <div class="card-body bg-warning text-dark">
                <?php

                /*
                +----------+--------------+------+-----+---------------------+----------------+
                | Field    | Type         | Null | Key | Default             | Extra          |
                +----------+--------------+------+-----+---------------------+----------------+
                | id       | int(11)      | NO   | PRI | NULL                | auto_increment |
                | nome     | varchar(255) | YES  |     | NULL                |                |
                | email    | varchar(255) | YES  | UNI | NULL                |                |
                | sexo     | varchar(10)  | YES  |     | NULL                |                |
                | telefone | varchar(25)  | YES  |     | NULL                |                |
                | senha    | varchar(255) | YES  |     | NULL                |                |
                | dtnasc   | varchar(25)  | YES  |     | NULL                |                |
                | tipo     | varchar(25)  | YES  |     | NULL                |                |
                | avatar   | varchar(255) | YES  |     | NULL                |                |
                | data     | timestamp    | NO   |     | current_timestamp() |                |
                +----------+--------------+------+-----+---------------------+----------------+
                */

                    include "connect.php";

                    $id = $_POST['txtId'];
                    $nomeNovo = $_POST['txtNome'];
                    $emailNovo = $_POST['txtEmail'];
                    $sexoNovo = $_POST['txtSexo'];
                    $telefoneNovo = $_POST['txtFone'];
                    $senhaNovo = $_POST['txtSenha'];
                    $dtNascNovo = $_POST['txtNascimento'];
                    $tipoNovo = $_POST['txtTipo'];
                    $avatarNovo = "";
                    $avatar = "";
                    $dir = "../assets/avatar/";

                    $consult = "SELECT * FROM usuario WHERE id='$id'";

                    $result = $conn->query($consult);

                    if($linha = $result->fetch_array()){
                        $avatar = $linha['avatar'];
                        $senha = $linha['senha'];
                    }

                    if($_FILES['txtAvatar']['name']){//verifico se foi selecionada uma imagem

                        unlink($dir.$avatar);

                        $arr_ext = $_FILES['txtAvatar']['name'];
                        $separa = explode(".", $arr_ext);
                        $ext = array_reverse($separa);//Obtem a ext no indice 0 do array
                        $avatarNovo = strtolower($emailNovo . "." . $ext[0]);

                        //Mover o arquivo para o dir
                        $from = $_FILES['txtAvatar']['tmp_name'];
                        $to = $dir . $avatarNovo;
                        move_uploaded_file($from, $to);

                    }else{
                        $avatarNovo = null;
                    }
    
                    if ($senhaNovo != null && $senhaNovo != $senha) {
                        $sql = "UPDATE usuario SET
                        nome = '$nomeNovo',
                        email = '$emailNovo',
                        sexo = '$sexoNovo',
                        telefone = '$telefoneNovo',
                        senha = '$senhaNovo',
                        dtnasc = '$dtNascNovo',
                        tipo = '$tipoNovo',
                        avatar = '$avatarNovo'
                        WHERE id = '$id'";

                        $res = $conn->query($sql);

                        if($res){
                            $html = <<<HTML
                            <div class="row justify-content-center">
                                <div class="rounded col-md-6 bg-dark text-light py-2 justify-content-center">
                                    <p class="text-center" >Senha e dados atualizados com sucesso. Anote sua nova senha!</h1>
                                </div>
                            </div>               
HTML;
                            echo $html;
                        }else{
                            $html = <<<HTML
                            <div class="row justify-content-center">
                                <div class="rounded col-md-6 bg-dark text-light py-2 justify-content-center">
                                    <p class="text-center" >Ocorreu um erro ao tentar atualizar os dados</h1>
                                </div>
                            </div>               
HTML;
                            echo $html;
                        }
                    } else {
                        $sql = "UPDATE usuario SET
                        nome = '$nomeNovo',
                        email = '$emailNovo',
                        sexo = '$sexoNovo',
                        telefone = '$telefoneNovo',
                        dtnasc = '$dtNascNovo',
                        tipo = '$tipoNovo',
                        avatar = '$avatarNovo'
                        WHERE id = '$id'";

                        $res = $conn->query($sql);

                        if($res){
                            $html = <<<HTML
                            <div class="row justify-content-center">
                                <div class="rounded col-md-6 bg-dark text-light py-2 justify-content-center">
                                    <p class="text-center" >Dados alterados com sucesso! Senha não foi alterada.</h1>
                                </div>
                            </div>               
HTML;
                            echo $html;
                        }else{
                            $html = <<<HTML
                            <div class="row justify-content-center">
                                <div class="rounded col-md-6 bg-dark text-light py-2 justify-content-center">
                                    <p class="text-center" >Ocorreu um erro ao tentar atualizar os dados.</h1>
                                </div>
                            </div>               
HTML;
                            echo $html;
                            //header('Location: view/formAlterarUsuarios.php');
                        }
                    }
                    $conn->close();
                    ?> 
                    <div class=" d-flex justify-content-center">

                        <div class="col-md-2 py-3">
                            <a href="../view/formulario.php" class="btn bg-light text-black">Voltar para cadastro</a>
                        </div>
                        <div class="col-md-2 py-3">
                            <a href="../view/exibirUsuarios.php" class="btn bg-light text-black">Listar usuários</a>
                        </div> 

                    </div>
                </div>

                <div class="card-footer bg-dark text-light d-flex justify-content-center">
                    <p>Todos os direitos reservados. By Geovani</p>
                </div>
                </div>           
            </div> 
        </main>
    </body>
</html>