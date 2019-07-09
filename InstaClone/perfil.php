<?php
  require_once "./app/functionUtil.php";

  session_start();
  $usuario = $_SESSION["autenticado"];
  if(!isset($usuario)){
    header("Location: ./index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang=pt dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/timeline.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Roboto|Sofia" rel="stylesheet">
    <title>Time line</title>
    <title>PERFIL</title>
  </head>
  <body>
    <div class="header">
      <div class="header">
        <div class="column-header">
          <a href="./timeline.php" class="buttom-timeline">
            <img src="./img/instagram.jpg">
            <span id="instaTL">Insta</span>
            <span id="cloneTL">Clone</span>
          </a>
        </div>
        <div class="column-header">
          <form method="GET" action="">
            <input type="text" class="text-search" name="buscaTimeLine" placeholder="Busca..">
          </form>
        </div>
        <div class="column-header">
          <a class="butom-timeline"><img src="./img/nav.jpg"></a>
          <a class="butom-timeline"><img src="./img/match.jpg"></a>
          <a href="./perfil.php" class="butom-timeline"><img src="./img/perfil.jpg"></a>
        </div>
      </div>
    </div>
    </br></br></br></br></br>
    <div class="align-center">
      <div class="painel-perfil area-inlineblock">
        <img class="foto-perfil" src="./img/foto-perfil-vazia.jpg">
      </div>
      <div class="painel-perfil area-inlineblock">
        <div class="area-inlineblock">
          <h3><?=$usuario["nome"];?></h3>
        </div>
        <div class="area-inlineblock">
          <a class="buttom-perfil" href="#">Editar Perfil</a>
        </div>
        <div>
          <div class="area-inlineblock">
            <a class="buttom-perfil" href="#">Publicações</a>
          </div>
          <div class="area-inlineblock">
            <a class="buttom-perfil" href="#">Seguidores</a>
          </div>
          <div class="area-inlineblock">
            <a class="buttom-perfil" href="#">Seguindo</a>
          </div>
        </div>
        <p>Nos conte um pouco sobre você :) </p>
      </div>
    </div>
    <div class="align-center">
      <div class="row">
        <div class="column-gallery">
          <img class="foto-gallery" src="./img/teste.jpg">
        </div>
        <div class="column-gallery">
          <img class="foto-gallery" src="./img/teste.jpg">
        </div>
        <div class="column-gallery">
          <img class="foto-gallery" src="./img/teste.jpg">
        </div>
      </div>
      <div class="row">
        <div class="column-gallery">
          <img class="foto-gallery" src="./img/teste.jpg">
        </div>
        <div class="column-gallery">
          <img class="foto-gallery" src="./img/teste.jpg">
        </div>
        <div class="column-gallery">
          <img class="foto-gallery" src="./img/teste.jpg">
        </div>
        <div class="column-gallery">
          <img class="foto-gallery" src="./img/teste.jpg">
        </div>
      </div>
    </div>
  </body>
</html>
