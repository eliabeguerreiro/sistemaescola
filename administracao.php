<?php
session_start();
include('functions/funcoes.php');
include('functions/conexao.php');    
$pagina = (isset($_GET['pg']))? $_GET['pg'] : 0;
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
    <center>
    <div class='jumbotron  container'>
    <h1>Relatorio de acessos</h1>
    </br>
    <a class="text-decoration-none text-reset" href="administracao.php?pg=1dia"><button type="button" class="btn btn-primary">Apenas um dia</button></a>
    <a class="text-decoration-none text-reset" href="administracao.php?pg=2dia"><button type="button" class="btn btn-primary">Mais de um dia</button></a>
    </div> 
    <?php
        if($pagina == '2dia'){?>
        <div class='jumbotron  container'> 
            <form method="POST" action="">
                <label>Matricula:</label></br>
                <input type="matricula" name="matricula" placeholder="Digite a matricula do aluno"></br>
                </br><label>Data:</label></br>
                <input type="text" name="dia" placeholder="dd/mm/aaaa">
                <input type="text" name="dia2" placeholder="dd/mm/aaaa">
                <input type="submit" name="btnCadUsuario" value="Procurar"><br>
                <small id="diaHelp" class="form-text text-muted">Preencha ambos os espaços as datas // Insira as barras "/"</small>
            </form>
        </div> 
        <div  class='jumbotron  container'>
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
            $_SESSION['dia2'] = $_POST['dia2'];
            $relat = "SELECT * FROM sessoes WHERE matricula='". $_POST['matricula'] ."' AND dia BETWEEN'". $_POST['dia'] ."' AND '". $_POST['dia2'] ."'";
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
            echo "<a class='text-decoration-none text-reset' href='adm.php?pg=2'><button type='button' class='btn btn-primary'>Baixar</button></a>";           
        }
        if($pagina == '1dia'){?>
        <div class='jumbotron  container'> 
            <form method="POST" action="">
                <label>Matricula:</label></br>
                <input type="matricula" name="matricula" placeholder="Digite a matricula do aluno"></br>
                </br><label>Data:</label></br>
                <input type="text" name="dia" placeholder="dd/mm/aaaa">
                <input type="submit" name="btnCadUsuario" value="Procurar"><br>
                <small id="diaHelp" class="form-text text-muted">Insira a data com as barras "/"</small>
            </form>
        </div>
        <div  class='jumbotron  container'>
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
            echo "<a class='text-decoration-none text-reset' href='adm.php?pg=1'><button type='button' class='btn btn-primary'>Baixar</button></a>";           
        }
?>
        </div>
            </center>            
    </body>
</html>