<?php
session_start();
include('functions/funcoes.php');
include('functions/conexao.php');    
(isset($_GET['pg']))? $_GET['pg'] : 1;
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modelo relatorio</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </head>

    <body>
        <div class='jumbotron  container'>
            <center>
            <form method="POST" action="">
                <label>Matricula:</label></br>
                <input type="matricula" name="matricula" placeholder="Digite a matricula do aluno"></br>
                </br><label>Data:</label></br>
                <input type="text" name="dia" placeholder="dd/mm/aaaa">
                <input type="submit" name="btnCadUsuario" value="Procurar"><br>
                <small id="diaHelp" class="form-text text-muted">Insira as barras "/"</small>
            </form>
        </div>



        <?php
        $html ='';
        $html .="<table class='table'>";
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th scope="col">Matricula</th>';
        $html .='<th scope="col">Dia</th>';
        $html .='<th scope="col">Entrada</th>';
        $html .='<th scope="col">Saída</th>';
        $html .='</tr>';
        $html .='</thead>';
        $html .='<tbody>';
        if ($_POST){
            $_SESSION['matricula'] = $_POST['matricula'];
            $_SESSION['dia'] = $_POST['dia'];
            $relat = "SELECT * FROM sessoes WHERE matricula='". $_POST['matricula'] ."' AND dia='". $_POST['dia'] ."'";
            $relatorio = mysqli_query($conn, $relat);
                 
            while($row_relatorio = mysqli_fetch_assoc($relatorio)){
                $html .='<tr>';
                $html .="<th scope 'row'>".$row_relatorio['matricula'].'</th>';
                $html .='<td>'.$row_relatorio['dia'].'</td>';
                $html .='<td>'.$row_relatorio['entrada'].'</td>';
                $html .='<td>'.$row_relatorio['saida'].'</td>';
                $html .='</tr>';
                }
            }
            $html .='</tbody>';
            $html .='</table>';
            echo $html;
            echo "<a href='adm.php'>Baixar</a>";
                        
            ?>
            </center>            
    </body>
</html>