<?php
require_once 'contrato/function-contrato.php';

switch ($_REQUEST["acaorelatorio"]) {
    case 'cadastrarRelatorio':
        $cd_Obra = $_POST["cd_Obra"];
        $num_Relatorio = $_POST["num_Relatorio"];
        $nm_TecResponsavel = $_POST["nm_TecResponsavel"];
        $ds_Email = $_POST["ds_Email"];
        $nm_LocResponsavel = $_POST["nm_LocResponsavel"];
        $dt_Carimbo = date("Y/m/d");
        $tp_AtivRealizada = $_POST["tp_AtivRealizada"];
        $tp_RelaSituacao = 1;
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

        $sql = $conn->prepare("SELECT c.* FROM contrato c, obra o WHERE o.cd_Contrato = c.cd_Contrato AND o.cd_Obra = ?");
        $sql->bind_param("i", $cd_Obra);
        $sql->execute();
        $res = $sql->get_result();
        if($res->num_rows === 0) {
            print "<script>alert('Obra não encontrada');
                    window.location.href='painel.php';</script>";
            exit();
        }
        $row = $res->fetch_object();


        $dt_Inicial = $row->dt_Inicial;
        $dt_Final = $row->dt_Final;

        $pr_Decorrido = dataDecorrida($dt_Inicial, $dt_Final);
        $pr_Vencer = dataVencer($dt_Final);

        $sql = $conn->prepare("INSERT INTO relatorio (cd_Obra,
                                            num_Relatorio,
                                            nm_TecResponsavel, 
                                            ds_Email, 
                                            nm_LocResponsavel, 
                                            dt_Carimbo, 
                                            tp_RelaSituacao, 
                                            nm_Dia, 
                                            tp_Periodo, 
                                            tp_Tempo, 
                                            tp_Condicao, 
                                            qt_TotalMaodeObra, 
                                            qt_Ajudantes, 
                                            qt_Eletricistas, 
                                            qt_Mestres, 
                                            qt_Pedreiros, 
                                            qt_Serventes, 
                                            qt_MaoDireta, 
                                            pt_Conclusao, 
                                            tp_AtivRealizada,
                                            tp_RelaComentario, 
                                            pr_Decorrido,
                                            pr_Vencer) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $sql->bind_param('iissssissssiiiiiiiissss', 
                $cd_Obra,$num_Relatorio,$nm_TecResponsavel,$ds_Email,$nm_LocResponsavel,
                $dt_Carimbo,$tp_RelaSituacao,$nm_Dia,$tp_Periodo,$tp_Tempo,$tp_Condicao,
                $qt_TotalMaodeObra,$qt_Ajudantes,$qt_Eletricistas,$qt_Mestres,$qt_Pedreiros,
                $qt_Serventes,$qt_MaoDireta,$pt_Conclusao,$tp_AtivRealizada,$tp_RelaComentario,
                $pr_Decorrido,$pr_Vencer);

        $res = $sql->execute();

        if ($res == true) {
            print "<script>alert('Relatório criado com sucesso');</script>";
            print "<script>location.href='?page=listar_relatorio';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar');</script>";
            print "<script>location.href='?page=listar_relatorio';</script>";
        }

        break;

    case 'excluirRelatorio':
        $cd_Relatorio = $_REQUEST["cd_Relatorio"];
        $sql = $conn->prepare("DELETE FROM relatorio WHERE cd_Relatorio = ?");
        $sql->bind_param('i', $cd_Relatorio);
        $res = $sql->execute();

        if ($res == true) {
            print "<script>alert('Excluido com sucesso');</script>";
            print "<script>location.href='?page=listar_relatorio';</script>";
        } else {
            print "<script>alert('Não foi possível excluir');</script>";
            print "<script>location.href='?page=listar_relatorio';</script>";
        }
        break;

    case 'editarrelatorio':
        $cd_Relatorio = $_REQUEST["cd_Relatorio"];
        $cd_Obra = $_POST["cd_Obra"];
        $num_Relatorio = $_POST["num_Relatorio"];
        $nm_TecResponsavel = $_POST["nm_TecResponsavel"];
        $ds_Email = $_POST["ds_Email"];
        $nm_LocResponsavel = $_POST["nm_LocResponsavel"];
        $dt_Carimbo = date("Y/m/d");
        $tp_AtivRealizada = $_POST["tp_AtivRealizada"];
        $tp_RelaSituacao = $_POST["tp_RelaSituacao"];
        $nm_Dia = $_POST["nm_Dia"];
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

        $sql = $conn->prepare("UPDATE relatorio SET cd_Obra = ?,
                                                    num_Relatorio = ?,
                                                    nm_TecResponsavel = ?, 
                                                    ds_Email = ?, 
                                                    nm_LocResponsavel = ?, 
                                                    dt_Carimbo = ?,
                                                    tp_AtivRealizada = ?,
                                                    tp_RelaSituacao= ?,
                                                    nm_Dia = ?, 
                                                    tp_Periodo= ?, 
                                                    tp_Tempo= ?,
                                                    tp_Condicao= ?,
                                                    qt_TotalMaodeObra = ?,
                                                    qt_Ajudantes = ?, 
                                                    qt_Eletricistas = ?, 
                                                    qt_Mestres = ?, 
                                                    qt_Pedreiros = ?, 
                                                    qt_Serventes = ?, 
                                                    qt_MaoDireta = ?, 
                                                    pt_Conclusao = ?, 
                                                    tp_RelaComentario = ?
                                WHERE
                                    cd_Relatorio = ?" );
        $sql->bind_param('iissssssssssiiiiiiiisi', 
                $cd_Obra,$num_Relatorio,$nm_TecResponsavel,$ds_Email,$nm_LocResponsavel,
                $dt_Carimbo,$tp_AtivRealizada,$tp_RelaSituacao,$nm_Dia,$tp_Periodo,$tp_Tempo,
                $tp_Condicao,$qt_TotalMaodeObra,$qt_Ajudantes,$qt_Eletricistas,$qt_Mestres,
                $qt_Pedreiros,$qt_Serventes,$qt_MaoDireta,$pt_Conclusao,$tp_RelaComentario, $cd_Relatorio);

        $res = $sql->execute();

        if ($res == true) {
            print "<script>alert('Relatório editado com sucesso');</script>";
            print "<script>location.href='?page=listar_relatorio';</script>";
        } else {
            print "<script>alert('Não foi possível editar');</script>";
            print "<script>location.href='?page=listar_relatorio';</script>";
        }
        break;
}
