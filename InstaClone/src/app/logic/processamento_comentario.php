<?php
  require_once "../functionUtil.php";
  require_once "../database/conexao.php";

  $idFoto = getPost("idFoto");
  $comentario = getPost("comentario-feed"); //---> Comentario do Usuario
  $usuario = getUser("autenticado"); //---> Usuario curtidor || Usuario logado

  $idUser = $usuario['id'];
  $nomeUser = $usuario['nome'];

  date_default_timezone_set('America/Sao_Paulo');
  $data = date('Y-m-d H:i:s');

  if(empty($comentario) || empty($idFoto)){
    header("Location: ../../timeline.php");
  }

  try{
    $sql = "INSERT INTO comentario(idFoto, idUsuario_Comentador, nome, comentario, data) VALUES (:idFoto, :usuario, :nome, :comentario, :data)";
    $stmt = getConnection()->prepare($sql);
    $stmt->bindParam(':idFoto', $idFoto);
    $stmt->bindParam(':usuario', $idUser);
    $stmt->bindParam(':nome', $nomeUser);
    $stmt->bindParam(':comentario', $comentario);
    $stmt->bindParam(':data', $data);
    $stmt->execute();
    header("Location: ../../timeline.php");
  }
  catch(PDOException $e){
    echo 'Erro: ' . $e->getMessage();
  }
?>
