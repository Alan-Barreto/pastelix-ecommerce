<main class="ventas">
    <h1>Ventas</h2>

    <form>
        <select name="fecha" id="fecha">
            <option 
                value="hoy" 
                <?php echo (isset($_GET['fecha']) && $_GET['fecha'] == 'hoy' ) 
                    ? 'selected' 
                   : '' ?>
            >
                Hoy
             </option>
    
            <option 
                value="ultima_semana" 
                   <?php echo (isset($_GET['fecha']) && $_GET['fecha'] == 'ultima_semana' ) 
                    ? 'selected' 
                    : '' ?>
            >
                Ultima semana
            </option> 

            <option 
                value="ultimo_mes" 
                <?php echo (isset($_GET['fecha']) && $_GET['fecha'] == 'ultimo_mes' ) 
                    ? 'selected' 
                    : '' ?>
            >
                Ultimo mes
            </option>

            <option 
                value="ultimos_tres_meses" 
                <?php echo (isset($_GET['fecha']) && $_GET['fecha'] == 'ultimos_tres_meses' ) 
                    ? 'selected' 
                    : '' ?>
            >
                Ultimo trimestre
            </option>

            <option 
                value="all" 
                <?php echo (isset($_GET['fecha']) && $_GET['fecha'] == 'all' ) 
                    ? 'selected' 
                    : '' ?>
            >
               Todo
            </option>
        </select>
        <button type="submit"><img src="" alt="Icono buscar"></button>
    </form>

    <?php if($listaVacia == true){ ?>
        <h2>No hay ventas registradas para este rango de fechas</h2>
    <?php }else { ?>
        <div class="mas_vendido">
            <h2>Producto mas vendido:</h2>
            <div class="mas_vendido__datos">
                <span>ID: <?php echo $productoMasVendido['id']; ?></span>
                <span>Nombre: <?php echo $productoMasVendido['nombre']; ?></span>
                <span>Cantidad: <?php echo $productoMasVendido['cantidad_vendida']; ?></span>
                <span>Ganancia: $<?php echo number_format($productoMasVendido['dinero_recaudado'], 2, '.', ''); ?></span>
            </div>
        </div>

        <div class="vendidos">
            <table>
                <thead>
                    <tr>
                        <th>
                            <a href="/admin/ventas?orden=<?php 
                                echo (
                                    (($_GET['orden'] ?? 'numero-asc') !== 'numero-desc' ) 
                                    ? 'numero-desc' 
                                    : 'numero-asc' 
                                );
                            ?>&fecha=<?php echo ($_GET['fecha'] ?? 'hoy'); ?>">
                                Numero
                            </a>
                        </th>

                        <th>
                            <a href="/admin/ventas?orden=<?php 
                                echo (
                                    (($_GET['orden'] ?? 'nombre-asc') !== 'nombre-desc' ) 
                                    ? 'nombre-desc' 
                                    : 'nombre-asc' 
                                );
                            ?>&fecha=<?php echo ($_GET['fecha'] ?? 'hoy'); ?>">
                                Nombre
                            </a>
                        </th>

                        <th>
                            <a href="/admin/ventas?orden=<?php 
                                echo (
                                    (($_GET['orden'] ?? 'cantidad-asc') !== 'cantidad-desc' ) 
                                    ? 'cantidad-desc' 
                                    : 'cantidad-asc' 
                                );
                            ?>&fecha=<?php echo ($_GET['fecha'] ?? 'hoy'); ?>">
                                Cantidad
                            </a>
                        </th>

                        <th>
                            <a href="/admin/ventas?orden=<?php 
                                echo (
                                    (($_GET['orden'] ?? 'recaudado-asc') !== 'recaudado-desc' ) 
                                    ? 'recaudado-desc' 
                                    : 'recaudado-asc' 
                                );
                            ?>&fecha=<?php echo ($_GET['fecha'] ?? 'hoy'); ?>">
                                Recaudado
                            </a>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($listaProductos as $producto){ ?>
                        <tr>
                            <td>
                                <span><?php echo $producto['id']; ?></span>
                            </td>

                            <td>
                                <span><?php echo $producto['nombre']; ?></span>
                            </td>

                            <td>
                                <span><?php echo $producto['cantidad_vendida']; ?></span>
                            </td>

                            <td>
                                <span><?php echo $producto['dinero_recaudado']; ?></span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="tabla__paginador">
                <?php if($paginaActual > 1){ ?>
                    <a 
                        href="/admin/ventas?pagina=<?php 
                            echo $paginaActual - 1; 
                        ?>&orden=<?php 
                            echo $_GET['orden'] ?? 'cantidad-desc'; 
                        ?>&fecha=<?php 
                            echo $_GET['fecha'] ?? 'hoy'; 
                        ?>"
                    >
                        < Pagina Anterior
                    </a>
                <?php } ?>
                <?php for($contadorPaginas = 1; $contadorPaginas <= $numeroPaginas; $contadorPaginas++) { 
                if ($contadorPaginas == $paginaActual) {?>
                        <p><?php echo $contadorPaginas ?></p>
                    <?php } else { ?>

                        <a 
                        href="/admin/ventas?pagina=<?php 
                            echo $contadorPaginas; 
                        ?>&orden=<?php
                            echo $_GET['orden'] ?? 'cantidad-desc'; 
                        ?>&fecha=<?php 
                            echo $_GET['fecha'] ?? 'hoy'; 
                        ?>"
                        >
                            <?php echo $contadorPaginas ?>
                        </a>
                    <?php }
                } ?>
                <?php if($paginaActual < $numeroPaginas){ ?>
                    <a 
                        href="/admin/ventas?pagina=<?php 
                            echo ($paginaActual + 1); 
                        ?>&orden=<?php 
                            echo $_GET['orden'] ?? 'cantidad-desc'; 
                        ?>&fecha=<?php 
                            echo $_GET['fecha'] ?? 'hoy'; 
                        ?>"
                    >
                        Pagina Siguiente >
                    </a>
                <?php } ?>
            </div>
        </div>
    
    <?php } ?>
    
</main>
