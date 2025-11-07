<main class="tienda">
  
    <section class="productos">
      <div class="filtro">
        <div>
          <input type="text" placeholder="Buscar producto" class="filtro__input">
          <button type="submit" class="filtro__boton">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
              </svg>
          </button>
        </div>
        

        <div>
          <span class="filtro__select-texto">Ordenar por:</span>

          <select name="" id="" class="filtro__select">
            <option value="default">Por defecto</option>
            <option value="nombre">Nombre (A–Z)</option>
            <option value="nombreInvertido">Nombre (Z–A)</option>
            <option value="precio">Precio (menor → mayor)</option>
            <option value="precioInvertido">Precio (mayor → menor)</option>
            <option value="categoria">Categoría (A–Z)</option>
            <option value="categoriaInvertida">Categoría (Z–A)</option>
          </select>
        </div>
        
      </div>

      <h2 class="productos__titulo">Productos</h2>
      
      <ul class="productos__contenedor">
 
      </ul>

    </section>

    <section class="carrito">
      <h2 class="carrito__contador">Tu Carrito (<b>0</b>)</h2>
      <div class="carrito__vacio">
        <img class="carrito__vacio-imagen" src="/build/img/illustration-empty-cart.svg" alt="Imagen Carrito Vacio">
        <p class="carrito__vacio-texto">Los productos añadidos se mostraran aquí</p>
      </div>
    </section>

    
  </main> 