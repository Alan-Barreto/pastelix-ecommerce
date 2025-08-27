<main class="pedidos">
    <h1>Pedidos</h1>

    <table class="tabla tabla--admin">
        <thead class="tabla__header">
            <tr class="tabla__fila tabla__fila--head">
                <th class="tabla__celda tabla__celda--head">
                    <a 
                        href="/admin/pedidos?orden=<?php
                            echo (
                                (($_GET['orden'] ?? 'numero_pedido-asc') !== 'numero_pedido-desc' ) 
                                ? 'numero_pedido-desc' 
                                : 'numero_pedido-asc' 
                            );
                        ?>"
                    >
                        Nº Pedido
                    </a>           
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a 
                        href="/admin/pedidos?orden=<?php 
                            echo (
                                (($_GET['orden'] ?? 'cliente_invitado-asc') !== 'cliente_invitado-desc' ) 
                                ? 'cliente_invitado-desc' 
                                : 'cliente_invitado-asc' 
                            );
                        ?>"
                    >
                        Cliente/Invitado
                    </a>                   
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a 
                        href="/admin/pedidos?orden=<?php 
                            echo (
                                (($_GET['orden'] ?? 'entrega-asc') !== 'entrega-desc' ) 
                                ? 'entrega-desc' 
                                : 'entrega-asc' 
                            );
                        ?>"
                    >
                        Entrega
                    </a>  
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a 
                        href="/admin/pedidos?orden=<?php 
                            echo (
                                (($_GET['orden'] ?? 'pagado-asc') !== 'pagado-desc' ) 
                                ? 'pagado-desc' 
                                : 'pagado-asc' 
                            );
                        ?>"
                    >
                        Pagado
                    </a>                
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a 
                        href="/admin/pedidos?orden=<?php 
                            echo (
                                (($_GET['orden'] ?? 'estado-asc') !== 'estado-desc' ) 
                                ? 'estado-desc' 
                                : 'estado-asc' 
                            );
                        ?>"
                    >
                        Estado
                    </a> 
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a 
                        href="/admin/pedidos?orden=<?php 
                            echo (
                                (($_GET['orden'] ?? 'fecha-asc') !== 'fecha-desc' ) 
                                ? 'fecha-desc' 
                                : 'fecha-asc' 
                            );
                        ?>"
                    >
                        Fecha
                    </a> 
                </th>
            </tr>
        </thead>

        <tbody class="tabla__body"> 
            <?php foreach($pedidos as $pedido){ ?>
                <tr 
                    onclick="window.location ='/admin/pedidos/pedido?id=<?php echo $pedido->id; ?>'"
                    tabindex="0" role="link"
                    onkeydown="if(event.key==='Enter'){window.location='/admin/pedidos/pedido?id=<?php echo $pedido->id; ?>';}"
                    class="tabla__fila"
                >
                    <td class="tabla__celda">
                        <?php echo $pedido->id;?>
                    </td>

                    <td class="tabla__celda">
                        <?php echo (($pedido->usuario_id == 1) ? 'Invitado' : 'Cliente');?>
                    </td>

                    <td class="tabla__celda">
                        <?php echo ucfirst($pedido->entrega);?>
                    </td>

                    <td class="tabla__celda">
                        <?php echo $pedido->total;?>
                    </td>

                    <td class="tabla__celda">
                        <?php echo ucfirst($pedido->estado);?>
                    </td>

                    <td class="tabla__celda">
                        <?php echo $pedido->fecha;?>
                    </td>
                </tr>
            <?php } ?>                   
        </tbody>

    </table>

    <div class="paginacion paginacion--admin">
        <?php if($paginaActual > 1){ ?>
            <a 
                href="/admin/pedidos?pagina=<?php echo $paginaActual - 1; ?>&orden=<?php echo $_GET['orden'] ?? 'numero_pedido-desc'; ?>"
            >
                < Pagina Anterior
            </a>
        <?php } ?>
        <?php for($contadorPaginas = 1; $contadorPaginas <= $numeroPaginas; $contadorPaginas++) { 
           if ($contadorPaginas == $paginaActual) {?>
                <span><?php echo $contadorPaginas ?></span>
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