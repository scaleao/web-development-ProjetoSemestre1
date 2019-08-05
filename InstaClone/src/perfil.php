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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/timeline.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Roboto|Sofia" rel="stylesheet">
    <title>PERFIL</title>
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

    </br></br></br></br></br>

    <div class="align-center">
      <div class="painel-perfil area-inlineblock">
        <img class="foto-perfil" src="<?=$usuario["fotoperfil"]?>">
      </div>
      <div class="painel-perfil area-inlineblock">
        <div class="area-inlineblock">
          <h3><?=$usuario["nome"];?></h3>
        </div>
        <div class="area-inlineblock">
          <a class="buttom-perfil" href="./perfil_alt.php">Editar Perfil</a>
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
        <?php
        require_once "./app/database/conexao.php";

        $idUsuario = $usuario["id"];

        $column_galler = "column-gallery";
        $foto_gallery = "foto-gallery";

        $sql = "SELECT * FROM foto WHERE idUsuario = '$idUsuario' ORDER BY data DESC";
        $result = getConnection()->query($sql);
        if(isset($result)){
          foreach($result as $row){
            echo "<div class='$column_galler'>";
            echo  "<img class='$foto_gallery'"." src='".$row['diretorioFoto']."'>";
            echo "</div>";
          }
        }
        ?>

        <!--PAREI NO FOREACH PARA BUSCAR OS DIRETORIOS DAS FOTOS PARA IMPRIMIR NA TELA "
        http://www.diogomatheus.com.br/blog/php/trabalhando-com-pdo-no-php/
        https://stackoverflow.com/questions/17220306/fetch-all-values-from-database-and-foreach-through-them
        https://www.php.net/manual/pt_BR/pdo.query.php
        -->


<!--
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
-->
    </div>
  </body>
</html>
