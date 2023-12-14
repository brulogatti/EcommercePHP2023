<form method="post">

<div class="py-5 text-center">
  <img class="d-block mx-auto mb-4" src="./img/site/logo_sf.png" alt="" width="80" height="80">
  <h2>Administrador</h2>
  <p class="lead">Cadastro exclusivo para administradores do site. Deve ser aceito por outros administradores.</p>
</div>

<div class="row g-3">
  <div class="col-sm-6">
    <label for="firstName" class="form-label">Nome</label>
    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="José" value="" required>
  </div>

  <div class="col-sm-6">
    <label for="lastName" class="form-label">Sobrenome</label>
    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="da Silva" value="" required>
  </div>

  <div class="col-12">
    <label for="username" class="form-label">Nome de Usuário</label>
    <div class="input-group has-validation">
      <span class="input-group-text">@</span>
      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
    </div>
  </div>

  <div class="col-12">
    <label for="username" class="form-label">Senha</label>
    <div class="input-group has-validation">
      <input type="password" class="form-control" name="password" id="password" placeholder="aAbBcC123@" required>
    </div>
    <div class="alert alert-danger" role="alert" id="error-senha" hidden>
    </div>
  </div>

  <div class="col-12">
    <label for="username" class="form-label">Senha</label>
    <div class="input-group has-validation">
      <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="aAbBcC123@" required>
    </div>
    <div class="alert alert-danger" role="alert" id="error-confirmsenha" hidden>
    </div>
  </div>

  <div class="col-12">
    <label for="username" class="form-label">CPF</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control" name="cpf" id="cpf" placeholder="555.444.777-33" required>
    </div>
    <div class="alert alert-danger" role="alert" id="error-cpf" hidden>
    </div>
  </div>

  <div class="col-12">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
  </div>
  <div class="alert alert-danger" role="alert" id="error-email" hidden>
  </div>

  <hr class="my-4">

  <input class="w-100 btn btn-warning btn-lg" id="enviar" type="submit" value="Registrar">
</form>