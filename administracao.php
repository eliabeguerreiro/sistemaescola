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
    <title>Relatório</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
</head>

<body>
    <center>
        <div class='jumbotron  container'>
            <h1>Relatório de acessos</h1>
            </br>
            <a class="text-decoration-none text-reset" href="administracao.php?pg=1dia"><button type="button"
                    class="btn btn-primary">Apenas um dia</button></a>
            <a class="text-decoration-none text-reset" href="administracao.php?pg=2dia"><button type="button"
                    class="btn btn-primary">Mais de um dia</button></a>
            <a class="text-decoration-none text-reset" href="../src.php?pg=painel"><button type="button"
                    class="btn btn-primary">Voltar</button></a>
        </div>
        <?php
        if($pagina == '2dia'){?>
        <div class='jumbotron  container'>
            <form method="POST" action="">
                <label>Matrícula:</label></br>
                <input type="matricula" name="matricula" placeholder="Digite a matricula do aluno"></br>
                </br><label>Datas:</label></br>
                <input type="text" name="dia" placeholder="dd/mm/aaaa">
                <input type="text" name="dia2" placeholder="dd/mm/aaaa">
                </br>
                </br>
                <input type="submit" name="btnCadUsuario" value="Procurar"><br>
                <small id="diaHelp" class="form-text text-muted">Preencha ambos os espaços as datas // Insira as barras
                    "/"</small>
            </form>
        </div>
        <div class='jumbotron  container'>
            <?php
        $html ='';
        $html .="<table class='table'>";
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th scope="col">Matricula</th>';
        $html .='<th scope="col">Dia</th>';
        $html .='<th scope="col">Entrada</th>';
        $html .='<th scope="col">Saida</th>';
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
            $_SESSION['html']=$html;
            echo "<a class='text-decoration-none text-reset' href='adm.php?pg=2'><button type='button' class='btn btn-primary'>Baixar tabela em Excel</button></a>"; 
            echo '<p>'; 
            echo '<p>'; 
            echo "<a class='text-decoration-none text-reset' href='create.php'><button type='button' class='btn btn-primary'>Baixar tabela em PDF</button></a>";           
         
        }
        if($pagina == '1dia'){?>
            <div class='jumbotron  container'>
                <form method="POST" action="">
                    <label>Matrícula:</label></br>
                    <input type="matricula" name="matricula" placeholder="Digite a matricula do aluno"></br>
                    </br><label>Data:</label></br>
                    <input type="text" name="dia" placeholder="dd/mm/aaaa">
                    </br>
                    </br>
                    <input type="submit" name="btnCadUsuario" value="Procurar"><br>
                    <small id="diaHelp" class="form-text text-muted">Insira a data com as barras "/"</small>
                </form>
            </div>
            <div class='jumbotron  container'>
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
            $_SESSION['html']=$html;
            echo "<a class='text-decoration-none text-reset' href='adm.php?pg=1'><button type='button' class='btn btn-primary'>Baixar tabela em Excel</button></a>";
            echo '<p>'; 
            echo '<p>'; 
            echo "<a class='text-decoration-none text-reset .mt-1' href='create.php'><button type='button' class='btn btn-primary'>Baixar tabela em PDF</button></a>";           
        }
?>
            </div>
    </center>
    <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>