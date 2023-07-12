<?php
session_start();
include 'conecta.php';

if (!isset($_SESSION['cpf'])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $novaSenha = $_POST['NovaSenha'];
  $cpf = $_SESSION['cpf'];

  // Atualiza a senha do usuário no banco de dados
  $sql = "UPDATE Respondente SET Senha = '$novaSenha', PrimeiroLogin = 0 WHERE CPF = '$cpf'";
  if ($conn->query($sql) === TRUE) {
    echo "Senha atualizada com sucesso.";
    header("Location: telainicial.php");
    exit;
  } else {
    echo "Erro ao atualizar a senha: " . $conn->error;
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
    <h1>Alteração da Senha Provisória</h1>
  </head>
  <body>
    <form action="alterasenha.php" method="POST" onsubmit="return validarFormulario()">
      <label for="senha">Nova Senha:</label>
      <input type="password" name="NovaSenha" required>
      <br>
      <input type="submit" value="Criar Senha Definitiva">
    </form>
  </body>
</html>
