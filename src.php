<?php
session_start();
include("functions/funcoes.php");
$pagina = $_GET['pg'];
$matricula[] = str_split($_SESSION['matricula']);

if ($pagina == 'painel'){
    if(!empty($_SESSION['id'])){}
    else{
        ob_start();
        $_SESSION['msg'] = "Login expirou!";
        header("Location: ../index.php");
        ob_end_flush();
    }
    if(isset($_SESSION['msg'])){
        echo "<div class='alert alert-danger' role='alert'>";
        echo$_SESSION['msg'];
        echo"</div>";
        unset($_SESSION['msg']);
    }
    ?>
    <html>
<head>
  <meta charset="utf-8">
	<title>site</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body class="">
  <nav class="navbar navbar-dark bg-primary  mb-2">
      <h1 class="navbar-brand ">Painel de acesso</h1> 
      <a class="text-decoration-none text-reset" href="<?php echo"src.php?pg=sair";?>"><button type="button" class="btn btn-danger">Sair</button></a>   
  </nav>
   <div class="card mb-1 bg-sencondary">
  <div class="card-body">
    <h5 class="card-title">Maternal</h5>
    <p class="card-text">Acesso exclusivo para alunos do Maternal</p>
    <a href="salas/maternal.php" class="btn btn-info">Sala do Maternal</a>
  </div></div>
</div>
<div class="card mb-1 bg-sencondary">
  <div class="card-body">
    <h5 class="card-title">Jardim 1</h5>
    <p class="card-text">Acesso exclusivo para alunos do Jardim 1</p>
    <a href="salas/jardim01.php" class="btn btn-info">Sala do Jardim 1</a>
  </div></div>
  <div class="card mb-1 bg-sencondary">
  <div class="card-body">
    <h5 class="card-title">Jardim 2</h5>
    <p class="card-text">Acesso exclusivo para alunos do Jardim 2</p>
    <a href="salas/jardim02.php" class="btn btn-info">Sala do Jardim 2</a>
  </div></div>
  <div class="card mb-1 bg-sencondary">
  <div class="card-body">
    <h5 class="card-title">1° Ano</h5>
    <p class="card-text">Acesso exclusivo para alunos do 1°Ano</p>
    <a href="salas/01ano.php" class="btn btn-info">Sala do 1°Ano</a>
  </div></div>
  <div class="card mb- bg-sencondary">
  <div class="card-body">
    <h5 class="card-title">2° Ano</h5>
    <p class="card-text">Acesso exclusivo para alunos do 2°Ano</p>
    <a href="salas/02ano.php" class="btn btn-info">Sala do 2°Ano</a>
  </div></div>
  <div class="card mb-1 bg-sencondary">
  <div class="card-body">    <h5 class="card-title">3° Ano</h5>
    <p class="card-text">Acesso exclusivo para alunos do 3°Ano</p>
    <a href="salas/03ano.php" class="btn btn-info">Sala do 3°Ano</a>
  </div></div>
  <div class="card mb-1 bg-sencondary">
  <div class="card-body">
    <h5 class="card-title">4° Ano</h5>
    <p class="card-text">Acesso exclusivo para alunos do 4°Ano</p>
    <a href="salas/04ano.php" class="btn btn-info">Sala do 4°Ano</a>
  </div></div>
  <div class="card mb-1 bg-sencondary">
  <div class="card-body">
    <h5 class="card-title">5° Ano</h5>
    <p class="card-text">Acesso exclusivo para alunos do 5°Ano</p>
    <a href="salas/05ano.php" class="btn btn-info">Sala do 5°Ano</a>
  </div></div>
  <nav class="navbar navbar-dark bg-primary">
    <h1 class="navbar-brand mx-auto">Escola Universo da Criança</h1>
    <h3 class="navbar-brand mx-auto"><?php echo $_SESSION['nome'];?></h3>
    </nav>

</body>
</html>
<?php
}

if($pagina == 'sair'){
    unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['matricula'], $_SESSION['tipo']);
    $_SESSION['msg'] = "Deslogado com sucesso";
    header("Location: index.php");
}