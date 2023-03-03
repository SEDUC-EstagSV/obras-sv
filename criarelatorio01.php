<?php
// definições de host, database, usuário e senha
$db_host = 'localhost';
$db_nome = 'seducbd';
$db_user = 'root';
$db_senha = '';

$conexao = new PDO("mysql:host=$db_host;dbname=$db_nome;charset=utf8", $db_user, $db_senha);
?>






<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="utf-8"/>

    <style>
	
	html {
			background-size: cover;
			background-image: url("https://i.pinimg.com/originals/8f/87/c8/8f87c8da6897e36bfe68aada00bb56bc.jpg");
			
		}
		
	a:link, a:visited, a:active, a:hover {
			color: #fff;
			text-decoration: none;
		}
	
	table{
			text-align: center;
			align-content: space-around;
			margin: auto;
			width: 70%;
			border-style: solid;
			border-radius: 15px;
			
			
		}
		
	th {
		border-style: solid, bold;
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
		
		select {
			max-width: 30%;
			
			
			}
	

    </style>

</head>
<body>


<p><a href="form.html">Voltar</a></p>



<div id="box2">
Terminal de Testes
</div>
<div id="box">
<?php

echo "<h2>Criar relatório</h2>";

echo "<form method='post' action='criarelatorio02.php' enctype='multipart/form-data'>";
	



echo "<p>Selecione a escola com obra existente:</p>";

$conexao = new PDO('mysql:host=localhost;dbname=seducbd;charset=utf8', 'root', '');


//Seleciona uma escola correspondente, que a pessoa dê o valor do código direto - ex. 7 que corresponde ao CEJAIN
//$query = $conexao->prepare("SELECT ds_Local FROM `escola` WHERE cd_Escola = $valor");



//Seleciona retornando nome de TODAS escolas
//$query = $conexao->prepare("SELECT * FROM `escola`");

//Seleciona TODAS escolas que possuem relatórios de Obra
//$query = $conexao->prepare("SELECT * FROM relatorio JOIN escola ON escola.cd_Escola = relatorio.cd_Escola");


//Seleciona TODAS escolas que possuem obra;
$query = $conexao->prepare("SELECT * FROM obra JOIN escola ON escola.cd_Escola = obra.cd_Escola GROUP BY escola.nm_Escola ASC");

//$query = $conexao->prepare("SELECT * FROM relatorio JOIN `escola` on escola.cd_Escola = relatorio.cd_Escola GROUP BY escola.cd_Escola ASC");


//$query = $conexao->prepare("SELECT ds_Local FROM `escola` WHERE cd_Escola = $valor");


$query->execute();


echo "<select name='newEscola'>";
echo "<datalist>";
echo "<option value='' disabled selected>Selecione a escola</option>";

while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {

$descricao = $linha['nm_Escola'];

echo "<option>" . $linha['cd_Escola'] . " - " . $descricao . "</option>";

}



echo "</datalist>";
echo "</select>";

	
echo "<br><br>";

echo "<input type='submit' value='Enviar'/>";

echo "</form>";
echo "<br>";




?>


</div>


</body>
</html>




