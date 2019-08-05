<?php
require_once "../database/conexao.php";
require_once "../functionUtil.php";

/*******
 *        $_GET Pega todas as informacoes do tipo GET, mas o Metodo GET não é recomendado para enviar dados sensiveis porque
 *   ele mostrado o que esta sendo passado pela URL
 *        $_POST Pega todas as informações do tipo POST, o Metodo POAT é mais recomendado para enviar dados sensiveis, pois
 *   não mostra na URL
 *        $_REQUEST Pega todas as informacoes de qualquer requisicao
 *
 *
 *        conexao do PHP com o MYSQL é pelo tecnica de PDO - PDO Connect
 *        concatena com operador de ponto
 *        chama metodos de classe com -> classe.metodo(); = classe->metodo();
 *
 *        var_dump($_POST); //var_dump serve para ver o que esta sendo passado pelo formulario
 */
    $email = getPost("email-cadastro"); //criar uma variavel, usa o metodo POST para pegar as informacoes que virão do input email-usuario-cadastro da index
    $nome = getPost("nome-cadastro");
    $usuario = getPost("usuario-cadastro");
    $senha = getPost("senha-cadastro");

    $diretorio = "./users/".$email;
    $fotoPerfil = "./users/00000foto-perfil-vazia.jpg";
    $concordo = getPost("remember");

    //VERIFICA SE OS CAMPOS ESTÃO PREENCHIDOS, SE NÃO AVISA ERRO, as funcões EMPTY = VAZIO ou !isset = não definido
    $messages_error = ""; //variavel que vai receber mais mensagens de erro
    $messages_sucess = "";
    if(empty($email)){ //funcao !isset verificada se essa variavel esta preenchida
      $messages_error .= ("<li>E-mail obrigatório</li>"); //Usa o operador de ponto para concatenar as mensagens de erro, caso sejam sucessivas
    }
    if(empty($nome)){ //funcao !isset verificada se essa variavel esta preenchida
      $messages_error .= ("<li>Nome obrigatório</li>");
    }
    if(empty($usuario)){ //funcao !isset verificada se essa variavel esta preenchida
      $messages_error .= ("<li>Usuário obrigatório</li>");
    }
    if(empty($senha)){ //funcao !isset verificada se essa variavel esta preenchida
      $messages_error .= ("<li>Senha obrigatória</li>");
    }
    if(!isset($concordo)){
      $messages_error .= ("<li>Concorde com as politicas de uso</li>");
    }

    if(strlen($messages_error) > 0){ //Se caso a variavel menssages for preenchida, tera erros para retornar ao usuario
      $messages_error = "<ul>".$messages_error."</ul>";
      toSession("messages-error", $messages_error); //Inicia uma sessão com as mensagens de erro
      toSession("email", $email); //Salva os dados ja preenchidos para o usuario não precisar preencher novamente
      toSession("nome", $nome);
      toSession("usuario", $usuario);

      header("Location: ../../index.php"); //função header direciona para alguma pagina desde que não tenha usado a funcao echo de escrever
      exit();
    }

    try{
      $sql = "INSERT INTO usuarios(email, nome, usuario, senha, diretorio, fotoPerfil) VALUES (:email, :nome, :usuario, :senha, :diretorio, :fotoperfil)" ; // ----------> Cria uma Query SQL e associa a coluna do banco com as variaveis dos dados
      $stmt = getConnection()->prepare($sql); // ---------------------------------> Faz o PreparedStatement com a conexao passando a Query SQL
      $stmt->bindParam(':email', $email); // ---------------------------> Preenche os campos das colunas para enviar para o banco
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam('usuario', $usuario);
      $stmt->bindParam(':senha', $senha);
      $stmt->bindParam(':diretorio', $diretorio);
      $stmt->bindParam(':fotoperfil', $fotoPerfil);
      //$stmt->execute(); //----------------------------------------------> Executa a SQL, se não ter certo retornará um erro que o catch ira pegar
      if($stmt->execute()){ //-------------------> Verifica se SQL se retorna true deu certo, se não falhou
        if(mkdir("../.$diretorio", 0777, true)){//-----------------------> Cria um diretoria para o usuario dentro da pasta users
          mkdir("../.$diretorio/fotoperfil", 0777, true);
          mkdir("../.$diretorio/publicacoes", 0777, true);
          $messages_sucess .= "<li>Cadastro realizado com sucesso !</li>";
          $messages_sucess = "<ul>".$messages_sucess."</ul>";
          toSession("messages-sucess", $messages_sucess);

          header("Location: ../../index.php");
          exit();
        }
      }
      else{
        echo "falhou";
      }
    }catch(PDOException $e) {
      echo 'Erro: ' . $e->getMessage();
    }
?>
