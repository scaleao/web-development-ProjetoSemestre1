<?php require_once "./app/functionUtil.php";?>
<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Roboto|Sofia" rel="stylesheet">
    <title>Projeto</title>
  </head>
  <body class="background-photo">
  <div class="panel-title">
    <div class="object-panel-title">
      <img src="./img/camera.png">
      <span id="insta">Insta</span>
      <span id="clone">Clone</span>
    </div>
    <div class="object-panel-title align-right">
      <forms method="POST" action="login.php">
        <div class="object-panel-title">
          Login: <input type="text" class="text-login" name="login">
        </div>
        <div class="object-panel-title">
          Senha: <input type="password" class="password-login" name="senha">
          <input type="checkbox" checked="checked" name="remember">Lembre-me
        </div>
        <div class="object-panel-title">
          <input type="submit" class="buttom-login" value="Entrar">
        </div>
      </forms>
    </div>
  </div>
  <div class="panel">
    <div>
    <h3 class="error"><?=fromSession("messages");?></h3>
    </div>
    <header class="titulo">
      <p><b>Cadastre-­se para ver fotos e vídeos dos seus amigos.</b></p>
    </header>
    <div class="formulario">
      <form method="POST" action="cadastro.php">
        <div>
          <input type="email" value="<?=fromSession("email"); ?>" class="text text-focus" name="email-cadastro" placeholder="Numero do celular ou e-mail" id="js_email">
        </div>
        <div>
          <input type="text" value="<?=fromSession("nome"); ?>" class="text text-focus" name="nome-cadastro" placeholder="Nome completo" id="js_nome">
        </div>
        <div>
          <input type="text" value="<?=fromSession("usuario"); ?>" class="text text-focus" name="usuario-cadastro" placeholder="Nome de Usuario" id="js_usuario">
        </div>
        <div>
          <input type="password" class="password password-focus" name="senha-cadastro" placeholder="Senha" id="js_senha">
        </div>
        <div>
          <label class="container">Concordo com os termos e a politicas de dados e cookies
            <input type="checkbox" name="remember">
            <span class="checkmark"></span>
          </label>
        </div>
        <div>
          <input  type="submit" class="buttom buttom-focus" value="Cadastre-se"> <!-- onclick="exibir()"-->
        </div>
      </form>
    </div>
  </div>
  <!--
  <script language="javascript">
    var email;
    var nome;
    var usuario;
    var senha;
    var informacao;

    function exibir(){
       email = Document.getElementById("js_email");
       nome = Document.getElementById("js_nome");
       usuario = Document.getElementById("js_usuario");
       senha = Document.getElementById("js_senha");

       informacao = email + ' ' + nome + ' ' + usuario + ' ' + senha;

       Document.write(informacao);
    }
  </script>
  <div class="panel">
    <h3>Já tem conta?</h3>
    <a href="login.php">Conecte-se</a>
  </div>
  -->
  </body>
</html>
