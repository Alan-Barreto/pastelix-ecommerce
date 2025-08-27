<main class="usuario">
    <h1>Usuario</h1>
    <div class="usuario__contenedor">

        <nav class="usuario__navegacion">
            <ul>
                <li class="usuario__enlace <?php echo (rutaActual('/usuario')) ?>">
                    <a href="/usuario">Mi Cuenta</a>
                </li>
                <li class="usuario__enlace <?php echo (rutaActual('/usuario/pedidos')) ?>">
                    <a href="/usuario/pedidos">Mis Pedidos</a>
                </li>
                <li class="usuario__enlace <?php echo (rutaActual('/usuario/direcciones')) . (rutaActual('/usuario/direcciones/editar'));  ?>">
                    <a href="/usuario/direcciones">Mis Direcciones</a>
                </li>
            </ul>
        </nav>