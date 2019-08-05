<?php
require_once "../database/conexao.php";
require_once "../functionUtil.php";

$login = getPost("login");
$senha = getPost("senha");

/* VERIFICAÇÃO CASO O USUARIO NÃO TENHA PREENCHIDO OS CAMPOS*/
$messages = "";
if(empty($login)){
  $messages .= "<li>Campo login é obrigatório</li>";
};

if(empty($senha)){
  $messages .= "<li>Campo senha é obrigatório</li>";
};

if(strlen($messages) > 0){
  $messages = "<ul>".$messages."</ul>";
  toSession("messages", $messages);
  toSession("login", $login);

  header("Location: ../../index.php");
  exit();
}

try{
  $sql = "SELECT id, nome, email, usuario, fotoperfil FROM usuarios WHERE email = '$login' and senha = '$senha'";
  $stmt = getConnection()->prepare($sql);
  $stmt->execute();
  $row = $stmt->fetch();
  if($row){
    toSession("autenticado", $row);
    header("Location: ../../timeline.php");
    exit();
  }
  else{
    toSession("messages", "<ul><li>Usuario/Senha incorretos</li></ul>");
    header("Location: ../../index.php");
    exit();
  }
}
catch(PDOException $e){
  toSession("messages", "<ul><li>Ocorreu um erro ao realizar seu login:".$e->getMessage()."</li></ul>");
  header("Location: ../../index.php");
}
?>
