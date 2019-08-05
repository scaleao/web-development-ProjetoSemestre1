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
        <form method="POST" action="./app/logic/processamento_consulta.php" class="none-item">
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

    <!-- https://www.satellasoft.com/?materia=exibir-e-ocultar-div-com-javascript -->

    <div class="background-perfilALT">
      <div class="painel-perfilALT">
        <form method="POST" action="./app/logic/processamento_consultaMobile.php">
          <input type="text" class="text-search none" placeholder="Busque um amigo.." name="buscaMobile">
          <input type="submit" class="buttom butom-search none" value="Ir">
        </form>
        <?php
        require_once "./app/database/conexao.php";

        $nomeConsultado = "";

        if(isset($_SESSION["nomeConsultadoMobile"])){

          $nomeConsultado = $_SESSION["nomeConsultadoMobile"];

          $SQLnomeConsultado = "%".$nomeConsultado."%";

          $sql = "SELECT nome, fotoperfil, id FROM usuarios WHERE nome LIKE $SQLnomeConsultado";

          foreach(getConnection()->query($sql) as $row){
            echo "<BR><BR>";
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

          if(isset($_SESSION["nomeConsultadoMobile"])){
            unset($_SESSION["nomeConsultadoMobile"]);
          }
        }
        ?>
      </div>
    </div>
  </body>
</html>
