<main class="pedido">
    <h1>Detalles del pedido</h1>
    
    <?php if($error == true) {?>
        <section class="pedido__error">
            <h2 class="pedido__subtitulo"><?php echo $mensajeError; ?></h2>
            <a href="/admin/pedidos" class="boton boton--admin">Volver a la lista</a>
        </section> 
    <?php } else {?>
    <a href="/admin/pedidos" class="boton boton--admin">Volver a la lista</a>
    
    <section class="pedido__datos pedido__datos--general">
        <p class="pedido__dato"><span>Nº pedido:</span> <?php echo $pedido->id; ?></p>
        <p class="pedido__dato"><span>Paypal ID:</span> <?php echo $pedido->pedido_id_paypal; ?></p>
        <p class="pedido__dato"><span>Fecha y hora:</span> <?php echo $pedido->fecha; ?></p>
        <p class="pedido__dato"><span>Total pagado:</span> $<?php echo $pedido->total; ?></p>
        <p class="pedido__dato"><span>Estado del pedido:</span> <?php echo ucfirst($pedido->estado); ?></p>
    </section>

  

    <section class="pedido__datos pedido__datos--cliente">
        <h2 class="pedido__subtitulo">Datos del cliente</h2>
        <p class="pedido__dato"><span>Nombre:</span> <?php echo $cliente->nombre ; ?></p>
        <p class="pedido__dato"><span>Apellido:</span> <?php echo $cliente->apellido; ?></p>
        <p class="pedido__dato"><span>Correo:</span> <?php echo $cliente->email; ?></p>
        <p class="pedido__dato"><span>Telefono:</span> <?php echo $cliente->telefono; ?></p>
    </section>

    <?php if($pedido->entrega == 'domicilio'){ ?>
        <section class="pedido__datos pedido__datos--direccion">
            <h2 class="pedido__subtitulo">Direccion del cliente</h2>
            <p class="pedido__dato"><span>Calle:</span> <?php echo $direccion->calle ; ?></p>
            <p class="pedido__dato"><span>Ciudad:</span> <?php echo $direccion->ciudad; ?></p>
            <p class="pedido__dato"><span>Provincia:</span> <?php echo $direccion->provincia; ?></p>
            <p class="pedido__dato"><span>Condigo Postal:</span> <?php echo $direccion->codigo_postal; ?></p>
            <p class="pedido__dato"><span>Pais:</span> <?php echo $direccion->pais_nombre; ?></p>
        </section>
    <?php } ?>
    
    <section class="pedido__datos pedido__datos--productos">
        <h2 class="pedido__subtitulo">Contenido del pedido</h2>
        <table class="tabla tabla--admin">
            <thead class="tabla__header">
                <tr class="tabla__fila tabla__fila--head tabla__fila--no-hover">
                    <th class="tabla__celda tabla__celda--head tabla__celda--no-hover">Imagen</th>
                    <th class="tabla__celda tabla__celda--head tabla__celda--no-hover">Nombre</th>
                    <th class="tabla__celda tabla__celda--head tabla__celda--no-hover">Precio</th>
                    <th class="tabla__celda tabla__celda--head tabla__celda--no-hover">Cantidad</th>
                    <th class="tabla__celda tabla__celda--head tabla__celda--no-hover">Subtotal</th>
                </tr>
            </thead>

            <tbody class="tabla__body">
                <?php foreach($productos as $producto){ ?>
                    <tr class="tabla__fila tabla__fila--no-hover">
                        <td class="tabla__celda">
                            <img src="/img/productos/<?php echo $producto['imagen']; ?>_thumb.webp" alt="Imagen Producto">
                        </td>

                        <td class="tabla__celda  tabla__celda--no-wrap" title="<?php echo $producto['nombre']; ?>">
                            <?php echo $producto['nombre']; ?>
                        </td>

                        <td class="tabla__celda">
                            <?php echo $producto['precio']; ?>
                        </td>

                        <td class="tabla__celda">
                            <?php echo $producto['cantidad']; ?>
                        </td>

                        <td class="tabla__celda">
                            <?php echo $producto['subtotal']; ?>
                        </td>
                    </tr>
                    
                <?php } ?>
            </tbody>
        </table>
        
    </section>

     <?php } ?>
</main>
