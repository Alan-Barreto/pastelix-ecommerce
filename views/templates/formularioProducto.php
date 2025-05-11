<?php 
    include_once  __DIR__.'/alertas.php';  
?>
    <a href="/admin/productos">Cancelar</a>
<form method="post" enctype="multipart/form-data" class="productos__formulario formulario">

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa el Nombre del producto" class="formulario__input" value="<?php echo $producto->nombre; ?>">
    </div>

    <div class="formulario__campo">
        <label for="categoria" class="formulario__label">Categoria</label>
        <input type="text" name="categoria" id="categoria" placeholder="Ingresa la Categoria del producto" class="formulario__input" value="<?php echo $producto->categoria; ?>">
    </div>

    <div class="formulario__campo">
        <label for="precio" class="formulario__label">Precio</label>
        <input type="number" step="0.01" name="precio" id="precio" placeholder="Ej: 6.50" class="formulario__input" value="<?php echo $producto->precio; ?>">
    </div>

    <!-- Podria agregar un if aqui o abajo para mostrar la imagen que ya tiene el producto en la seccion editar -->
    <?php 
        if($_SERVER['PATH_INFO'] === '/admin/productos/editar'){ ?>
        <label for="imagen" class="formulario__label">Imagen actual</label>
        <img src="<?php echo '/img/productos/'.  $imagenActual . '.webp' ?>" alt="Imagen actual">
      <?php } ?>
    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen <?php echo ($_SERVER['PATH_INFO'] === '/admin/productos/editar') ? ' Nueva' : '';?></label>
        <input type="file" name="imagen" id="imagen" class="formulario__input">
    </div>
