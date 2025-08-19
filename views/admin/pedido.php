<main class="pedido">
    <h1>Detalles del pedido</h1>
    
    <?php if($error == true) {?>
        <div class="pedido__error">
            <p><?php echo $mensajeError; ?></p>
            <a href="/admin/pedidos">Volver a la lista</a>
        </div> 
    <?php } else {?>

    <div class="datos__general">
        <p>Nº pedido: <?php echo $pedido->id; ?></p>
        <p>Paypal ID: <?php echo $pedido->pedido_id_paypal; ?></p>
        <p>Fecha y hora: <?php echo $pedido->fecha; ?></p>
        <p>Total pagado: $<?php echo $pedido->total; ?></p>
        <p>Estado del pedido: <?php echo $pedido->estado; ?></p>
    </div>

    <div class="datos__productos">
        <p>Contenido del pedido</p>
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($productos as $producto){ ?>
                    <tr>
                        <td>
                            <img src="/img/productos/<?php echo $producto['imagen']; ?>_thumb.webp" alt="">
                        </td>

                        <td>
                            <p><?php echo $producto['nombre']; ?></p>
                        </td>

                        <td>
                            <p><?php echo $producto['precio']; ?></p>
                        </td>

                        <td>
                            <p><?php echo $producto['cantidad']; ?></p>
                        </td>

                        <td>
                            <p><?php echo $producto['subtotal']; ?></p>
                        </td>
                    </tr>
                    
                <?php } ?>
            </tbody>
        </table>
        
    </div>

    <div class="datos__cliente">
        <p>Datos del cliente</p>
        <p>Nombre: <?php echo $cliente->nombre ; ?></p>
        <p>Apellido: <?php echo $cliente->apellido; ?></p>
        <p>Correo: <?php echo $cliente->email; ?></p>
        <p>Telefono: <?php echo $cliente->telefono; ?></p>
    </div>

    <?php if($pedido->entrega == 'domicilio'){ ?>
        <div class="datos__direccion">
            <p>Direccion del cliente</p>
            <p>Calle: <?php echo $direccion->calle ; ?></p>
            <p>Ciudad: <?php echo $direccion->ciudad; ?></p>
            <p>Provincia: <?php echo $direccion->provincia; ?></p>
            <p>Condigo Postal: <?php echo $direccion->codigo_postal; ?></p>
            <p>Pais: <?php echo $direccion->pais_nombre; ?></p>
        </div>
    <?php } ?>
    
    

     <?php } ?>
</main>
