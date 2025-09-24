<header class="header">

     <a href="/" class="header__logo">Pastelix</a>

    <nav class="header__navegacion">
        <ul>
            <?php if(is_admin()){ ?>
                <li>
                    <a href="/admin" class="header__enlace">Administrar</a>
                </li>
            <?php } ?>
            <li class="<?php echo (rutaActual('/tienda')); ?>">
                <a href="/tienda" class="header__enlace">Comprar</a>
            </li>

            <?php 
            if(!is_auth()){ ?>
                <li class="<?php echo (rutaActual('/login')); ?>">
                    <a href="/login" class="header__enlace">Iniciar Sesión</a>
                </li>

                <li class="<?php echo (rutaActual('/registro')); ?>">
                    <a href="/registro" class="header__enlace">Registro</a>
                </li>

            <?php }else{ ?>
                <li class="<?php 
                    echo (rutaActual('/usuario') . rutaActual('/usuario/pedidos') . rutaActual('/usuario/direcciones') . rutaActual('/usuario/direcciones/editar')); ?>"
                >
                    <a href="/usuario" class="header__enlace"
                    >
                        Mi Cuenta
                    </a>
                </li>

                <form action="/logout" method="POST">
                    <input type="submit" class="header__submit" value="Cerrar Sesión">
                </form>

            <?php } ?>
                
                
        </ul>
        
    </nav>

</header>