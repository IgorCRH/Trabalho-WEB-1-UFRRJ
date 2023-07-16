<?php
session_start();
include 'conecta.php';


if (!isset($_SESSION['cpf'])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cpf = $_SESSION['cpf'];
  $nomeNovo = $_POST['NomeNovo'];
  $senhaNova = $_POST['SenhaNova'];


  $sql = "SELECT * FROM Respondente WHERE CPF = '$cpf'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $nomeAtual = $row['Nome'];
    $senhaAtual = $row['Senha'];


    if (!empty($nomeNovo) && !empty($senhaNova)) {
      $nomeAtualizado = $nomeNovo;
      $senhaAtualizada = $senhaNova;
    } elseif (!empty($nomeNovo) && empty($senhaNova)) {
      $nomeAtualizado = $nomeNovo;
      $senhaAtualizada = $senhaAtual;
    } elseif (empty($nomeNovo) && !empty($senhaNova)) {
      $nomeAtualizado = $nomeAtual;
      $senhaAtualizada = $senhaNova;
    } else {
	  echo "<p style='color: white; font-size: 20px;'>Nenhum dado foi alterado.</p>";
      exit;
    }

    $sqlUpdate = "UPDATE Respondente SET Nome = '$nomeAtualizado', Senha = '$senhaAtualizada' WHERE CPF = '$cpf'";
    if ($conn->query($sqlUpdate) === TRUE) {
      echo "<p style='color: white; font-size: 20px;'>Nome e/ou senha alterados com sucesso!</p>";
	  header("Location: telainicial.php");
    } else {
      echo "<p style='color: white; font-size: 20px;'>Erro ao alterar nome e/ou senha: <span style='color: white; font-size: 20px;'>{$conn->error}</span></p>";
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
        <h1 class="titulo">Alteração de Nome e Senha</h1>
    </div>
    <form action="alteranomesenha.php" method="POST">
        <label class="label2" for="nomenov">Nome Novo:</label>
        <input class="input2" type="text" name="NomeNovo">
        <br>
        <label class="label2" for="senhanov">Senha Nova:</label>
        <input class="input2" type="password" name="SenhaNova">
        <br>
        <div class="caixa">
            <input class="btao2" type="submit" value="Alterar">
        </div>
    </form>
</body>
</html>
