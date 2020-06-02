<?php
session_start();
include("../functions/funcoes.php");
$_SESSION['hora_entrada'] = hora_entrada();
if(!empty($_SESSION['id'])){   
}else{header("Location: ../index.php");}
if($_SESSION['tipo'] == 'Administrador'){
}elseif($_SESSION['tipo'] != '02ano'){
    $_SESSION['msg']='Você não pertence a esta sala!</br>';
	ob_start();
	header("Location:../src.php?pg=painel");}
	ob_end_flush();
$pagina = '02ano';
?>
<html>

<head>
    <meta charset="utf-8">
    <title>2° Ano</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
</head>

<body class="">
    <nav class="navbar navbar-dark bg-primary">
        <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand m-auto">2° Ano</h1>
        <a class="text-decoration-none text-reset" href="../relatorio.php"><button type="button"
                class="btn btn-danger">Sair da sala</button></a>
    </nav><?php
    $video = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    video($pagina,$video);?>
    <nav class="navbar navbar-dark bg-primary">
        <h1 class="navbar-brand mx-auto">Escola Universo da Criança</h1>
        <h3 class="navbar-brand mx-auto"><?php echo$_SESSION['nome'];?></h3>
    </nav>
    <footer class="page-footer font-small blue">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2020 Copyright | Hants Tecnologys:
            <a href="https://www.linkedin.com/in/eliabe-paz-212927184/"> Eliabe G Paz</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>