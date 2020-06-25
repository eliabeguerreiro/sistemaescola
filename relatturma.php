<?php
include_once('functions/conexão.php');

$result = "SELECT * FROM ususarios WHERE tipo ='" .$_POST['sala']. "'";
$resultildo = mysqli_query($conn, $result);
$resultado = mysqli_fetch_array($resultildo);

$cont = 0;
foreach($resultado['matricula'] as $aluno){
    $res = "SELECT * FROM sessoes WHERE matricula='" .$_aluno['matricula']. "' and dia='" .$_POST['dia']. "' limit-1";
    $resul = mysqli_query($conn, $res);
    if (mysqli_num_rows($resul = 1)){
        $frequencia[$cont] = 'Presente';     
    }else{
        $frequencia[$cont] = 'Faltou';
    }
}