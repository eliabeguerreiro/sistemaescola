<?php
session_start();
include("../functions/funcoes.php");
if(!empty($_SESSION['id'])){   
}else{header("Location: ../index.php");}
if($_SESSION['tipo'] == 'Admin'){
}elseif($matricula[0]!=0 || $matricula[1]!=1){
    $_SESSION['msg']='Você não pertence a esta sala!</br>';
    header("Location:../src.php?pg=painel");}
$pagina ='01ano';
?>
    <html>
<head>
    <meta charset="utf-8">
	<title>1° Ano</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
</head>

<body class="">
	<nav class="navbar navbar-dark bg-primary">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	    <span class="navbar-toggler-icon"></span>
 		</button>
 		<h1 class="navbar-brand m-auto">Maternal</h1>
 		<button type="button" class="btn btn-danger"><a class="text-decoration-none text-reset" href="../src.php?pg=painel">Voltar</a></button>
	</nav><?php
    $video = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    video($pagina,$video);?> 
    <nav class="navbar navbar-dark bg-primary">
    <h1 class="navbar-brand mx-auto">Escola Universo da Criança</h1>
    <h3 class="navbar-brand mx-auto"><?php echo $_SESSION['tipo'].': '.$_SESSION['nome'];?></h3>
    </nav>
</body>
</html><?php


