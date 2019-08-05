<?php
require_once "../functionUtil.php";
require_once "../database/conexao.php";

$usuario = getUser("autenticado");
$idUsuario = $usuario["id"];

$quemSeguir = getPost("escolha");

date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i:s');

$error = "";
$sucess = "";

try{
  $sql = "INSERT INTO seguindo(idUsuario, idSeguido, data) VALUES (:idUsuario, :idSeguido, :data)";
  $stmt = getConnection()->prepare($sql);
  $stmt->bindParam(':idUsuario', $idUsuario);
  $stmt->bindParam(':idSeguido', $quemSeguir);
  $stmt->bindParam(':data', $data);
  if($stmt->execute()){
    $sucess = "Seguido com sucesso !";
    toSession("messages-sucesso_perfilALT", $sucess);
    header("Location: ../../timeline.php");
  }
}
catch(PDOException $e){
  echo $e->getMessage();
}

?>
