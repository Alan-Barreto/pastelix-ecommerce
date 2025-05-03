<main class="recuperar">
    <h2 class="recuperar__titulo titulo">Ingresa tu nueva contraseña</h2>

    <?php include_once  __DIR__.'/../templates/alertas.php';
    
    if($tokenValido){ ?>
        <form method="post" class="formulario formulario__recuperar">
            <div class="formulario__campo">
                <label for="password" class="formulario__label">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Elije tu Nueva Contraseña" class="formulario__input">
            </div>

            <div class="formulario__campo">
                <label for="password2" class="formulario__label">Repetir Contraseña</label>
                <input type="password" name="password2" id="password2" placeholder="Repite tu Nueva Contraseña" class="formulario__input">
            </div>
            <input type="submit" class="formulario__submit" value="Cambiar contraseña">
        </form>
    <?php } 
    if($iniciarSesion){ ?>
        <div class="inicio__elemento">  
            <a href="/login" class="inicio__boton boton">Iniciar sesion</a>
        </div>
    <?php } ?>
    
</main>