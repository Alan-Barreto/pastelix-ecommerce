<main class="usuario">
    <h1>Mi Cuenta</h1>
    <div class="usuario__contenedor">

        <nav class="usuario__navegacion">
            <ul>
                <li >
                    <a href="/usuario" class="usuario__enlace <?php echo (rutaActual('/usuario')) ?>">Mis Datos</a>
                </li>
                <li >
                    <a href="/usuario/pedidos" class="usuario__enlace <?php echo (rutaActual('/usuario/pedidos')) ?>">Mis Pedidos</a>
                </li>
                <li >
                    <a 
                        href="/usuario/direcciones" 
                        class="usuario__enlace <?php 
                            echo (rutaActual('/usuario/direcciones')) . 
                            (rutaActual('/usuario/direcciones/editar')) . 
                            (rutaActual('/usuario/direcciones/crear'));  
                        ?>"
                    >
                        Mis Direcciones
                    </a>
                </li>
            </ul>
        </nav>