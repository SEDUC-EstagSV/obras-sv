<style>
    #grid-table>div.row {
        color: black;
        justify-content: center;
    }

    .btn {
        font-size: 15px;
        margin: 1px;
        margin-top: 5px;
        margin-bottom: 25px;
        padding: 5px;
        width: 70px;
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
	
	label {
		font-weight: bold;
	}


    .form-control {
        width: 100%;
        border-radius: 5px;
    }

    #servicos {
        padding: 25px 50px 5px 50px;


    }


    @media (min-width: 992px) {

        .caixa {
            padding-top: 80px;
        }
    }




    @media (max-width: 575.98px) {
        .caixa {
            margin: 10px;
            margin-left: -65px;
            margin-right: -85px;
            font-size: 15px;
            background-color: white;
            font-size: 12px;
            padding: 10px;

        }



        #space {
            padding-top: 25px;
        }






        .btn {
            font-size: 12px;
            margin: 2px;
            margin-top: 0px;
            margin-bottom: 30px;
            padding: 5px;
            width: 46px;

        }



        .form-control {

            width: 100%;
            border-radius: 5px;

        }

        #servicos {
            padding-left: 8px;
            padding-right: 25px;


        }


    }
</style>

<?php
include_once('function-seduc.php');

redirecionamentoPorAutoridade(4);
?>

<section id="servicos" class="caixa">
    <div class="secao-title">
        <h3>Novo Fornecedor</h3>

        <form action="?page=salvarfornecedor" method="POST">
            <input type="hidden" name="acaofornecedor" value="CadastrarFornecedor">
            <div class="mb-3">
                <label>Nome fornecedor</label>
                <input type="nome" name="nm_Fornecedor" class="form-control">
            </div>
            <div class="mb-3">
                <label>CNPJ</label>
                <input type="text" name="num_CNPJ" class="form-control">
            </div>
            <div class="mb-3">
                <label>E-mail</label>
                <input type="email" name="ds_Email" class="form-control">
            </div>
            <div class="mb-3">
                <label>Endereço</label>
                <input type="text" name="ds_Endereco" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
</section>