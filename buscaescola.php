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
$query = $conexao->prepare("SELECT DISTINCT (cd_Obra) FROM relatorio");

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



echo "<h2>Relatório existente por Escolas</h2>";



echo "</div>";

//*****************Fim do Header*************************











$conexao2 = new PDO('mysql:host=localhost;dbname=seducbd;charset=utf8', 'root', '');

//Seleciona uma escola correspondente, que a pessoa dê o valor do código direto - ex. 7 que corresponde ao CEJAIN
//$query = $conexao->prepare("SELECT ds_Local FROM `escola` WHERE cd_Escola = $valor");



//Seleciona retornando nome de TODAS escolas
//$query = $conexao->prepare("SELECT * FROM `escola`");

//Seleciona TODAS escolas que possuem relatórios de Obra
$query2 = $conexao2->prepare("SELECT * FROM `relatorio` JOIN `obra` JOIN `escola` on obra.cd_Obra = relatorio.cd_Obra AND obra.cd_Escola = escola.cd_Escola");






$query2->execute();



echo "<div class='container mt-5'>";


echo "<form method='POST' action='mostrarelatorioescola.php'>";
  echo "<div class='form-group'>";
  echo "<label>Selecione a escola desejada:</label>";
    echo "<select class='form-control mt-2' name='verRelEscola'>";
     echo "<option value='' disabled selected class='text-center'>- Escolas -</option>";
			echo "<datalist>";
				while ($linha2 = $query2->fetch(PDO::FETCH_ASSOC)) {
				$descricao = $linha2['nm_Escola'];
				echo "<option>" . $linha2['cd_Escola'] . " - " . $descricao . "</option>";
				}
			echo "</datalist>";
	echo "</select>";
	echo "</div>";

echo "<div class='text-center'>";
echo "<button type='submit' class='btn btn-success mt-3' value='Enviar'>Enviar</button>";
echo "</div>";

echo "</form>";

echo "</div>";

?>





</body>
</html>




