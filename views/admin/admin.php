<main class="admin">

    <a href="/admin/dashboard" class="ganancia_hoy">
        <h3>Ganancias de hoy:</h3>
        <span>$<?php echo number_format($totalGanadoHoy, 2, '.', ''); ?></span>
    </a>
    
    <a href="/admin/pedidos" class="pedidos_hoy">
        <h3>Pedidos recibidos hoy:</h3>
        <span><?php echo $pedidosHoy; ?></span>
    </a>

    <div class="ultimos_pedidos">   
        <h3>Ultimos pedidos recibidos:</h3>
            
        <table class="tabla tabla--admin">
            <thead class="tabla__header">
                <tr class="tabla__fila tabla__fila--head tabla__fila--no-hover">
                    <th class="tabla__celda tabla__celda--head tabla__celda--no-hover">Nº Pedido</th>
                    <th class="tabla__celda tabla__celda--head tabla__celda--no-hover">Cliente/Invitado</th>
                    <th class="tabla__celda tabla__celda--head tabla__celda--no-hover">Estado</th>
                    <th class="tabla__celda tabla__celda--head tabla__celda--no-hover">Fecha</th>
                </tr>
            </thead>

            <tbody class="tabla__body">
                <?php foreach($ultimosPedidos as $pedido){ ?>
                   <tr 
                        onclick="window.location ='/admin/pedidos/pedido?id=<?php echo $pedido->id; ?>'"
                        tabindex="0" role="link"
                        onkeydown="if(event.key==='Enter'){window.location='/admin/pedidos/pedido?id=<?php echo $pedido->id; ?>';}"
                        class="tabla__fila"
                    >
                        <td class="tabla__celda"><?php echo $pedido->id; ?></td>
                        <td class="tabla__celda"><?php echo ($pedido->usuario_id == 1) ? 'Invitado' : 'Cliente'; ?></td>
                        <td class="tabla__celda"><?php echo ucfirst($pedido->estado); ?></td>
                        <td class="tabla__celda"><?php echo $pedido->fecha; ?></td>
                    </tr>
                <?php } ?>          
            </tbody>
        </table>
        
    </div>
    

</main>