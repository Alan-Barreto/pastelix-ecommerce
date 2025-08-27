<main class="productos">
    <h1>Productos</h1>
    <?php
            if(isset($_SESSION['alerta'])){
                $alertas = getAlertaSession();
            }
            include_once __DIR__ .'/../../templates/alertas.php'; ?>
        <div class="productos__acciones">
            <a href="productos/crear" class="boton boton--admin">Nuevo Producto</a>
            <form class="filtro">
                <input 
                    type="text" 
                    placeholder="Buscar" 
                    class="filtro__input" 
                    name="datoBuscado"
                    value="<?php echo htmlspecialchars($_GET['datoBuscado'] ?? ''); ?>"
                    >
                <button type="submit" class="filtro__boton">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </form>    
        </div>
        
    <table class="tabla tabla--admin">
        <thead class="tabla__header">
            <tr class="tabla__fila tabla__fila--head">
                <th class="tabla__celda tabla__celda--head">
                    <a 
                        href="/admin/productos?orden=<?php 
                            echo (
                                ((($_GET['orden'] ?? 'id-asc') !== 'id-desc' ) 
                                ? 'id-desc' 
                                : 'id-asc' ) .
                                ($filtroPagina ?? '')
                            );
                        ?>"
                    >
                        ID
                    </a>  
                </th>
                <th class="tabla__celda tabla__celda--head">
                    <a 
                        href="/admin/productos?orden=<?php 
                            echo (
                                ((($_GET['orden'] ?? 'nombre-desc') !== 'nombre-asc' ) 
                                ? 'nombre-asc' 
                                : 'nombre-desc') .
                                ($filtroPagina ?? '') 
                            );
                        ?>"
                    >
                        Nombre
                    </a>        
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a 
                        href="/admin/productos?orden=<?php 
                            echo (
                                ((($_GET['orden'] ?? 'categoria-desc') !== 'categoria-asc' ) 
                                ? 'categoria-asc' 
                                : 'categoria-desc') .
                                ($filtroPagina ?? '') 
                            );
                        ?>"
                    >
                        Categoria
                    </a> 
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a 
                        href="/admin/productos?orden=<?php 
                            echo (
                                ((($_GET['orden'] ?? 'precio-asc') !== 'precio-desc' ) 
                                ? 'precio-desc' 
                                : 'precio-asc') .
                                ($filtroPagina ?? '') 
                            );
                        ?>"
                    >
                        Precio
                    </a>
                </th>

                <th class="tabla__celda tabla__celda--head tabla__celda--no-hover">    
                    Acciones
                </th>
            </tr> 
        </thead>

        <tbody class="tabla__body">
        <?php
        foreach($productos as $producto){ ?>
            <tr class="tabla__fila tabla__fila--no-hover">
                <td class="tabla__celda"><?php echo $producto->id ?></td>
           
                <td class="tabla__celda"><?php echo $producto->nombre ?></td>
            
                <td class="tabla__celda"><?php echo $producto->categoria ?></td>
            
                <td class="tabla__celda"><?php echo $producto->precio ?></td>
    
                <td class="tabla__celda">
                        <div class="tabla__acciones">
                            <a href="productos/editar?id=<?php echo $producto->id; ?>">
                            <button class="tabla__boton tabla__boton--editar">Editar</button>
                        </a>

                        <form action="productos/borrar?id=<?php echo $producto->id; ?>" method="POST">
                            <input type="submit" class="tabla__boton tabla__boton--borrar" value="Borrar">
                        </form>
                    </div>   
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    
    <div class="paginacion paginacion--admin">
        <?php if($paginaActual > 1){ ?>
            <a 
                href="/admin/productos?pagina=<?php 
                    echo $paginaActual - 1; 
                ?>&orden=<?php 
                    echo ($_GET['orden'] ?? 'id-asc') . ($filtroPagina ?? ''); 
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
                href="/admin/productos?pagina=<?php 
                    echo $contadorPaginas; 
                ?>&orden=<?php
                    echo ($_GET['orden'] ?? 'id-asc') . ($filtroPagina ?? ''); 
                ?>"
                >
                    <?php echo $contadorPaginas ?>
                </a>
            <?php }
        } ?>
        <?php if($paginaActual < $numeroPaginas){ ?>
            <a 
                href="/admin/productos?pagina=<?php 
                    echo ($paginaActual + 1); 
                ?>&orden=<?php 
                    echo ($_GET['orden'] ?? 'id-asc') . ($filtroPagina ?? '');
                ?>"
            >
                Pagina Siguiente >
            </a>
        <?php } ?>
    </div>
</main>
