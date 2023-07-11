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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailerAutoload.php'; // Substitua pelo caminho correto para o arquivo autoload.php

include 'conecta.php';

// Função para enviar o email usando o PHPMailer
function enviarEmail($nome, $email) {
    $mail = new PHPMailer(true);
    
    try {
        // Configurações do servidor de email
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'iguhasnv@gmail.com';
        $mail->Password = 'senderh8937';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        // Configurações do email
        $mail->setFrom('iguhasnv@gmail.com', 'Sistema de Docentes');
        $mail->addAddress($email, $nome);
        $mail->Subject = 'Cadastro realizado com sucesso';
        $mail->Body = "Olá $nome,\n\nSeu cadastro foi realizado com sucesso.";
        
        // Envio do email
        $mail->send();
        
        echo "Discente cadastrado com sucesso e email enviado.";
        header("Location: primeirologin.php");
        exit;
    } catch (Exception $e) {
        echo "Erro ao enviar email: " . $mail->ErrorInfo;
    }
}

// Verifica se dentro do método POST os campos existem e têm algum valor
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


</body>
</html>
