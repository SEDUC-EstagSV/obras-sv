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

<head>
  <title>Busca por Escola</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>

/*--------------------------------------------------------------
STYLE TOGGLE
--------------------------------------------------------------*/
	.navbar-toggler:focus,
	.navbar-toggler:active,
	.navbar-toggler-icon:focus {
    outline: none;
    box-shadow: none;
	}

	.navbar-toggler span {
	display: block;
	background-color: #4f4f4f;
	height: 3px;
	width: 25px;
	margin-top: 5px;
	margin-bottom: 5px;
	position: relative;
	left: 0;
	opacity: 1;
	transition: all 0.25s ease-out;
	transform-origin: center left;
	}



	.navbar-toggler span:nth-child(1) {
	transform: translate(0%, 0%) rotate(0deg);
	}

	.navbar-toggler span:nth-child(2) {
	opacity: 1;
	}

	.navbar-toggler span:nth-child(3) {
	transform: translate(0%, 0%) rotate(0deg);
	}

	.navbar-toggler span:nth-child(1) {
	margin-top: 0.3em;
	}

	.navbar-toggler:not(.collapsed) span:nth-child(1) {
	transform: translate(15%, -33%) rotate(45deg);
	}

	.navbar-toggler:not(.collapsed) span:nth-child(2) {
	opacity: 0;
	}

	.navbar-toggler:not(.collapsed) span:nth-child(3) {
	transform: translate(15%, 33%) rotate(-45deg);
	}
	
/*--------------------------------------------------------------
STYLE LOGO NAVBAR
--------------------------------------------------------------*/	
	.logo img {
	max-height: 40px;
	}
	
    h2{
    color: #fff;
    text-shadow: 2px 2px 2px gray;
    }

    </style>

</head>
<body>
<?php

$conexao = new PDO('mysql:host=localhost;dbname=seducbd;charset=utf8', 'root', '');




//************ Para retornar valor de quantas escolas existem com relatório *************
$query = $conexao->prepare("SELECT DISTINCT (cd_Escola) FROM relatorio");

$query->execute();

$somaEscolaRel = 0;
while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
				$somaEscolaRel = $somaEscolaRel + 1;		
				}

$valorTotalEscolaRel = $somaEscolaRel;





//*****************Header*************************


echo "<nav class='navbar navbar-expand-lg bg-light'>
		<div class='container-fluid'>
	
	
	
	<div class='logo me-auto'>
      <img src='logo.png' alt='brasao sao vicente' class='img-fluid'>
    <a class='navbar-brand' href='#'>SEDUC-SV / OBRAS</a>
	</div>
		
		
		<button class='navbar-toggler collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='true' aria-label='Toggle navigation'>
	      <span class='icon-bar top-bar'></span>
          <span class='icon-bar middle-bar'></span>
          <span class='icon-bar bottom-bar'></span>
		</button>
    
	<div class='collapse navbar-collapse' id='navbarSupportedContent'>
      <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
	  
		<li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='#'>Home</a>
        </li>
        
		<li class='nav-item'>
          <a class='nav-link' href='#'>Link</a>
        </li>		
		
		<li class='nav-item dropdown'>
		<span class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
							Relatórios
			</span>
				<ul class='dropdown-menu'>
					<li><a class='dropdown-item' href='criarelatorio01.php'>Criar relatório</a>
					</li>

					<li><span class='dropdown-item'>Pesquisa de relatórios </span>
			
				<ul class='dropdown-submenu'>
					<li><a class='dropdown-item' href='buscaescola.php'>Por Escolas
					<span class='btn btn-primary badge badge-success badge-pill'>$valorTotalEscolaRel</span>
					</a></li>
					<li><a class='dropdown-item' href='#'>Por Contratos</a></li>
				</ul>
		</li>	
		
	  </ul>

		
       </li>
	   </ul>
    </div>
  </div>
</nav>";






echo "<div class='container-fluid p-5 bg-primary text-white text-center'>";



echo "<h2>Criar relatório</h2>";



echo "</div>";

//*****************Fim do Header*************************

echo "<form method='post' action='criadorelatorio.php' enctype='multipart/form-data'>";



echo "<div class='container text-center'>";


echo "<form method='post' action='criadorelatorio.php' enctype='multipart/form-data'>";

echo "<div class='mb-3 mt-3'>";

$newEscola = $_POST['newEscola'];

$newCodContrato = $_POST['newCodContrato'];

//Elimina o conteúdo do string recebido anterior "Contrato nº " deixando apenas o n. do contrato correspondente na variável
$newCodContrato = substr($newCodContrato, 12);

echo "<h4>Contrato</h4>";
echo "nº " . "$newCodContrato";

echo "</div>";

	
//***********************************Código da Obra ***********************

echo "<div class='mb-3'>";

$conexao2 = new PDO('mysql:host=localhost;dbname=seducbd;charset=utf8', 'root', '');

$query2 = $conexao2->prepare("select * from Obra WHERE cd_Escola = $newEscola limit 1");

$query2->execute();

while ($linha2 = $query2->fetch(PDO::FETCH_ASSOC)) {


echo "<h4>Código da Obra: </h4>";


$newCodObra = $linha2['cd_Obra'];


//Para inserir Código da Obra no banco de dados

echo "<input type='hidden' name='newCodObra' value='$newCodObra'/>";

echo $newCodObra;

}
	
echo "</div>";
	
	
//********************************************************************************	
	


$conexao3 = new PDO('mysql:host=localhost;dbname=seducbd;charset=utf8', 'root', '');

$query3 = $conexao3->prepare("select * from relatorio ORDER BY cd_Relatorio DESC LIMIT 1");

$query3->execute();

while ($linha3 = $query3->fetch(PDO::FETCH_ASSOC)) {

echo "<div class='mb-3'>";

echo "<h4>Código do Relatório: </h4>";

$newCodRel = $linha3['cd_Relatorio'] + 1;

echo $newCodRel;

}

echo "</div>";

echo "<input type='hidden' name='newCodRel' value='$newCodRel'/>";

$conexao4 = new PDO('mysql:host=localhost;dbname=seducbd;charset=utf8', 'root', '');

$query4 = $conexao4->prepare("SELECT * FROM `escola` WHERE cd_Escola = $newEscola");

$query4->execute();
	
//$numRel = $conexao->prepare("select * from relatorio ORDER BY cd_Relatorio DESC LIMIT 1");


echo "<div class='mb-3'>";

while ($linha4 = $query4->fetch(PDO::FETCH_ASSOC)) {

echo "<h4><label for='tecResp' class='form-label'>Local da obra: </label></h4>";
			
	//Código da Escola
	//$newEscola;
	//Nome e Endereço da escola
	echo " " . $linha4['nm_Escola'] . " - " . $linha4['end_Escola'];
	
//Para inserir o valor do código da escola no banco de dados
echo "<input type='hidden' name='newEscola' value='$newEscola'/>";

echo "</div>";
}



echo "<div class='mb-3'>
<h4><label for='numRel' class='form-label'>Número do Relatório:</label></h4>
  <input type='text' name='newNumRel' class='form-control' id='numRel' placeholder='Digite o número'>
</div>";



echo "<div class='mb-3'>
<h4><label for='tecResp' class='form-label'>Técnico Responsável:</label></h4>
  <input type='text' name='newTecResp' class='form-control' id='tecResp' placeholder='Digite o nome'>
</div>";


echo "<div class='mb-3'>
<h4><label for='mailResp' class='form-label'>E-mail do Téc. Responsável:</label></h4>
  <input type='email' name='newMail' class='form-control' id='mailResp' placeholder='Ex.: nome@site.com.br'>
</div>";



echo "<div class='mb-3'>
<h4><label for='respLocal' class='form-label'>Responsável Local:</label></h4>
  <input type='text' name='newRespLocal' class='form-control' id='respLocal' placeholder='Digite o nome:'>
</div>";

	
	
echo "<div class='mb-3 text-center'>";
echo "<h4>Andamento da Obra: </h4>";	
echo "<label for='andamentoObra' class='form-label' id='valorAndamento'></label>";

echo "<div class='slidecontainer'>";

echo "<input type='range' name='newPtConclusao' class='form-range' min='0' max='100' step='5' id='sliderAndamento' value='0'>";

echo "</div>";	
echo "</div>";
	
	
	

	
echo "<div class='mb-3'>	
<h4><label for='comment'>Comentários:</label></h4>
<textarea class='form-control' rows='5' id='comment' name='newTpRelaComentario' placeholder='Digite comentários aqui...'></textarea>
</div>";


echo "<div class='mb-3'>
<h4>Fotos</h4>
<p>(Limite de 05 fotos)</p>
</div>";


echo "<div class='mb-3'>
  <label for='formFile' class='form-label'>Adicione foto 01: </label>
  <input class='form-control' type='file' id='formFile' name='newFoto01''>

<div id='pic02a' onclick='mostrar02()'>
<i class='bi bi-plus-circle-dotted' style='display: block'></i>
</div>

</div>";



echo "<div id='pic02' class='mb-3' style='display: none'>
  <label for='formFile' class='form-label'>Adicione foto 02: </label>
  <input class='form-control' type='file' id='formFile' name='newFoto02''>
 
<div id='pic03a' onclick='mostrar03()'>
<i class='bi bi-plus-circle-dotted' style='display: block'></i>
</div>
  
</div>";


echo "<div id='pic03' class='mb-3' style='display: none'>
  <label for='formFile' class='form-label'>Adicione foto 03: </label>
  <input class='form-control' type='file' id='formFile' name='newFoto03''>

<div id='pic04a' onclick='mostrar04()'>
<i class='bi bi-plus-circle-dotted' style='display: block'></i>
</div>  
  
</div>";


echo "<div id='pic04' class='mb-3' style='display: none'>
  <label for='formFile' class='form-label'>Adicione foto 04: </label>
  <input class='form-control' type='file' id='formFile' name='newFoto04''>

<div id='pic05a' onclick='mostrar05()'>
<i class='bi bi-plus-circle-dotted' style='display: block'></i>
</div>
  
</div>";


echo "<div id='pic05' class='mb-3' style='display: none'>
  <label for='formFile' class='form-label'>Adicione foto 05: </label>
  <input class='form-control' type='file' id='formFile' name='newFoto05''>
</div>";
	


echo "<button type='submit' class='btn btn-success' value='Enviar'>Enviar</button>";




echo "</div>";

echo "</div>";



echo "</form>";
echo "<br>";


	

?>


</div>


</body>

<script>
//Código Javascript para atualização de valor do Slider(Andamento da obra)
var slider = document.getElementById('sliderAndamento');
var output = document.getElementById('valorAndamento');
output.innerHTML = slider.value + "%";

slider.oninput = function() {
  output.innerHTML = this.value + "%";
}
</script>





<script>
function mostrar02()
{
 var z = document.getElementById('pic02');
 var y = document.getElementById('pic02a');
 if  (z.style.display === 'none')
	 {
  	  z.style.display = 'block';
	  y.style.display = 'none';
     }
else {
      z.style.display = 'none';
     }
};

//========================================================

function mostrar03()
{
 var z = document.getElementById('pic03');
 var y = document.getElementById('pic03a');
 if  (z.style.display === 'none')
	 {
  	  z.style.display = 'block';
	  y.style.display = 'none';
     }
else {
      z.style.display = 'none';
     }
};

//========================================================

function mostrar04()
{
 var z = document.getElementById('pic04');
 var y = document.getElementById('pic04a');
 if  (z.style.display === 'none')
	 {
  	  z.style.display = 'block';
	  y.style.display = 'none';
     }
else {
      z.style.display = 'none';
     }
};

//========================================================

function mostrar05()
{
 var z = document.getElementById('pic05');
 var y = document.getElementById('pic05a');
 if  (z.style.display === 'none')
	 {
  	  z.style.display = 'block';
	  y.style.display = 'none';
     }
else {
      z.style.display = 'none';
     }
};
</script>








</html>