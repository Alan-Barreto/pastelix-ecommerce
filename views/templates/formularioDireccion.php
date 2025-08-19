<div class="usuario_direcciones">

    <?php include_once  __DIR__.'/alertas.php'; 
    ?>

    <form method="post" class="direccion__formulario formulario">

        <div class="formulario__campo">
            <label for="calle" class="formulario__label">Calle</label>
            <input type="text" name="calle" id="calle" placeholder="Ingresa tu Calle y numero" class="formulario__input" value="<?php echo $direccion->calle; ?>">
        </div>

        <div class="formulario__campo">
            <label for="ciudad" class="formulario__label">Ciudad</label>
            <input type="text" name="ciudad" id="ciudad" placeholder="Ingresa tu Ciudad" class="formulario__input" value="<?php echo $direccion->ciudad; ?>">
        </div>

        <div class="formulario__campo">
            <label for="provincia" class="formulario__label">Provincia</label>
            <input type="text" name="provincia" id="provincia" placeholder="Ingresa tu Provincia" class="formulario__input" value="<?php echo $direccion->provincia; ?>">
        </div>

        <div class="formulario__campo">
            <label for="codigo_postal" class="formulario__label">Codigo Postal</label>
            <input type="text" name="codigo_postal" id="codigo_postal" placeholder="Ingresa tu Codigo Postal" class="formulario__input" value="<?php echo $direccion->codigo_postal; ?>">
        </div>

        <div class="formulario__campo">
            <label for="pais" class="formulario__label">Pais</label>
            <!-- <input type="text" name="pais" id="pais" placeholder="Ingresa tu Pais" class="formulario__input" value="<?php //echo $direccion->pais; ?>"> -->
            <select name="pais" id="pais" class="formulario__input campo-pais">
                <option value="" disabled selected>Seleccione un país</option>
                <?php 
                    foreach($paises as $pais){ ?>
                    
                        <option value="<?php echo $pais['codigo']; ?>" <?php echo $direccion->pais==$pais['codigo'] ? 'selected' : ''; ?>><?php echo $pais['nombre']; ?></option>

                <?php } ?>
            </select>
        </div>  