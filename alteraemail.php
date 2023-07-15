<?php
session_start();
include 'conecta.php';


if (!isset($_SESSION['cpf'])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cpf = $_SESSION['cpf'];
  $emailSelecionado = $_POST['EmailSelecionado'];
  $emailNovo = $_POST['EmailNovo'];

  // Verifica se o CPF existe no banco de dados
  $sql = "SELECT * FROM Respondente WHERE CPF = '$cpf'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $emails = explode(", ", $row['Email']);
    $emailsAtualizados = array();


    foreach ($emails as $email) {
      if ($email == $emailSelecionado) {
        $emailsAtualizados[] = $emailNovo;
      } else {
        $emailsAtualizados[] = $email;
      }
    }

    $emailsAtualizadosString = implode(", ", $emailsAtualizados);


    $sqlUpdate = "UPDATE Respondente SET Email = '$emailsAtualizadosString' WHERE CPF = '$cpf'";
    if ($conn->query($sqlUpdate) === TRUE) {
      echo "<p style='color: white; font-size: 20px;'>Email alterado com sucesso!</p>";
	  header("refresh:2; url=telainicial.php");
    } else {
      echo "<p style='color: red; font-size: 20px;'>Erro ao alterar email: <span style='color: white; font-size: 20px;'>{$conn->error}</span></p>";
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
        <h1 class="titulo">Alteração de Email</h1>
    </div>
    <form action="alteraemail.php" method="POST" onsubmit="return validarFormulario()">
        <label class="label2" for="emailselecionado">Email Selecionado:</label>
        <select class="input2" name="EmailSelecionado">
          <?php
          $cpf = $_SESSION['cpf'];

          // Consulta os dados do usuário no banco de dados
          $sql = "SELECT * FROM Respondente WHERE CPF = '$cpf'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $emails = explode(", ", $row['Email']);

            // Exibe os emails existentes como opções no select
            foreach ($emails as $email) {
              echo "<option value='$email'>$email</option>";
            }
          }
          ?>
        </select>
        <br>
        <label class="label2" for="emailnovo">Email Novo:</label>
        <input class="input2" type="text" name="EmailNovo" required>
        <br>
        <div class="caixa">
            <input class="btao2" type="submit" value="Alterar">
        </div>
    </form>
</body>
</html>
