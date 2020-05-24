<?php
session_start();
include('functions/funcoes.php');
include('functions/conexao.php');    
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
        <div id="dvData">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Matricula</th>
                <th scope="col">Dia</th>
                <th scope="col">Entrada</th>
                <th scope="col">Saída</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_POST){
                    $relat = "SELECT * FROM sessoes WHERE matricula='". $_POST['matricula'] ."' AND dia='". $_POST['dia'] ."'";
                    $relatorio = mysqli_query($conn, $relat);
                    $$dadosXls ='';
                    while($row_relatorio = mysqli_fetch_assoc($relatorio)){
                        $dadosXls.='<tr>';
                        $dadosXls.="<th scope 'row'>".$row_relatorio['matricula'].'</th>';
                        $dadosXls.='<td>'.$row_relatorio['dia'].'</td>';
                        $dadosXls.='<td>'.$row_relatorio['entrada'].'</td>';
                        $dadosXls.='<td>'.$row_relatorio['saida'].'</td>';
                        $dadosXls.='</tr>';
                    }
                }
                /*$arquivo = "Relatorio.xls";
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$arquivo.'"');
                header('Cache-Control: max-age=1');
                echo $dadosXls;  
                */?>    
            </tbody>
        </table>
        </div>
        
            </center>                     
    </body>
</html>