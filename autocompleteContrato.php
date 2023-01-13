<?php

include_once "config.php";

$cd_contrato = filter_input(INPUT_GET, "cd");

if(!empty($cd_contrato)){
  header('Content-type: application/json');   
  
  $pesq_contrato = $cd_contrato;
  
  $query_contrato= $conn->prepare("SELECT cd_Contrato
  FROM contrato
  WHERE cd_Contrato LIKE ? LIMIT 10");
  $query_contrato->bind_param('i', $pesq_contrato);
  $query_contrato->execute();

  $result_contrato = $query_contrato->get_result();
  
  if(($result_contrato->num_rows > 0)){
      while($row_contrato = $result_contrato->fetch_assoc()){
            $dados[] = [
                'cd' => $row_contrato['cd_Contrato']
            ];
        }

        $retorna = ['erro' => false, 'dados' => $dados];
    }else{
        $retorna = ['erro' => true, 'msg' => "Erro: Nenhum contrato encontrado!"];
    }
    
}else{
    $retorna = ['erro' => true, 'msg' => "Erro: Nenhum contrato encontrado!"];
}

echo json_encode($retorna);


?>