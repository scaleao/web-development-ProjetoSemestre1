<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lista de usuarios</title>
  </head>
  <body>
    <table border ="1">
      <thread>
        <th>E-mail</th><th>Nome</th><th>Usuario</th>
      </thread>
      <tbody>
        <?php
        require_once "conexao.php";

        $sql = "SELECT * FROM usuarios";

        foreach(getConnection()->query($sql) as $row){
          echo "<tr>";
          echo "<td>".$row['nome']."</td>";
          echo "<td>".$row['email']."</td>";
          echo "<td>".$row['usuario']."</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </body>
</html>
