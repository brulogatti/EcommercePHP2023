<?php
    session_start();
    require_once "funcoes.php";
    $produtos = buscarCarrinho(session_id());
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
    $tamanho = sizeof($produtos);
    $soma = 0;
    ?>

    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row w-100">
                <div class="col-lg-12 col-md-12 col-12">
                    <h3 class="display-5 mb-2 text-center">Carrinho</h3>
                    <p class="mb-5 text-center">
                        <i class="text-warning font-weight-bold"><?=$tamanho?></i> produto(s) no seu carrinho
                    </p>
                    <table id="shoppingCart" class="table table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th style="width:60%">Produto</th>
                                <th style="width:12%">Preço</th>
                                <th style="width:10%">Quantidade</th>
                                <th style="width:16%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($produtos as $produto) {
                                $qtditem=buscarQtd(session_id(),$produto["codigo"]);
                            ?>
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-md-3 text-left">
                                            <img src="<?=$produto['url']?>" alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow">
                                        </div>
                                        <div class="col-md-9 text-left mt-sm-2">
                                            <h4><?=$produto["produto"]?></h4>
                                            <p class="font-weight-light"><?=$produto["descricao"]?></p>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">R$<?=number_format($produto['preco'],2,",",".")?></td>
                                <td data-th="Quantity">
                                    <input type="number" class="form-control form-control-lg text-center" min="0" value=<?=$qtditem?> disabled>
                                </td>
                                <td class="actions" data-th="">
                                    <div class="text-right">
                                        <a href="delete.php?codigo=<?=$produto['codigo']?>" class="btn btn-white border-secondary bg-white btn-md mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $soma += $produto["preco"]*$qtditem;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="float-right text-right">
                        <h4>Subtotal:</h4>
                        <h1>R$<?=number_format($soma,2,",",".")?></h1>
                    </div>
                </div>
            </div>
            <div class="row mt-4 d-flex align-items-center">
                <div class="col-sm-6 order-md-2 text-right">
                    <a href="checkout.php" class="btn btn-warning mb-4 btn-lg pl-5 pr-5">Checkout</a>
                </div>
            </div>
        </div>
    </section>


    <?php
    include_once "inc/footer.inc";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </main>
</body>

</html>