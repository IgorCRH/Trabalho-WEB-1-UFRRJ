<?php
session_start();
include 'conecta.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['cpf'])) {
  header("Location: login.php");
  exit;
}

$cpf = $_SESSION['cpf'];

// Consulta o código do discente usando o CPF
$sql = "SELECT codigodiscente FROM Respondente WHERE CPF = '$cpf'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $codigodiscente = $row['codigodiscente'];

  // Remover avaliações do usuário (codigodiscente igual ao dele) da tabela "Avaliacao"
  $sqlRemoverAvaliacoes = "DELETE FROM Avaliacao WHERE codigodiscente = '$codigodiscente'";
  if ($conn->query($sqlRemoverAvaliacoes) !== TRUE) {
    echo "<p style='color: red; font-size: 20px;'>Erro ao remover as avaliações: {$conn->error}</p>";
  }

  // Desativar o acesso do usuário (campo AcessoAtivo igual a 0) na tabela "Respondente"
  $sqlUpdateAcessoAtivo = "UPDATE Respondente SET AcessoAtivo = 0 WHERE codigodiscente = '$codigodiscente'";
  if ($conn->query($sqlUpdateAcessoAtivo) !== TRUE) {
    echo "<p style='color: red; font-size: 20px;'>Erro ao desativar o acesso: {$conn->error}</p>";
  } else {
    // Logout do usuário e redirecionamento para a página de login
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
  }
} else {
  echo "<p style='color: white; font-size: 20px;'>Usuário não encontrado no sistema!</p>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="reset.css?v=2">
  <link rel="stylesheet" href="style.css?v=2">
  <title>Remover Acesso</title>
</head>
<body>
  <div class="caixa">
    <h1 class="titulo">Remover Acesso ao Sistema</h1>
  </div>
  <p style='color: white; font-size: 20px;'>Acesso removido com sucesso!</p>
</body>
</html>
