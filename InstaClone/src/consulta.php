<?php
  require_once "./app/functionUtil.php";

  session_start();
  $usuario = $_SESSION["autenticado"];
  $nomeConsultado = $_SESSION["nomeConsultado"];
  if(!isset($usuario)){
    header("Location: ./index.php");
    exit();
  }

  if(!isset($nomeConsultado)){
    header("Location: ./timeline.php");
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
        <form method="GET" action="consulta.php">
          <input type="text" class="text-search" name="buscaTimeLine" placeholder="Busca.." value="<?=$nomeConsultado?>">
          <input type="submit" class="buttom butom-search" value="Ir">
        </form>
      </div>
      <div class="column-header">
        <a href="./addFoto.php" class="butom-timeline"><img src="./img/buttom-add.jpg"></a>
        <a class="butom-timeline"><img src="./img/nav.jpg"></a>
        <a class="butom-timeline"><img src="./img/match.jpg"></a>
        <a href="./perfil.php" class="butom-timeline"><img src="./img/perfil.jpg"></a>
      </div>
    </div>

    </br></br></br></br></br>

    <div class="background-perfilALT">
      <div class="painel-perfilALT">
        <?php
        require_once "./app/database/conexao.php";

        $SQLnomeConsultado = "%".$nomeConsultado."%";

        $sql = "SELECT nome, fotoperfil, id FROM usuarios WHERE nome = '$nomeConsultado'";

        foreach(getConnection()->query($sql) as $row){
          echo "<div class='row'>";
          echo   "<div class='column-item'>";
          echo     "<div class='area-inlineblock'>";
          echo       "<img class='foto-username' src=".$row["fotoperfil"].">";
          echo     "</div>";
          echo     "<div class='area-inlineblock'>";
          echo       "<h3>".$row["nome"]."</h3>";
          echo     "</div>";
          echo     "<div class='area-inlineblock'>";
          echo       "<form method='POST' action='./app/logic/processamento_seguir.php'>";
          echo         "<input type='radio' name='escolha' value=".$row["id"].">";
          echo         "<input type='submit' class='buttom' value='Seguir'>";
          echo       "</form>";
          echo     "</div>";
          echo     "<div class='area-inlineblock'>";
          echo       "<a class='buttom' href='#'>Visitar</a>";
          echo     "</div>";
          echo   "</div>";
          echo "</div>";
        }
        ?>
      </div>
    </div>
  </body>
</html>
