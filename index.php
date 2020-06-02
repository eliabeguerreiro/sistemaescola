<?php
session_start();
include("functions/funcoes.php");
?>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Escola - Universo da Criança</title>
    <meta name=”description” content='Plataforma online da escola universo da criança'>
    <meta name="keywords"
        content="universo da criança, escolinha várzea, escolinha universo da criança, escolinha universo, escolinha infantl várzea, escolinha infantl varzea" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script data-ad-client="ca-pub-5526172241213918" async
        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body>
    <center>
        <h2>Escola Universo da Criança</h2>
        <?php
		if(isset($_SESSION['msg'])){
			msg_sistem($_SESSION['msg']);
			unset($_SESSION['msg']);
		}?>
        <p>
            <div class="jumbotron  container">
                <form method="POST" action="functions/verifica-login.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Matrícula</label>
                        <input type="matricula" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" name="matricula" placeholder="Digite sua matrícula">
                        <small id="emailHelp" class="form-text text-muted">Não compartilhe sua matrícula com
                            ninguém</small>
                    </div>
                    <div class="form-group">
                        <labelfor="exampleInputPassword1">Senha</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="senha"
                                placeholder="Digite sua senha">
                            <br>
                    </div>
                    <button class="btn btn-primary" type="submit" name="btnLogin" value="acessar">Login</button>
                </form>
            </div>
            <br>

            <footer class="page-footer font-small blue">
                <!-- Copyright -->
                <div class="footer-copyright text-center py-3">© 2020 Copyright | Hants Tecnologys:
                    <a href="https://www.linkedin.com/in/eliabe-paz-212927184/"> Eliabe G Paz</a>
                </div>
                <!-- Copyright -->
            </footer>





    </center>
    <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>