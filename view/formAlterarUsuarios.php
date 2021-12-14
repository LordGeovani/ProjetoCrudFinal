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
        <title>Alterar Usuário</title>
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

        //Receber o id do usuário a ser alterado
        $id = isset($_GET['id_usuario'])? $_GET['id_usuario'] : "";
        
        //Conectar no banco
        include "../model/connect.php";
        $sql = "SELECT * FROM usuario WHERE id='$id'";

        //Executar a query
        $result = $conn->query($sql);
        if($linha = $result->fetch_array()){
            $id = $linha['id'];
            $nome = $linha['nome'];
            $email = $linha['email'];
            $sexo = $linha['sexo'];
            $telefone = $linha['telefone'];
            $senha = $linha['senha'];
            $nascimento = $linha['dtnasc'];
            $tipo = $linha['tipo'];
            $avatar = $linha['avatar'];
        }


        ?>

        <main class="container">

            <div class="pt-2">

                <div class="card">
                    <div class="card-header bg-dark text-light d-flex flex-column">
                        <div class="row">
                            <div class="col-md-10">
                                <h1>Alteração de dados do usuário</h1>
                            </div>
                            <div class="col-md-1 py-2 d-flex flex-column-reverse">
                                <a href="../model/logout.php" class="btn bg-light text-black">Sair</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-warning text-dark">
                        
                        <form method="POST" action="../model/alterarUsuarios.php" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md-12" style="display:none;">
                                    <label for="txtId" class="form-label">ID</label>
                                    <input type="text" name="txtId"  id="txtId" class="form-control" required value="<?= isset($id) ? $id : '' ?>" >
                                </div>
                            </div>                  
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="txtNome" class="form-label, py-3">Nome:</label>
                                    <input 
                                        type="text" 
                                        name="txtNome" 
                                        id="txtNome" 
                                        class="form-control"
                                        value="<?= isset($nome)?$nome:''?>"
                                        >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="txtEmail" class="form-label, py-3" >E-mail:</label>
                                    <input 
                                        type="email" 
                                        name="txtEmail" 
                                        id="txtEmail" 
                                        class="form-control"
                                        value="<?= isset($email)?$email:''?>"
                                        >
                                </div>

                                <div class="col-md-6">
                                    <label for="txtSenha" class="form-label, py-3">Senha:</label>
                                    <input type="password" name="txtSenha" id="txtSenha" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="txtFone" class="form-label, py-3">Telefone:</label>
                                    <input 
                                        type="tel" 
                                        name="txtFone" 
                                        id="txtFone" 
                                        placeholder="(XX) XXXXX-XXXX" 
                                        class="form-control"
                                        value="<?= isset($telefone)?$telefone:''?>"
                                        >
                                </div>

                                <div class="col-md-4">
                                    <label for="txtNascimento" class="form-label, py-3">Data de nascimento:</label>
                                    <input 
                                        type="date" 
                                        name="txtNascimento" 
                                        id="txtNascimento" 
                                        class="form-control"
                                        value="<?= isset($nascimento)?$nascimento:''?>"
                                        >
                                </div>

                                <div class="col-md-4">
                                    <label for="txtSexo" class="form-label, py-3">Sexo:</label><br>
                                    <select id="txtSexo" name="txtSexo" class="form-control" checked="checked">
                                        <option value="f" <?= $sexo == 'f' ? 'selected' : ''?>>Feminino</option>
                                        <option value="m" <?= $sexo == 'm' ? 'selected' : ''?>>Masculino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="txtTipo" class="form-label, py-3">Tipo:</label><br>
                                    <select id="txtTipo" name="txtTipo" class="form-control" checked="checked">
                                        <option value="user" <?= $tipo == 'user' ? 'selected' : ''?>>Usuário</option>
                                        <option value="adm"  <?= $tipo == 'adm' ? 'selected' : ''?>>Administrador</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="txtAvatar" class="form-label, py-3">Avatar:</label>
                                    <input type="file" name="txtAvatar" id="txtAvatar" class="form-control">
                                </div>
                            </div>

                            <div class="row d-flex justify-content-center">
                                <div class="col-md-2 py-3">
                                    
                                    <button type="submit" class="btn bg-light text-black">Atualizar</button>
                                    
                                </div>
                                <div class="col-md-2 py-3">
                                    <a href="exibirUsuarios.php" class="btn bg-light text-black">Listar usuários</a>
                                </div> 
                                <div class="col-md-3 py-3">
                                    <a href="formulario.php" class="btn bg-light text-black">Voltar para o Cadastro</a>
                                </div> 
                            </div>

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






