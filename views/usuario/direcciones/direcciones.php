<?php
    include_once __DIR__ .'/../../templates/navegacionUsuario.php';
?>
        <h1>direcciones</h1>
    <div class="usuario__direcciones"> 
        <a href="/usuario/direcciones/crear"><button>Nueva Direccion</button></a>
        <?php
            if(isset($_SESSION['alerta'])){
                $alertas = getAlertaSession();
            }
            include_once __DIR__ .'/../../templates/alertas.php';
        ?>
        <ul>
            <?php 
                if (!empty($direcciones)){
                    foreach ($direcciones as $key=>$direccion) { ?>

                        <li>
                            <h3>Direccion <?php echo $key + 1; ?></p>
                            <p><?php echo $direccion->nombre . " " . $direccion->apellido; ?>
                                <span>
                                    <?php echo $direccion->calle . " " . $direccion->ciudad. " " . $direccion->codigo_postal. " " . $direccion->provincia. " " . $direccion->pais; ?>
                                </span>    
                            </p>
                            
                            <div class="direcciones__acciones">
                                <a href="/usuario/direcciones/editar?id=<?php echo $direccion->id ?>"><button>Editar</button></a>
                                <form action="/usuario/direcciones/borrar?id=<?php echo $direccion->id ?>" method="POST">
                                    <input type="submit" class="" value="Borrar">
                                </form>
                            </div>
                            
                            
                        </li>

                <?php 
                    }
                }else{ ?>
                <li>
                    <p>Las direccions que guardes apareceran aqui</p>
                </li>
            <?php } ?>
        </ul>
    </div>
       
    </div>
</main>