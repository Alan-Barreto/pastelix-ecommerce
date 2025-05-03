<main class="registro">
    <h2 class="registro__titulo titulo">Registrate</h2>

    <?php include_once  __DIR__.'/../templates/alertas.php'; ?>

    <form method="post" class="registro__formulario formulario">
        
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Ingresa tu nombre" class="formulario__input" value="<?php echo $usuario->nombre ?>">
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Ingresa tu apellido" class="formulario__input" value="<?php echo $usuario->apellido ?>">
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario__label">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Ingresa tu E-mail" class="formulario__input" value="<?php echo $usuario->email ?>">
        </div>
        
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Elije tu Contraseña" class="formulario__input">
        </div>

        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir Contraseña</label>
            <input type="password" name="password2" id="password2" placeholder="Repite tu Contraseña" class="formulario__input">
        </div>
        <input type="submit" class="formulario__submit" value="Registro">
    </form>

    <div class="registro__acciones acciones">
        <a class="acciones__enlace" href="/login">¿Ya tienes cuenta? Inicia sesión</a>
        <a class="acciones__enlace" href="/olvide">¿Olvidaste tu contraseña?</a>
    </div>
</main>