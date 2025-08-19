<main class="admin">
    <h1>Admin</h1>

    <a href="/admin/dashboard" class="ganancia_hoy">
        <h3>Ganancias de hoy:</h3>
        <p>$<?php echo number_format($totalGanadoHoy, 2, '.', ''); ?></p>
    </a>
    
    <a href="/admin/pedidos" class="pedidos_hoy">
        <h3>Pedidos recibidos hoy:</h3>
        <p><?php echo $pedidosHoy; ?></p>
    </a>

    <div class="ultimos_pedidos">   
        <h3>Ultimos pedidos recibidos:</h3>
        <ul >
            <li class="ultimos_pedidos__cabecera">
                <span>Nº Pedido</span>
                <span>Cliente/Invitado</span>
                <span>Estado</span>
                <span>Fecha</span>
            </li>

             <?php foreach($ultimosPedidos as $pedido){ ?>
                    <a href="/admin/pedidos/pedido?id=<?php echo $pedido->id; ?>">
                        <li class="ultimos_pedidos__pedido">
                            <span><?php echo $pedido->id; ?></span>
                            <span><?php echo ($pedido->usuario_id == 1) ? 'Invitado' : 'Cliente'; ?></span>
                            <span><?php echo $pedido->estado; ?></span>
                            <span><?php echo $pedido->fecha; ?></span>
                        </li>
                    </a>
                    
                <?php } ?>
           
        </ul>
        
    </div>
    

</main>