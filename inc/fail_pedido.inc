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
    require_once "funcoes.php";
    ?>

    <div class="container">

        <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalChoice">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-3 shadow">
                    <div class="modal-body p-4 text-center">
                        <h5 class="mb-0">Houve um problema na geração do pedido!</h5>
                    </div>
                    <div class="modal-footer flex-nowrap p-0">
                        <button type="button" id="button_fail_ok" class="btn btn-lg btn-link fs-6 text-decoration-none col-12 py-3 m-0 rounded-0 border-end"><strong>Ok</strong></button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script>
            function okFailRedirect() {
                window.location = "carrinho.php";
            }

            const button_fail_ok = document.getElementById("button_fail_ok");
            if (button_fail_ok != null) {
                button_fail_ok.addEventListener("click", okFailRedirect);
            }
        </script>
    </div>
    </main>

    <?php
    include_once "inc/footer.inc";
    ?>
</body>

</html>