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
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/timeline.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Roboto|Sofia" rel="stylesheet">
    <title>Time line</title>
  </head>
  <body>
    <div class="header">
      <div class="column-header">
        <a href="./timeline.html" class="buttom-timeline">
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

    </br></br></br></br></br>

    <div class="column">
      <div class="row column-feed">
        <div class="painel-body-feed">
          <h4>USERNAME</h4>
          <img class="painel-foto-feed" src="./img/teste.jpg">
          <p><b>USERNAME: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna.</p>
          <form method="POST" action="#">
            <span>
              <input type="text" class="text-feed" name="comentario-feed" placeholder="Adicione um comentario...">
            </span>
            <span>
              <input type="submit" class="buttom-publish" value="Publicar">
            </span>
          </form>
        </div>
      </div>
      <div class="row column-feed">
        <div class="painel-body-feed">
          <h4>USERNAME</h4>
          <img class="painel-foto-feed" src="./img/teste.jpg">
          <p><b>USERNAME: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna.</p>
          <form method="POST" action="#">
            <span>
              <input type="text" class="text-feed" name="comentario-feed" placeholder="Adicione um comentario...">
            </span>
            <span>
              <input type="submit" class="buttom-publish" value="Publicar">
            </span>
          </form>
        </div>
      </div>
      <div class="row column-feed">
        <div class="painel-body-feed">
          <h4>USERNAME</h4>
          <img class="painel-foto-feed" src="./img/teste.jpg">
          <p><b>USERNAME: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna.</p>
          <form method="POST" action="#">
            <span>
              <input type="text" class="text-feed" name="comentario-feed" placeholder="Adicione um comentario...">
            </span>
            <span>
              <input type="submit" class="buttom-publish" value="Publicar">
            </span>
          </form>
        </div>
      </div>
      <div class="row column-feed">
        <div class="painel-body-feed">
          <h4>USERNAME</h4>
          <img class="painel-foto-feed" src="./img/teste.jpg">
          <p><b>USERNAME: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna.</p>
          <form method="POST" action="#">
            <span>
              <input type="text" class="text-feed" name="comentario-feed" placeholder="Adicione um comentario...">
            </span>
            <span>
              <input type="submit" class="buttom-publish" value="Publicar">
            </span>
          </form>
        </div>
      </div>
      <div class="row column-feed">
        <div class="painel-body-feed">
          <h4>USERNAME</h4>
          <img class="painel-foto-feed" src="./img/teste.jpg">
          <p><b>USERNAME: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna.</p>
          <form method="POST" action="#">
            <span>
              <input type="text" class="text-feed" name="comentario-feed" placeholder="Adicione um comentario...">
            </span>
            <span>
              <input type="submit" class="buttom-publish" value="Publicar">
            </span>
          </form>
        </div>
      </div>
      <div class="row column-feed">
        <div class="painel-body-feed">
          <h4>USERNAME</h4>
          <img class="painel-foto-feed" src="./img/teste.jpg">
          <p><b>USERNAME: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna.</p>
          <form method="POST" action="#">
            <span>
              <input type="text" class="text-feed" name="comentario-feed" placeholder="Adicione um comentario...">
            </span>
            <span>
              <input type="submit" class="buttom-publish" value="Publicar">
            </span>
          </form>
        </div>
      </div>
    </div>






    <div class="column">
      <div class="row perfil-fixed">
        <div class="column">
            <img class="foto-username" src="./img/foto-perfil-vazia.jpg">
        </div>
          <div class="column">
              <h3><?=$usuario["nome"]?></h3>
              <p><?=$usuario["usuario"]?></p>
          </div>
      </div>
</br></br></br></br></br></br></br>
      <div class="row area-fixed-historia">
        <div class="column-item">
          <h4>Histórias</h4>
          <p>Historias de amigos.</p>
          <p>Historias de amigos.</p>
          <p>Historias de amigos.</p>
          <p>Historias de amigos.</p>
          <p>Historias de amigos.</p>
          <p>Historias de amigos.</p>
          <p>Historias de amigos.</p>
          <p>Historias de amigos.</p>
          <p>Historias de amigos.</p>
        </div>
      </div>
</br></br></br></br></br></br></br></br></br></br>
      <div class="row area-fixed">
        <div class="column-item">
          <h5>Segestões</h5>
          <p>Sugestão para você.</p>
          <p>Sugestão para você.</p>
          <p>Sugestão para você.</p>
        </div>
      </div>
    </div>
  </body>
</html>
