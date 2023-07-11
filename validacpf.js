function validarCPF(cpf) {
  cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos
  
  if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
    return false;
  }
  
  var soma = 0;
  var resto;
  
  for (var i = 1; i <= 9; i++) {
    soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
  }
  
  resto = (soma * 10) % 11;
  
  if ((resto === 10) || (resto === 11)) {
    resto = 0;
  }
  
  if (resto !== parseInt(cpf.substring(9, 10))) {
    return false;
  }
  
  soma = 0;
  
  for (var i = 1; i <= 10; i++) {
    soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
  }
  
  resto = (soma * 10) % 11;
  
  if ((resto === 10) || (resto === 11)) {
    resto = 0;
  }
  
  if (resto !== parseInt(cpf.substring(10, 11))) {
    return false;
  }
  
  return true;
}

function validarFormulario() {
  var cpfInput = document.getElementsByName('CPF')[0];
  var cpf = cpfInput.value;
  
  if (!validarCPF(cpf)) {
    alert('CPF inválido. Por favor, insira um CPF válido.');
    cpfInput.focus();
    return false;
  }
  
  return true;
}
