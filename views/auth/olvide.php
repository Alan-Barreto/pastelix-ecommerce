<main class="olvide">
    <h2 class="olvide__titulo titulo">Ingresa tu correo para recuperar tu contraseña</h2>

    <?php include_once  __DIR__.'/../templates/alertas.php'; ?>

    <form method="post" class="formulario formulario__olvide">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Ingresa tu E-mail" class="formulario__input" value="<?php echo $usuario->email ?>">
        </div>
        <input type="submit" class="formulario__submit" value="Enviar Correo">
    </form>
</main>