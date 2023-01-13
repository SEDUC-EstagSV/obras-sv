<?php
include 'function-seduc.php';
    if (isset($_POST['pesquisa'])) {
        $cd_Escola = $_POST['pesquisa'];
        require_once 'config.php';
        try{

            $sql = $conn->prepare("SELECT * FROM contrato WHERE cd_Escola = ?");
            $sql->bind_param('i', $cd_Escola);
            $sql->execute();

            $res = $sql->get_result();
            $data = "";
            if($res->num_rows > 0){
                while ($row = $res->fetch_object()) {
                    $data .= '<option value={' . $row->cd_Contrato . '}>' . $row->cd_Contrato .  '/' . $row->dt_AnoContrato . '</option>';
                }
            } else {
                $data .= '<option value={' . -1 . '}>Esta escola não possui contratos</option>';
            }
            echo json_encode($data); // This will encode the data into a variable that JavaScript can decode.
        } catch (mysqli_sql_exception $e){
            criaLogErro($e);
        }
    }
?>