<?php
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
    $email = $_POST['email-usuario-cadastro']; //criar uma variavel, usa o metodo POST pegar as informacoes que virão do input email-usuario-cadastro
    $nome = $_POST['nome-usuario-cadastro'];
    $usuario = $_POST['usuario-cadastro'];
    $senha = $_POST['senha-cadastro'];

    $databaseNome = 'root'; //Nome do usuario e senha para fazer a conexão com MySQL
    $databaseSenha = '';

    try {
      $conn = new PDO('mysql:host=localhost;dbname=instaclone',
                      $databaseNome, $databaseSenha); // ---------------> Cria e instancia uma classe de conexao PDO e passa URL, usuario e senha
      $sql = ' INSERT INTO usuarios(email, nome, usuario, senha) '.
             ' VALUES (:nome, :email, :usuario, :senha)' ; // ----------> Cria uma Query SQL e associa a coluna do banco com as variaveis dos dados
      $stmt = $conn->prepare($sql); // ---------------------------------> Faz o PreparedStatement com a conexao passando a Query SQL
      $stmt->bindParam(':email', $email); // ---------------------------> Preenche os campos das colunas para enviar para o banco
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam('usuario', $usuario);
      $stmt->bindParam(':senha', $senha);
      $stmt->execute(); //----------------------------------------------> Executa a SQL, se não ter certo retornará um erro que o catch ira pegar
      echo 'Tudo certo';
    }catch(PDOException $e) {
      echo 'Erro: ' . $e->getMessage();
    }
?>
