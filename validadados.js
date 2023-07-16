function isEmail(email) {
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function validarEmail() {
    var email = document.getElementById('emailInput').value;
    var emailInput = document.getElementById('emailInput');

    if (isEmail(email)) {
        emailInput.setCustomValidity("");
    } else {
        emailInput.setCustomValidity("Email inválido!");
    }
    emailInput.reportValidity();
}

function nomeValido(nome)
{
    if(nome.length>80 || /\d/.test(nome))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function chamarNomeValido()
{
    var nome = document.getElementById('NomeInput').value;
    var nomeInput = document.getElementById('NomeInput');

    if(nomeValido(nome))
    {
        nomeInput.setCustomValidity("");
    }
    else
    {
        nomeInput.setCustomValidity("Nome inválido!");
    }
    nomeInput.reportValidity();
}

function senhaValida()
{
    var senha = document.getElementById('senhaInput').value;
    var senhaInput = document.getElementById('senhaInput');

    if(senha.length > 10)
    {
        senhaInput.setCustomValidity("Senha inválida!");
    }
    else
    {
        senhaInput.setCustomValidity("");
    }
    senhaInput.reportValidity();
}

function alturaValida()
{
    altura = document.getElementById('AlturaInput').value;
    alturaInput = document.getElementById('AlturaInput');

    if(/^[\d.,;]+$/.test(altura))
    {
        valorInput.setCustomValidity("");
    }
    else
    {
        alturaInput.setCustomValidity("Valor inválido!");
    }
    alturaInput.reportValidity();
}

function pesoValido()
{
    peso = document.getElementById('PesoInput').value;
    pesoInput = document.getElementById('PesoInput');

    if(/^[\d.,;]+$/.test(peso))
    {
        pesoInput.setCustomValidity("");
    }
    else
    {
        pesoInput.setCustomValidity("Valor inválido!");
    }
    pesoInput.reportValidity();
}

function HorasSonoValidas()
{
    horasono = document.getElementById('HoraSonoInput').value;
    horasonoInput = document.getElementById('HoraSonoInput');

    if(/^[\d.,;]+$/.test(horasono))
    {
        horasonoInput.setCustomValidity("");
    }
    else
    {
        horasonoInput.setCustomValidity("Valor inválido!");
    }
    horasonoInput.reportValidity();
}

function dataValida()
{
    valorData = document.getElementById('DataInput').value;
    valorDataInput = document.getElementById('DataInput');

    if(/^\d{4}-\d{2}-\d{2}$/.test(valorData))
    {
         valorDataInput.setCustomValidity("");
    }
    else
    {
         valorDataInput.setCustomValidity("Data inválida! Use o formato AAAA-MM-DD.");
    }
     valorDataInput.reportValidity();
}

function notaAvaliacaoValida()
{
    nota = document.getElementById('notaInput').value;
    notaInput = document.getElementById('notaInput');

    if(/^[\d.,;]+$/.test(nota))
    {
        notaInput.setCustomValidity("");
    }
    else
    {
        notaInput.setCustomValidity("Valor inválido!");
    }
    notaInput.reportValidity();
}