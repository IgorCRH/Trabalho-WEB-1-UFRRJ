<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['cpf'])) {
  header("Location: login.php");
  exit;
}

include 'conecta.php';

$cpf = $_SESSION['cpf'];

// Consulta os dados do usuário no banco de dados
$sql = "SELECT * FROM Respondente WHERE CPF = '$cpf'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();

  // Recupera os valores dos campos do usuário
  $nome = $row['Nome'];
  $cpf = $row['CPF'];
  $email = $row['Email'];
  $peso = $row['Peso'];
  $altura = $row['Altura'];
  $horasSono = $row['Horas_Sono_Dia'];
} else {
  // Usuário não encontrado no banco de dados
  echo "Erro ao carregar os dados do usuário.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="reset.css?v=1">
    <link rel="stylesheet" href="style.css?v=1">
    <title>Página Aluno</title>
</head>

<body>
<header>
    <h1 id="titulo">Seja bem-vindo, <?php echo $nome; ?>!</h1>
</header>

<div id="conteudo">
    <ul id="informacoes">
        <li class="itemLista">
            <p>Nome: <?php echo $nome; ?></p>
        </li>
        <li class="itemLista">
            <p>CPF: <?php echo $cpf; ?></p>
        </li>
        <li class="itemLista">
            <p>E-mail: <?php echo $email; ?></p>
        </li>
        <li class="itemLista">
            <p>Peso: <?php echo $peso; ?></p>
        </li>
        <li class="itemLista">
            <p>Altura: <?php echo $altura; ?></p>
        </li>
        <li class="itemLista">
            <p>Horas de Sono: <?php echo $horasSono; ?></p>
        </li>
    </ul>

    <div id="avaliacao" class="btao" onclick="realizarAvaliacao()">
        <p>Realizar Avaliação</p>
    </div>

    <div id="logout" class="btao" onclick="realizarLogout()">
        <p>Realizar Logout</p>
    </div>

    <script>
        function realizarLogout() {
            window.location.href = "logout.php";
        }

        function realizarAvaliacao() {
            window.location.href = "avaliacao.php";
        }
    </script>
</div>
</body>

</html>
