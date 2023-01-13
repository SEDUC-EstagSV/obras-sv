<?php
include 'function-seduc.php';
    if (isset($_POST['pesquisa'])) {
        $cd_Contrato = $_POST['pesquisa'];
        require_once 'config.php';
        try{

            $sql = $conn->prepare("SELECT * FROM escola WHERE cd_Escola IN (SELECT cd_Escola FROM escola_has_contrato WHERE cd_contrato = ?)");
            $sql->bind_param('i', $cd_Contrato);
            $sql->execute();

            $res = $sql->get_result();
            $data = "";
            if($res->num_rows > 0){
                while ($row = $res->fetch_object()) {
                    $data .= '<option value={' . $row->cd_Escola . '}>' . $row->nm_Escola . '</option>';
                }
            } else {
                $data .= '<option value={' . -1 . '}>Este contrato não possui escolas</option>';
            }
            echo json_encode($data); // This will encode the data into a variable that JavaScript can decode.
        } catch (mysqli_sql_exception $e){
            criaLogErro($e);
        }
    }
?>