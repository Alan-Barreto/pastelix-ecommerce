<main class="usuarios">
    <h1>Usuarios</h1>
    <form class="filtro">
        <select name="filtro" id="filtro" class="filtro__select">
            <option 
                value="all" 
                <?php echo (isset($_GET['filtro']) && $_GET['filtro'] == 'all' ) 
                    ? 'selected' 
                    : '' ?>
            >
               Todo
            </option>

            <option 
                value="solo_clientes" 
                <?php echo (isset($_GET['filtro']) && $_GET['filtro'] == 'solo_clientes' ) 
                    ? 'selected' 
                   : '' ?>
            >
                Solo Clientes
             </option>
    
            <option 
                value="solo_admins" 
                   <?php echo (isset($_GET['filtro']) && $_GET['filtro'] == 'solo_admins' ) 
                    ? 'selected' 
                    : '' ?>
            >
                Solo Admins
            </option> 

        </select>
        <button type="submit" class="filtro__boton">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </form>
    <table class="tabla tabla--admin">
        <thead class="tabla__header">
            <tr class="tabla__fila tabla__fila--head">
                <th class="tabla__celda tabla__celda--head">
                    <a href="/admin/usuarios?orden=<?php 
                                echo (
                                    (($_GET['orden'] ?? 'id-asc') !== 'id-desc' ) 
                                    ? 'id-desc' 
                                    : 'id-asc' 
                                );
                            ?>&filtro=<?php echo ($_GET['filtro'] ?? 'all'); ?>">
                                ID
                    </a>
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a href="/admin/usuarios?orden=<?php 
                                echo (
                                    (($_GET['orden'] ?? 'correo-asc') !== 'correo-desc' ) 
                                    ? 'correo-desc' 
                                    : 'correo-asc' 
                                );
                            ?>&filtro=<?php echo ($_GET['filtro'] ?? 'all'); ?>">
                                Correo
                    </a>
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a href="/admin/usuarios?orden=<?php 
                                echo (
                                    (($_GET['orden'] ?? 'nombre_apellido-asc') !== 'nombre_apellido-desc' ) 
                                    ? 'nombre_apellido-desc' 
                                    : 'nombre_apellido-asc' 
                                );
                            ?>&filtro=<?php echo ($_GET['filtro'] ?? 'all'); ?>">
                                Nombre y apellido
                    </a>
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a href="/admin/usuarios?orden=<?php 
                                echo (
                                    (($_GET['orden'] ?? 'confirmado-asc') !== 'confirmado-desc' ) 
                                    ? 'confirmado-desc' 
                                    : 'confirmado-asc' 
                                );
                            ?>&filtro=<?php echo ($_GET['filtro'] ?? 'all'); ?>">
                                Confirmado
                    </a>
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a href="/admin/usuarios?orden=<?php 
                                echo (
                                    (($_GET['orden'] ?? 'rol-asc') !== 'rol-desc' ) 
                                    ? 'rol-desc' 
                                    : 'rol-asc' 
                                );
                            ?>&filtro=<?php echo ($_GET['filtro'] ?? 'all'); ?>">
                                Rol
                    </a>
                </th>

                <th class="tabla__celda tabla__celda--head">
                    <a href="/admin/usuarios?orden=<?php 
                                echo (
                                    (($_GET['orden'] ?? 'estado-asc') !== 'estado-desc' ) 
                                    ? 'estado-desc' 
                                    : 'estado-asc' 
                                );
                            ?>&filtro=<?php echo ($_GET['filtro'] ?? 'all'); ?>">
                                Estado
                    </a>
                </th>
            </tr>
        </thead>

        <tbody class="tabla__body">
            <?php foreach($listaUsuarios as $usuario){ 
                     ?>
                <tr 
                    onclick="window.location ='/admin/usuarios/usuario?id=<?php echo $usuario->id; ?>'"
                    tabindex="0" role="link"
                    onkeydown="if(event.key==='Enter'){window.location='/admin/usuarios/usuario?id=<?php echo $usuario->id; ?>';}"
                    class="tabla__fila"
                >
                    <td class="tabla__celda"><?php echo $usuario->id; ?></td>
                    <td class="tabla__celda"><?php echo $usuario->email; ?></td>
                    <td class="tabla__celda"><?php echo $usuario->nombre . ' ' . $usuario->apellido; ?></td>
                    <td class="tabla__celda"><?php echo ($usuario->confirmado == 1) ? 'Si' : 'No'; ?></td>
                    <td class="tabla__celda"><?php echo ($usuario->admin == 1) ? 'Admin' : 'Cliente'; ?></td>
                    <td class="tabla__celda"><?php echo ($usuario->baneo == 1) ? 'Baneado' : 'Activo'; ?></td> 
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="paginacion paginacion--admin">
        <?php if($paginaActual > 1){ ?>
            <a 
                href="/admin/usuarios?pagina=<?php 
                    echo $paginaActual - 1; 
                ?>&orden=<?php 
                    echo $_GET['orden'] ?? 'id-asc'; 
                ?>&filtro=<?php 
                    echo $_GET['filtro'] ?? 'all'; 
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
                href="/admin/usuarios?pagina=<?php 
                    echo $contadorPaginas; 
                ?>&orden=<?php
                    echo $_GET['orden'] ?? 'id-asc'; 
                ?>&filtro=<?php 
                    echo $_GET['filtro'] ?? 'all'; 
                ?>"
                >
                    <?php echo $contadorPaginas ?>
                </a>
            <?php }
        } ?>
        <?php if($paginaActual < $numeroPaginas){ ?>
            <a 
                href="/admin/usuarios?pagina=<?php 
                    echo ($paginaActual + 1); 
                ?>&orden=<?php 
                    echo $_GET['orden'] ?? 'id-asc'; 
                ?>&filtro=<?php 
                    echo $_GET['filtro'] ?? 'all'; 
                ?>"
            >
                Pagina Siguiente >
            </a>
        <?php } ?>
    </div>
</main>
