// Adiciona um ouvinte de evento para verificar quando o rádio é alterado
document.querySelectorAll('input[name="paymentMethod"]').forEach(function (radio) {
  radio.addEventListener('change', function () {
    // Esconde todos os campos
    document.getElementById('creditCardFields').style.display = 'none';
    document.getElementById('paypalFields').style.display = 'none';

    // Mostra os campos com base na opção de pagamento selecionada
    if (document.getElementById('credit').checked || document.getElementById('debit').checked) {
      document.getElementById('creditCardFields').style.display = 'block';
      desabilitarBotao();
    } else if (document.getElementById('paypal').checked) {
      document.getElementById('paypalFields').style.display = 'block';
      document.getElementById('paypalFields').hidden = false;
      document.getElementById("cc-name").value=null;
      document.getElementById("cc-cvv").value=null
      document.getElementById("cc-expiration").value=null;
      document.getElementById("cc-number").value=null;
      habilitarBotao();
    }
  });
});


function habilitarBotao() {
  document.getElementById("finalizar").disabled=false;
}

function desabilitarBotao() {
  document.getElementById("finalizar").disabled=true;
}


function verificarCampos(){
  let nome = document.getElementById("cc-name").value;
  let codigovv = document.getElementById("cc-cvv").value;
  let expira = document.getElementById("cc-expiration").value;
  let numero = document.getElementById("cc-number").value;
  let cvv = document.getElementById("error-cvv").innerHTML;
  let expiration = document.getElementById("error-expiration").innerHTML;
  let number = document.getElementById("error-number").innerHTML;

  if(nome!="" && cvv=="" && expiration=="" && number=="" && numero!="" && expira!="" && codigovv!="" ){
    habilitarBotao();
  }else{
    desabilitarBotao();
  }

  if(document.getElementById('paypal').checked){
    habilitarBotao();
  }
}

// Máscara para o número do cartão (formato: 9999 9999 9999 9999)
document.getElementById('cc-number').addEventListener('input', function (e) {
  let value = e.target.value;
  value = value.replace(/\D/g, '');
  value = value.replace(/(\d{4})(\d{4})(\d{4})(\d{4})/, '$1 $2 $3 $4');
  e.target.value = value.trim();
  if(value.length!=19){
    document.getElementById("error-number").innerHTML="Formato inválido! Digite 16 números";
  }else{
    document.getElementById("error-number").innerHTML="";
  }
});

// Máscara para a validade (formato: MM/YY)
document.getElementById('cc-expiration').addEventListener('input', function (e) {
  let value = e.target.value;
  value = value.replace(/\D/g, '');
  value = value.replace(/(\d{2})(\d{2})/, '$1/$2');
  e.target.value = value.trim();
  if(value.length!=5){
    document.getElementById("error-expiration").innerHTML="Formato inválido! Data MM/YY";
  }else{
    document.getElementById("error-expiration").innerHTML="";
  }
});

// Máscara para o CVV (formato: 999)
document.getElementById('cc-cvv').addEventListener('input', function (e) {
  let value = e.target.value;
  value = value.replace(/\D/g, '');
  e.target.value = value.trim();
  if(value.length!=3){
    document.getElementById("error-cvv").innerHTML="CVV deve conter 3 números!";
  }else{
    document.getElementById("error-cvv").innerHTML="";
  }
});

document.addEventListener("click",verificarCampos);