<?php
include 'function-seduc.php';
    if (isset($_POST['pesquisa'])) {
        $value = explode('/', $_POST['pesquisa']);
        $num_contrato = $value[0];
        $ano_contrato = $value[1];

        require_once 'config.php';
        try{
            $sql = $conn->prepare("SELECT * FROM escola WHERE cd_Escola IN 
                                    (SELECT cd_Escola FROM escola_has_contrato 
                                    INNER JOIN contrato 
                                    ON escola_has_contrato.cd_contrato = contrato.cd_contrato 
                                    WHERE num_contrato = ? AND dt_AnoContrato = ?)");
            $sql->bind_param('ss', $num_contrato, $ano_contrato);
            $sql->execute();

            $res = $sql->get_result();
            $data = "";
            if($res->num_rows > 0){
                while ($row = $res->fetch_object()) {
                    $data .= '<option value=' . $row->cd_Escola . '>' . $row->nm_Escola . '</option>';
                }
            } else {
                $data .= '<option value=' . -1 . '>Este contrato não possui escolas</option>';
            }
            echo json_encode($data);
        } catch (mysqli_sql_exception $e){
            criaLogErro($e);
        }
    }
?>