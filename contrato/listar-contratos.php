<style>
	#keepAll {
		word-break: keep-all;
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

    .caixa {
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
        .caixa {
            margin: 16px;
            margin-left: -55px;
            margin-right: -65px;
            font-size: 9px;
            background-color: white;
            padding: 25px 8px 20px 10px;
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
    <div>
        <div>
            <h3>Lista de Contratos</h3>
        </div>
        <div style="overflow-x:auto;">

            <?php

            require_once 'function-contrato.php';

            try {
                $sql = "SELECT * FROM contratoview";

                $res = $conn->query($sql);

                $qtd = $res->num_rows;
            } catch (mysqli_sql_exception $e) {
                print "<script>alert('Ocorreu um erro interno ao buscar dados dos contratos');
    location.href='painel.php';</script>";
                criaLogErro($e);
            }



            if ($qtd > 0) {
                print "<table class='table table-hover table-striped table-bordered'>";
                print "<tr>";
                print "<th class='align-middle text-center'>Nº</th>";
                // print "<th class='align-middle text-center'>#Fornecedor</th>";
                print "<th id='keepAll' class='align-middle text-center'>Fornecedor</th>";
                print "<th id='keepAll' class='align-middle text-center'>Ano</th>";
                // print "<th>Início</th>";
                // print "<th>Termino</th>";
                //  print "<th>Prazo Contratual</th>";
                // print "<th>Tempo decorrido</th>";
                // print "<th>Prazo a vencer</th>";
                print "<th class='align-middle text-center'>Objeto do Contrato</th>";
                print "<th id='keepAll' class='align-middle text-center'>Situação</th>";
                if (liberaFuncaoParaAutoridade(4)) {
                    print "<th class='align-middle text-center'>Ações</th>";
                }
                print "</tr>";
                while ($row = $res->fetch_object()) {
                    print "<tr>";
                    print "<td id='keepAll' class='align-middle text-center'>" . $row->num_contrato . "</td>";
                    // print "<td class='align-middle text-center'>" . $row->cd_Fornecedor . "</td>";
                    print "<td class='align-middle'>" . $row->nm_Fornecedor . "</td>";
                    print "<td id='keepAll' class='align-middle text-center'>" . $row->dt_AnoContrato . "</td>";
                    // print "<td>" . $row->dt_Inicial . "</td>";
                    //  print "<td>" . $row->dt_Final . "</td>";
                    // print "<td>" . $row->pr_Total . "</td>";
                    $dt_Inicial = $row->dt_Inicial;
                    $dt_Final = $row->dt_Final;
                    // print "<td>" . dataDecorrida($dt_Inicial, $dt_Final) . "</td>";
                    // print "<td>" . dataVencer($dt_Final) . "</td>";
                    print "<td id='keepAll' class='align-middle'>" . $row->tp_Servico . "</td>";
                    print "<td id='keepAll' class='align-middle text-center'>" . $row->nm_situacao . "</td>";
                    if (liberaFuncaoParaAutoridade(4)) {
                        print "<td class='align-middle text-center'>
            <button onclick=\"location.href='?page=editarcontrato&cd_Contrato=" . $row->cd_Contrato . "';\" class='btn btn-success'>Editar</button>
            <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarcontrato&acaocontrato=excluircontrato&cd_Contrato=" . $row->cd_Contrato . "';}else{false;}\" class='btn btn-danger'>Excluir</button>
            
            </td>";
                    }
                    print "</tr>";
                }
                print "</table>";
            } else
                print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";

            ?>

        </div>
    </div>
</section>