
<main class="dashboard">
    <h1>Dashboard</h1>
    <form >
        <fieldset class="ventas">
            <div class="titulo">
                <legend>Ventas</legend>
                <select name="ventas_fecha" id="ventas_fecha">
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
                <button type="submit"><img src="" alt="Icono buscar"></button>
            </div>
            
            <a href="/admin/ventas">  
                    <div class="ventas__ganancia">
                        <h3>Ganancias totales</h3>
                        <span>$<?php echo number_format($gananciasTotales, 2, '.', ''); ?></span>
                    </div>

                    <div class="ventas__productos">
                        <h3>Productos vendidos</h3>
                        <span><?php echo $totalProductosVendidos; ?></span>
                    </div>           
            </a>
        </fieldset>

        <fieldset class="pedidos_recibidos">
            
            <div class="titulo">
                <legend>Pedidos</legend>
                <select name="pedidos_recibidos_fecha" id="pedidos_recibidos_fecha">
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
                <button type="submit"><img src="" alt="Icono buscar"></button>
            </div>
            
            <a href="/admin/pedidos">
            
                <div class="pedidos_recibidos__estado">
                    <ul>
                        <li>
                            <h3>Pagados</h3>
                            <span><?php echo $estadoPedidos['pagados']; ?></span>
                        </li>
                            
                        <li>
                            <h3>Enviados</h3>
                            <span><?php echo $estadoPedidos['enviados']; ?></span>
                        </li>
                            
                        <li>
                            <h3>Completados</h3>
                            <span><?php echo $estadoPedidos['completados']; ?></span>
                        </li>
                            
                        <li>
                            <h3>Cancelados</h3>
                            <span><?php echo $estadoPedidos['cancelados']; ?></span>
                        </li>
                    </ul>
                </div>

                <div class="pedidos_recibidos__usuario">
                    <ul>
                        <li>
                            <h3>Cliente</h3>
                            <span><?php echo $tipoUsuario['cliente']; ?></span>
                        </li>

                        <li>
                            <h3>Invitado</h3>
                            <span><?php echo $tipoUsuario['invitado']; ?></span>
                            </li>
                    </ul>            
                </div>

                <div class="pedidos_recibidos__entrega">
                    <ul>
                        <li>
                            <h3>Retiro en tienda</h3>
                            <span><?php echo $tipoEntrega['tienda'] ?? 0; ?></span>
                        </li>

                        <li>
                            <h3>Envio a domicilio</h3>
                            <span><?php echo $tipoEntrega['domicilio'] ?? 0; ?></span>
                            </li>
                    </ul>            
                </div>
            </a>
        </fieldset>

        <fieldset class="nuevos_usuarios">
            <div class="titulo">
                <legend>Nuevos usuarios registrados</legend>
                <select name="usuarios_fecha" id="usuarios_fecha">
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
                <button type="submit"><img src="" alt="Icono buscar"></button>
            </div>

            <a href="/admin/usuarios">
                <h3><?php echo $usuariosRegistrados; ?></h3>
            </a>
    
        </fieldset>
    </form>
</main>