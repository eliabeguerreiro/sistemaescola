<?php
session_start();
include('functions/funcoes.php');
include('functions/conexao.php'); 
?>

<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Relatorio</title>
    </head>
    <body>
        <?php
            $arquivo = 'relatorioaluno.xls';
            $html = '';
            $html .= "<table border='1'>";
            $html .= '<tr>';
            $html .= "<td colspan='4'>Planilha de acessos do aluno</tr>";
            $html .= '</tr>';                    


            $html .='<tr>';
            $html .='<td scope="col"><b>Matricula</b></td>';
            $html .='<td scope="col"><b>Dia</b></td>';
            $html .='<td scope="col"><b>Entrada</b></td>';
            $html .='<td scope="col"><b>Saída</b></td>';
            $html .='</tr>';
        

            $relat = "SELECT * FROM sessoes WHERE matricula='". $_SESSION['matricula'] ."' AND dia='". $_SESSION['dia'] ."'";
            $relatorio = mysqli_query($conn, $relat);
                 
            while($row_relatorio = mysqli_fetch_assoc($relatorio)){
                $html .='<tr>';
                $html .="<td>".$row_relatorio['matricula'].'</td>';
                $html .='<td>'.$row_relatorio['dia'].'</td>';
                $html .='<td>'.$row_relatorio['entrada'].'</td>';
                $html .='<td>'.$row_relatorio['saida'].'</td>';
                $html .='</tr>';
            }

            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		    header ("Cache-Control: no-cache, must-revalidate");
	    	header ("Pragma: no-cache");
	    	header ("Content-type: application/x-msexcel");
	    	header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
	    	header ("Content-Description: PHP Generated Data" );
            // Envia o conteúdo do arquivo
		    echo $html;
		    exit; ?>
    
    </body>
</html>