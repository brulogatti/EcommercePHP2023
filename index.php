<?php
require_once "funcoes.php";
$produtos = listarProdutos();
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Comprai&copy;</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <?php
  include_once "inc/navbar.inc";
  ?>

  <!--Product-->
  <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary" style="background-image: url('img/site/capa.jpg'); background-size: cover;">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
      <h1 class="display-3 fw-bold">Vem comprar com a gente!</h1>
      <h3 class="fw-normal text-muted mb-3">Compre em Conjunto, Economize Sempre. Comprai, a Sua Comunidade de Compras</h3>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
  </div>


  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <?php
        foreach ($produtos as $produto) {
        ?>
          <!--Carrossel-->
          <div class="col">
            <div class="card shadow-sm">
              <a href="produto.php?codigo=<?= $produto['codigo'] ?>">
                <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="<?= $produto['url'] ?>" alt="" role="img" title="<?= $produto['produto'] ?>" preserveAspectRatio="xMidYMid slice" focusable="false">
                <!--<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
            </svg>-->
              </a>
              <div class="card-body">
                <p class="card-text"><?= $produto["descricao"] ?></p>
                <p class="card-text" style="color:red;">R$<?= number_format($produto["preco"], 2, ",", ".") ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="produto.php?codigo=<?= $produto['codigo'] ?>" class="btn btn-sm btn-warning">Detalhes</a>
                    <a href="add.php?codigo=<?= $produto['codigo'] ?>" class="btn btn-sm btn-outline-warning">Adicionar</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>

      </div>
    </div>
  </div>

  <?php
  include_once "inc/footer.inc";
  ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </main>
</body>

</html>