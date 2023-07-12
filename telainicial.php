<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet", href="reset.css">
        <link rel="stylesheet", href="style.css">
        <title>Pagina Aluno</title>
    </head>

    <body>
        <header>
            <h1 id="titulo">Seja bem-vindo, usuário!</h1>
        </header>

        <ul id="informacoes">
            <li class="itemLista">
                <p>Nome: XXXXXXXXXXX</p>
            </li>
            <li class="itemLista">
                <p>CPF: XXXXXXXXXXX</p>
            </li>
            <li class="itemLista">
                <p>E-mail: XXXXXXXXXXX</p>
            </li>
            <li class="itemLista">
                <p>Peso: XXXXXXXXXXX</p>
            </li>
            <li class="itemLista">
                <p>Altura: XXXXXXXXXXX</p>
            </li>
            <li class="itemLista">
                <p>Horas de Sono: XXXXXXXXXXX</p>
            </li>
        </ul>


<div class="caixaVerdeAvaliacao" onclick="realizarAvaliacao()">
        <p>Realizar Avaliação</p>
</div>

<div class="caixaVerdeLogout" onclick="realizarLogout()">
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
    </body>

</html>