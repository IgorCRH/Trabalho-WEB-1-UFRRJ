<?php
session_start();
include 'conecta.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['cpf'])) {
  header("Location: login.php");
  exit;
}

$cpf = $_SESSION['cpf'];

// Remover avaliações do usuário (codigodiscente igual a ele) da tabela "avaliacao"
$sqlRemoverAvaliacoes = "DELETE FROM avaliacao WHERE codigodiscente = '$cpf'";
if ($conn->query($sqlRemoverAvaliacoes) !== TRUE) {
  echo "<p style='color: red; font-size: 20px;'>Erro ao remover as avaliações: {$conn->error}</p>";
}

// Desativar o acesso do usuário (campo AcessoAtivo igual a 0) na tabela "Respondente"
$sqlUpdateAcessoAtivo = "UPDATE Respondente SET AcessoAtivo = 0 WHERE CPF = '$cpf'";
if ($conn->query($sqlUpdateAcessoAtivo) !== TRUE) {
  echo "<p style='color: red; font-size: 20px;'>Erro ao desativar o acesso: {$conn->error}</p>";
} else {
  // Logout do usuário e redirecionamento para a página de login
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit;
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
