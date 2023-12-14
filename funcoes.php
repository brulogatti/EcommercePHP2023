<?php
function cadastrarUsuario($admin)
{
    $result = false;

    $codigo = obterCodigo("json/codigo_usuarios.json");

    //Verificar se a senha é igual a confirmação de senha
    if (confirmarSenha()) {

        if ($admin) {
            $usuario = array(
                "nome" => $_POST["firstName"],
                "sobrenome" => $_POST["lastName"],
                "login" => $_POST["username"],
                "email" => $_POST["email"],
                "senha" => $_POST["password"],
                "cpf" => $_POST["cpf"],
                "endereco" => null,
                "complemento" => null,
                "cidade" => null,
                "estado" => null,
                "CEP" => null,
                "admin" => $admin,
                "codigo" => $codigo,
                "data" => date("d/m/Y")
            );
        } else {
            $usuario = array(
                "nome" => $_POST["firstName"],
                "sobrenome" => $_POST["lastName"],
                "login" => $_POST["username"],
                "email" => $_POST["email"],
                "senha" => $_POST["password"],
                "cpf" => $_POST["cpf"],
                "endereco" => $_POST["address"],
                "complemento" => $_POST["address2"],
                "cidade" => $_POST["city"],
                "estado" => $_POST["state"],
                "CEP" => $_POST["cep"],
                "admin" => $admin,
                "codigo" => $codigo,
                "data" => date("d/m/Y")
            );
        }


        if (naoExisteUsuario($_POST["email"])) {

            if (file_exists("json/usuarios.json")) {
                $dados = file_get_contents("json/usuarios.json");
                $dados = json_decode($dados, true);
            }
            $dados[] = $usuario;
            $dados = json_encode($dados, JSON_PRETTY_PRINT);
            file_put_contents("json/usuarios.json", $dados);

            atualizarCodigo($codigo, "json/codigo_usuarios.json");
            $result = true;
        } else {
            $result = false;
            setcookie("erroCadastro", "Usuário já existente!", time() + 60);
        }
    }

    return $result;
}

function confirmarSenha()
{
    $result = false;
    if ($_POST["password"] == $_POST["confirmPassword"]) {
        $result = true;
    }
    return $result;
}

function obterCodigo($arquivo)
{
    if (file_exists($arquivo)) {
        $codigo = file_get_contents($arquivo);
        $codigo = json_decode($codigo);
    } else {
        $codigo = 1;
    }
    return $codigo;
}

function atualizarCodigo($codigo, $arquivo)
{
    $codigo = $codigo + 1;
    $codigo = json_encode($codigo);
    file_put_contents($arquivo, $codigo);
}

function naoExisteUsuario($usuario)
{
    $existe = true;
    if (file_exists("json/usuarios.json")) {
        $dados = file_get_contents("json/usuarios.json");
        $dados = json_decode($dados, true);
        foreach ($dados as $user) {
            if ($user["email"] == $usuario) {
                $existe = false;
            }
        }
    }

    return $existe;
}

function verificarLogin()
{
    $result = 2;

    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $dados = file_get_contents("json/usuarios.json");
        $dados = json_decode($dados, true);

        foreach ($dados as $indice => $user) {
            if ($user["email"] == $email && $user["senha"] == $password) {
                $_SESSION["email"] = $email;
                $_SESSION["codigo"] = $user["codigo"];
                $_SESSION["admin"] = $user["admin"];
                if ($user["admin"]) {
                    $result = 0;
                } else {
                    $result = 1;
                }
            }
        }

        if (!isset($_SESSION["email"]) && !isset($_SESSION["codigo"])) {
            $result = 3;
        }
    }

    return $result;
}

function listarUsers()
{

    $dados = array();

    if (file_exists("json/usuarios.json")) {
        $dados = file_get_contents("json/usuarios.json");
        $dados = json_decode($dados, true);
    }

    return $dados;
}

function listarPedidos()
{

    $dados = array();

    if (file_exists("json/pedidos.json")) {
        $dados = file_get_contents("json/pedidos.json");
        $dados = json_decode($dados, true);
    }

    return $dados;
}

function deleteUser($codigo)
{
    $result = false;

    if (file_exists("json/usuarios.json")) {
        $dados = file_get_contents("json/usuarios.json");
        $dados = json_decode($dados, true);

        for ($i = 0; $i < sizeof($dados); $i++) {
            if ($dados[$i]["codigo"] == $codigo) {
                unset($dados[$i]);
            }
        }

        $dadosModificados = array();
        foreach ($dados as $dado) {
            $dadosModificados[] = $dado;
        }

        $dadosModificados = json_encode($dadosModificados, JSON_PRETTY_PRINT);
        file_put_contents("json/usuarios.json", $dadosModificados);

        $result = true;
    }

    return $result;
}

function deletePedido($codigo)
{
    $result = false;

    if (file_exists("json/pedidos.json")) {
        $dados = file_get_contents("json/pedidos.json");
        $dados = json_decode($dados, true);

        for ($i = 0; $i < sizeof($dados); $i++) {
            if ($dados[$i]["id"] == $codigo) {
                unset($dados[$i]);
            }
        }

        $dadosModificados = array();
        foreach ($dados as $dado) {
            $dadosModificados[] = $dado;
        }

        $dadosModificados = json_encode($dadosModificados, JSON_PRETTY_PRINT);
        file_put_contents("json/pedidos.json", $dadosModificados);

        $result = true;
    }

    return $result;
}

function buscarUsuario($codigo)
{
    $usuario = array();

    if (file_exists("json/usuarios.json")) {
        $dados = file_get_contents("json/usuarios.json");
        $dados = json_decode($dados, true);

        foreach ($dados as $user) {
            if ($user["codigo"] == $codigo) {
                $usuario = $user;
            }
        }
    }

    return $usuario;
}

function cadastrarProduto()
{
    $result = false;

    $codigo = obterCodigo("json/codigo_produtos.json");
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    // Lida com o upload da imagem
    $targetDir = "img/produtos/";
    $targetFile = $targetDir . "produto" . $codigo . "_" . basename($_FILES["photo"]["name"]);

    // Cria um array com os dados do produto
    $productData = array(
        "produto" => $productName,
        "preco" => $price,
        "descricao" => $description,
        "codigo" => $codigo,
        "url"=>$targetFile,
    );

    $filename = "json/produtos.json";

    if (file_exists($filename)) {
        $dados = file_get_contents($filename);
        $dados = json_decode($dados, true);
    }
    $dados[] = $productData;
    $dados = json_encode($dados, JSON_PRETTY_PRINT);
    file_put_contents($filename, $dados);

    atualizarCodigo($codigo,"json/codigo_produtos.json");

    move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);

    $result = true;

    return $result;
}

function listarProdutos(){
    $dados = array();

    if (file_exists("json/produtos.json")) {
        $dados = file_get_contents("json/produtos.json");
        $dados = json_decode($dados, true);
    }

    return $dados;
}

function deleteProduto($codigo)
{
    $result = false;

    if (file_exists("json/produtos.json")) {
        $dados = file_get_contents("json/produtos.json");
        $dados = json_decode($dados, true);

        for ($i = 0; $i < sizeof($dados); $i++) {
            if ($dados[$i]["codigo"] == $codigo) {
                unset($dados[$i]);
            }
        }

        $dadosModificados = array();
        foreach ($dados as $dado) {
            $dadosModificados[] = $dado;
        }

        $dadosModificados = json_encode($dadosModificados, JSON_PRETTY_PRINT);
        file_put_contents("json/produtos.json", $dadosModificados);

        apagarCarrinhosProduto($codigo);

        $result = true;
    }

    return $result;
}

function buscarProduto($codigo)
{
    $produto = array();

    if (file_exists("json/produtos.json")) {
        $dados = file_get_contents("json/produtos.json");
        $dados = json_decode($dados, true);

        foreach ($dados as $product) {
            if ($product["codigo"] == $codigo) {
                $produto = $product;
            }
        }
    }

    return $produto;
}

function editarProduto($codigo){
    $result=false;
    if(file_exists("json/produtos.json")){
        $dados = file_get_contents("json/produtos.json");
        $dados = json_decode($dados,true);

        for ($i=0; $i < sizeof($dados); $i++) { 
            if($dados[$i]["codigo"] == $codigo){
                $dados[$i]["produto"]=$_POST["productName"];
                $dados[$i]["preco"]=$_POST["price"];
                $dados[$i]["descricao"]=$_POST["description"];
                if(!empty($_FILES["photo"]["name"])){

                    if (file_exists($dados[$i]["url"])) {
                        unlink($dados[$i]["url"]);
                    }

                    $targetDir = "img/produtos/";
                    $targetFile = $targetDir . "produto" . $codigo . "_" . basename($_FILES["photo"]["name"]);
                    $dados[$i]["url"]=$targetFile;
                    move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);

                }
            }
        }

        $dados = json_encode($dados,JSON_PRETTY_PRINT);
        file_put_contents("json/produtos.json",$dados);

        $result=true;
    }
    return $result;
}

function buscarCarrinho($sessionId){
    $carrinho = array();
    $produtos = array();

    if(file_exists("json/carrinhos.json")){
        $dados = file_get_contents("json/carrinhos.json");
        $dados = json_decode($dados, true);

        foreach ($dados as $dado) {
            if($dado["id"] == $sessionId){
                $carrinho[] = $dado;
            }
        }
    }

    $codigos = "";

    if(sizeof($carrinho)>0){
        foreach ($carrinho as $item) {
            if(!str_contains($codigos, $item["codigoP"]))
            $produto=buscarProduto($item["codigoP"]);
            $produtos[]=$produto;
            $codigos = $codigos."-".$item["codigoP"];
        }
    }

    return $produtos;
}

function adicionarCarrinho($codigoProduto, $sessionId){
    $entrei=false;
    $carrinho = array(
        "id"=>$sessionId,
        "codigoP"=>$codigoProduto,
        "qtd"=>1
    );
    if(file_exists("json/carrinhos.json")){
        $dados = file_get_contents("json/carrinhos.json");
        $dados = json_decode($dados, true);
        for ($i = 0; $i < sizeof($dados); $i++) {
            if ($dados[$i]["id"] == $sessionId && $dados[$i]["codigoP"] == $codigoProduto) {
                $dados[$i]["qtd"]+=1;
                $entrei=true;
            }
        }
    }
    
    if(!$entrei){
        $dados[]=$carrinho;
    }
    $dados = json_encode($dados,JSON_PRETTY_PRINT);
    file_put_contents("json/carrinhos.json",$dados);
}

function buscarQtd($sessionId, $codigoProduto){
    $result=1;
    if (file_exists("json/carrinhos.json")) {
        $dados = file_get_contents("json/carrinhos.json");
        $dados = json_decode($dados, true);
        foreach ($dados as $carrinho) {
            if($carrinho["codigoP"] == $codigoProduto && $carrinho["id"]==$sessionId){
                $result = $carrinho["qtd"];
            }
        }
    }
    return $result;
}

function deletarProdutoCarrinho($codigo){
    if (file_exists("json/carrinhos.json")) {
        $dados = file_get_contents("json/carrinhos.json");
        $dados = json_decode($dados, true);

        for ($i = 0; $i < sizeof($dados); $i++) {
            if ($dados[$i]["codigoP"] == $codigo) {
                unset($dados[$i]);
            }
        }

        $dadosModificados = array();
        foreach ($dados as $dado) {
            $dadosModificados[] = $dado;
        }

        $dadosModificados = json_encode($dadosModificados, JSON_PRETTY_PRINT);
        file_put_contents("json/carrinhos.json", $dadosModificados);
    }
}

function gerarPedido($sessaoId){
    $result = false;
    $produtos = buscarCarrinho($sessaoId);
    $soma = 0;
    $data = date("d/m/Y");
    $nomeProdutos=array();
    $codigoProdutos=array();
    $codigo = obterCodigo("json/codigo_pedido.json");
    $codigoPagamento=obterCodigo("json/codigo_pagamento.json");

    $nroCartao=null;
    $cvv=null;
    $nomeCartao=null;
    $validadeCartao=null;

    if($_POST["paymentMethod"] != 2){
        $nroCartao=$_POST["cc-number"];
        $cvv=$_POST["cc-cvv"];
        $nomeCartao=$_POST["cc-name"];
        $validadeCartao=$_POST["cc-expiration"];
    }

    foreach ($produtos as $produto) {
        $nomeProdutos[]=$produto["produto"];
        $codigoProdutos[]=$produto["codigo"];
        $qtd=buscarQtd($sessaoId,$produto["codigo"]);
        $soma+=$qtd*$produto["preco"];
        $qtdCodigo[]=array(
            "qtd"=>$qtd,
            "codigo"=>$produto["codigo"],
            "produto"=>$produto["produto"]
        );
    }

    $pedido = array(
        "id"=> $codigo,
        "idCliente" => $_SESSION["codigo"],
        "emailCliente" => $_SESSION["email"],
        "codigoProdutos" => $codigoProdutos,
        "nomeProdutos"=>$nomeProdutos,
        "qtdCodigo"=>$qtdCodigo,
        "data"=> $data,
        "pagamento"=>$codigoPagamento,
        "valor"=>$soma
    );

    $pagamento = array(
        "codigo"=>$codigoPagamento,
        "tipoPagamento"=>$_POST["paymentMethod"],
        "nroCartao" => $nroCartao,
        "cvv" => $cvv,
        "nomeCartao" => $nomeCartao,
        "validade" => $validadeCartao
    );

    if (file_exists("json/pedidos.json")) {
        $dados = file_get_contents("json/pedidos.json");
        $dados = json_decode($dados, true);
    }

    if (file_exists("json/pagamentos.json")) {
        $dadosPagamentos = file_get_contents("json/pagamentos.json");
        $dadosPagamentos = json_decode($dadosPagamentos, true);
    }

    $dados[]=$pedido;
    $dadosPagamentos[]=$pagamento;

    $dados = json_encode($dados, JSON_PRETTY_PRINT);
    $dadosPagamentos = json_encode($dadosPagamentos, JSON_PRETTY_PRINT);
    file_put_contents("json/pedidos.json",$dados);
    file_put_contents("json/pagamentos.json",$dadosPagamentos);

    atualizarCodigo($codigo,"json/codigo_pedido.json");
    atualizarCodigo($codigo,"json/codigo_pagamento.json");
    apagarCarrinho($sessaoId);

    $result = true;

    return $result;
}

function buscarPedidos($codigo){
    $pedidos = array();

    if(file_exists("json/pedidos.json")){
        $dados = file_get_contents("json/pedidos.json");
        $dados = json_decode($dados, true);

        foreach ($dados as $pedido) {
            if($pedido["idCliente"]==$codigo){
                $pedidos = $dados;
            }
        }

    }

    return $pedidos;
}

function buscarPagamento($codigo){
    $result="";

    if(file_exists("json/pagamentos.json")){
        $dados = file_get_contents("json/pagamentos.json");
        $dados = json_decode($dados, true);

        foreach ($dados as $pagamento) {
            if($codigo==$pagamento["codigo"]){
                if($pagamento["tipoPagamento"]==2){
                    $result = "Boleto";
                }else if($pagamento["tipoPagamento"]==0){
                    $result = "Crédito";
                }else{
                    $result = "Débito";
                }
            }
        }
    }

    return $result;
}

function apagarCarrinho($sessaoId){
    if (file_exists("json/carrinhos.json")) {
        $dados = file_get_contents("json/carrinhos.json");
        $dados = json_decode($dados, true);

        $tamanho = sizeof($dados);

        for ($i = 0; $i < $tamanho; $i++) {
            if ($dados[$i]["id"] == $sessaoId) {
                unset($dados[$i]);
            }
        }

        $dadosModificados = array();
        foreach ($dados as $dado) {
            $dadosModificados[] = $dado;
        }

        $dadosModificados = json_encode($dadosModificados, JSON_PRETTY_PRINT);
        file_put_contents("json/carrinhos.json", $dadosModificados);
    }
}

function apagarCarrinhosProduto($codigoP){
    if (file_exists("json/carrinhos.json")) {
        $dados = file_get_contents("json/carrinhos.json");
        $dados = json_decode($dados, true);

        $tamanho = sizeof($dados);

        for ($i = 0; $i < $tamanho; $i++) {
            if ($dados[$i]["codigoP"] == $codigoP) {
                unset($dados[$i]);
            }
        }

        $dadosModificados = array();
        foreach ($dados as $dado) {
            $dadosModificados[] = $dado;
        }

        $dadosModificados = json_encode($dadosModificados, JSON_PRETTY_PRINT);
        file_put_contents("json/carrinhos.json", $dadosModificados);
    }
}

