<main class="login">
    <h2 class="login__titulo titulo">Iniciar Sesión</h2>

    <?php include_once  __DIR__.'/../templates/alertas.php'; 
    
    if($reenviarConfirmacion == true){ ?>
        <form method="post" action="/reenviar-confirmacion" class="acciones acciones--centrar">
            <input type="hidden" name="email" value="<?php echo $usuario->email; ?>">
            <input type="submit" class="acciones__enlace acciones__enlace--reenviar" value="Reenviar confirmación">
        </form>
    <?php } ?>

    <form method="post" class="login__formulario formulario">

        <div class="formulario__campo">
            <label for="email" class="formulario__label">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Ingresa tu E-mail" class="formulario__input" value="<?php echo $usuario->email; ?>">
        </div>
        
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Ingresa tu Contraseña" class="formulario__input">
        </div>

        <div class="formulario__campo ">
            <label for="recuerdame" class="formulario__label formulario__label--recuerdame">
                <input type="checkbox" name="recuerdame" id="recuerdame" class="formulario__input formulario__input--radio" value="si">
                Mantener conectado
            </label>
        </div>
        <input type="submit" class="formulario__submit" value="Iniciar Sesión">
    </form>

    <div class="registro__acciones acciones">
        <a class="acciones__enlace" href="/registro">¿Aun no tienes cuenta? Registrate</a>
        <a class="acciones__enlace" href="/olvide">¿Olvidaste tu contraseña?</a>
    </div>
</main>
