<?php
require_once "../database/conexao.php";
require_once "../functionUtil.php";

$nomeConsulta = getPost("buscaTimeLine");

if(!isset($nomeConsulta)){
  header("Location: ../../timeline.php");
  exit();
}
else{
  toSession("nomeConsultado", $nomeConsulta);
  header("Location: ../../consulta.php");
  exit();
}
?>
