<form method="post">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="./img/site/logo_sf.png" alt="" width="80" height="80">
        <h2>Registre-se</h2>
        <p class="lead"> Garanta os melhores preços na Comprai!</p>
    </div>

    <div class="row g-3">
        <div class="col-sm-6">
            <label for="firstName" class="form-label">Nome</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="José" value="" required>
        </div>

        <div class="col-sm-6">
            <label for="lastName" class="form-label">Sobrenome</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="da Silva" value="" required>
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
                <input type="password" class="form-control" id="password" name="password" placeholder="aAbBcC123@" required>
            </div>
            <div class="alert alert-danger" role="alert" id="error-senha" hidden>
            </div>
        </div>

        <div class="col-12">
            <label for="username" class="form-label">Confirmar Senha</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="aAbBcC123@" required>
            </div>
            <div class="alert alert-danger" role="alert" id="error-confirmsenha" hidden>
            </div>
        </div>

        <div class="col-12">
            <label for="username" class="form-label">CPF</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="555.444.777-33" required>
            </div>
            <div class="alert alert-danger" role="alert" id="error-cpf" hidden>
            </div>
        </div>

        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
        </div>
        <div class="alert alert-danger" role="alert" id="error-email" hidden>
        </div>

        <div class="col-12">
            <label for="address" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Rua das Flores, 245, Vila Florida" required>
        </div>

        <div class="col-12">
            <label for="address2" class="form-label">Complemento <span class="text-body-secondary">(Opcional)</span></label>
            <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartamento 101, bloco C">
        </div>

        <div class="col-md-5">
            <label for="country" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="São Paulo" required>
        </div>

        <div class="col-md-4">
            <label for="state" class="form-label">Estado</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="São Paulo" required>
        </div>

        <div class="col-md-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="25652-140" required>
        </div>
        <div class="alert alert-danger" role="alert" id="error-cep" hidden>
        </div>
    </div>

    <hr class="my-4">

    <input class="w-100 btn btn-warning btn-lg" type="submit" value="Registrar" id="enviar" name="enviar">
</form>