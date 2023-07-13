<?php
session_start();
include 'conecta.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
  header("Location: login.php");
  exit;
}

// Obtém o código do discente com base no CPF do usuário logado
$cpfDiscente = $_SESSION['cpf'];
$sqlDiscente = "SELECT CodigoDiscente FROM Respondente WHERE CPF = '$cpfDiscente'";
$resultDiscente = $conn->query($sqlDiscente);

if ($resultDiscente->num_rows > 0) {
  $rowDiscente = $resultDiscente->fetch_assoc();
  $codigoDiscente = $rowDiscente['CodigoDiscente'];
} else {
  echo "Erro ao obter o código do discente.";
  exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtém o código do docente selecionado
  $codigoDocente = $_POST['Docente'];

  // Verifica se o usuário já avaliou o docente
  $sqlVerificarAvaliacao = "SELECT * FROM Avaliacao WHERE CodigoDiscente = '$codigoDiscente' AND CodigoDocente = '$codigoDocente'";
  $resultVerificarAvaliacao = $conn->query($sqlVerificarAvaliacao);

  if ($resultVerificarAvaliacao->num_rows > 0) {
    echo "Você já avaliou esse docente.";
	header("Location: telainicial.php");
    exit;
  }

  // Obtém as notas da avaliação
  $notaOrganizacao = $_POST['NotadeOrganizacaodasAulas'];
  $notaPlanoCurso = $_POST['NotadoPlanodeCurso'];
  $notaDidatica = $_POST['NotadeDidatica'];
  $notaEsclarecimento = $_POST['NotadeEsclarecimentodeDuvidas'];

  // Insere a avaliação no banco de dados
  $sqlInserirAvaliacao = "INSERT INTO Avaliacao (CodigoDiscente, CodigoDocente, NotadeOrganizacaodasAulas, NotadoPlanodeCurso, NotadeDidatica, NotadeEsclarecimentodeDuvidas)
                          VALUES ('$codigoDiscente', '$codigoDocente', '$notaOrganizacao', '$notaPlanoCurso', '$notaDidatica', '$notaEsclarecimento')";

  if ($conn->query($sqlInserirAvaliacao) === TRUE) {
    echo "Avaliação cadastrada com sucesso.";
  } else {
    echo "Erro ao cadastrar a avaliação: " . $conn->error;
  }
}

// Consulta os docentes no banco de dados
$sqlDocentes = "SELECT * FROM Docente";
$resultDocentes = $conn->query($sqlDocentes);
$docentes = $resultDocentes->fetch_all(MYSQLI_ASSOC);

?>

<html>
  <head>
    <style>
      h1 {
        text-align: center;
        color: white;
      }

      input,
      button {
        display: block;
        margin: 0 auto;
        font-size: 20px;
        color: white;
        background-color: #323232;
      }

      label {
        display: block;
        text-align: center;
        color: white;
        margin-bottom: 10px;
      }

    </style>
    <h1 id="tituloav">Avaliação de Docentes</h1>
    <link rel="stylesheet" href="reset.css?v=1">
    <link rel="stylesheet" href="style.css?v=1">
  </head>
  <body>
    <form id="formav" action="avaliacao.php" method="POST">
      <label for="docente">Docente:</label>
      <select name="Docente" required>
        <?php foreach ($docentes as $docente) : ?>
          <option value="<?php echo $docente['CodigoDocente']; ?>"><?php echo $docente['Nome']; ?></option>
        <?php endforeach; ?>
      </select>
      <br>
      <label for="cpf">Nota de Organização das Aulas:</label>
      <input type="text" name="NotadeOrganizacaodasAulas" required>
      <br>
      <label for="datanascimento">Nota do Plano de Curso:</label>
      <input type="text" name="NotadoPlanodeCurso" required>
      <br>
      <label for="peso">Nota de Didática:</label>
      <input type="text" name="NotadeDidatica" required>
      <br>
      <label for="altura">Nota de Esclarecimento de Dúvidas:</label>
      <input type="text" name="NotadeEsclarecimentodeDuvidas" required>
      <br>
      <input type="submit" value="Cadastrar">
    </form>
  </body>
</html>
