<?php
require_once 'contrato/function-contrato.php';
require('validator.php');

switch ($_REQUEST["acaorelatorio"]) {
    case 'cadastrarRelatorio':
        $cd_Obra = validateInput($_POST["cd_Obra"]);
        $nm_TecResponsavel = validateInput($_POST["nm_TecResponsavel"]);
        $ds_Email = validateInput($_POST["ds_Email"]);
        $nm_LocResponsavel = validateInput($_POST["nm_LocResponsavel"]);
        $dt_Carimbo = date("Y/m/d");
        $tp_AtivRealizada = validateInput($_POST["tp_AtivRealizada"]);
        $tp_RelaSituacao = 1;
        $nm_Dia = date("l");
        if(isset($_POST["tp_Periodo"])){
            $tp_Periodo = validateArray($_POST["tp_Periodo"]);
        } else {
            $tp_Periodo = null;
        }
        $tp_Tempo = validateInput($_POST["tp_Tempo"]);
        $tp_Condicao = validateInput($_POST["tp_Condicao"]);
        $qt_TotalMaodeObra = validateInput($_POST["qt_TotalMaodeObra"]);
        $qt_Ajudantes = validateInput($_POST["qt_Ajudantes"]);
        $qt_Eletricistas = validateInput($_POST["qt_Eletricistas"]);
        $qt_Mestres = validateInput($_POST["qt_Mestres"]);
        $qt_Pedreiros = validateInput($_POST["qt_Pedreiros"]);
        $qt_Serventes = validateInput($_POST["qt_Serventes"]);
        $qt_MaoDireta = validateInput($_POST["qt_MaoDireta"]);
        $pt_Conclusao = validateInput($_POST["pt_Conclusao"]);
        $tp_RelaComentario = validateInput($_POST["tp_RelaComentario"]);
        $cd_Usuario = $_SESSION['user'][2];

        //verificação e validação de arquivos de foto
        function rearrange( $arr ){
            foreach( $arr as $key => $all ){
                foreach( $all as $i => $val ){
                    $new[$i][$key] = $val;    
                }    
            }
            return $new;
        }

        $fileExists = $_FILES['foto']['tmp_name'][0] != "";
        if($fileExists){
            $allowTypes = array('jpg','png','jpeg'); 
        
            $arquivosDeFoto = rearrange($_FILES['foto']);
            $i = 0;
            foreach($arquivosDeFoto as $foto){
                if(in_array($foto['type'], $foto)){
                    $fotos = $arquivosDeFoto;
                    $fotos[$i]['tmp_name'] = file_get_contents($foto['tmp_name']);
                    $i++;
                } else {
                    print "<script>alert('Existe uma imagem em formato incorreto, formatos permitidos: 
                                    jpg, png, jpeg');
                                    window.history.go(-1);</script>";
                }
            } 
        } else {
            $fotos = NULL;
        }
        

        try{
            $sql = $conn->prepare("SELECT DISTINCT o.*, c.* FROM contrato c, obra o WHERE o.cd_Contrato = c.cd_Contrato AND o.cd_Obra = ?");
            $sql->bind_param("i", $cd_Obra);
            $sql->execute();
            $res = $sql->get_result();
            if($res->num_rows === 0) {
                print "<script>alert('Obra não encontrada');
                window.history.go(-1);</script>";
                exit();
            }
            $row = $res->fetch_object();
            $cd_Escola = $row->cd_Escola;

        } catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao buscar dados da obra informada');
                    window.history.go(-1);</script>";
            criaLogErro($e);
            exit();
        }


        $dt_Inicial = $row->dt_Inicial;
        $dt_Final = $row->dt_Final;

        $pr_Decorrido = dataDecorrida($dt_Inicial, $dt_Final);
        $pr_Vencer = dataVencer($dt_Final);

        try{
            $sql = $conn->prepare("INSERT INTO relatorio (
                cd_Obra,
                cd_Escola,
                nm_TecResponsavel, 
                ds_Email_TecResponsavel, 
                nm_LocResponsavel, 
                dt_Carimbo, 
                cd_situacaoRelatorio, 
                nm_Dia, 
                cd_tipoTempo, 
                cd_tipoCondicao, 
                qt_TotalMaodeObra, 
                qt_Ajudantes, 
                qt_Eletricistas, 
                qt_Mestres, 
                qt_Pedreiros, 
                qt_Serventes, 
                qt_MaoDireta, 
                pt_Conclusao, 
                tp_AtivRealizada,
                tp_Comentario, 
                pr_Decorrido,
                pr_Vencer,
                cd_Usuario,
                num_Relatorio) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                     (SELECT COUNT(*) AS num_relatorios 
                     FROM relatorio rnum WHERE (rnum.cd_obra LIKE ?) + 1))");
    
            $sql->bind_param('iissssisiiiiiiiiiissssii', 
                    $cd_Obra,$cd_Escola,$nm_TecResponsavel,$ds_Email,$nm_LocResponsavel,
                    $dt_Carimbo,$tp_RelaSituacao,$nm_Dia,$tp_Tempo,$tp_Condicao,
                    $qt_TotalMaodeObra,$qt_Ajudantes,$qt_Eletricistas,$qt_Mestres,$qt_Pedreiros,
                    $qt_Serventes,$qt_MaoDireta,$pt_Conclusao,$tp_AtivRealizada,$tp_RelaComentario,
                    $pr_Decorrido,$pr_Vencer, $cd_Usuario, $cd_Obra);
    
            $res = $sql->execute();
    
            if ($res == true) {
                try{
                    $cd_Relatorio = $conn->insert_id;
                    if($fotos != null){
                        $sqlFoto = $conn->prepare("INSERT INTO foto (cd_Relatorio, img_foto, ds_foto) VALUES (?, ?, ?)");
                        foreach($fotos as $a){
                            $img = $a['tmp_name'];
                            $descricao = $a['name'];
                            $sqlFoto->bind_param('iss', $cd_Relatorio, $img, $descricao);
                            $resFoto = $sqlFoto->execute();
                        }
                    }
                } catch (mysqli_sql_exception $e){
                    print "<script>alert('Ocorreu um erro interno na criação do relatório');
                            window.history.go(-1);</script>";
                    criaLogErro($e);
                }

                if($tp_Periodo != null){
                    try{
                        $sqlJunctionTable = $conn->prepare("INSERT INTO relatorio_has_tipo_periodo (cd_Relatorio, cd_tipoPeriodo) VALUES (?, ?)");
                        foreach($tp_Periodo as $periodo){
                            $sqlJunctionTable->bind_param('ii', $cd_Relatorio, $periodo);
                            $resJunctionTable = $sqlJunctionTable->execute();
                        }
                    } catch (mysqli_sql_exception $e){
                        print "<script>alert('Ocorreu um erro interno na criação do relatório');
                        window.history.go(-1);</script>";
                        criaLogErro($e);
                    }
                }

                print "<script>alert('Relatório criado com sucesso');</script>";
                print "<script>location.href='?page=listar_relatorio';</script>";
            } else {
                print "<script>alert('Não foi possível cadastrar');</script>";
                print "<script>location.href='?page=listar_relatorio';</script>";
            }
        } catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao criar relatório');
                    window.history.go(-1);</script>";
            criaLogErro($e);
        }

        break;

    case 'excluirRelatorio':
        $cd_Relatorio = $_REQUEST["cd_Relatorio"];

        try{
            $sql = $conn->prepare("DELETE FROM relatorio_has_tipo_periodo WHERE cd_Relatorio = ?");
            $sql->bind_param('i', $cd_Relatorio);
            $res = $sql->execute();

            if ($res == true) {
                try{
                    $sql = $conn->prepare("DELETE FROM relatorio WHERE cd_Relatorio = ?");
                    $sql->bind_param('i', $cd_Relatorio);
                    $resDeleteRelatorio = $sql->execute();
                } catch (mysqli_sql_exception $e){
                    print "<script>alert('Ocorreu um erro ao excluir');</script>";
                print "<script>location.href='?page=listar_relatorio';</script>";
                }
                print "<script>alert('Excluido com sucesso');</script>";
                print "<script>location.href='?page=listar_relatorio';</script>";
            } else {
                print "<script>alert('Não foi possível excluir');</script>";
                print "<script>location.href='?page=listar_relatorio';</script>";
            }
        } catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao excluir relatório');
                            location.reload();</script>";
            criaLogErro($e);
        }
        break;

    case 'editarrelatorio':
        $cd_Relatorio = validateInput($_REQUEST["cd_Relatorio"]);
        $tp_RelaSituacao = validateInput($_POST["tp_RelaSituacao"]);

        try{
            $sql = $conn->prepare("UPDATE relatorio SET cd_situacaoRelatorio= ?
                                    WHERE cd_Relatorio = ?" );
            $sql->bind_param('ii', $tp_RelaSituacao, $cd_Relatorio);
    
            $res = $sql->execute();
    
            if ($res == true) {
                print "<script>alert('Relatório editado com sucesso');</script>";
                print "<script>location.href='?page=listar_relatorio';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listar_relatorio';</script>";
            }
        } catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao editar relatório');
                    window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;

/*
    case 'editarrelatorioADM':
        $cd_Relatorio = $_REQUEST["cd_Relatorio"];
        $cd_Obra = $_POST["cd_Obra"];
        $num_Relatorio = $_POST["num_Relatorio"];
        $nm_TecResponsavel = $_POST["nm_TecResponsavel"];
        $ds_Email = $_POST["ds_Email"];
        $nm_LocResponsavel = $_POST["nm_LocResponsavel"];
        $dt_Carimbo = date("Y/m/d");
        $tp_AtivRealizada = $_POST["tp_AtivRealizada"];
        $tp_RelaSituacao = $_POST["tp_RelaSituacao"];
        $nm_Dia = date("l");
        $tp_Periodo = $_POST["tp_Periodo"];
        $tp_Tempo = $_POST["tp_Tempo"];
        $tp_Condicao = $_POST["tp_Condicao"];
        $qt_TotalMaodeObra = $_POST["qt_TotalMaodeObra"];
        $qt_Ajudantes = $_POST["qt_Ajudantes"];
        $qt_Eletricistas = $_POST["qt_Eletricistas"];
        $qt_Mestres = $_POST["qt_Mestres"];
        $qt_Pedreiros = $_POST["qt_Pedreiros"];
        $qt_Serventes = $_POST["qt_Serventes"];
        $qt_MaoDireta = $_POST["qt_MaoDireta"];
        $pt_Conclusao = $_POST["pt_Conclusao"];
        $tp_RelaComentario = $_POST["tp_RelaComentario"];

        try{
            $sql = $conn->prepare("UPDATE relatorio SET cd_Obra = ?,
                                                        num_Relatorio = ?,
                                                        nm_TecResponsavel = ?, 
                                                        ds_Email_TecResponsavel = ?, 
                                                        nm_LocResponsavel = ?, 
                                                        dt_Carimbo = ?,
                                                        tp_AtivRealizada = ?,
                                                        cd_situacaoRelatorio= ?,
                                                        nm_Dia = ?, 
                                                        cd_tipoTempo= ?,
                                                        cd_tipoCondicao= ?,
                                                        qt_TotalMaodeObra = ?,
                                                        qt_Ajudantes = ?, 
                                                        qt_Eletricistas = ?, 
                                                        qt_Mestres = ?, 
                                                        qt_Pedreiros = ?, 
                                                        qt_Serventes = ?, 
                                                        qt_MaoDireta = ?, 
                                                        pt_Conclusao = ?, 
                                                        tp_Comentario = ?
                                    WHERE
                                        cd_Relatorio = ?" );
            $sql->bind_param('iisssssssssiiiiiiiisi', 
                    $cd_Obra,$num_Relatorio,$nm_TecResponsavel,$ds_Email,$nm_LocResponsavel,
                    $dt_Carimbo,$tp_AtivRealizada,$tp_RelaSituacao,$nm_Dia,$tp_Tempo,
                    $tp_Condicao,$qt_TotalMaodeObra,$qt_Ajudantes,$qt_Eletricistas,$qt_Mestres,
                    $qt_Pedreiros,$qt_Serventes,$qt_MaoDireta,$pt_Conclusao,$tp_RelaComentario, $cd_Relatorio);
    
            $res = $sql->execute();
    
            if ($res == true) {

                try{
                    $sql = $conn->prepare("DELETE FROM relatorio_has_tipo_periodo WHERE cd_Relatorio = ?");
                    $sql->bind_param('i', $cd_Relatorio);
                    $resDelHist = $sql->execute();

                    if($resDelHist){
                        $sqlJunctionTable = $conn->prepare("INSERT INTO relatorio_has_tipo_periodo (cd_Relatorio, cd_tipoPeriodo) VALUES (?, ?)");
                        foreach($tp_Periodo as $periodo){
                            $sqlJunctionTable->bind_param('ii', $cd_Relatorio, $periodo);
                            $resJunctionTable = $sqlJunctionTable->execute();
                        }
                    }
                } catch (mysqli_sql_exception $e){
                    print "<script>alert('Ocorreu um erro interno na criação do relatório');
                            window.history.go(-1);</script>";
                    criaLogErro($e);
                }

                print "<script>alert('Relatório editado com sucesso');</script>";
                print "<script>location.href='?page=listar_relatorio';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listar_relatorio';</script>";
            }
        } catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao editar relatório');
                    window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;
*/
}
