function validarEmail() {
  var emailInput = document.getElementById('emailInput');
  var email = emailInput.value;
  
  // Expressão regular para verificar o formato do email
  var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  if (regex.test(email)) {
    emailInput.setCustomValidity("");
    return true;
  } else {
    emailInput.setCustomValidity("Email inválido");
    return false;
  }
}
