<main class="pedidos">
    <h2>Pedidos</h2>

    <table>
        <thead>
            <tr>
                <th>
                    <form action="">
                        <button 
                            type="submit" 
                            name="orden" 
                            value="<?php

                                echo (
                                    (($_GET['orden'] ?? 'numero_pedido-asc') !== 'numero_pedido-desc' ) 
                                    ? 'numero_pedido-desc' 
                                    : 'numero_pedido-asc' 
                                );
                            ?>"
                        >
                            Nº Pedido
                        </button>
                    </form>
                    
                </th>
                <th>
                    <form>   
                        <button
                            type="submit" 
                            name="orden" 
                            value="<?php 
                                echo (
                                    (($_GET['orden'] ?? 'cliente_invitado-asc') !== 'cliente_invitado-desc' ) 
                                    ? 'cliente_invitado-desc' 
                                    : 'cliente_invitado-asc' 
                                );
                            ?>"
                        >
                            Cliente/Invitado
                        </button>
                    </form>
                    
                </th>
                <th>
                    <form action="">
                        <button 
                            type="submit" 
                            name="orden" 
                            value="<?php 
                                echo (
                                    (($_GET['orden'] ?? 'entrega-asc') !== 'entrega-desc' ) 
                                    ? 'entrega-desc' 
                                    : 'entrega-asc' 
                                );
                            ?>"
                        >
                            Entrega
                        </button>
                    </form>
                    
                </th>
                <th>
                    <form action="">
                        <button 
                            type="submit" 
                            name="orden" 
                            value="<?php 
                                echo (
                                    (($_GET['orden'] ?? 'pagado-asc') !== 'pagado-desc' ) 
                                    ? 'pagado-desc' 
                                    : 'pagado-asc' 
                                );
                            ?>"
                        >
                            Pagado
                        </button>
                    </form>
                    
                </th>
                <th>
                    <form action="">
                        <button 
                            type="submit"
                            name="orden" 
                            value="<?php 
                                echo (
                                    (($_GET['orden'] ?? 'estado-asc') !== 'estado-desc' ) 
                                    ? 'estado-desc' 
                                    : 'estado-asc' 
                                );
                            ?>"
                        >
                            Estado
                        </button>
                    </form>
                   
                </th>
                <th>
                    <form action="">
                        <button 
                            type="submit" 
                            name="orden" 
                            value="<?php 
                                echo (
                                    (($_GET['orden'] ?? 'fecha-asc') !== 'fecha-desc' ) 
                                    ? 'fecha-desc' 
                                    : 'fecha-asc' 
                                );
                            ?>"
                        >
                            Fecha
                        </button>
                    </form>
                    
                </th>

                <th>
                    Acciones
                </th>
            </tr>
        </thead>

        <tbody> 
            <?php foreach($pedidos as $pedido){ ?>
                <tr>
                    <td>
                        <p><?php echo $pedido->id;?></p>
                    </td>

                    <td>
                        <p><?php echo (($pedido->usuario_id == 1) ? 'Invitado' : 'Cliente');?></p>
                    </td>

                    <td>
                        <p><?php echo $pedido->entrega;?></p>
                    </td>

                    <td>
                        <p><?php echo $pedido->total;?></p>
                    </td>

                    <td>
                        <p><?php echo $pedido->estado;?></p>
                    </td>

                    <td>
                        <p><?php echo $pedido->fecha;?></p>
                    </td>

                    <td>
                        <a href="/admin/pedidos/pedido?id=<?php echo $pedido->id; ?>">Ver Detalles</a>
                    </td>
                </tr>
            <?php } ?>                   
        </tbody>

    </table>

    <div class="tabla__paginador">
        <?php if($paginaActual > 1){ ?>
            <a 
                href="/admin/pedidos?pagina=<?php echo $paginaActual - 1; ?>&orden=<?php echo $_GET['orden'] ?? 'numero_pedido-desc'; ?>"
            >
                < Pagina Anterior
            </a>
        <?php } ?>
        <?php for($contadorPaginas = 1; $contadorPaginas <= $numeroPaginas; $contadorPaginas++) { 
           if ($contadorPaginas == $paginaActual) {?>
                <p><?php echo $contadorPaginas ?></p>
            <?php } else { ?>

                <a 
                   href="/admin/pedidos?pagina=<?php echo $contadorPaginas; ?>&orden=<?php echo $_GET['orden'] ?? 'numero_pedido-desc'; ?>"
                >
                    <?php echo $contadorPaginas ?>
                </a>
            <?php }
        } ?>
        <?php if($paginaActual < $numeroPaginas){ ?>
            <a 
                href="/admin/pedidos?pagina=<?php echo $paginaActual + 1; ?>&orden=<?php echo $_GET['orden'] ?? 'numero_pedido-desc'; ?>"
            >
                Pagina Siguiente >
            </a>
       <?php } ?>
    </div>
</main>