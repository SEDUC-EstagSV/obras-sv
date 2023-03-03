<?php
session_start();
require 'dbcon.php';
?>






<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="utf-8"/>

    <style>
	
	html {
			background-tmp_name: cover;
			background-image: url("https://i.pinimg.com/originals/8f/87/c8/8f87c8da6897e36bfe68aada00bb56bc.jpg");
			
		}
		
	a:link, a:visited, a:active, a:hover {
			color: #fff;
			text-decoration: none;
		}
	
	
	#box{
			padding-top: 5px;
			padding-bottom: 15px;
			margin-left: 100px;
			margin-right: 100px;
			background-color: #000;
			text-align: center;
			color: #fff;
		
		}
		
	#box2{
			
			border: 1px;
			padding: 1px;
			border-style: ridge;
			border-color: #555;
			margin-left: 100px;
			margin-right: 100px;
			background-color: #aaa;
			color: #333;
			
		}
	
	
        h2
        {
            color: #fff;
            text-shadow: 2px 2px 2px gray;
        }
		
		img{
		
		
			border-style: solid, 4px;
			border-radius: 15px;
			max-width: 160px;
			max-height: 160px;
			object-fit: cover;
		
			}


    </style>

</head>
<body>


<p><a href="criarelatorio01.php">Voltar</a></p>



<div id="box2">
Terminal de Testes
</div>
<div id="box">
<?php

echo "<h2>Relatório</h2>";

$conexao = new PDO('mysql:host=localhost;dbname=seducbd;charset=utf8', 'root', '');


	$newCodRel = $_POST['newCodRel'];

	$newCodObra = $_POST['newCodObra'];
	
	$newEscola = $_POST['newEscola'];
		
	$newNumRel = $_POST['newNumRel'];
	
	$newTecResp = $_POST['newTecResp'];
	
	$newMail = $_POST['newMail'];
	
	$newRespLocal = $_POST['newRespLocal'];
	
	$newPtConclusao = $_POST['newPtConclusao'];
	
	$newTpRelaComentario = $_POST['newTpRelaComentario'];
	
	
	/*
	if ($_FILES['newFoto01']['tmp_name']) != NULL {
	
	$newFoto01 = addslashes (file_get_contents($_FILES['newFoto01']['tmp_name']));
	
	}
	
	else
		
	{
	$newFoto01 = '';
	}
		
		
		
	$newFoto02 = addslashes (file_get_contents($_FILES['newFoto02']['tmp_name']));
	
	$newFoto03 = addslashes (file_get_contents($_FILES['newFoto03']['tmp_name']));
	
	$newFoto04 = addslashes (file_get_contents($_FILES['newFoto04']['tmp_name']));	
		
	$newFoto05 = addslashes (file_get_contents($_FILES['newFoto05']['tmp_name']));
	*/

if ($_FILES['newFoto01']['tmp_name'] != NULL) {
	$newFoto01 = addslashes (file_get_contents($_FILES['newFoto01']['tmp_name']));
	}
	
else
		
	{
	$newFoto01 = '';
	}
	

if ($_FILES['newFoto02']['tmp_name'] != NULL) {
	$newFoto02 = addslashes (file_get_contents($_FILES['newFoto02']['tmp_name']));
	}
	
else
		
	{
	$newFoto02 = '';
	}
	


if ($_FILES['newFoto03']['tmp_name'] != NULL) {
	$newFoto03 = addslashes (file_get_contents($_FILES['newFoto03']['tmp_name']));
	}
	
else
		
	{
	$newFoto03 = '';
	}
	
	
if ($_FILES['newFoto04']['tmp_name'] != NULL) {
	$newFoto04 = addslashes (file_get_contents($_FILES['newFoto04']['tmp_name']));
	}
	
else
		
	{
	$newFoto04 = '';
	}


if ($_FILES['newFoto05']['tmp_name'] != NULL) {
	
	$newFoto05 = addslashes (file_get_contents($_FILES['newFoto05']['tmp_name']));
	}
	
else
		
	{
	$newFoto05 = '';	
	}
	


 $newRelatorio = "INSERT into relatorio
(cd_Relatorio, cd_Obra, cd_Escola, num_Relatorio, dt_Carimbo, nm_TecResponsavel, ds_Email, nm_LocResponsavel, pt_Conclusao, tp_RelaComentario, foto01, foto02, foto03, foto04, foto05)
VALUES
('$newCodRel','$newCodObra','$newEscola','$newNumRel', now(), '$newTecResp','$newMail','$newRespLocal','$newPtConclusao','$newTpRelaComentario','$newFoto01','$newFoto02','$newFoto03','$newFoto04','$newFoto05')";
  
$conexao->exec($newRelatorio);
  echo "<h3>Relatório criado com sucesso!</h3>";



?>





</div>


</body>
</html>