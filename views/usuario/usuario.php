
        <?php
        include_once __DIR__ .'/../templates/navegacionUsuario.php';
        ?>
        <div class="datos__contenedor">
                
            <div class="usuario__datos">
                
                <p class="datos__nombre">
                    <span class="datos__tipo">Nombre:</span>
                    <span class="datos__dato"><?php echo $_SESSION['nombre']; ?></span>
                </p>
                <p class="datos__apellido">
                    <span class="datos__tipo">Apellido:</span>
                    <span class="datos__dato"><?php echo $_SESSION['apellido']; ?></span>
                </p>
                <p class="datos__email">
                    <span class="datos__tipo">E-mail:</span>
                    <span class="datos__dato"><?php echo $_SESSION['email']; ?></span>
                </p>
            </div>
            <div class="usuario__acciones">
                <button class="accion modificar">Modificar datos</button>
                <button class="accion correo">Modificar E-mail</button>
                <button class="accion contraseña">Cambiar contraseña</button>
            </div>
            <?php include_once  __DIR__.'/../templates/alertas.php'; ?>
            <div class="formulario__contenedor formulario--ocultar">
                <form method='post' class="formulario formulario__datos">
                    <div class="formulario__campo">
                        <label for="nombre" class="formulario__label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ingresa tu nombre" class="formulario__input" value="<?php echo $nuevosDatos['nombre']; ?>">
                    </div>

                    <div class="formulario__campo">
                        <label for="apellido" class="formulario__label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" placeholder="Ingresa tu apellido" class="formulario__input" value="<?php echo $nuevosDatos['apellido']; ?>">
                    </div>
                    <input type="submit" class="formulario__submit" value="Actualizar datos">
                </form>
                <button class="formulario__cerrar">X</button>
            </div>

            <div class="formulario__contenedor formulario--ocultar">
                <form method='post' class="formulario formulario__correo">
                    <div class="formulario__campo">
                        <label for="email" class="formulario__label">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="Ingresa tu E-mail" class="formulario__input" value="<?php echo $nuevosDatos['email']; ?>">
                    </div>
                    <input type="submit" class="formulario__submit" value="Actualizar E-mail">
                </form>
                <button class="formulario__cerrar">X</button>
            </div>

            <div class="formulario__contenedor formulario--ocultar">
                <form method='post' class="formulario formulario__contraseña">
                    <div class="formulario__campo">
                        <label for="contraseñaActual" class="formulario__label">Contraseña Actual</label>
                        <input type="password" name="contraseñaActual" id="contraseñaActual" placeholder="Ingresa tu Contraseña" class="formulario__input">
                    </div>

                    <div class="formulario__campo">
                        <label for="contraseñaNueva" class="formulario__label">Nueva Contraseña</label>
                        <input type="password" name="contraseñaNueva" id="contraseñaNueva" placeholder="Elige tu nueva Contraseña" class="formulario__input">
                    </div>
                    <input type="submit" class="formulario__submit" value="Cambiar contraseña">
                </form>
                <button class="formulario__cerrar">X</button>
            </div>
            
        </div>
     
    </div>
</main>