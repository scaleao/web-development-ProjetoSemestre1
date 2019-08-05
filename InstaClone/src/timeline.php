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
        <a href="./timeline.php" class="buttom-timeline">
          <img src="./img/instagram.jpg">
          <span id="instaTL">Insta</span>
          <span id="cloneTL">Clone</span>
        </a>
      </div>
      <div class="column-header">
        <a href="./consultaMobile.php"><img class="none" src="./img/pesquisar.jpg"></a>
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
        echo "<div class='row column-feed'>";
        echo   "<div class='painel-body-feed'>";
        echo     "<img class='fotinha-timeline' src='".$row["fotoperfil"]."'>";
        echo     "<b>".$row["nome"]."</b>";
        echo     "<img class='painel-foto-feed' src='".$row["diretorioFoto"]."'>";
        echo     "<form method='POST' action='./app/logic/processamento_curtida.php'>";
        echo       "Selecione para curtir->";
        echo       "<input type='radio' name='curtir' value='".$row["idFoto"]."'>";
        echo       "<input type='submit' class='buttom' value='Curtir'>";
        echo     "</form>";
        echo     "<i>".$row["data"]."</i>";
        echo     "<p><b>".$row["nome"]."</b>".$row["legenda"]."</p>";
        echo "<div class='block_comentario'>";
        $idFotoComentario = $row["idFoto"];
        $sqlC = "SELECT idUsuario_Comentador, nome, comentario, data FROM comentario WHERE idFoto = $idFotoComentario";
        foreach(getConnection()->query($sqlC) as $result){
          echo "<div>";
          echo   "<b class='user_comentario'>".$result["nome"]."</b> <i class='comentario'>".$result["data"]."</i>";
          echo   $result["comentario"];
          echo "</div>";
        }
        echo     "</div>";
        echo     "<form method='POST' action='./app/logic/processamento_comentario.php'>";
        echo       "Selecione para enviar o comentario->";
        echo       "<input type='radio' name='idFoto' value='".$row["idFoto"]."'>";
        echo       "<span>";
        echo         "<input type='text' class='text-feed' name='comentario-feed' placeholder='Adicione um comentario...'>";
        echo       "</span>";
        echo       "<span>";
        echo         "<input type='submit' class='buttom-publish' value='Publicar'>";
        echo       "</span>";
        echo     "</form>";
        echo   "</div>";
        echo "</div>";
      }
      ?>

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
