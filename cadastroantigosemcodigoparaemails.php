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
    <h1>Cadastro de Discente</h1>
  </head>
  <body>
    <form action="cadastro.php" method="POST" onsubmit="return validarFormulario()">
	     <label for="nome">Nome:</label>
        <input type="text" name="NomeDisc" required>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="CPF" required onblur="validarCPF(this.value)">
        <br>
        <label for="datanascimento">Data de Nascimento:</label>
        <input type="text" name="DataNascDisc" required>
        <br>
		<label for="senha">Senha:</label>
        <input type="text" name="SenhaDisc" required>
        <br>
		<label for="senha">Email:</label>
        <input type="text" name="EmailDisc" required>
        <br>
        <input type="submit" value="Cadastrar">
    </form>

<?php
include 'conecta.php';

// Verifica se dentro do método POST os campos existem e tem algum valor
if (isset($_POST['NomeDisc']) && isset($_POST['CPF']) && isset($_POST['DataNascDisc']) && isset($_POST['SenhaDisc']) && isset($_POST['EmailDisc'])) {
$nome_discente = $_POST['NomeDisc'];
$cpf_discente = $_POST['CPF'];
$data_nasc_discente = $_POST['DataNascDisc'];
$senha_discente = $_POST['SenhaDisc'];
$email_discente = $_POST['EmailDisc'];

    // Insere os dados de endereço na tabela tb_endereco
$sql_cadastro = "INSERT INTO Discente (Nome, CPF, DataNascimento, Senha, Email) VALUES ('$nome_discente', '$cpf_discente', '$data_nasc_discente', '$senha_discente', '$email_discente')";
if ($conn->query($sql_cadastro) === TRUE) {
      echo "Discente cadastrado com sucesso.";
	  header("Location: primeirologin.php");
      exit;
        } else {
            echo "Erro ao cadastrar discente: " . $conn->error;
        }
$conn->close();
}
?>

</body>
</html>
