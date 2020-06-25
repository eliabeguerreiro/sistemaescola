<?php
include_once('functions/conexão.php');

$result = "SELECT * FROM ususarios WHERE tipo = /*aqui vem a sala */";

$resultildo = mysqli_query($conn, $result);


$resultado = mysqli_fetch_array($resultildo);

//percorrer o array