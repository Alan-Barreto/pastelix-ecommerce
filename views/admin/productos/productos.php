<main class="productos">
    <h1>Productos</h1>
    <?php
            if(isset($_SESSION['alerta'])){
                $alertas = getAlertaSession();
            }
            include_once __DIR__ .'/../../templates/alertas.php'; ?>
    <a href="productos/crear">Nuevo Producto</a>
    <table>
        <thead>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </thead>

        <tbody>
        <?php
        foreach($productos as $producto){ ?>
            <tr>
                <td><?php echo $producto->id ?></td>
           
                <td><?php echo $producto->nombre ?></td>
            
                <td><?php echo $producto->categoria ?></td>
            
                <td><?php echo $producto->precio ?></td>
    
                <td>
                    <a href="productos/editar?id=<?php echo $producto->id; ?>"><button>Editar</button></a>
                    <form action="productos/borrar?id=<?php echo $producto->id; ?>" method="POST">
                        <input type="submit" class="" value="Borrar">
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    
</main>
