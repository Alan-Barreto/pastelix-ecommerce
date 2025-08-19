
<?php
    include_once __DIR__ .'/../templates/navegacionUsuario.php';
?>
        <h1>Pedidos</h1>

        <div class="usuario__pedidos"> 
            <?php 
                if(empty($listaPedidos)){ ?>
                    <p>Los pedidos que hagas se guardaran aqui</p>        
            <?php }else{ ?>
                    <table class="tabla__pedidos">
                        <thead>
                            <tr>
                                <th>Nº Pedido</th>
                                <th>Fecha</th>
                                <th>Entrega</th>
                                <th>Pagado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <?php foreach($listaPedidos as $pedido){ ?>
                                <tr>
                                    <td><?php echo $pedido->id; ?></td>
                                    <td><?php echo $pedido->fecha; ?></td>
                                    <td><?php echo $pedido->entrega; ?></td>
                                    <td><?php echo $pedido->total; ?></td>
                                    <td> <button class="boton boton-detalles" data-id="<?php echo $pedido->id;?>">Mostrar Detalles</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                       
                    </table>
            <?php } ?>
        </div>
    </div>
</main>