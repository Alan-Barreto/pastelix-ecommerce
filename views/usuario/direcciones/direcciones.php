<?php
    include_once __DIR__ .'/../../templates/navegacionUsuario.php';
?>
    <div class="usuario__direcciones"> 
        <h2>Direcciones</h2>

        <a href="/usuario/direcciones/crear" class="boton">Nueva Direccion</a>
        <?php
            if(isset($_SESSION['alerta'])){
                $alertas = getAlertaSession();
            }
            include_once __DIR__ .'/../../templates/alertas.php';
        ?>
        <ul class="usuario__lista-direcciones">
            <?php 
                if (!empty($direcciones)){
                    foreach ($direcciones as $key=>$direccion) { ?>

                        <li class="usuario__direccion">
                            <h3>Direccion <?php echo $key + 1; ?></h3>

                            <?php if($direccion->predeterminada == 1){ ?>
                                <p class="usuario__direccion-predeterminada">Predeterminada</p>
                            <?php } ?>
                            <div class="usuario__direccion-datos">
                                <p>
                                    <?php echo $direccion->calle . ", " . $direccion->ciudad . ", "; ?>
                                    <span>
                                        <?php echo $direccion->codigo_postal. ", " . $direccion->provincia. ", " . $direccion->pais_nombre; ?>
                                    </span>    
                                </p>
                            </div>
                                             
                            <div class="usuario__direccion-acciones">
                                <a class="boton boton--pequeño" href="/usuario/direcciones/editar?id=<?php echo $direccion->id ?>">Editar</a>
                                <form action="/usuario/direcciones/borrar?id=<?php echo $direccion->id ?>" method="POST">
                                    <input type="submit" class="boton boton--pequeño" value="Borrar">
                                </form>
                            </div>
                            
                            
                        </li>

                <?php 
                    }
                }else{ ?>
                <li>
                    <p>Las direcciones que guardes apareceran aqui</p>
                </li>
            <?php } ?>
        </ul>
    </div>
       
    </div>
</main>