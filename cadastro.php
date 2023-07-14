<html>

<head>

    <link rel="stylesheet" , href="reset.css?v=2">
    <link rel="stylesheet" , href="style.css?v=2">
    <script src="validacpf.js"></script>
</head>

<body>
    <div class="caixa">
        <h1 class="titulo2">Cadastro de Discentes Respondentes</h1>
    </div>
    <form action="cadastro.php" method="POST" onsubmit="return validarFormulario()">
        <label class="label2" for="nome">Nome:</label>
        <input class="input2" type="text" name="NomeDisc" required>
        <br>
        <label class="label2" for="cpf">CPF:</label>
        <input class="input2" type="text" name="CPF" required onblur="validarCPF(this.value)">
        <br>
        <label class="label2" for="datanascimento">Data de Nascimento:</label>
        <input class="input2" type="text" name="DataNascDisc" required>
        <br>
        <label class="label2" for="peso">Peso:</label>
        <input class="input2" type="text" name="PesoDisc" required>
        <br>
        <label class="label2" for="altura">Altura:</label>
        <input class="input2" type="text" name="AlturaDisc" required>
        <br>
        <label class="label2" for="horassono">Horas de Sono ao Dia:</label>
        <input class="input2" type="text" name="HorasSonoDisc" required>
        <br>
        <label class="label2" for="senha">Senha:</label>
        <input class="input2" type="text" name="SenhaDisc" required>
        <br>
        <label class="label2" for="senha">Email:</label>
        <input class="input2" type="text" name="EmailDisc" required>
        <br>
        <div class="caixa">
            <input class="btao2" type="submit" value="Cadastrar">
        </div>
    </form>
</body>

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
        $mail->Username = 'email@gmail.com';
        $mail->Password = 'senha';
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

</html>