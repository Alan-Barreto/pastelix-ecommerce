
<main class="dashboard">
    <h1>Dashboard</h1>
    <form class="resumen">
        <fieldset class="resumen__section resumen__section--ventas">
            <div class="resumen__header">
                <legend class="resumen__titulo">Ventas</legend>

                <div class="filtro">
                    <select name="ventas_fecha" id="ventas_fecha" class="filtro__select">
                        <option 
                            value="hoy" 
                            <?php echo (isset($_GET['ventas_fecha']) && $_GET['ventas_fecha'] == 'hoy' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Hoy
                        </option>
                        <option 
                            value="ultima_semana" 
                            <?php echo (isset($_GET['ventas_fecha']) && $_GET['ventas_fecha'] == 'ultima_semana' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Ultima semana
                        </option> 

                        <option 
                            value="ultimo_mes" 
                            <?php echo (isset($_GET['ventas_fecha']) && $_GET['ventas_fecha'] == 'ultimo_mes' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Ultimo mes
                        </option>

                        <option 
                            value="ultimos_tres_meses" 
                            <?php echo (isset($_GET['ventas_fecha']) && $_GET['ventas_fecha'] == 'ultimos_tres_meses' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Ultimo trimestre
                        </option>

                        <option 
                            value="all" 
                            <?php echo (isset($_GET['ventas_fecha']) && $_GET['ventas_fecha'] == 'all' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                        Todo
                        </option>
                    </select>
                    <button type="submit" class="filtro__boton">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </div>
                
            </div>
            
            <a href="/admin/ventas" class="resumen__enlace">  
                <ul class="resumen__lista resumen__lista--ganancias">
                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Ganancias totales</h3>
                        <span class="resumen__datos-valor">$<?php echo number_format($gananciasTotales, 2, '.', ''); ?></span>
                    </li>

                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Productos vendidos</h3>
                        <span class="resumen__datos-valor"><?php echo $totalProductosVendidos; ?></span>
                    </li>
                </ul>         
            </a>
        </fieldset>

        <fieldset class="resumen__section resumen__section--recibidos">
            
            <div class="resumen__header">
                <legend class="resumen__titulo">Pedidos</legend>

                <div class="filtro">
                    <select name="pedidos_recibidos_fecha" id="pedidos_recibidos_fecha" class="filtro__select">
                        <option 
                            value="hoy" 
                            <?php echo (isset($_GET['pedidos_recibidos_fecha']) && $_GET['pedidos_recibidos_fecha'] == 'hoy' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Hoy
                        </option>
                        <option 
                            value="ultima_semana" 
                            <?php echo (isset($_GET['pedidos_recibidos_fecha']) && $_GET['pedidos_recibidos_fecha'] == 'ultima_semana' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Ultima semana
                        </option> 

                        <option 
                            value="ultimo_mes" 
                            <?php echo (isset($_GET['pedidos_recibidos_fecha']) && $_GET['pedidos_recibidos_fecha'] == 'ultimo_mes' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Ultimo mes
                        </option>

                        <option 
                            value="ultimos_tres_meses" 
                            <?php echo (isset($_GET['pedidos_recibidos_fecha']) && $_GET['pedidos_recibidos_fecha'] == 'ultimos_tres_meses' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Ultimo trimestre
                        </option>

                        <option 
                            value="all" 
                            <?php echo (isset($_GET['pedidos_recibidos_fecha']) && $_GET['pedidos_recibidos_fecha'] == 'all' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                        Todo
                        </option>
                    </select>
                    <button type="submit" class="filtro__boton">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                    </button>
                </div>
                
            </div>
            
            <a href="/admin/pedidos" class="resumen__enlace">

                <ul class="resumen__lista resumen__lista--estados">
                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Pagados</h3>
                        <span class="resumen__datos-valor"><?php echo $estadoPedidos['pagados']; ?></span>
                    </li>
                            
                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Enviados</h3>
                        <span class="resumen__datos-valor"><?php echo $estadoPedidos['enviados']; ?></span>
                       </li>
                            
                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Completados</h3>
                         <span class="resumen__datos-valor"><?php echo $estadoPedidos['completados']; ?></span>
                    </li>
                            
                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Cancelados</h3>
                        <span class="resumen__datos-valor"><?php echo $estadoPedidos['cancelados']; ?></span>
                    </li>
                </ul>
        
                <ul class="resumen__lista resumen__lista--usuarios">
                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Cliente</h3>
                        <span class="resumen__datos-valor"><?php echo $tipoUsuario['cliente']; ?></span>
                    </li>

                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Invitado</h3>
                        <span class="resumen__datos-valor"><?php echo $tipoUsuario['invitado']; ?></span>
                        </li>
                </ul>            

                <ul class="resumen__lista resumen__lista--entregas">
                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Retiro en tienda</h3>
                        <span class="resumen__datos-valor"><?php echo $tipoEntrega['tienda'] ?? 0; ?></span>
                    </li>

                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Envio a domicilio</h3>
                        <span class="resumen__datos-valor"><?php echo $tipoEntrega['domicilio'] ?? 0; ?></span>
                        </li>
                </ul>            
            </a>
        </fieldset>

        <fieldset class="resumen__section resumen__section--registros">
            <div class="resumen__header">
                <legend class="resumen__titulo">Nuevos Usuarios</legend>
                <div class="filtro">
                    <select name="usuarios_fecha" id="usuarios_fecha" class="filtro__select">
                        <option 
                            value="hoy" 
                            <?php echo (isset($_GET['usuarios_fecha']) && $_GET['usuarios_fecha'] == 'hoy' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Hoy
                        </option>
                        <option 
                            value="ultima_semana" 
                            <?php echo (isset($_GET['usuarios_fecha']) && $_GET['usuarios_fecha'] == 'ultima_semana' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Ultima semana
                        </option> 

                        <option 
                            value="ultimo_mes" 
                            <?php echo (isset($_GET['usuarios_fecha']) && $_GET['usuarios_fecha'] == 'ultimo_mes' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Ultimo mes
                        </option>

                        <option 
                            value="ultimos_tres_meses" 
                            <?php echo (isset($_GET['usuarios_fecha']) && $_GET['usuarios_fecha'] == 'ultimos_tres_meses' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                            Ultimo trimestre
                        </option>

                        <option 
                            value="all" 
                            <?php echo (isset($_GET['usuarios_fecha']) && $_GET['usuarios_fecha'] == 'all' ) 
                                ? 'selected' 
                                : '' ?>
                        >
                        Todo
                        </option>
                    </select>
                    <button type="submit" class="filtro__boton">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                    </button>
                </div>   
            </div>

            <a href="/admin/usuarios" class="resumen__enlace">

                <ul class="resumen__lista resumen__lista--usuarios">
                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Confirmado</h3>
                        <span class="resumen__datos-valor"><?php echo $totalUsuariosRegistrados['usuarios_confirmados'] ?? 0; ?></span>
                    </li>

                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Sin Confirmar</h3>
                        <span class="resumen__datos-valor"><?php echo $totalUsuariosRegistrados['usuarios_no_confirmados'] ?? 0; ?></span>
                    </li>

                    <li class="resumen__datos">
                        <h3 class="resumen__datos-titulo">Total</h3>
                        <span class="resumen__datos-valor"><?php echo $totalUsuariosRegistrados['total_usuarios'] ?? 0; ?></span>
                    </li>
                </ul> 

            </a>
    
        </fieldset>
    </form>
</main>