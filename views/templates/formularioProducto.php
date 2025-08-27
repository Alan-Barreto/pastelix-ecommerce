<?php 
    include_once  __DIR__.'/alertas.php';  
?>


<form method="post" enctype="multipart/form-data" class="formulario formulario--admin">
    <a href="/admin/productos" class="boton boton--admin">Cancelar</a>
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

    <?php 
        if(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/admin/productos/editar'){ ?>
        <div class="formulario__campo">
            <label class="formulario__label">Imagen actual</label>
            <img class="formulario__img" src="<?php echo '/img/productos/'.  $imagenActual . '_thumb.webp' ?>" alt="Imagen actual" >
        </div> 
      <?php } ?>
    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">
            Imagen <?php echo (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/admin/productos/editar') ? ' Nueva' : '';?>
        </label>

        <div class="formulario__input formulario__input--file">
            
            <label for="imagen" class="formulario__input-button">
                <input type="file" name="imagen" id="imagen" class="hidden">
                <span >
                    Subir archivo
                </span>
            </label>

            <span class="formulario__input-text" title="Ningún archivo selecionado">
                Ningún archivo selecionado
            </span>
        </div>
        

    </div>
