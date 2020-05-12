<?php
session_start();
include("functions/funcoes.php");
?>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
	<center>
		<h2>Entrar</h2>
		<?php
		if(isset($_SESSION['msg'])){
			msg_sistem($_SESSION['msg']);
			unset($_SESSION['msg']);
		}elseif(isset($_SESSION['msgcad'])){
			msg_sistem($_SESSION['msgcad']);
			unset($_SESSION['msg']);
		}?>
		<p>
		<div class="jumbotron  container">	
			<form method="POST" action="functions/verifica-login.php">
				<div class="form-group">
					<label for="exampleInputEmail1">Matricula</label>
					<input type="matricula"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="matricula" placeholder="Digite sua matricula">
					<small id="emailHelp" class="form-text text-muted">Não compartilhe sua matricula com ninguém.</small>
				</div>
				<div class="form-group">	
					<labelfor="exampleInputPassword1">Senha</label>
					<input type="password" class="form-control" id="exampleInputPassword1" name="senha" placeholder="Digite sua senha">
					<br>
				</div>
				
					<button class="btn btn-primary" type="submit" name="btnLogin" value="acessar">Loguin</button>
					<h4>Mudar senha?</h4>
					<a href="src/mudarsenha.php">aqui</a>
				
			</form>
		</div>
		<br>
		</center>
		<script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>

</html>