<?php
require_once "funcoes.php";
if (isset($_GET["codigo"])) {
    $codigo = $_GET["codigo"];
    $produto = buscarProduto($codigo);
}
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
</head>

<body>

    <?php
    include_once "inc/navbar.inc";
    ?>

    <main>

        <div class="container py-4 my-4 mx-auto d-flex flex-column">
            <div class="header">
                <div class="row r1">
                    <div class="col-md-9 abc">
                        <h1><?= $produto["produto"] ?></h1>
                    </div>
                    <div>
                        <h2>R$<?= number_format($produto["preco"], 2, ",", ".") ?></h2>
                    </div>
                </div>
            </div>
            <div class="container-body mt-4">
                <div class="row r3">
                    <div class="col-md-5 p-0 klo">
                        <ul>
                            <li><?= $produto["descricao"] ?></li>
                            <li>Não gostou do produto? Devolução Garantida</li>
                            <li>Pagamento: cartão ou boleto</li>
                            <li>Entrega normal : 7-14 dias</li>
                            <li>Entrega expressa : 3 dias</li>
                        </ul>
                    </div>
                    <div class="col-md-7"> <img src="<?= $produto['url'] ?>" width="90%" height="95%"> </div>
                </div>
            </div>
            <div class="footer d-flex flex-column mt-5">
                <div class="row r4">
                    <div class="col-md-2 mio offset-md-4">
                        <a class="btn btn-warning" href="add.php?codigo=<?=$produto['codigo']?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z" />
                            </svg>
                            Carrinho
                        </a>
                    </div>
                    <div class="col-md-2 myt "><a href="checkout.php?codigo=<?=$produto['codigo']?>" class="btn btn-outline-warning">Comprar Agora</a></div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <?php
        include_once "inc/footer.inc";
        ?>
    </main>
</body>

</html>