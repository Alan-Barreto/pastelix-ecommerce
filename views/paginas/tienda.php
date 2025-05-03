<main class="tienda">
    <section class="productos">
      <h2>Desserts</h2>
      <div class="contenedor-productos">
        <?php 

        //Aqui se hara llamado a la DB para rellenar con los datos de esta
        foreach ($productos as $producto){?>
          <article class="articulo">
            <img src="<?php echo $producto->imagen;?>" alt="Imagen Producto" class="imagen-producto">
            <button class="boton boton-añadir">
              <img src="/build/img/icon-add-to-cart.svg" alt="Icono Carrito">
              <p>Add to Cart</p>
            </button>
            <div class="boton boton-cantidad ocultar">
              <button class="boton-restar">
                <img src="/build/img/icon-decrement-quantity.svg" alt="Boton Restar">
              </button>
              <input type="number" class="cantidad" min="0" value="0">
              <input type="hidden" class="indice" value="<?php echo $producto->id; ?>">
              <button class="boton-sumar">
                <img src="/build/img/icon-increment-quantity.svg" alt="Boton Restar">
              </button>
            </div>
            
            <h4><?php echo $producto->categoria; ?></h4>
            <h3><?php echo $producto->nombre; ?></h3>
            <p class="precio">$ <?php echo $producto->precio; ?></p>

          </article>
        <?php } ?>
      </div>
    </section>

    <section class="carrito">
      <h2 class="contador-carrito">Your Cart (<b>0</b><!-- Quantity -->)</h2>
      <div class="carrito-vacio ">
        <img src="/build/img/illustration-empty-cart.svg" alt="Imagen Carrito Vacio">
        <p class="texto-carrito-vacio">Your added items will appear here</p>
      </div>
      <div class="contenido-carrito ocultar">
        
        <ul class="articulos__carrito">
        
        </ul>

        <div class="total-orden">
          <p>Order Total</p>
          <p class="precio-final"></p>
        </div>
        <div class="ecologico">
          <img src="/build/img/icon-carbon-neutral.svg" alt="">
          <p>This is a <b>carbon-neutral</b> delibery</p>
        </div>
        <button class="boton confirmar-orden">Confirm Order</button>
      </div>
    </section>

    
  </main> 