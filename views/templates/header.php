<header class="header">
    <a href="/" class="header__logo">Pastelix</a>

    <nav class="header__navegacion">
        <ul>
            <li>
                <!-- Cambiar esto por una comprobacion que agregue la clase "actual" para marcar en que pagina se está -->
                <?php if($_SERVER['PATH_INFO'] !== '/tienda'){ ?>
                <a href="/tienda" class="header__enlace">Comprar</a>
                <?php } ?>
            </li>

            <?php 
            if(!is_auth()){ ?>
                <li>
                
                <a href="/login" class="header__enlace">Iniciar Sesión</a>
                </li>

                <li>
                
                <a href="/registro" class="header__enlace">Registro</a>
                </li>

            <?php }else{ ?>
                <?php if(is_admin()){ ?>
                    <li>
                    <a href="/admin" class="header__enlace">Administrar</a>
                    </li>
                <?php } ?>
                <li>
                
                <a href="/usuario" class="header__enlace">Mi Cuenta</a>
                </li>

                <form action="/logout" method="POST">
                    <input type="submit" class="header__submit" value="Cerrar Sesión">
                </form>

            <?php } ?>
            
            
        </ul>
       
    </nav>
</header>