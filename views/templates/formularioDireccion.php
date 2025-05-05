<div class="usuario_direcciones">

    <?php include_once  __DIR__.'/alertas.php'; 
    ?>

    <form method="post" class="direccion__formulario formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Ingresa el Nombre del destinatario" class="formulario__input" value="<?php echo $direccion->nombre; ?>">
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Ingresa el Apellido del destinatario" class="formulario__input" value="<?php echo $direccion->apellido; ?>">
        </div>

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
            <input type="text" name="pais" id="pais" placeholder="Ingresa tu Pais" class="formulario__input" value="<?php echo $direccion->pais; ?>">
        </div>

        <div class="formulario__campo">
            <label for="telefono" class="formulario__label">Telefono</label>
            <input type="text" name="telefono" id="telefono" placeholder="Ingresa tu Telefono" class="formulario__input" value="<?php echo $direccion->telefono; ?>">
        </div>