<?php
require_once "../database/conexao.php";
require_once "../functionUtil.php";

$usuario = getUser("autenticado");

$foto = getFiles("imagem");

$idUsuario = $usuario["id"];
$emailUser = $usuario["email"];

//echo $usuario["nome"];
//echo $usuario["id"];
//echo $usuario["email"];

$messages_erro = "";
$messages_sucess = "";

try {

  // Undefined | Multiple Files | $_FILES Corruption Attack
  // If this request falls under any of them, treat it invalid.
  if (
      !isset($_FILES["imagem"]["error"]) ||
      is_array($_FILES["imagem"]["error"])
  ) {
      //throw new RuntimeException('Invalid parameters.');
      $messages_erro .= "<li>Invalid parameters.</li>";
  }

  // Check $_FILES['upfile']['error'] value.
  switch ($_FILES['imagem']['error']) {
      case UPLOAD_ERR_OK:
          break;
      case UPLOAD_ERR_NO_FILE:
          //throw new RuntimeException('O arquivo não foi enviado');
          $messages_erro .= "<li>O arquivo não foi enviado</li>";
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
          //throw new RuntimeException('Limite de tamanho de arquivo excedido..');
          $messages_erro .= "<li>Limite de tamanho de arquivo excedido..</li>";
      default:
          //throw new RuntimeException('Erro desconhecido');
          $messages_erro .= "<li>Erro desconhecido</li>";
  }

  // You should also check filesize here.
  if ($_FILES['imagem']['size'] > 2000000) {
      //throw new RuntimeException('Fotos com tamanho superior a 2MB, não são permitidas.');
      $messages_erro .= "<li>Fotos com tamanho superior a 2MB, não são permitidas.</li>";
  }

  // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
  // Check MIME Type by yourself.
  $finfo = new finfo(FILEINFO_MIME_TYPE);
  if (false === $ext = array_search(
      $finfo->file($_FILES['imagem']['tmp_name']),
      array(
          'jpg' => 'image/jpeg',
          'png' => 'image/png',
          'gif' => 'image/gif',
      ),
      true
  )) {
      //throw new RuntimeException('Formato do arquivo invalido, formatos validos .jpg .png .gif');
      $messages_erro .= "<li>Formato do arquivo invalido, formatos validos .jpg .png .gif</li>";

  }

  // You should name it uniquely.
  // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
  // On this example, obtain safe unique name from its binary data.
  if (!move_uploaded_file(
      $_FILES['imagem']['tmp_name'],
      sprintf('../../users/'.$usuario["email"].'/publicacoes/%s.%s',
          sha1_file($_FILES['imagem']['tmp_name']),
          $ext
      )
  )) {
      //throw new RuntimeException('Failed to move uploaded file.');
      $messages_erro .= "<li>Failed to move uploaded file.</li>";
      if(strlen($messages_erro) > 0){
        $messages_erro = "<ul>".$messages_erro."</ul>";
        toSession("messages-erro_perfilALT", $messages_erro);
        header("Location: ../../addFoto.php");
        exit();
      }
  }

  /*-------------------------------------------------------------------------------------------------Pega o nome do foto*/
  // Recupera a lista de todos os arquivos:
  $itens = glob("../../users/".$usuario["email"]."/publicacoes/*");

  // Ordena os arquivos pela data de modificacão:
  usort($itens, function ($a, $b) { return filemtime($a) < filemtime($b); });

  // Pega apenas o último modificado:
  $cont = array_slice($itens, 0, 1);

  $nomeAtual = "";

  foreach ($cont   as $arq )

  $nomeAtual = $arq; // ---> Nome da foto ../../users/[a-z][.[a-z]{3}]


  /*----------------------------------------------------------------------Acerta o nome do diretotio para colocar no banco*/
  $nomeAtual = str_split($nomeAtual, 4);

  unset($nomeAtual[0]);

  $stringArray = "";

  foreach ($nomeAtual as $stringNome){
    $stringArray = $stringArray.$stringNome;
    $nomeAtual = $stringArray;
  }

  $nomeAtual; // ---> Nome certo para jogar no banco ./users/[a-z][.[a-z]{3}]

// Exemplo para renomar o arquivo que acabei não usando:
//  rename($nomeAtual, "../../users/".$usuario["email"].$nomeFotoPerfil);


  $legenda = getPost("legenda");
  $curtidas = 0;
  $comentarios = 0;

  date_default_timezone_set('America/Sao_Paulo');
  $data = date('Y-m-d H:i:s');

  $messages_sucess .= "<li>Foto publicada com sucesso.</li>";
  if(strlen($messages_sucess) > 0){
    $messages_sucess = "<ul>".$messages_sucess."</ul>";
    toSession("messages-sucesso_perfilALT", $messages_sucess);


    $sql = "INSERT INTO foto(idUsuario, diretorioFoto, legenda, curtidas, comentarios, data) VALUES (:idUsuario, :nomeAtual, :legenda, :curtidas, :comentarios :data)" ; // ----------> Cria uma Query SQL e associa a coluna do banco com as variaveis dos dados
    $stmt = getConnection()->prepare($sql); // ---------------------------------> Faz o PreparedStatement com a conexao passando a Query SQL
    $stmt->bindParam(':idUsuario', $idUsuario); // ---------------------------> Preenche os campos das colunas para enviar para o banco
    $stmt->bindParam(':nomeAtual', $nomeAtual); // ---> Direorio da foto
    $stmt->bindParam(':legenda', $legenda);
    $stmt->bindParam(':curtidas', $curtidas);
    $stmt->bindParam('comentarios', $comentarios);
    $stmt->bindParam(':data', $data);
    if($stmt->execute()){
      toSession("messages-sucesso_perfilALT", $messages_sucess);
      header("Location: ../../addFoto.php");
      exit();
    }
  }

} catch (RuntimeException $e) {

  echo $e->getMessage();

}

/*
    $sql = "UPDATE usuarios SET fotoperfil = '$nomeAtual' WHERE id = '$idUser' and email = '$emailUser'";
    $stmt = getConnection()->prepare($sql);
    if($stmt->execute()){
      toSession("messages-sucesso_perfilALT", $messages_sucess);
      $usuario["fotoperfil"] = $nomeAtual;
      unset($_SESSION["autenticado"]);
      toSession("autenticado", $usuario);
      header("Location: ../../perfil_alt.php");
      exit();
*/

?>
