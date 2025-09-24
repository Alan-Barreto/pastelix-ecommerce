<main class="registro">
    <h2 class="registro__titulo titulo">Registrate</h2>

    <form method="post" class="registro__formulario formulario">
        
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                type="text" 
                name="nombre" 
                id="nombre" 
                placeholder="Ingresa tu nombre" 
                class="formulario__input  <?php echo isset($errores['nombre']) ? 'formulario__input--error' : ''; ?>" 
                value="<?php echo $usuario->nombre ?>"
            >
            <?php
                if(isset($errores['nombre'])){ ?>
                    <p class="mensaje__error"><?php echo $errores['nombre']; ?></p>
            <?php } ?>
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input 
                type="text" 
                name="apellido" 
                id="apellido" 
                placeholder="Ingresa tu apellido" 
                class="formulario__input <?php echo isset($errores['apellido']) ? 'formulario__input--error' : ''; ?>" 
                value="<?php echo $usuario->apellido ?>">
            
            <?php
                if(isset($errores['apellido'])){ ?>
                    <p class="mensaje__error"><?php echo $errores['apellido']; ?></p>
            <?php } ?>
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario__label">E-mail</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                placeholder="Ingresa tu E-mail" 
                class="formulario__input <?php echo isset($errores['email']) ? 'formulario__input--error' : ''; ?>" 
                value="<?php echo $usuario->email ?>">
            
            <?php
                if(isset($errores['email'])){ ?>
                    <p class="mensaje__error"><?php echo $errores['email']; ?></p>
            <?php } ?>
        </div>

        <div class="formulario__campo">
            <label for="telefono" class="formulario__label">Telefono</label>
            <input 
                type="tel" 
                name="telefono" 
                id="telefono" 
                placeholder="Ingresa tu E-mail" 
                class="formulario__input <?php echo isset($errores['telefono']) ? 'formulario__input--error' : ''; ?>" 
                value="<?php echo $usuario->telefono ?>">
            
            <?php
                if(isset($errores['telefono'])){ ?>
                    <p class="mensaje__error"><?php echo $errores['telefono']; ?></p>
            <?php } ?>
        </div>
        
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                placeholder="Elije tu Contraseña" 
                class="formulario__input <?php echo isset($errores['password']) ? 'formulario__input--error' : ''; ?>">
            
            <?php
                if(isset($errores['password'])){ ?>
                    <p class="mensaje__error"><?php echo $errores['password']; ?></p>
            <?php } ?>
        </div>

        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir Contraseña</label>
            <input 
                type="password" 
                name="password2" 
                id="password2" 
                placeholder="Repite tu Contraseña" 
                class="formulario__input <?php echo isset($errores['password2']) ? 'formulario__input--error' : ''; ?>">
            <?php
                if(isset($errores['password2'])){ ?>
                    <p class="mensaje__error"><?php echo $errores['password2']; ?></p>
            <?php } ?>
        </div>
        <input type="submit" class="formulario__submit" value="Registro">
    </form>

    <div class="registro__acciones acciones">
        <a class="acciones__enlace" href="/login">¿Ya tienes cuenta? Inicia sesión</a>
        <a class="acciones__enlace" href="/olvide">¿Olvidaste tu contraseña?</a>
    </div>
</main>