<main class="ventas">
    <h1>Ventas</h2>

    <form class="filtro">
        <select name="fecha" id="fecha" class="filtro__select">
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
        <button type="submit" class="filtro__boton">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </form>

    <?php if($listaVacia == true){ ?>
        <h2>No hay ventas registradas para este rango de fechas</h2>
    <?php }else { ?>
        <div class="mas_vendido">
            <h2>Producto mas vendido:</h2>
            <div class="mas_vendido__datos">
                <p><strong>Nombre: </strong><?php echo $productoMasVendido['nombre']; ?></p>
                <p><strong>ID: </strong><?php echo $productoMasVendido['id']; ?></p>
                <p><strong>Cantidad: </strong><?php echo $productoMasVendido['cantidad_vendida']; ?></p>
                <p><strong>Ganancia: </strong>$<?php echo number_format($productoMasVendido['dinero_recaudado'], 2, '.', ''); ?></p>
            </div>
        </div>

        <div class="vendidos">
            <table class="tabla tabla--admin">
                <thead class="tabla__header">
                    <tr class="tabla__fila tabla__fila--head">
                        <th class="tabla__celda tabla__celda--head">
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

                        <th class="tabla__celda tabla__celda--head">
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

                        <th class="tabla__celda tabla__celda--head">
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

                        <th class="tabla__celda tabla__celda--head">
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

                <tbody class="tabla__body">
                    <?php foreach($listaProductos as $producto){ ?>
                        <tr class="tabla__fila tabla__fila--no-hover">
                            <td class="tabla__celda">
                                <?php echo $producto['id']; ?>
                            </td>

                            <td class="tabla__celda">
                                <?php echo $producto['nombre']; ?>
                            </td>

                            <td class="tabla__celda">
                                <?php echo $producto['cantidad_vendida']; ?>
                            </td>

                            <td class="tabla__celda">
                                <?php echo $producto['dinero_recaudado']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="paginacion paginacion--admin">
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
                        <span><?php echo $contadorPaginas ?></span>
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
