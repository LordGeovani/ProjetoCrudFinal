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
        <title>Cadastro de Usuário</title>
    </head>
    <body>

        <main class="container">

            <div class="pt-2">

                <div class="card">
                    <div class="card-header bg-dark text-light d-flex justify-content-center">
                        <h1>Cadastro de Usuários</h1>
                    </div>
                    <div class="card-body bg-warning text-dark">
                        
                        <form method="post" action="#" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <label for="txtEmail" class="form-label, py-3" >E-mail:</label>
                                    <input type="email" name="txtEmail" id="txtEmail" required class="form-control">
                                </div>
                                <div class="col-md"></div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <label for="txtSenha" class="form-label, py-3">Senha:</label>
                                    <input type="password" name="txtSenha" id="txtSenha" required class="form-control">
                                </div>
                                <div class="col-md"></div>
                            </div>

                            <div class="row d-flex justify-content-center">
                                <div class="col-md-2 py-3 d-flex justify-content-center">
                                    <button type="submit" class="btn bg-light text-black ">Logar</button>
                                </div> 
                            </div>
                            
                            <?php
                                include "../model/connect.php"; 

                                

                                $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
                                $senha = isset($_POST['txtSenha']) ? $_POST['txtSenha'] : '';

                                if(isset($_POST['txtEmail']) && isset($_POST['txtSenha'])){
                                    $sql = "SELECT  senha, email FROM usuario WHERE email='$email' AND senha='$senha'";
                                    
                                    $result = $conn->query($sql);

                                    if($result->num_rows === 1){
                                        session_start();

                                        $_SESSION['email'] = $email;
                                        header("Location: formulario.php");
                                    }else{
                                        $html = <<<HTML
                                        <div class="row d-flex justify-content-center">
                                            <div class="rounded col-md-4 bg-dark text-light py-2 d-flex justify-content-center text-align-justify">
                                                <p>Falha ao logar, por favor verifique email e senha!</h1>
                                            </div>
                                        </div>
HTML;
                                        echo $html;
                                    }
                                }

                            ?>

                        </form>

                    </div>
                    <div class="card-footer bg-dark text-light d-flex justify-content-center">
                        <p>Todos os direitos reservados. By Geovani</p>
                    </div>
                </div>

            </div>
            
        </main>

    </body>
</html>