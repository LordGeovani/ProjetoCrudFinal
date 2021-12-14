<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>Lista de Usuários</title>
    </head>
    <body>
        
        <!--
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
        -->
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
        <main class="container">
            <div class="pt-4">

                <div class="card">
                    <div class="card-header bg-dark text-light d-flex flex-column">
                        <div class="row">
                            <div class="col-md-10">
                                <h1>Listar Usuários</h1>
                            </div>
                            <div class="col-md-1 py-2 d-flex flex-column-reverse">
                                <a href="../model/logout.php" class="btn bg-light text-black">Sair</a>
                            </div>
                        </div>
                    </div>
                        
                    <div class="card-body">

                        <form method="POST" action="#">

                            <div class="col pb-3">
                                <div class="col-md-2"></div>

                                <div clas="col-md-6">
                                    <input 
                                        id="txtPesq" 
                                        name="txtPesq" 
                                        type="seach" 
                                        class="form-control"  
                                       value="<?= isset($_POST['txtPesq']) ? $_POST['txtPesq'] : "" ?>"
                                    >
                                </div>
                                
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-2">
                                    <button type="submit" class="btn-warning text-black">Pesquisar por nome</button>
                                </div>    
                            </div> 

                            <div class="table-responsive">
                                <table class="table align-middle table-striped table-hover">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th scope="col" class="border border-dark">ID</th>
                                            <th scope="col" class="border border-dark">NOME</th>
                                            <th scope="col" class="border border-dark">EMAIL</th>
                                            <th scope="col" class="border border-dark">SEXO</th>
                                            <th scope="col" class="border border-dark">TELEFONE</th>
                                            <th scope="col" class="border border-dark">DATA DE NASCIMENTO</th>
                                            <th scope="col" class="border border-dark">TIPO</th>
                                            <th scope="col" class="border border-dark">AÇÃO</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        include "../model/connect.php";

                                        //Receber dados do seach do form
                                        $nomePesq = isset($_POST['txtPesq']) ? $_POST['txtPesq'] : "";

                                        $sql = "SELECT * FROM usuario WHERE nome LIKE '%$nomePesq%'";
                                        //Buscar no banco de dados por meio da query select
                                        $result = $conn->query($sql);

                                        //Mostar a lista na tabela
                                        while($linha = $result->fetch_array()){
                                            $id = $linha['id'];
                                            $nome = $linha['nome'];
                                            $email = $linha['email'];
                                            $sexo = $linha['sexo'];
                                            $telefone = $linha['telefone'];
                                            $senha = $linha['senha'];
                                            $date = date_create($linha['dtnasc']);
                                            $nascimento = date_format($date,"Y/m/d");
                                            $tipo = $linha['tipo'];
                                            
                                            $html = <<<HTML

                                            <tr>
                                                <td scope="col" class="border border-dark">$id</td>
                                                <td scope="col" class="border border-dark">$nome</td>
                                                <td scope="col" class="border border-dark">$email</td>
                                                <td scope="col" class="border border-dark">$sexo</td>
                                                <td scope="col" class="border border-dark">$telefone</td>
                                                <td scope="col" class="border border-dark">$nascimento</td>
                                                <td scope="col" class="border border-dark">$tipo</td>
                                                <td scope="col" class="border border-dark">
                                                    <a href='formAlterarUsuarios.php?id_usuario=$id' class="text-decoration-none">
                                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 
                                                        width="16px" height="16px" viewBox="0 0 528.899 528.899" style="enable-background:new 0 0 528.899 528.899;" xml:space="preserve">
                                                            <path d="M328.883,89.125l107.59,107.589l-272.34,272.34L56.604,361.465L328.883,89.125z M518.113,63.177l-47.981-47.981
                                                            c-18.543-18.543-48.653-18.543-67.259,0l-45.961,45.961l107.59,107.59l53.611-53.611
                                                            C532.495,100.753,532.495,77.559,518.113,63.177z M0.3,512.69c-1.958,8.812,5.998,16.708,14.811,14.565l119.891-29.069
                                                            L27.473,390.597L0.3,512.69z"/>
                                                        </svg>
                                                    </a>
                                                    <a href='../model/excluirUsuarios.php?id_usuario=$id' class="text-decoration-none">
                                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 
                                                        width="16px" height="16px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                            <path d="M432,96h-48V32c0-17.672-14.328-32-32-32H160c-17.672,0-32,14.328-32,32v64H80c-17.672,0-32,14.328-32,32v32h416v-32
                                                            C464,110.328,449.672,96,432,96z M192,96V64h128v32H192z"/>
                                                            <path d="M80,480.004C80,497.676,94.324,512,111.996,512h288.012C417.676,512,432,497.676,432,480.008v-0.004V192H80V480.004z
                                                            M320,272c0-8.836,7.164-16,16-16s16,7.164,16,16v160c0,8.836-7.164,16-16,16s-16-7.164-16-16V272z M240,272
                                                            c0-8.836,7.164-16,16-16s16,7.164,16,16v160c0,8.836-7.164,16-16,16s-16-7.164-16-16V272z M160,272c0-8.836,7.164-16,16-16
                                                            s16,7.164,16,16v160c0,8.836-7.164,16-16,16s-16-7.164-16-16V272z"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
HTML;
                                        echo $html;
                                        }
                                        $result->close();

                                        $conn->close();
                                    ?>
                                    </tbody>
                                </table>
                        
                            </div>
                        </form>
                        <div class=" g-3 text-light">
                            <div class="col-md pb-3">
                                <div class="d-grid gap-2 d-flex justify-content-center">
                                    <a href="formulario.php" class="btn btn-warning text-black">Voltar</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class=" g-3 pt-3 bg-dark text-light">
                        <div class="col-md pb-3">
                            <div class="d-grid gap-2 d-flex justify-content-center">
                                <p>Todos os direitos reservados. By Geovani</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </body>
</html>