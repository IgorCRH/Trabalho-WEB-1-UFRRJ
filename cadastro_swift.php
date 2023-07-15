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
    <h1>Cadastro de Discentes Respondentes</h1>
  </head>
  <body>
    <form action="cadastro_swift.php" method="POST" onsubmit="return validarFormulario()">
	     <label for="nome">Nome:</label>
        <input type="text" name="NomeDisc" required>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="CPF" required onblur="validarCPF(this.value)">
        <br>
        <label for="datanascimento">Data de Nascimento:</label>
        <input type="text" name="DataNascDisc" required>
        <br>
		<label for="peso">Peso:</label>
        <input type="text" name="PesoDisc" required>
        <br>
		<label for="altura">Altura:</label>
        <input type="text" name="AlturaDisc" required>
        <br>
		<label for="horassono">Horas de Sono ao Dia:</label>
        <input type="text" name="HorasSonoDisc" required>
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

function enviarEmail($nome, $email){
    require 'vendor/autoload.php';

    // Configuração do transporte SMTP para o Gmail
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
    ->setUsername('iguhasnv@gmail.com')
    ->setPassword('senderh8937');

    // Criando o objeto Mailer usando o transporte SMTP configurado
    $mailer = new Swift_Mailer($transport);

    // Criando a mensagem de e-mail
    $message = (new Swift_Message('Assunto do E-mail'))
    ->setFrom(['iguhasnv@gmail.com' => 'Sender'])
    ->setTo([$email_discente => $nome_discente])
    ->setBody(
      'Nome: ' . $nome_discente . "\n" .
      'CPF: ' . $cpf_discente . "\n" .
      'Data de Nascimento: ' . $data_nasc_discente . "\n" .
      'Senha: ' . $senha_discente . "\n" .
      'Email: ' . $email_discente . "\n" .
      'Altura: ' . $altura_discente . "\n" .
      'Peso: ' . $peso_discente . "\n" .
      'Horas de Sono: ' . $horassonodia_discente . "\n"
  );

    // Enviando o e-mail
    $result = $mailer->send($message);

    // Verificando se o e-mail foi enviado com sucesso
    if ($result) {
    echo "E-mail enviado com sucesso!";
    } else {
    echo "Falha ao enviar o e-mail.";
    }
}

if (isset($_POST['NomeDisc']) && isset($_POST['CPF']) && isset($_POST['PesoDisc']) && isset($_POST['AlturaDisc']) && isset($_POST['HorasSonoDisc']) && isset($_POST['DataNascDisc']) && isset($_POST['SenhaDisc']) && isset($_POST['EmailDisc'])) {
    $nome_discente = $_POST['NomeDisc'];
    $cpf_discente = $_POST['CPF'];
    $data_nasc_discente = $_POST['DataNascDisc'];
    $senha_discente = $_POST['SenhaDisc'];
    $email_discente = $_POST['EmailDisc'];
	$altura_discente = $_POST['AlturaDisc'];
	$peso_discente = $_POST['PesoDisc'];
	$horassonodia_discente = $_POST['HorasSonoDisc'];

    // Insere os dados de endereço na tabela tb_endereco
    $sql_cadastro = "INSERT INTO Respondente (Nome, CPF, DataNascimento, Peso, Altura, Horas_Sono_Dia, Senha, Email) VALUES ('$nome_discente', '$cpf_discente', '$data_nasc_discente', '$peso_discente', '$altura_discente', '$horassonodia_discente', '$senha_discente', '$email_discente')";
    if ($conn->query($sql_cadastro) === TRUE) {
        // Chama a função para enviar o email
        enviarEmail($nome_discente, $email_discente);
    } else {
        echo "Erro ao cadastrar discente: " . $conn->error;
    }
    $conn->close();
}
?>