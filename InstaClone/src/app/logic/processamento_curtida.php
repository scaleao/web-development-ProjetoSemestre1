<?php
  require_once "../functionUtil.php";
  require_once "../database/conexao.php";

  $idFoto = getPost("curtir"); //---> ID da foto que será curtida
  $usuario = getUser("autenticado"); //---> Usuario curtidor || Usuario logado
  $idUser = $usuario['id'];

  date_default_timezone_set('America/Sao_Paulo');
  $data = date('Y-m-d H:i:s');


  try{
    $sql_1 = "INSERT INTO curtida(idFoto, idUsuario_Curtidor, data) VALUES (:idFoto, :usuario, :data)";
    $stmt = getConnection()->prepare($sql_1);
    $stmt->bindParam(":idFoto", $idFoto);
    $stmt->bindParam(":usuario", $idUser);
    $stmt->bindParam(":data", $data);
    if($stmt->execute()){
      $sql_2 = "UPDATE foto SET curtidas = curtidas+1 WHERE idFoto = $idFoto";
      $stmt_2 = getConnection()->prepare($sql_2);
      $stmt_2->execute();
    }
  }
  catch(PDOException $e){
    echo 'Erro: ' . $e->getMessage();
  }
?>
