<main class="usuarios">
    <h1>Usuarios</h1>
    <form>
        <select name="filtro" id="filtro">
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
                Solo Adminis
            </option> 

        </select>
        <button type="submit"><img src="" alt="Icono buscar"></button>
    </form>
    <table class="tabla">
        <thead>
            <tr>
                <th>
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

                <th>
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

                <th>
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

                <th>
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

                <th>
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

                <th>
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

                <th>
                    Acciones
                </th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($listaUsuarios as $usuario){ 
                     ?>
                <tr>
                    <td><?php echo $usuario->id; ?></td>
                    <td><?php echo $usuario->email; ?></td>
                    <td><?php echo $usuario->nombre . ' ' . $usuario->apellido; ?></td>
                    <td><?php echo ($usuario->confirmado == 1) ? 'Si' : 'No'; ?></td>
                    <td><?php echo ($usuario->admin == 1) ? 'Admin' : 'Cliente'; ?></td>
                    <td><?php echo ($usuario->baneo == 1) ? 'Baneado' : 'Activo'; ?></td>
                    <td>
                        <a href="/admin/usuarios/usuario?id=<?php echo $usuario->id; ?>">Ver Mas</a>
                    </td>   
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="tabla__paginador">
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
                <p><?php echo $contadorPaginas ?></p>
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
