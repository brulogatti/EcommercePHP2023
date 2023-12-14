<?php
require_once "funcoes.php";
$produtos = buscarCarrinho(session_id());
$usuario = buscarUsuario($_SESSION["codigo"]);
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comprai&copy;</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <!-- Inclua a biblioteca jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Inclua a jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body>

    <?php
    include_once "inc/navbar.inc";
    if(sizeof($produtos)>0){
    ?>

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="img/site/logo_sf.png" alt="" width="72" height="72">
            <h2>Checkout</h2>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Seu carrinho</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    $soma = 0;
                    foreach ($produtos as $produto) {
                        $qtdProduto = buscarQtd(session_id(), $produto["codigo"]);
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?= $qtdProduto ?> x <?= $produto["produto"] ?></h6>
                                <small class="text-muted"><?= $produto["descricao"] ?></small>
                            </div>
                            <span class="text-muted">R$<?= number_format($produto["preco"], 2, ",", ".") ?></span>
                        </li>
                    <?php
                        $soma += $produto["preco"] * $qtdProduto;
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (R$)</span>
                        <strong>R$<?= number_format($soma, 2, ",", ".") ?></strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Endereço de Entrega</h4>
                <form action="pedido.php" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Nome</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="<?= $usuario['nome'] ?>" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="<?= $usuario['sobrenome'] ?>" disabled>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $usuario['login'] ?>" disabled>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $usuario['email'] ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="address">Endereço</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= $usuario['endereco'] ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Complemento <span class="text-muted">(Opcional)</span></label>
                        <input type="text" class="form-control" id="address2" name="address2" value="<?= $usuario['complemento'] ?>" disabled>
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Cidade</label>
                            <input type="text" class="form-control" name="city" id="city" value="<?= $usuario['cidade'] ?>" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">Estado</label>
                            <input type="text" class="form-control" name="state" id="state" value="<?= $usuario['estado'] ?>" disabled>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" placeholder="" value="<?= $usuario['CEP'] ?>" disabled>
                        </div>
                    </div>
                    <hr class="mb-4">

                    <h4 class="mb-3">Pagamento</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" value="0" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="credit">Cartão de Crédito</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" value="1" class="custom-control-input" required>
                            <label class="custom-control-label" for="debit">Cartão de Débito</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" value="2" class="custom-control-input" required>
                            <label class="custom-control-label" for="paypal">Mercado Pago</label>
                        </div>
                    </div>
                    <div class="row" id="creditCardFields">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Nome</label>
                                <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="" >
                                <small class="text-muted">Nome Completo</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Número do Cartão</label>
                                <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="">
                                <small id="error-number" class="text-muted"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Validade</label>
                                <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="">
                                <small id="error-expiration" class="text-muted"></small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="">
                                <small id="error-cvv" class="text-muted"></small>
                            </div>
                        </div>
                    </div>
                    <div id="paypalFields" hidden>
                        <!-- Logotipo do Mercado Pago -->
                        <img src="img/site/MercadoPago.jpg" alt="Logo Mercado Pago" width=200px>
                        <label>Finalize seu pedido no site do Mercado Pago (opção de gerar boleto).</label>
                    </div>
                    <hr class="mb-4">
                    <input class="btn btn-warning btn-lg btn-block" id="finalizar" type="submit" value="Finalizar Pedido" disabled>
                </form>
            </div>
        </div>
    </div>
    <?php
    }else{
    ?>
        <div class="container">
        <div class="py-5 text-center">
            Adicione produtos ao seu carrinho!
        </div>
        </div>
    <?php
    }
    ?>



    <?php
    include_once "inc/footer.inc";
    ?>
    <script src="js/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </main>
</body>

</html>