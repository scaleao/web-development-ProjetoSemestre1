<?php
require_once "./app/conexao.php";
require_once "./app/functionUtil.php";

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
    $concordo = getPost("remember");

    //VERIFICA SE OS CAMPOS ESTÃO PREENCHIDOS, SE NÃO AVISA ERRO, as funcões EMPTY = VAZIO ou !isset = não definido
    $messages = ""; //variavel que vai receber mais mensagens de erro
    if(empty($email)){ //funcao !isset verificada se essa variavel esta preenchida
      $messages .= ("<li>E-mail obrigatório</li>"); //Usa o operador de ponto para concatenar as mensagens de erro, caso sejam sucessivas
    }
    if(empty($nome)){ //funcao !isset verificada se essa variavel esta preenchida
      $messages .= ("<li>Nome obrigatório</li>");
    }
    if(empty($usuario)){ //funcao !isset verificada se essa variavel esta preenchida
      $messages .= ("<li>Usuário obrigatório</li>");
    }
    if(empty($senha)){ //funcao !isset verificada se essa variavel esta preenchida
      $messages .= ("<li>Senha obrigatória</li>");
    }
    if(!isset($concordo)){
      $messages .= ("<li>Concorde com as politicas de uso</li>");
    }

    if(strlen($messages) > 0){ //Se caso a variavel menssages for preenchida, tera erros para retornar ao usuario
      $messages = "<ul>".$messages."</ul>";
      toSession("messages", $messages); //Inicia uma sessão com as mensagens de erro
      toSession("email", $email); //Salva os dados ja preenchidos para o usuario não precisar preencher novamente
      toSession("nome", $nome);
      toSession("usuario", $usuario);

      header("Location: ./index.php"); //função header direciona para alguma pagina desde que não tenha usado a funcao echo de escrever
      exit();
    }

    try{
      $sql = "INSERT INTO usuarios(email, nome, usuario, senha) VALUES (:email, :nome, :usuario, :senha)" ; // ----------> Cria uma Query SQL e associa a coluna do banco com as variaveis dos dados
      $stmt = getConnection()->prepare($sql); // ---------------------------------> Faz o PreparedStatement com a conexao passando a Query SQL
      $stmt->bindParam(':email', $email); // ---------------------------> Preenche os campos das colunas para enviar para o banco
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam('usuario', $usuario);
      $stmt->bindParam(':senha', $senha);
      //$stmt->execute(); //----------------------------------------------> Executa a SQL, se não ter certo retornará um erro que o catch ira pegar
      if($stmt->execute()){ //-------------------> Verifica se SQL se retorna true deu certo, se não falhou
        echo "Tudo certo";
      }
      else{
        echo "falhou";
      }
    }catch(PDOException $e) {
      echo 'Erro: ' . $e->getMessage();
    }
?>
