<?php
session_start();
include('functions/funcoes.php');
include('functions/conexao.php');
if(!empty($_SESSION['id'])){   
}else{header("Location: ../index.php");}
if($_SESSION['tipo'] == 'Administrador'){}
else{$_SESSION['msg']='Você não Tem permissão para acessar essa pagina!</br>';
header("Location:../src.php?pg=painel");} 
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
</head>

<body>
    <center>
        <div class='jumbotron  container'>
            <h1>Painel de controle</h1>
            </br>
            <a class="text-decoration-none text-reset" href="cadastrar.php?pg=cadastrar"><button type="button"
                    class="btn btn-primary">Adicionar Aluno</button></a>
            <a class="text-decoration-none text-reset" href="cadastrar.php?pg=apagar"><button type="button"
                    class="btn btn-primary">Excluir Aluno</button></a>
            <a class="text-decoration-none text-reset" href="cadastrar.php?pg=subirvideo"><button type="button"
                    class="btn btn-primary">Adicionar Vídeo</button></a>
            <a class="text-decoration-none text-reset" href="cadastrar.php?pg=mudar"><button type="button"
                    class="btn btn-primary">Mudar Senha</button></a>
            <a class="text-decoration-none text-reset" href="cadastrar.php?pg=subirhomenagem"><button type="button"
                    class="btn btn-primary">Adicionar Homenagem</button></a>
            <a class="text-decoration-none text-reset" href="../src.php?pg=painel"><button type="button"
                    class="btn btn-primary">Voltar</button></a>
        </div>
    </center>
    <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
<?php


$pagina = $_GET['pg'];
if ($pagina == 'cadastrar'){
    $btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
    if($btnCadUsuario){
        include_once 'functions/conexao.php';
        $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $erro = false;
        $dados_st = array_map('strip_tags', $dados_rc);
        $dados = array_map('trim', $dados_st);
        if(in_array('',$dados)){
            $erro = true;
            $_SESSION['msg'] = "Necessário preencher todos os campos";
        }elseif((strlen($dados['senha'])) < 6){
            $erro = true;
            $_SESSION['msg'] = "A senha deve ter no minímo 6 caracteres";
        }elseif(stristr($dados['senha'], "'")) {
            $erro = true;
            $_SESSION['msg'] = "Caracter ( ' ) utilizado na senha é inválido";
        }else{
            $result_usuario = "SELECT id FROM usuarios WHERE nome='". $dados['nome'] ."'";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
            if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
                $erro = true;
                $_SESSION['msg'] = "Esse nome já consta no sistema!";
            }	
            $result_usuario = "SELECT id FROM usuarios WHERE matricula='". $dados['matricula'] ."'";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
            if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
                $erro = true;
                $_SESSION['msg'] = "Esta matricula já foi cadastrada";
            }
        }
        if(!$erro){
            $tipo = $dados['turma'];
            $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $result_usuario = "INSERT INTO usuarios (nome, matricula, senha, tipo) VALUES ('" .$dados['nome']. "','" .$dados['matricula']. "','" .$dados['senha']. "','$tipo')";
            $resultado_usario = mysqli_query($conn, $result_usuario);
            if(mysqli_insert_id($conn)){
                $_SESSION['msg'] = "Usuário cadastrado com sucesso";
            }else{
                $_SESSION['msg'] = "Erro ao cadastrar o usuário";
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <center>
        <h2>Cadastro</h2>
        <?php
                if(isset($_SESSION['msg'])){
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo$_SESSION['msg'];
                    echo"</div>";
                    unset($_SESSION['msg']);
                }
            ?><p>
            <form method="POST" action="">
                <label>Nome</label>
                <input type="text" name="nome" placeholder="Digite seu nome e o sobrenome">
                <label>Matricula</label>
                <input type="matricula" name="matricula" placeholder="Digite a sua matricula">
                <label for="turma">Turma</label>
                <select name="turma">
                    <option value="">--</option>
                    <option value="infantil02">Infantil 2</option>
                    <option value="infantil03">Infantil 3</option>
                    <option value="infantil04">Infantil 4</option>
                    <option value="infantil05">Infantil 5</option>
                    <option value="01ano">1° Ano</option>
                    <option value="02ano">2° Ano</option>
                    <option value="03ano">3° Ano</option>
                    <option value="04ano">4° Ano</option>
                    <option value="05ano">5° Ano</option>
                </select>
                <label>Senha</label>
                <input type="password" name="senha" placeholder="Digite uma senha" />
                <br>
                <input type="submit" name="btnCadUsuario" value="Cadastrar"><br>
            </form>
    </center>
    <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
<?php  
}

if ($pagina == 'apagar'){
    $btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
    if($btnCadUsuario){
        include_once 'functions/conexao.php';
        $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $erro = false;
        $dados_st = array_map('strip_tags', $dados_rc);
        $dados = array_map('trim', $dados_st);
        $checkresult = "SELECT nome FROM usuarios WHERE matricula = ".$dados['matricula']."";
        echo($checkresult);
        $checkresultado = mysqli_fetch_array(mysqli_query($conn, $checkresult));
        var_dump($checkresultado);
        if ($checkresultado['nome'] != $dados['nome']){
            $_SESSION['msg'] = "Dados incorretos!";
        }else{
            $result = "DELETE FROM usuarios WHERE (`matricula` = '".$dados['matricula']."')";
            $resultido = mysqli_query($conn, "DELETE FROM sessoes WHERE (`matricula` = '".$dados['matricula']."')");
            if(mysqli_query($conn, $result)){$_SESSION['msg'] = "Aluno excluido com sucesso";}
        }
    }
    ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Apagar Aluno</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <center>
        <h2>Excluir Aluno</h2>
        <?php
                if(isset($_SESSION['msg'])){
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo$_SESSION['msg'];
                    echo"</div>";
                    unset($_SESSION['msg']);
                }
            ?><p>
            <form method="POST" action="">
                <label>Nome</label>
                <input type="text" name="nome" placeholder="Digite o nome do aluno">
                <label>Matrícula</label>
                <input type="text" name="matricula" placeholder="Digite a matrícula do aluno">
                <br><input type="submit" name="btnCadUsuario" value="Excluir">
            </form>
    </center>
    <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
}


if ($pagina == 'mudar'){
    $btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
    include_once 'functions/conexao.php';
    if($btnCadUsuario){
        include_once 'functions/conexao.php';
        $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $erro = false;
        $dados_st = array_map('strip_tags', $dados_rc);
        $dados = array_map('trim', $dados_st);
        if(in_array('',$dados)){
            $erro = true;
            $_SESSION['msg'] = "Necessário preencher todos os campos";
        }elseif((strlen($dados['senha'])) < 6){
            $_SESSION['msg'] = "A senha deve ter no minímo 6 caracteres";
        }elseif(stristr($dados['senha'], "'")) {
            $_SESSION['msg'] = "Caracter ( ' ) utilizado na senha é inválido";
        }else{
            $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $result_usuario = "UPDATE usuarios SET senha = '" .$dados['senha']. "' WHERE matricula = '" .$dados['matricula']. "'";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
            if($resultado_usario = true){
                $_SESSION['msg'] = "Senha alterada com sucesso";
            }else{
                $_SESSION['msg'] = "Erro ao mudar senha";
            }
        }
        }
    ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Mudar Senha</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <center>
        <h2>Cadastro</h2>
        <?php
                if(isset($_SESSION['msg'])){
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo$_SESSION['msg'];
                    echo"</div>";
                    unset($_SESSION['msg']);
                }
            ?><p>
            <form method="POST" action="">
                <label>Matricula</label>
                <input type="matricula" name="matricula" placeholder="Digite a matricula do aluno">
                <label>Senha</label>
                <input type="password" name="senha" placeholder="Digite uma nova senha" />
                <br>
                <input type="submit" name="btnCadUsuario" value="Mudar"><br>
            </form>
    </center>
    <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
<?php }

























if ($pagina == 'subirvideo'){
    $btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
    if($btnCadUsuario){
        include_once 'functions/conexao.php';
        $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $erro = false;
        $dados_st = array_map('strip_tags', $dados_rc);
        $dados = array_map('trim', $dados_st);
        if(in_array('',$dados)){
            $erro = true;
            $_SESSION['msg'] = "Necessário preencher todos os campos";
        }else{          
            $result_usuario = "SELECT id FROM videos WHERE link='". $dados['link'] ."'";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
            if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
                $erro = true;
                $_SESSION['msg'] = "Esta video já foi cadastrada";
            }
        }
        if(!$erro){
            $tipo = $dados['turma'];
            $result_usuario = "INSERT INTO videos (num_fila, link, sala) VALUES ('" .$dados['numero']. "','" .$dados['link']. "','$tipo')";
            $resultado_usario = mysqli_query($conn, $result_usuario);
            if(mysqli_insert_id($conn)){
                $_SESSION['msg'] = "Video cadastrado com sucesso";
            }else{
                $_SESSION['msg'] = "Erro ao cadastrar o video";
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Subir Videos</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <center>
        <h2>Cadastro</h2>
        <?php
                if(isset($_SESSION['msg'])){
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo$_SESSION['msg'];
                    echo"</div>";
                    unset($_SESSION['msg']);
                }
            ?><p>
            <form method="POST" action="">
                <label>Numero na Fila</label>
                <input type="number" name="numero" placeholder="digite um número">
                <label>Link</label>
                <input type="limk" name="link" placeholder="digite apenas o codigo contido na url">
                <label for="turma">Turma</label>
                <select name="turma">
                    <option value="">--</option>
                    <option value="infantil02">Infantil 2</option>
                    <option value="infantil03">Infantil 3</option>
                    <option value="infantil04">Infantil 4</option>
                    <option value="infantil05">Infantil 5</option>
                    <option value="01ano">1° Ano</option>
                    <option value="02ano">2° Ano</option>
                    <option value="03ano">3° Ano</option>
                    <option value="04ano">4° Ano</option>
                    <option value="05ano">5° Ano</option>
                </select>
                <br>
                <input type="submit" name="btnCadUsuario" value="Cadastrar"><br>
            </form>
    </center>
    <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
}































if ($pagina == 'subirhomenagem'){
    $btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
    if($btnCadUsuario){
        include_once 'functions/conexao.php';
        $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $erro = false;
        $dados_st = array_map('strip_tags', $dados_rc);
        $dados = array_map('trim', $dados_st);
        if(in_array('',$dados)){
            $erro = true;
            $_SESSION['msg'] = "Necessário preencher todos os campos";
        }else{          
            $result_usuario = "SELECT id FROM videos WHERE link='". $dados['link'] ."'";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
            if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
                $erro = true;
                $_SESSION['msg'] = "Esta video já foi cadastrado";
            }
        }
        if(!$erro){
            $tipo = 'homenagem';
            $result_usuario = "INSERT INTO videos (num_fila, link, sala, nome) VALUES ('" .$dados['numero']. "','" .$dados['link']. "','$tipo', '" .$dados['nome']. "')";
            $resultado_usario = mysqli_query($conn, $result_usuario);
            if(mysqli_insert_id($conn)){
                $_SESSION['msg'] = "Video cadastrado com sucesso";
            }else{
                $_SESSION['msg'] = "Erro ao cadastrar o video";
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Subir Homenagem</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <center>
        <h2>Cadastro</h2>
        <?php
                if(isset($_SESSION['msg'])){
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo$_SESSION['msg'];
                    echo"</div>";
                    unset($_SESSION['msg']);
                }
            ?><p>
            <form method="POST" action="">
                <label>Numero na Fila</label>
                <input type="number" name="numero" placeholder="Digite um número">
                <label>Link</label>
                <input type="link" name="link" placeholder="Digite apenas o codigo contido na url">
                <label>Nome da Homenagem</label>
                <input type="name" name="nome" placeholder="Digite com atenção">
                <br>
                <input type="submit" name="btnCadUsuario" value="Cadastrar"><br>
            </form>
    </center>
    <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
}
