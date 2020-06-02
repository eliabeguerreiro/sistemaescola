<?php
session_start();
include("conexao.php");
$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if($btnLogin){
	$matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	if((!empty($matricula)) AND (!empty($senha))){
		$result_usuario = "SELECT id, nome, matricula, senha, tipo FROM usuarios WHERE matricula='$matricula' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if($resultado_usuario){
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			ob_start();
			if(password_verify($senha, $row_usuario['senha'])){
				$_SESSION['id'] = $row_usuario['id'];
				$_SESSION['nome'] = $row_usuario['nome'];
				$_SESSION['matricula'] = $row_usuario['matricula'];
				$_SESSION['tipo'] = $row_usuario['tipo'];
				$nh = '';
    			$nh .='Dia: '. date('d/m/Y') .' Hora: '.date('h:i:s');
				$relat = "INSERT INTO `entrada` (`matricula`, `entrada`) VALUES ('" .$_SESSION['matricula']. "','$nh')";
				$resultado_usario = mysqli_query($conn, $relat);
				header("Location:../src.php?pg=painel");
			}else{
				$_SESSION['msg'] = "Login e senha incorreto!";
				header("Location: ../index.php");
			}
		}
	}else{
		$_SESSION['msg'] = "Você precisar inserir os dados de login!";
		header("Location: ../index.php");
	}
}else{
	$_SESSION['msg'] = "Página não encontrada";
	header("Location: ../index.php");
}
ob_end_flush();