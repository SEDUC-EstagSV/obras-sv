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


    .form-control {
        width: 100%;
        border-radius: 5px;
    }

    label {
        font-weight: bold;
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
        <h3>Criar nova conta</h3>
    </div>

    <form action="?page=salvarusuario" method="POST">
        <?php
        $blank = $_GET['blank'];
        if ($blank == 1) {
            print "<input type='text' name='blank' value='1' hidden>";
        }
        ?>
        <input type="hidden" name="acaousuario" value="cadastrarUsuario">
        <div class="mb-3">
            <label>Nome de Usuário</label>
            <input type="name" name="user_Login" class="form-control">
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <div class="input-group">
                <input type="password" name="user_Senha" class="form-control" id="senha" autocomplete="off">
                <i class="input-group-text bi bi-eye-slash" id="viewSenha"></i>
            </div>
        </div>

        <div class="mb-3">
            <label>Confirmar Senha</label>
            <input type="password" name="user_Senha2" class="form-control">
        </div>
        <div class="mb-3">
            <label>Nome completo</label>
            <input type="name" name="user_Nome" class="form-control">
        </div>
        <div class="mb-3">
            <label>CPF</label>
            <input type="text" name="user_CPF" class="form-control">
        </div>
        <div class="mb-3">
            <label>E-mail</label>
            <input type="text" name="user_Email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Celular / Telefone</label>
            <input type="tel" name="user_Telefone" class="form-control">
        </div>
        <div class="mb-3">
            <label>Fornecedor</label>

            <?php
            try {
                $sql = "SELECT * FROM fornecedor";

                $res = $conn->query($sql);
            } catch (mysqli_sql_exception $e) {
                print "<script>alert('Ocorreu um erro interno ao buscar dados de fornecedores');
                    location.href='painel.php';</script>";
                criaLogErro($e);
            }

            print "<select class='form-select' name='cd_Fornecedor'>";
            print "<option value='' disabled selected>Selecione o fornecedor</option>";
            print "<datalist>";

            while ($row = $res->fetch_object()) {

                print "<option value=$row->cd_Fornecedor>" . $row->nm_Fornecedor . "</option>";
            }
            print "</datalist>";
            print "</select>";
            ?>


        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</section>