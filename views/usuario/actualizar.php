<main class="confirmar">
    <h2 class="confirmar__titulo"><?php echo $titulo; ?></h2>
    <?php
        require_once __DIR__ . '/../templates/alertas.php';

        if($botonLogin == true){ ?>
            <div class="inicio__elemento">  
                <a href="/login" class="inicio__boton boton">Iniciar sesion</a>
            </div>
        <?php } ?>
</main>