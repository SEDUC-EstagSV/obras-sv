<?php

/*
$a = $_POST["tp_Periodo"];
foreach ($a as $el){
    echo $el;
}
*/
echo $cd_Relatorio = $_REQUEST["cd_Relatorio"];
echo "<br>";
echo $cd_Obra = $_POST["cd_Obra"];
echo "<br>";
echo $nm_TecResponsavel = $_POST["nm_TecResponsavel"];
echo "<br>";
echo $ds_Email = $_POST["ds_Email"];
echo "<br>";
echo $nm_LocResponsavel = $_POST["nm_LocResponsavel"];
echo "<br>";
echo $dt_Carimbo = date("Y/m/d");
echo "<br>";
echo $tp_AtivRealizada = $_POST["tp_AtivRealizada"];
echo "<br>";
echo $tp_RelaSituacao = $_POST["tp_RelaSituacao"];
echo "<br>";
echo $nm_Dia = date("l");
echo "<br>";
echo $tp_Periodo = $_POST["tp_Periodo"];
echo "<br>";
echo $tp_Tempo = $_POST["tp_Tempo"];
echo "<br>";
echo $tp_Condicao = $_POST["tp_Condicao"];
echo "<br>";
echo $qt_TotalMaodeObra = $_POST["qt_TotalMaodeObra"];
echo "<br>";
echo $qt_Ajudantes = $_POST["qt_Ajudantes"];
echo "<br>";
echo $qt_Eletricistas = $_POST["qt_Eletricistas"];
echo "<br>";
echo $qt_Mestres = $_POST["qt_Mestres"];
echo "<br>";
echo $qt_Pedreiros = $_POST["qt_Pedreiros"];
echo "<br>";
echo $qt_Serventes = $_POST["qt_Serventes"];
echo "<br>";
echo $qt_MaoDireta = $_POST["qt_MaoDireta"];
echo "<br>";
echo $pt_Conclusao = $_POST["pt_Conclusao"];
echo "<br>";
echo $tp_RelaComentario = $_POST["tp_RelaComentario"];
echo "<br>";

?>