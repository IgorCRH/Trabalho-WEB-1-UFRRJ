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
    <link rel="stylesheet" , href="reset.css?v=2">
    <link rel="stylesheet" , href="style.css?v=2">
    <script src="validacpf.js"></script>
</head>

<body>
    <div class="caixa">
        <h1 class="titulo2">Login dos Discentes Respondentes</h1>
    </div>

    <form action="login.php" method="POST" onsubmit="return validarFormulario()">
        <label class="label2" for="cpf">CPF:</label>
        <input class="input2" type="text" name="CPF" required onblur="validarCPF(this.value)">
        <br>
        <label class="label2" for="senha">Senha:</label>
        <input class="input2" type="password" name="SenhaDisc" required>
        <br>
        <div class="caixa">
            <input class="btao2" type="submit" value="Logar">
        </div>
    </form>
</body>

</html>

