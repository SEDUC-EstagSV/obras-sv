<?php

include_once "../config.php";

$cd_contrato = filter_input(INPUT_GET, "cd");

if(!empty($cd_contrato)){
  header('Content-type: application/json');   

  if(str_contains($cd_contrato, '/')){
    $valueContrato = explode($cd_contrato, '/');
    $num_contrato = $valueContrato[0] . "%";
    $ano_contrato = $valueContrato[1] . "%";

    $query_contrato= $conn->prepare("SELECT num_contrato, dt_AnoContrato
  FROM contrato
  WHERE num_contrato LIKE ? AND dt_AnoContrato LIKE ? LIMIT 10");
  $query_contrato->bind_param('ss', $pesq_contrato);
  $query_contrato->execute();

  $result_contrato = $query_contrato->get_result();
  
  if(($result_contrato->num_rows > 0)){
      while($row_contrato = $result_contrato->fetch_assoc()){
          $dados[] = [
              'num' => $row_contrato['num_contrato'],
              'ano' => $row_contrato['dt_AnoContrato']
            ];
        }
        
        $retorna = ['erro' => false, 'dados' => $dados];
    }else{
        $retorna = ['erro' => true, 'msg' => "Erro: Nenhum contrato encontrado!"];
    }

  }
  
  if(!str_contains($cd_contrato, '/')){

      $pesq_contrato = $cd_contrato . "%";
      
      $query_contrato= $conn->prepare("SELECT num_contrato, dt_AnoContrato
  FROM contrato
  WHERE num_contrato LIKE ? LIMIT 10");
  $query_contrato->bind_param('s', $pesq_contrato);
  $query_contrato->execute();

  $result_contrato = $query_contrato->get_result();
  
  if(($result_contrato->num_rows > 0)){
      while($row_contrato = $result_contrato->fetch_assoc()){
          $dados[] = [
              'num' => $row_contrato['num_contrato'],
              'ano' => $row_contrato['dt_AnoContrato']
            ];
        }
        
        $retorna = ['erro' => false, 'dados' => $dados];
    }else{
        $retorna = ['erro' => true, 'msg' => "Erro: Nenhum contrato encontrado!"];
    }
}
    
}else{
    $retorna = ['erro' => true, 'msg' => "Erro: Nenhum contrato encontrado!"];
}

echo json_encode($retorna);


?>