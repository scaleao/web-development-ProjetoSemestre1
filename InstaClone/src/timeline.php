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
    <?=include './layout/header.html'?>

    </br></br></br></br></br>

    <div class="column">
      <?php
        require_once "./app/database/conexao.php";

        $idUsuario = $usuario["id"];

        $sql = "SELECT a.nome, a.fotoperfil, b.idFoto, b.diretorioFoto, b.legenda, b.data
                FROM usuarios a, foto b, seguindo c
                WHERE     c.idUsuario = '$idUsuario'
                      AND c.idSeguido = b.idUsuario
                      AND b.idUsuario = a.id
                ORDER BY b.data DESC;";

        foreach(getConnection()->query($sql) as $row){
      ?>

      <div class='row column-feed'>
        <div class='painel-body-feed'>
          <img class='fotinha-timeline' src="<?=$row["fotoperfil"]?>">
          <b><?=$row["nome"]?>   </b>
          <img class='painel-foto-feed' src="<?=$row["diretorioFoto"]?>">
          <i><?=$row["data"]?></i>
          <p><b><?=$row["nome"]?></b><?=$row["legenda"]?></p>
          <div class='block_comentario'>
          <?php
            $idFotoComentario = $row["idFoto"];
            $sqlC = "SELECT idUsuario_Comentador, nome, comentario, data FROM comentario WHERE idFoto = $idFotoComentario";
            foreach(getConnection()->query($sqlC) as $result){
          ?>
            <div>
              <b class='user_comentario'><?=$result["nome"]?></b> <i class='comentario'><?=$result["data"]?></i>
              <?=$result["comentario"]?>
            </div>
          <?php } ?>
          </div>
          <form method='POST' action='./app/logic/processamento_comentario.php'>
            "Selecione para enviar o comentario->";
            <input type='radio' name='idFoto' value="<?=$row["idFoto"]?>">
            <span>
              <input type='text' class='text-feed' name='comentario-feed' placeholder='Adicione um comentario...'>
            </span>
            <span>
              <input type='submit' class='buttom-publish' value='Publicar'>
            </span>
          </form>
        </div>
      </div>

      <?php   }     ?>

      <!--

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

    -->
    </div>






    <div class="column none-item">
      <div class="row perfil-fixed none-item">
        <div class="column">
          <img class="foto-username" src="<?=$usuario["fotoperfil"]?>">
        </div>
        <div class="column">
          <h3><?=$usuario["nome"]?></h3>
          <p><?=$usuario["usuario"]?></p>
        </div>
      </div>

      </br></br></br></br></br></br></br>

      <div class="row area-fixed-historia none-item">
        <div class="column-item none-item">
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

      <div class="row area-fixed none-item">
        <div class="column-item none-item">
          <h5>Segestões</h5>
          <p>Sugestão para você.</p>
          <p>Sugestão para você.</p>
          <p>Sugestão para você.</p>
        </div>
      </div>
    </div>
  </body>
</html>
