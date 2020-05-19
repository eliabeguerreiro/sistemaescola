<?php
session_start();
include('functions/funcoes.php');
include('functions/conexao.php');
    
?>
<form method="POST" action="">
			<label>Matricula:</label></br>
            </br>
			<input type="matricula" name="matricula" placeholder="Digite a matricula do aluno"></br>
			</br><label>Data:</label></br>
            </br>
            <input type="text" name="dia" placeholder="dd/mm/aaaa">
			<input type="submit" name="btnCadUsuario" value="Procurar"><br>
            <small id="diaHelp" class="form-text text-muted">Insira as barras "/"</small>
		</form>
<?php
if ($_POST){
    $relat = "SELECT * FROM sessoes WHERE matricula='". $_POST['matricula'] ."' AND dia='". $_POST['dia'] ."'";
    $relatorio = mysqli_query($conn, $relat);
    $html ='';
    while($row_relatorio = mysqli_fetch_assoc($relatorio)){
        
    $html .= $row_relatorio['matricula'].'</br>';
    $html .= $row_relatorio['dia'].'</br>';
    $html .= $row_relatorio['entrada'].'</br>';
    $html .= $row_relatorio['saida'].'<hr>';
    
    }
}