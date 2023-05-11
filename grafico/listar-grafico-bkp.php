<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<style>

#chartSelect {

	width:100%;
	max-width:800px;
	margin: auto;
	height:550px;
	font-size: 0.4em;
	border-style: solid;
	border-color: rgba(0,0,0,0.1);
	border-radius: 25px;
	justify-content: center;
}


.form-select {
	width: 25%!important;
}

.newChart{
	width:100%;
	max-width:800px;
	margin: auto;
	height:500px;
	font-size: 0.4em;
	
	border-style: solid;
	border-color: rgba(0,0,0,0.1);
	border-radius: 25px;
	
}


    #grid-table>div.row {
        color: black;
        justify-content: center;
    }

    .btn {
        font-size: 15px;
        margin: 1px;
        margin-top: 2px;
        margin-bottom: 5px;
        padding: 3px;
        width: 60px;
    }

    .caixa{
        font-size: 16px;
        margin-left: 50px;
        margin-right: 80px;
        padding-right: 10px;
        padding-left: 10px;
        margin: 10px;
        margin-bottom: 100px;
    }


    .form-control {
        width: 100%;
        border-radius: 5px;
    }

    #servicos {
        padding: 25px;
    }


    @media (min-width: 992px) {

        .caixa {
            padding-top: 80px;
        }
    }

    @media (max-width: 575.98px) {
		
		
	#chartSelect {
		width:100%;
		max-width:570px;
		height:350px;
		font-size: 0.4em;
		border-style: solid;
		border-color: rgba(0,0,0,0.1);
		border-radius: 25px;
		justify-content: center;
}	
		
		
	
	
		.form-select {
			width: 70%!important;
}
		
		.newChart{
			
			width:100%;
			max-width:570px;
			height: 300px;
			font-size: 0.2em;
			margin-left: 0px;
			border-style: solid;
			border-radius: 25px;
			
}
			
        .caixa {
            margin: 16px;
            margin-left: -55px;
            margin-right: -65px;
            font-size: 9px;
            background-color: white;
            padding: 25px 8px 20px 10px;
			overflow-x: auto;
        }

        .btn {
            font-size: 9px;
            margin: 3px;
            margin-top: 0px;
            padding: 5px;
            width: 40px;
        }

        div.col {
            margin: auto;
            width: 100%;
            word-break: break-word;
            padding: 10 0 10 0;
            padding: 2px;
        }

        #servicos {
            padding: 10px 5px 2px 1px;
        }

    }
</style>

<?php
include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);
?>

<section id="servicos" class="caixa">
    <div class="text-center">
        <div class="secao-title">
            <h3>Lista de Gráficos</h3>
        </div>



<!--       xxxxxxxxx    Gráfico 01    xxxxxxxxx      -->


<div id="chartSelect" class="mt-3 justify-content-center">

<!-- <label for="ano">Escolha o ano:</label> -->
<div class="d-flex justify-content-center">
<select name="ano" id="ano" class="form-select mt-2" aria-label="Default select example">
  <option selected style="display: none" disabled>Escolha o ano:</option>
  <option value="2020">2020</option>
  <option value="2021">2021</option>
  <option value="2022">2022</option>
  <option value="2023">2023</option>
</select>
</div>

<div id="myChart" class="newChart" style="border-style: none"></div>

</div>


<!--       xxxxxxxxx    Gráfico 02    xxxxxxxxx      -->

<div id="myChart2" class="newChart mt-3"></div>

<!--       xxxxxxxxx    Gráfico 03    xxxxxxxxx      -->

<div id="myChart3" class="newChart mt-3"></div>

<!--       xxxxxxxxx    Gráfico 04    xxxxxxxxx      -->

<div id="myChart4" class="newChart mt-3"></div>


<!--       xxxxxxxxx    Gráfico 05    xxxxxxxxx      -->

<div id="myChart5" class="newChart mt-3"></div>


<!--       xxxxxxxxx    Gráfico 06    xxxxxxxxx      -->
<div id="chartSelect" class="mt-3 justify-content-center">

<!-- <label for="ano">Escolha o ano:</label> -->
<div class="d-flex justify-content-center">
<select name="ano" id="ano" class="form-select mt-2" aria-label="Default select example">
  <option selected style="display: none" disabled>Escolha o ano:</option>
  <option value="2020">2020</option>
  <option value="2021">2021</option>
  <option value="2022">2022</option>
  <option value="2023">2023</option>
</select>
</div>

<div id="myChart6" class="newChart" style="border-style: none"></div>

</div>





        <div>

            <?php


/*
            require_once('function-seduc.php');

            try {
                if (isset($_REQUEST['pendente'])) {
                    $sql = "SELECT * FROM relatorioview r 
                            WHERE nm_situacaoRelatorio LIKE 'Pendente' ORDER BY num_Relatorio ";
                } else {
                    $sql = "SELECT * FROM relatorioview r 
                            ORDER BY nm_situacaoRelatorio <> 'Pendente', num_Relatorio DESC";
                }
                $res = $conn->query($sql);
                $qtd = $res->num_rows;
            } catch (mysqli_sql_exception $e) {
                /*
                print "<script>alert('Ocorreu um erro interno ao buscar dados dos relatórios');
                                location.href='painel.php';</script>";
                
                criaLogErro($e);
            }
			
			
	*/		
			
		 
                
            $sql = "SELECT num_Relatorio FROM relatorio 
                            WHERE cd_Relatorio = '140'";
                
            $res = $conn->query($sql);
                       
			
            $sql2 = "SELECT num_Relatorio FROM relatorio WHERE cd_Relatorio = '141'";
                
                $res2 = $conn->query($sql2);
                $qtd2 = $res2->num_rows;
            
			
                //print "</tr>";
                while ($row = $res->fetch_object()) {
					$valor = $row->num_Relatorio;
				}
				while ($row2 = $res2->fetch_object()) {
					$valor2 = $row2->num_Relatorio;
				}
 
  
            ?>

        </div>
    </div>

</section>



<script>


/* ---------------------   Gráfico 01   ------------------------*/

//quant. contrato ativo finalizado (ano escolhido)

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);



function drawChart() {
var data = google.visualization.arrayToDataTable([
  ['Nº de Contrato ativo e finalizado', 'Ano'],
  <?php
  print "['Ativo', $valor ],";
    
  print "['Finalizado', $valor2 ],";
  ?>
]);


var options = {
  title:'Nº de Contrato', 'legend':'bottom', backgroundColor: 'transparent'
};

var chart = new google.visualization.PieChart(document.getElementById('myChart'));
  chart.draw(data, options);
};




/* ---------------------   Gráfico 02   ------------------------*/


google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart2);



function drawChart2() {
var data = google.visualization.arrayToDataTable([
  ['Escola', '% Andamento da obra'],
  ['EMEF CAIC – AYRTON SENNA DA SILVA',55],
  ['EMEF MATTEO BEI',50],
  ['EMEF PROFESSOR LÚCIO MARTINS RODRIGUES',45],
  ['EMEI VILA JÓQUEI',25],
  ['EMEIEF NILTON RIBEIRO',85],
  ['EMEI DOM PEDRO I',55],
  ['EMEIEF ERCÍLIA NOGUEIRA COBRA',30],
  ['EMEIEF PREFEITO JONAS RODRIGUES',90],
  ['EMEIEF NILTON RIBEIRO',75],
  ['EMEIEF SAULO TARSO MARQUES DE MELLO',10]  
  
]);

var options = {
  title:'Andamento de obra ativa por Escola', 'legend':'bottom', backgroundColor: 'transparent'
};

var chart = new google.visualization.BarChart(document.getElementById('myChart2'));
  chart.draw(data, options);
}



/* ---------------------   Gráfico 03   ------------------------*/

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart3);



function drawChart3() {
var data = google.visualization.arrayToDataTable([
  ['Escola', 'Quantidade de contratos ativos'],
  ['EMEF CAIC – AYRTON SENNA DA SILVA', 2],
  ['EMEF MATTEO BEI', 1],
  ['EMEF PROFESSOR LÚCIO MARTINS RODRIGUES',1],
  ['EMEIEF SAULO TARSO MARQUES DE MELLO',1]  
  
]);

var options = {
  title:'Quantidade de contratos ativos por Escola', 'legend':'bottom', backgroundColor: 'transparent'
};

var chart = new google.visualization.BarChart(document.getElementById('myChart3'));
  chart.draw(data, options);
}


/* ---------------------   Gráfico 04   ------------------------*/

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart4);



function drawChart4() {
var data = google.visualization.arrayToDataTable([
  ['Escola', 'Quantidade de obras ativas'],
  ['EMEF CAIC – AYRTON SENNA DA SILVA',2],
  ['EMEI DOM PEDRO I',1],
  ['EMEIEF ERCÍLIA NOGUEIRA COBRA',3],
  ['EMEIEF NILTON RIBEIRO',1],
  ['EMEIEF SAULO TARSO MARQUES DE MELLO',2]  
  
]);

var options = {
  title:'Quantidade de obras ativas por Escola', 'legend':'bottom', backgroundColor: 'transparent'
};

var chart = new google.visualization.BarChart(document.getElementById('myChart4'));
  chart.draw(data, options);

}

/* ---------------------   Gráfico 05   ------------------------*/


google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart5);



function drawChart5() {
var data = google.visualization.arrayToDataTable([
  ['Fornecedor', 'Quantidade de contrato ativo'],
  ['Barbosa Reformas Ltda',2],
  ['VT Pinturas S.A.',1],
  ['Tela Rodrigues Ltda',1],
  ['Irmãos Carpintaria Ltda',3],
  
  
]);

var options = {
  title:'Quantidade de contratos ativos por fornecedor', 'legend':'bottom', backgroundColor: 'transparent'
};

var chart = new google.visualization.BarChart(document.getElementById('myChart5'));
  chart.draw(data, options);
}






/* ---------------------   Gráfico 06   ------------------------*/

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart6);


function drawChart6() {
var data = google.visualization.arrayToDataTable([
  ['Obras ativas e finalizadas', 'Quantidade'],
  <?php
  print "['Ativa', $valor ],";
  
  
  print "['Finalizada', $valor2 ],";
  ?>
]);

var options = {
  title:'Nº de Obras', 'legend':'bottom', backgroundColor: 'transparent'
};


var chart = new google.visualization.PieChart(document.getElementById('myChart6'));
  chart.draw(data, options);
  
 
};


</script>




