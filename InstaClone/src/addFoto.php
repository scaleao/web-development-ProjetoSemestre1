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
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Roboto|Sofia" rel="stylesheet">
    <link rel="stylesheet" href="./css/timeline.css">
    <title>Alterar perfil</title>
  </head>
  <body>
    <div class="header">
      <div class="column-header">
        <a href="./timeline.php" class="buttom-timeline">
          <img src="./img/instagram.jpg">
          <span id="instaTL">Insta</span>
          <span id="cloneTL">Clone</span>
        </a>
      </div>
      <div class="column-header">
        <a href="consultaMobile.php" class="none"><img class="none" src="./img/pesquisar.jpg"></a>
        <h4 class="error"></h4>
        <h4 class="sucess"></h4>
        <form method="POST" action="./app/logic/processamento_consulta.php">
          <input type="text" class="text-search none-item" name="buscaTimeLine" placeholder="Busca..">
          <input type="submit" class="buttom butom-search none-item" value="Ir">
        </form>
      </div>
      <div class="column-header">
        <a href="./addFoto.php" class=""><img src="./img/buttom-add.jpg"></a>
      </div>
      <div class="column-header">
        <a href="#" class=""><img src="./img/nav.jpg"></a>
      </div>
      <div class="column-header">
        <a href="#" class=""><img src="./img/match.jpg"></a>
      </div>
      <div class="column-header">
        <a href="./perfil.php" class=""><img src="./img/perfil.jpg"></a>
      </div>
    </div>

    </br></br></br></br></br></br></br>

    <div class="background-perfilALT">
      <div class="painel-perfilALT">
        <div class="row">
          <div class="column-item">
            <div class="area-inlineblock">
              <img class="foto-username" src="<?=$usuario["fotoperfil"]?>">
            </div>
            <div class="area-inlineblock">
              <h3><?=$usuario["nome"]?></h3>
              <h4 class="error"><?=fromSession("messages-erro_perfilALT");?></h4>
              <h4 class="sucess"><?=fromSession("messages-sucesso_perfilALT");?></h4>
            </div>
          </div>
          <div class="column-item">
            <div class="formulario">
              <div>
                <h4 class="error"><?=fromSession("messages-erro_perfilALT");?></h4>
                <h4 class="sucess"><?=fromSession("messages-sucesso_perfilALT");?></h4>
              </div>
              <form method="POST" action="./app/logic/processamento_addFoto.php" enctype="multipart/form-data">
                <div>
                  <input type="file" name="imagem">
                </div>
                <div>
                  <input type="text" class="text-editar" name="legenda" placeholder="Adicione uma legenda a sua foto">
                </div>
                <input type="submit" class="buttom" value="Publicar">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
