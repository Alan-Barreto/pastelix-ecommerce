<main class="usuario_detalles">
    <h1>Detalles del Usuario</h1>
    <?php if($error == true){ ?>

        <p>Id no valido o faltante</p>
        <a href="/admin/usuarios">Volver atras</a>

    <?php  }else{ ?>

         <div class="acciones">
            <a href="/admin/usuarios">Volver a la lista</a>
            <?php if($usuario->admin != 1){ ?>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $usuario->id?>">
                    <input type="submit" value="<?php echo ($usuario->baneo == 1 ) ? 'Desbanear' : 'Banear'; ?>">
                </form>
            <?php } ?>      
        </div>
        
        <div class="cuenta">
            <p>
                ID: 
                <span><?php echo $usuario->id; ?></span>
            </p>

            <p>
                Rol: 
                <span><?php echo ($usuario->admin == 1) ? 'Admin' : 'Cliente'; ?></span>
            </p>

            <p>
                Fecha Registro: 
                <span><?php echo $usuario->fecha_registro; ?></span>
            </p>
                
            <p>
                Confirmado: 
                <span><?php echo ($usuario->confirmado == 1 ) ? 'Si' : 'No'; ?></span>
            </p>
           
            <p>
                Estado: 
                <span><?php echo ($usuario->baneo == 1 ) ? 'Baneado' : 'Activo'; ?></span>
            </p>
           
        </div>

        <div class="usuario">
             <p>
                Nombre y Apellido: 
                <span><?php echo $usuario->nombre . ' ' . $usuario->apellido; ?></span>
            </p>

            <p>
                Correo: 
                <span><?php echo $usuario->email; ?></span>
            </p>

            <p>
                Telefono: 
                <span><?php echo $usuario->telefono; ?></span>
            </p>
        </div>

        <div class="pedidos">
            <p>Pedidos hechos: <span><?php echo $pedidos['total']; ?></span></p>
            <p>Completados:<span><?php echo $pedidos['completados']; ?></span></p>
            <p>Pendientes: <span><?php echo $pedidos['pendientes']; ?></span></p>
            <p>Cancelados: <span><?php echo $pedidos['cancelados']; ?></span></p>
            <p>Total Pagado: <span>$ <?php echo number_format($pagado, 2, '.',''); ?></span></p>
            <p>Retiros en tienda:<span><?php echo $pedidos['retiroEnTienda']; ?></span></p>
            <p>Envios a domicilio:<span><?php echo $pedidos['domicilio']; ?></span></p>
        </div>
    <?php  } ?>
</main>