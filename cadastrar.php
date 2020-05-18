<?php
ob_start();
session_start();
include("functions/funcoes.php");
$_SESSION['hora_entrada'] = hora_entrada();
if(!empty($_SESSION['id'])){   
}else{header("Location: ../index.php");}
if($_SESSION['tipo'] == 'Administrador'){}
else{$_SESSION['msg']='Você não Tem pérmissão para acessar essa pagina!</br>';
header("Location:../src.php?pg=painel");}
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
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        </head>
        <body><center>
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
                <input type="password" name="senha" placeholder="Digite uma senha"/>
            <br>	
                <input type="submit" name="btnCadUsuario" value="Cadastrar"><br>
            </form>
            </center>
            <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </body>
    </html>
<?php }

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
            $erro = true;
            $_SESSION['msg'] = "A senha deve ter no minímo 6 caracteres";
        }elseif(stristr($dados['senha'], "'")) {
            $erro = true;
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
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        </head>
        <body><center>
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
			<input type="password" name="senha" placeholder="Digite uma nova senha"/>
		<br>	
			<input type="submit" name="btnCadUsuario" value="Mudar"><br>
		</form>
            </center>
            <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </body> 
    </html>
<?php }
echo "<h1>Cadastrar Aluno</h1></br><a href='cadastrar.php?pg=cadastrar'>Aqui</a></br>";
echo "<h1>Mudar Senha </h1></br><a href='cadastrar.php?pg=mudar'>Aqui</a></br>";  