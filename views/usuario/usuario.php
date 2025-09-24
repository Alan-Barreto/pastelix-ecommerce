
        <?php
        include_once __DIR__ .'/../templates/navegacionUsuario.php';
        ?>
        <div class="datos__contenedor">
                
            <div class="usuario__datos">
                
                <p class="usuario__nombre">
                    <b>Nombre: </b>
                    <?php echo $_SESSION['nombre']; ?>
                </p>
                <p class="usuario__apellido">
                    <b>Apellido: </b>
                    <?php echo $_SESSION['apellido']; ?>
                </p>
                <p class="usuario__email">
                    <b>E-mail: </b>
                    <?php echo $_SESSION['email']; ?>
                </p>

                <p class="usuario__telefono">
                    <b>Telefono: </b>
                    <?php echo $_SESSION['telefono']; ?>
                </p>
            </div>
            <div class="usuario__acciones">
                <button class="usuario__accion modificar boton boton--pequeño">Modificar datos</button>
                <button class="usuario__accion correo boton boton--pequeño">Modificar E-mail</button>
                <button class="usuario__accion contraseña boton boton--pequeño">Cambiar contraseña</button>
            </div>
            
        </div>
     
    </div>
</main>