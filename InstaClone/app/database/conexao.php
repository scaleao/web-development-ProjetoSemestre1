<?php
function getConnection(){
  $databaseNome = 'root';
  $databaseSenha = '';

  $conn = new PDO('mysql:host=localhost;dbname=instaclone',
                  $databaseNome, $databaseSenha); // ---------------> Cria e instancia uma classe de conexao PDO e passa URL, usuario e senha
  return $conn;
}
?>
