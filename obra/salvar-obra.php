<?php


include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);


switch ($_REQUEST["acaoobra"]) {
    case 'cadastrarObra':
        $st_Obra = $_POST["st_Obra"];
        $cd_Escola = $_POST["nm_Escola"];
        //$nm_Contratante = $_POST["nm_Contratante"];
        $tp_AtivDescricao = $_POST["tp_AtivDescricao"];
        $valueContrato = explode('/', $_POST["num_contrato"]);
        $numContrato = $valueContrato[0];
        $anoContrato = $valueContrato[1];
        
            try{
                $sql = $conn->prepare("INSERT INTO obra (cd_Escola,tp_AtividadeDescricao,dt_AnoContrato,cd_situacaoObra, cd_Contrato) 
                    VALUES(?,?,?,?,(SELECT cd_Contrato FROM contrato WHERE num_contrato = ? AND dt_AnoContrato = ?))");
                $sql->bind_param('ississ',
                $cd_Escola,$tp_AtivDescricao,
                $anoContrato,$st_Obra, $numContrato, $anoContrato);

                $res = $sql->execute();
                if ($res == true) {
                    print "<script>alert('Cadastro com sucesso');</script>";
                    print "<script>location.href='?page=listaobra';</script>";
                } else {
                    print "<script>alert('Não foi possível cadastrar');</script>";
                    print "<script>location.href='?page=listaobra';</script>";
                }
            } catch(mysqli_sql_exception $e){
                print "<script>alert('Não foi possível cadastrar. Verifique se os dados estão corretos');</script>";
                print "<script>window.history.go(-1);</script>";
                criaLogErro($e);
            }
            

        break;

    case 'editarobra':
        $cd_Obra = $_REQUEST["cd_Obra"];
        $cd_Escola = $_POST["cd_Escola"];
        $nm_Obra = $_POST["nm_Obra"];
        $cd_Contrato = $_POST["cd_Contrato"];
        $nm_Contratante = $_POST["nm_Contratante"];
        $tp_AtivDescricao = $_POST["tp_AtivDescricao"];
        $st_Obra = $_POST["st_Obra"];
        $tp_Comentario = $_POST["tp_Comentario"];

        try{
            $sql = $conn->prepare("UPDATE obra SET cd_Escola = ?,
                                        nm_Obra = ?,
                                        cd_Contrato = ?,
                                        nm_Contratante = ?, 
                                        tp_AtivDescricao = ?,
                                        st_Obra = ?, 
                                        tp_Comentario = ?
                            WHERE
                                cd_Obra= ?");

            $sql->bind_param('isiisssi', $cd_Escola,$nm_Obra,$cd_Contrato,$nm_Contratante,$tp_AtivDescricao,$st_Obra,$tp_Comentario,$cd_Obra);
            $res = $sql->execute();

            if($sql->affected_rows === 0){
                print "<script>alert('Ocorreu um erro ao buscar obra');</script>";
                print "<script>window.history.go(-1);</script>";
            }

            if ($res == true) {
                print "<script>alert('Editado com sucesso');</script>";
                print "<script>location.href='?page=listaobra';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listaobra';</script>";
            }
        } catch(mysqli_sql_exception $e){
            print "<script>alert('Não possível editar. Verifique se os dados estão corretos');</script>";
            print "<script>window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;

    case 'excluirObra':
        $cd_Obra = $_REQUEST["cd_Obra"];

        try{
            $sql = $conn->prepare("DELETE FROM obra WHERE cd_Obra= ?");
            $sql->bind_param('i',$cd_Obra);
    
            $res = $sql->execute();
    
            if ($res == true) {
                print "<script>alert('Excluido com sucesso');</script>";
                print "<script>location.href='?page=listaobra';</script>";
            } else {
                print "<script>alert('Não foi possível excluir');</script>";
                print "<script>location.href='?page=listaobra';</script>";
            }

        } catch (mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro ao tentar excluir');</script>";
            criaLogErro($e);
        }
        break;
}
