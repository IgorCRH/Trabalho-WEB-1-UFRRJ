<?php
include('conecta.php');

if(isset($_POST['login']) || isset($_POST['senha'])){ 
        // Verifica se o login e a senha existem
    if(empty($_POST['login'])){
        echo "Preencha seu login";
    }
    else if(empty($_POST['senha'] == 0)){
        echo "Preencha sua senha";
    }
        // Caso algum dos dois esteja vazio, será emitida uma mensagem solicitando o preenchimento
    else {

        $login = $conn->real_escape_string($_POST['login']); 
        $senha = $conn->real_escape_string($_POST['senha']);
        // Escapa os dados para evitar SQL injection e os coloca nas variáveis

        $sql_codeC = "SELECT * FROM respondente WHERE CPF = '$login' AND Senha = '$senha'"; 
        $sql_queryC = $conn->query($sql_codeC) or die("Falha no comando SQL: ". $conn->error);
        $quantidadeC = $sql_queryC->num_rows;
        // Responsável por checar o CPF

        $sql_codeE = "SELECT * FROM respondente WHERE Email = '$login' AND Senha = '$senha'"; 
        $sql_queryE = $conn->query($sql_codeE) or die("Falha no comando SQL: ". $conn->error);
        $quantidadeE = $sql_queryE->num_rows;
        // Responsável por checar o Email

        if($quantidadeC == 1){ 
            // Se o login foi feito por CPF, irá seguir por aqui
            $usuario = $sql_queryC->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }
            
            $_SESSION['CPF'] = $usuario['CPF'];

            //header("Location: index.php"); // index.php é uma página genérica para fins de teste
            
        }
        else if($quantidadeE == 1){
            // Se o login foi feito por Email, irá seguir por aqui

            $usuario = $sql_queryE->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['Email'] = $usuario['Email'];

            //header("Location: index.php"); // index.php é uma página genérica para fins de teste
            
        }
        else{
            echo "Falha no login! Email ou senha incorreto(s)";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Login</title>
</head>
<body>
    <h1>Página de Login</h1>
    <form action="" method="POST">
        <p>
            <label>Login</label>
            <input type="text" name="login">
        </p>
        <p>
            <label>Senha</label>
            <input type="text" name="senha">
        </p>

        <p>
            <button type="submit">Entrar</button>
        </p>
    </form>
</body>
</html>
