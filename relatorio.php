<?php
session_start();
include_once('functions/funcoes.php');
include_once('functions/conexao.php');
$_SESSION['hora_saida'] = hora_entrada();
$_SESSION['dia'] = date("d/m/Y");
$relat = "INSERT INTO `sessoes` (`matricula`, `dia`, `entrada`, `saida`) VALUES ('" .$_SESSION['matricula']. "','" .$_SESSION['dia']. "','" .$_SESSION['hora_entrada']. "','" .$_SESSION['hora_saida']. "')";
$resultado_usario = mysqli_query($conn, $relat);
header("Location:../src.php?pg=painel");