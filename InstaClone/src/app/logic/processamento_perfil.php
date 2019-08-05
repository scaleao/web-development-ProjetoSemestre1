<?php
require_once "../database/conexao.php";
require_once "../functionUtil.php";

$usuario = getUser("autenticado");

$telefone = gePost("telefone");
$biografia = getPost("biografia");

echo $usuario["nome"];
echo $usuario["id"];
echo $usuario["email"];

?>
