
<?php
    include_once __DIR__ .'/../templates/navegacionUsuario.php';
?>

        <div class="usuario__pedidos"> 
            <h2>Pedidos</h2>

            <?php 
                if(empty($listaPedidos)){ ?>
                    <p>Los pedidos que hagas se guardaran aqui</p>        
            <?php }else{ ?>
                    <table class="tabla tabla__pedidos">
                        <thead class="tabla__header">
                            <tr class="tabla__fila tabla__fila--head">
                                <th class="tabla__celda tabla__celda--head">Nº Pedido</th>
                                <th class="tabla__celda tabla__celda--head">Fecha</th>
                                <th class="tabla__celda tabla__celda--head">Entrega</th>
                                <th class="tabla__celda tabla__celda--head">Pagado</th>
                                <th class="tabla__celda tabla__celda--head">Acciones</th>
                            </tr>
                        </thead>
                       
                        <tbody class="tabla__body">
                            <?php foreach($listaPedidos as $pedido){ ?>
                                <tr class="tabla__fila">
                                    <td class="tabla__celda"><?php echo $pedido->id; ?></td>
                                    <td class="tabla__celda"><?php echo date("Y-m-d", strtotime($pedido->fecha)); ?></td>
                                    <td class="tabla__celda"><?php echo ucfirst($pedido->entrega); ?></td>
                                    <td class="tabla__celda"><?php echo $pedido->total; ?></td>
                                    <td class="tabla__celda"> <button class="boton boton--pequeño boton-detalles" data-id="<?php echo $pedido->id;?>">Detalles</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                       
                    </table>
            <?php } ?>
        </div>
    </div>
</main>