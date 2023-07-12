<?php
session_start();
include 'conecta.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cpf = $_POST['CPF'];
  $senha = $_POST['SenhaDisc'];

  // Verifica se o CPF existe no banco de dados
  $sql = "SELECT * FROM Respondente WHERE CPF = '$cpf'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($row['PrimeiroLogin'] == 1) {
      // Primeiro login, redireciona para a página de alteração de senha
      $_SESSION['cpf'] = $cpf;
      header("Location: alterasenha.php");
      exit;
    } else {
      if ($row['Senha'] === $senha) {
        // Usuário autenticado com sucesso
        $_SESSION['cpf'] = $cpf;
        header("Location: telainicial.php");
        exit;
      } else {
        // Senha incorreta
        echo "Senha incorreta.";
      }
    }
  } else {
    // Usuário não encontrado
    echo "Usuário não encontrado no sistema.";
  }
}
?>
<html>
  <head>
    <style>
      button {
        font-size: 20px;
        color: white;
        background-color: blue;
      }

      h1 {
        text-align: center;
        line-height: 1;
        height: 100px;
        color: white;
      }

      input,
      button {
        display: block;
        margin: 0 auto;
        font-size: 20px;
        color: white;
        background-color: darkblue;
      }

      label {
        display: block;
        text-align: center;
        color: white;
        margin-bottom: 10px;
      }

      body {
        background-color: #4682B4;
      }
    </style>
    <script src="validacpf.js"></script>
    <h1>Login dos Discentes Respondentes</h1>
  </head>
  <body>
    <form action="login.php" method="POST" onsubmit="return validarFormulario()">
      <label for="cpf">CPF:</label>
      <input type="text" name="CPF" required onblur="validarCPF(this.value)">
      <br>
      <label for="senha">Senha:</label>
      <input type="password" name="SenhaDisc" required>
      <br>
      <input type="submit" value="Logar">
    </form>
  </body>
</html>

