
function okRedirect(){
    window.location="index.php";
}

const button_ok = document.getElementById("button_ok");
if(button_ok!=null){
    button_ok.addEventListener("click", okRedirect);
}

function okFailRedirect(){
    window.location="registerAdmin.php";
}

const button_fail_ok = document.getElementById("button_fail_ok");
if(button_fail_ok!=null){
    button_fail_ok.addEventListener("click", okFailRedirect);
}

function activateButton(){
    let cpf = document.getElementById("error-cpf").hidden;
    let senha = document.getElementById("error-senha").hidden;
    let confirm = document.getElementById("error-confirmsenha").hidden;
    let email = document.getElementById("error-email").hidden;

    if(cpf && senha && confirm && email){
        document.getElementById("enviar").disabled=false;
    }else{
        document.getElementById("enviar").disabled=true;
    }
}

// Função para aplicar a máscara de CPF
function formatarCPF(cpf) {
    cpf = cpf.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
    cpf = cpf.replace(/(\d{3})(\d{2})$/, '$1-$2'); // Adiciona o traço
    return cpf;
}

// Função para tratar o evento de entrada no campo de CPF
function mascaraCPF(input) {
    input.value = formatarCPF(input.value);

    let cpf = input.value.replace(/\D/g,"");
    if(cpf.length!=11){
        document.getElementById("error-cpf").hidden = false;
        document.getElementById("error-cpf").textContent="Insira um cpf válido.";
    }else{
        document.getElementById("error-cpf").textContent="";
        document.getElementById("error-cpf").hidden = true;
    }
}

// Adicione o evento de entrada ao campo de CPF
const campoCPF = document.getElementById('cpf'); // Substitua 'cpf' pelo ID do seu campo de CPF
campoCPF.addEventListener('input', function () {
    mascaraCPF(campoCPF);
});

// Função para validar um endereço de e-mail simples
function validarEmail(email) {
    const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    return emailRegex.test(email);
}

// Adicione o evento de entrada ao campo de e-mail
const campoEmail = document.getElementById('email'); // Substitua 'email' pelo ID do seu campo de e-mail
campoEmail.addEventListener('input', function () {
    if (!validarEmail(campoEmail.value)) {
        document.getElementById("error-email").hidden = false;
        document.getElementById("error-email").textContent="Por favor, insira um e-mail válido.";
    } else {
        document.getElementById("error-email").textContent="";
        document.getElementById("error-email").hidden = true;
    }
});

function validarSenha(senha) {
    // Verificar se a senha tem pelo menos 8 caracteres
    if (senha.length < 8) {
        return false;
    }

    // Verificar se a senha contém pelo menos 1 letra maiúscula
    if (!/[A-Z]/.test(senha)) {
        return false;
    }

    // Verificar se a senha contém pelo menos 1 número
    if (!/[0-9]/.test(senha)) {
        return false;
    }

    // Verificar se a senha contém pelo menos 1 caractere especial
    if (!/[$&+,:;=?@#|'<>.^*()%!-]/.test(senha)) {
        return false;
    }

    // Se a senha atender a todos os critérios, é válida
    return true;
}

// Adicione o evento de entrada ao campo de senha
const campoSenha = document.getElementById('password'); 
campoSenha.addEventListener('input', function () {
    if (!validarSenha(campoSenha.value)) {
        document.getElementById("error-senha").hidden = false;
        document.getElementById("error-senha").textContent="A senha deve conter ao menos 8 caracteres, 1 letra maiúscula, 1 número e 1 caractere especial!";
    } else {
        document.getElementById("error-senha").textContent="";
        document.getElementById("error-senha").hidden = true;
    }
});

const campoConfirmaSenha = document.getElementById("confirmPassword");
campoConfirmaSenha.addEventListener('input', function () {
    if (campoSenha.value!=campoConfirmaSenha.value) {
        document.getElementById("error-confirmsenha").hidden = false;
        document.getElementById("error-confirmsenha").textContent="A confirmação de senha deve ser igual a senha!";
    } else {
        document.getElementById("error-confirmsenha").textContent="";
        document.getElementById("error-confirmsenha").hidden = true;
    }
});

document.getElementById("firstName").addEventListener("input", function (e) {
    e.target.value = e.target.value.replace(/[^A-Za-zÀ-ú\s]/g, "");
});

document.getElementById("lastName").addEventListener("input", function (e) {
    e.target.value = e.target.value.replace(/[^A-Za-zÀ-ú\s]/g, "");
});

document.addEventListener("click", activateButton);








