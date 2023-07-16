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
    <link rel="stylesheet", href="reset.css?v=2">
    <link rel="stylesheet", href="style.css?v=2">
    <script src="validacpf.js"></script>
  </head>  

  <body>
    <header class="caixa">
        <h1 class="titulo2">Alteração da Senha Provisória</h1>
    </header>

    <form action="alterasenha.php" method="POST" onsubmit="return validarFormulario()">
        <div class="caixa">
            <label for="senha" class="label1">Nova Senha:</label>
            <input class="input" type="password" name="NovaSenha" id="senhaInput" required oninput="senhaValida(this)">
        </div>
        <br>
        <div class="caixa">
            <input type="submit" value="Criar Senha Definitiva" class="btao2" id="btaoSenha">
        </div>
    </form>
  </body>
</html>