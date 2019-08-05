<?php
require_once "../database/conexao.php";
require_once "../functionUtil.php";

$nomeConsulta = getPost("buscaMobile");

if(isset($nomeConsulta)){
  toSession("nomeConsultadoMobile", $nomeConsulta);
  header("Location: ../../consultaMobile.php");
  exit();
}
else{
  header("Location: ../../consultaMobile.php");
  exit();
}
?>
