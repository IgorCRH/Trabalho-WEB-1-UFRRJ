<?php
session_start();
include 'conecta.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['cpf'])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cpf = $_SESSION['cpf'];
  $emailNovo = $_POST['EmailNovo'];

  // Verifica se o CPF existe no banco de dados
  $sql = "SELECT * FROM Respondente WHERE CPF = '$cpf'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $emailAtual = $row['Email'];
    $emailAtualizado = $emailAtual . ', ' . $emailNovo;

    // Atualiza o campo "Email" na tabela "Respondente"
    $sqlUpdate = "UPDATE Respondente SET Email = '$emailAtualizado' WHERE CPF = '$cpf'";
    if ($conn->query($sqlUpdate) === TRUE) {
      echo "<p style='color: white; font-size: 20px;'>Email adicionado com sucesso!</p>";
	  header("Location: telainicial.php");
    } else {
      echo "<p style='color: red; font-size: 20px;'>Erro ao adicionar email: <span style='color: white; font-size: 20px;'>{$conn->error}</span></p>";
    }
  } else {
    echo "<p style='color: white; font-size: 20px;'>Usuário não encontrado no sistema!</p>";
  }
}
?>

<html>
<head>
    <link rel="stylesheet" , href="reset.css?v=2">
    <link rel="stylesheet" , href="style.css?v=2">
    <script src="validadados.js"></script>
</head>
<body>
    <div class="caixa">
        <h1 class="titulo">Adição de Emails</h1>
    </div>
    <form action="adicionaemails.php" method="POST" onsubmit="return validarFormulario()">
        <label class="label2" for="emailnov">Email Novo:</label>
        <input class="input2" type="text" name="EmailNovo" id="emailInput" required oninput="validarEmail(this)">
        <br>
        <div class="caixa">
            <input class="btao2" type="submit" value="Inserir">
        </div>
    </form>
</body>
</html>
