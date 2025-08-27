<main class="usuario-detalles">
    <h1>Detalles del Usuario</h1>
    <?php if($error == true){ ?>

        <p>Id no valido o faltante</p>
        <a href="/admin/usuarios">Volver atras</a>

    <?php  }else{ ?>

         <div class="acciones">
            <a href="/admin/usuarios" class="boton boton--admin">Volver a la lista</a>
            <?php if($usuario->admin != 1){ ?>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $usuario->id?>">
                    <input type="submit" value="<?php echo ($usuario->baneo == 1 ) ? 'Desbanear' : 'Banear'; ?>"  class="boton boton--admin">
                </form>
            <?php } ?>      
        </div>
        
        <section class="usuario-detalles__datos usuario-detalles__datos--cuenta">
            <p class="usuario-detalles__dato">
                <span>ID: </span>
                 
                <?php echo $usuario->id; ?>
            </p>

            <p class="usuario-detalles__dato">
                <span>Rol: </span>
                 
                <?php echo ($usuario->admin == 1) ? 'Admin' : 'Cliente'; ?>
            </p>

            <p class="usuario-detalles__dato">
                <span>Fecha Registro: </span>
                
                <?php echo $usuario->fecha_registro; ?>
            </p>
                
            <p class="usuario-detalles__dato">
                <span>Confirmado: </span>
                
                <?php echo ($usuario->confirmado == 1 ) ? 'Si' : 'No'; ?>
            </p>
           
            <p class="usuario-detalles__dato">
                <span>Estado: </span>
                 
                <?php echo ($usuario->baneo == 1 ) ? 'Baneado' : 'Activo'; ?>
            </p>
           
        </section>

        <section class="usuario-detalles__datos usuario-detalles__datos--usuario">
             <p class="usuario-detalles__dato">
                <span>Nombre y Apellido: </span>                
                <?php echo $usuario->nombre . ' ' . $usuario->apellido; ?>
            </p>

            <p class="usuario-detalles__dato">
                <span>Correo: </span>              
                <?php echo $usuario->email; ?>
            </p>

            <p class="usuario-detalles__dato">
                <span>Telefono: </span>            
                <?php echo $usuario->telefono; ?>
            </p>
        </section>

        <section class="usuario-detalles__datos usuario-detalles__datos--pedidos">
            <p class="usuario-detalles__dato">
                <span>Pedidos hechos: </span>
                <?php echo $pedidos['total']; ?>
            </p>

            <p class="usuario-detalles__dato">
                <span>Completados: </span>
                <?php echo $pedidos['completados']; ?>
            </p>

            <p class="usuario-detalles__dato">
                <span>Pendientes: </span>
                <?php echo $pedidos['pendientes']; ?>
            </p>

            <p class="usuario-detalles__dato">
                <span>Cancelados: </span>
                <?php echo $pedidos['cancelados']; ?>
            </p> 

            <p class="usuario-detalles__dato">
                <span>Retiros en tienda: </span>
                <?php echo $pedidos['retiroEnTienda']; ?>
            </p>

            <p class="usuario-detalles__dato">
                <span>Envios a domicilio: </span>
                <?php echo $pedidos['domicilio']; ?>
            </p>

            <p class="usuario-detalles__dato">
                <span>Total Pagado:</span> 
                $
                <?php echo number_format($pagado, 2, '.',''); ?>
            </p>

        </section>
    <?php  } ?>
</main>