<html>

<head>

    <link rel="stylesheet" , href="reset.css?v=2">
    <link rel="stylesheet" , href="style.css?v=2">
    <script src="validacpf.js"></script>
	<script src="validadados.js"></script>
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
        <input class="input2" type="text" name="EmailDisc" id="emailInput" required oninput="validarEmail()">
        <br>
        <div class="caixa">
            <input class="btao2" type="submit" value="Cadastrar">
        </div>
    </form>
</body>

<?php

include 'conecta.php';

function enviarEmail($nome, $email){
    require 'vendor/autoload.php';

    // Configuração do transporte SMTP para o Gmail
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
    ->setUsername('sistemadeavaliacao0@gmail.com')
    ->setPassword('Jasintod87!');

    // Criando o objeto Mailer usando o transporte SMTP configurado
    $mailer = new Swift_Mailer($transport);

    // Criando a mensagem de e-mail
    $message = (new Swift_Message('Seus Dados!'))
    ->setFrom(['sistemadeavaliacao0@gmail.com' => 'SistemadeAvaliacao'])
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
		header("Location: login.php");
    } else {
        echo "Erro ao cadastrar discente: " . $conn->error;
    }
    $conn->close();
}
?>

</html>