(function(){
  const tienda = document.querySelector('.tienda');
  if(tienda){

    const iconosSVG = {};    
    renderizarPagina();

    async function renderizarPagina() {
      await cargarIconos();
      const [listaCatalogo, listaCarrito] = await Promise.all([
        crearCatalogo(),
        rearmarCarrito()
      ]);

      sincronizarBotones(listaCatalogo,listaCarrito)
      añadirFuncionalidadBotones();

    }
    
    //Crear el catalogo de productos
    async function crearCatalogo(){
      const listaProductos = await recuperarCatalogo();
      if(listaProductos.error){
        console.log(listaProductos.error);
      }else{
        const catalogo = document.querySelector('.productos__contenedor');
        listaProductos.forEach(producto => {
          const articulo = crearArticulo(producto);
          catalogo.appendChild(articulo);
        });
        const listaArticulos = document.querySelectorAll('.productos__articulo');

        return listaArticulos;
      }
    }

    //Crear articulos para el catalogo
    function crearArticulo(producto){
      const articulo = document.createElement('LI');
      articulo.dataset.id = producto.id;
      articulo.classList.add('productos__articulo');

      const imagenArticulo = document.createElement('IMG');
      imagenArticulo.src = `/img/productos/${producto.imagen}.webp`;
      imagenArticulo.alt = `Imagen ${producto.nombre}`;
      imagenArticulo.classList.add('productos__imagen');
      articulo.appendChild(imagenArticulo);

      const categoriaArticulo = document.createElement('P');
      categoriaArticulo.classList.add('productos__categoria');
      categoriaArticulo.innerText =  producto.categoria;
      articulo.appendChild(categoriaArticulo);

      const nombreArticulo = document.createElement('H3');
      nombreArticulo.classList.add('productos__nombre');
      nombreArticulo.innerText =  producto.nombre;
      articulo.appendChild(nombreArticulo);
        
      const precioArticulo = document.createElement('P');
      precioArticulo.classList.add('productos__precio');
      precioArticulo.innerText = `$ ${producto.precio}`;
      articulo.appendChild(precioArticulo);
      
      return articulo;
    }

    //Añade el boton correspondiente segun los productos en el carrito
    function sincronizarBotones(listaCatalogo,listaCarrito){
      listaCatalogo.forEach( articuloCatalogo => {
        const indiceBuscado = Number(articuloCatalogo.dataset.id);
        const articuloEncontrado = Array.from(listaCarrito).find(articuloCarrito => indiceBuscado == articuloCarrito.dataset.id); 
        if(articuloEncontrado){
          const imagenArticuloCatalogo = articuloCatalogo.querySelector('img');
          imagenArticuloCatalogo.classList.add('productos__imagen--seleccionado');
          const cantidadArticulo = parseInt(articuloEncontrado.querySelector('.carrito__cantidad').innerText);
          crearBtnCantidad(articuloCatalogo, cantidadArticulo);
        }else{
          crearBtnAñadir(articuloCatalogo);
        }          
      });
    }

    //Agrega la funcion adecuada a los botones
    function añadirFuncionalidadBotones(){
      const botonesAñadir = document.querySelectorAll('.productos__boton-añadir');
      const botonesCantidad = document.querySelectorAll('.productos__boton-cantidad');

      añadirCarrito(botonesAñadir);
      cambiarCantidad(botonesCantidad);
    }

    //Agrega la funcion "añadir" a todos los botones de este tipo que se le pasen
    function añadirCarrito(botonesAñadir){
      botonesAñadir.forEach(botonAñadir => {
        asignarFuncionalidadAñadir(botonAñadir);
      });
    }

    //Agrega la funcion "cantidad" a todos los botones de este tipo que se le pasen
    function cambiarCantidad(botonesCantidad){ 
      botonesCantidad.forEach(botonCantidad =>{
        asignarFuncionalidadCantidad(botonCantidad)        
      });
    };

    //Funciones para crear los botones de los articulos
    function crearBtnCantidad(articulo, cantidadArticulo = 1){
      const btnCantidad= document.createElement('DIV');
      btnCantidad.classList.add('boton');
      btnCantidad.classList.add('productos__boton-cantidad');

      const btnRestar = document.createElement('BUTTON');
      btnRestar.classList.add('productos__boton-restar');

      const imgBtnRestar = iconosSVG['signo-menos'].cloneNode(true);
      btnRestar.appendChild(imgBtnRestar);
      btnCantidad.appendChild(btnRestar);

      const cantidadBtnCantidad = document.createElement('INPUT');
      cantidadBtnCantidad.type = 'number';
      cantidadBtnCantidad.name ='cantidad'
      cantidadBtnCantidad.classList.add('productos__cantidad');
      cantidadBtnCantidad.min = 0;
      cantidadBtnCantidad.value = cantidadArticulo;
      btnCantidad.appendChild(cantidadBtnCantidad);

      const btnSumar = document.createElement('BUTTON');
      btnSumar.classList.add('productos__boton-sumar');

      const imgBtnSumar = iconosSVG['signo-mas'].cloneNode(true);
      btnSumar.appendChild(imgBtnSumar);
      btnCantidad.appendChild(btnSumar);

      const datosArticulo = articulo.querySelector('.productos__categoria');

      articulo.insertBefore(btnCantidad,datosArticulo);

      return btnCantidad;
    }

    function crearBtnAñadir(articulo){
      const btnAñadir= document.createElement('BUTTON');
      btnAñadir.classList.add('boton');
      btnAñadir.classList.add('productos__boton-añadir');

      const imgBtnAñadir = iconosSVG['agregar-carrito'].cloneNode(true);
      btnAñadir.appendChild(imgBtnAñadir);

      const textoBtnAñadir = document.createElement('P');
      textoBtnAñadir.innerText = 'Añadir';
      btnAñadir.appendChild(textoBtnAñadir);

      const datosArticulo = articulo.querySelector('.productos__categoria');

      articulo.insertBefore(btnAñadir,datosArticulo);

      return btnAñadir;
    }

    //Funciones para agregar funcionalidad a los botones
    function  asignarFuncionalidadCantidad(botonCantidad){
      const articulo = botonCantidad.parentElement;
      const idBuscado = articulo.dataset.id;
      const botonResta = botonCantidad.querySelector('.productos__boton-restar');
      const botonSuma = botonCantidad.querySelector('.productos__boton-sumar');
      const inputCantidad = botonCantidad.querySelector('.productos__cantidad');
      
      inputCantidad.addEventListener('change', async function(){
            
        const listaCarrito = Array.from(document.querySelectorAll('.carrito__articulo'));
        
              
        if(inputCantidad.value <= 0){
          const resultado = await eliminarProductoDelCarritoDB(idBuscado);

          if(resultado.error != false){
            const seccionProductos = document.querySelector('.productos');
            const contenedorProductos = document.querySelector('.productos__contenedor');
            const alerta = crearAlerta('error',resultado.error);

            seccionProductos.insertBefore(alerta,contenedorProductos);
            return;
          }else{
            const btnAñadir = crearBtnAñadir(articulo);
            asignarFuncionalidadAñadir(btnAñadir);
            articulo.querySelector('.productos__imagen').classList.remove('productos__imagen--seleccionado');
            botonCantidad.remove();
                
            const articuloBuscado = listaCarrito.find(articuloCarrito => idBuscado == articuloCarrito.dataset.id);
           if(articuloBuscado){
              articuloBuscado.remove();
            }
          }
          
        }else{
          const resultado = await actualizarCantidadProductoDelCarrito({'producto_id': idBuscado, 'cantidad': inputCantidad.value} )
          if(resultado.error != false){
            const seccionProductos = document.querySelector('.productos');
            const contenedorProductos = document.querySelector('.productos__contenedor');
            const alerta = crearAlerta('error','Ocurrio un error al actualizar el carrito, por favor recargue la pagina');

            seccionProductos.insertBefore(alerta,contenedorProductos);
            return;
          }else{
            actualizarCantidadSubtotal(botonCantidad);
          }
        }
          calcularPrecioCantidad();
      });
      
      botonResta.addEventListener('click', async function(){
          
        if(inputCantidad.value > 1){
          inputCantidad.value --;
          const resultado = await actualizarCantidadProductoDelCarrito({'producto_id': idBuscado, 'cantidad': inputCantidad.value} )
          if(resultado.error != false){
            const seccionProductos = document.querySelector('.productos');
            const contenedorProductos = document.querySelector('.productos__contenedor');
            const alerta = crearAlerta('error','Ocurrio un error al actualizar el carrito, por favor recargue la pagina');

            seccionProductos.insertBefore(alerta,contenedorProductos);
            return;
          }else{
            actualizarCantidadSubtotal(botonCantidad);
          }
        }else{
          const resultado = await eliminarProductoDelCarritoDB(idBuscado);
          if(resultado.error != false){
            const seccionProductos = document.querySelector('.productos');
            const contenedorProductos = document.querySelector('.productos__contenedor');
            const alerta = crearAlerta('error',resultado.error);

            seccionProductos.insertBefore(alerta,contenedorProductos);
            return;
          }else{
            inputCantidad.value --; 
            const btnAñadir = crearBtnAñadir(articulo);
            asignarFuncionalidadAñadir(btnAñadir);
            botonCantidad.remove();

            articulo.querySelector('.productos__imagen').classList.remove('productos__imagen--seleccionado'); 

            const listaCarrito = Array.from(document.querySelectorAll('.carrito__articulo'));

            const articuloBuscado = listaCarrito.find(articuloCarrito => idBuscado == articuloCarrito.dataset.id);

            if(articuloBuscado){
                articuloBuscado.remove();
            }
          }
        }    
          calcularPrecioCantidad();
      });

      botonSuma.addEventListener('click', async function(){
        inputCantidad.value ++;

        const resultado = await actualizarCantidadProductoDelCarrito({'producto_id': idBuscado, 'cantidad': inputCantidad.value} )

        if(resultado.error !== false){
          const seccionProductos = document.querySelector('.productos');
          const contenedorProductos = document.querySelector('.productos__contenedor');
          const alerta = crearAlerta('error','Ocurrio un error al actualizar el carrito, por favor recargue la pagina');

          seccionProductos.insertBefore(alerta,contenedorProductos);
          return;
        }else{
          actualizarCantidadSubtotal(botonCantidad);
          calcularPrecioCantidad();      
        }
      });
    }

    function  asignarFuncionalidadAñadir(botonAñadir){
      const articulo = botonAñadir.parentElement;
      botonAñadir.addEventListener('click', async function(){
        const idArticulo = articulo.dataset.id;
        const listaCarrito = Array.from(document.querySelectorAll('.carrito__articulo'));
        const seccionProductos = document.querySelector('.productos');
        const contenedorProductos = document.querySelector('.productos__contenedor');

        const articuloRepetido = listaCarrito.find(articulo => articulo.dataset.id === idArticulo);

        if(articuloRepetido){
          const alerta = crearAlerta('error','El producto que intenta añadir ya se encuentra en el carrito');
          seccionProductos.insertBefore(alerta,contenedorProductos);
        } else{
          const datosProducto = await añadirProducto(idArticulo);

          if(datosProducto.error){
            const alerta = crearAlerta('error',datosProducto.error);
            seccionProductos.insertBefore(alerta,contenedorProductos);
          }else{

            const imagenArticulo = articulo.querySelector('.productos__imagen');
            imagenArticulo.classList.add('productos__imagen--seleccionado');

            crearCarrito(datosProducto)

            const btnCantidad = crearBtnCantidad(articulo);
            asignarFuncionalidadCantidad(btnCantidad);
                
            calcularPrecioCantidad();
            botonAñadir.remove();
          }  
        }       
      });
    }

    
    function asignarFuncionalidadEliminar(articuloCarrito, botonBorrar){
        
        const idBotonBorrar = articuloCarrito.dataset.id
      
        botonBorrar.addEventListener('click', async function(){
          const articulosMostrados = Array.from(document.querySelectorAll('.productos__articulo'));

          const resultado = await eliminarProductoDelCarritoDB(idBotonBorrar);

          if(resultado.error != false){
            const seccionProductos = document.querySelector('.productos');
            const contenedorProductos = document.querySelector('.productos__contenedor');
            const alerta = crearAlerta('error',resultado.error);

            seccionProductos.insertBefore(alerta,contenedorProductos);
            return;
          }else{
            const articuloEncontrado = articulosMostrados.find(articulo => articulo.dataset.id === idBotonBorrar);          
            if (articuloEncontrado){
              const imagenArticulo = articuloEncontrado.querySelector('.productos__imagen');
              imagenArticulo.classList.remove('productos__imagen--seleccionado');

              const botonCantidad = articuloEncontrado.querySelector('.productos__boton-cantidad');  

              if(botonCantidad){
                const botonAñadir = crearBtnAñadir(articuloEncontrado);
                asignarFuncionalidadAñadir(botonAñadir);
                botonCantidad.remove();
              }
            }            
            articuloCarrito.remove();
            calcularPrecioCantidad(); 
          }                       
        });     
    }

    //Recalcula el subtotal de un articulo al cambiar la cantidad de este
    function actualizarCantidadSubtotal(articuloTienda){
        const articulo = articuloTienda.parentElement;
        const articulosCarrito = Array.from(document.querySelectorAll('.carrito__articulo'));
        const nuevaCantidad= articuloTienda.querySelector('.productos__cantidad').value;
        const indiceBuscado = articulo.dataset.id;

        const articuloBuscado = articulosCarrito.find(articuloCarrito => articuloCarrito.dataset.id == indiceBuscado);

        if(!articuloBuscado){
          const seccionProductos = document.querySelector('.productos');
          const contenedorProductos = document.querySelector('.productos__contenedor');
          const alerta = crearAlerta('error','Ocurrio un error al actualizar el carrito, por favor recargue la pagina');

          seccionProductos.insertBefore(alerta,contenedorProductos);
          return;
        }

        const precioUnidad = Number(articuloBuscado.querySelector('.carrito__precio-unitario').innerText.replace('@', ''));
  
        const cantidadActualizada = articuloBuscado.querySelector('.carrito__cantidad');
        cantidadActualizada.innerText = `${nuevaCantidad}x`;

        const subtotal = articuloBuscado.querySelector('.carrito__subtotal');
        subtotal.innerText = `$${(precioUnidad * nuevaCantidad).toFixed(2)}`;
    }
    
    
    function calcularPrecioCantidad(){
      let nuevoPrecioFinal = 0;
      let nuevaCantidadCarrito = 0;
      const listaCarrito = document.querySelectorAll('.carrito__articulo');
      if(listaCarrito.length > 0){
        listaCarrito.forEach(producto => {    
          const precioTotal =Number(producto.querySelector('.carrito__subtotal').innerText.replace('$', ''));
          const cantidadProducto = Number(producto.querySelector('.carrito__cantidad').innerText.replace('x', ''));
          nuevoPrecioFinal +=precioTotal;
          nuevaCantidadCarrito += cantidadProducto;
        });

        //Se actualiza el localStorage
        const carritoLocalStorage = Array.from(listaCarrito).map(productoCarrito => {
          return{
            producto_id: productoCarrito.dataset.id ,
            cantidad: Number(productoCarrito.querySelector('.carrito__cantidad').innerText.replace('x', ''))
          }
        });
        localStorage.setItem('carrito', JSON.stringify(carritoLocalStorage));
        //console.log(JSON.parse(localStorage.getItem('carrito') || '[]'));
        //console.log(carritoLocalStorage);
      }else{
        //Se limpia el localstorage
        localStorage.removeItem('carrito');

      }

      let contadorCarrito = document.querySelector('.carrito__contador').querySelector('b');
      contadorCarrito.innerText = nuevaCantidadCarrito;

      if(nuevaCantidadCarrito == 0){
        let carritoVacio = document.querySelector('.carrito__vacio');
        if(!carritoVacio){
          crearCarritoVacio();
        }
      }
  
      let precioFinal= document.querySelector('.carrito__total-precio');
      if(precioFinal){
        precioFinal.innerText= `$${nuevoPrecioFinal.toFixed(2)}`
      }
    }
      
    function crearCarrito(articulo, cantidadArticulo = 1){ 
        const contenidoCarrito = document.querySelector('.carrito__contenido');
        const nombreArticulo = articulo.nombre;
        const precioArticulo = Number(articulo.precio);
        const idArticulo = articulo.id;
    
        if(!contenidoCarrito){
          crearContenidoCarrito();
        }
        const articulosCarrito = document.querySelector('.carrito__lista');

        const articuloCarrito = document.createElement('LI');
        articuloCarrito.classList.add('carrito__articulo');
        articuloCarrito.dataset.id = idArticulo;
        articulosCarrito.appendChild(articuloCarrito);
        
        const datosArticulo=document.createElement('DIV');
        datosArticulo.classList.add('carrito__datos');
        articuloCarrito.appendChild(datosArticulo);
        
        const nombre=document.createElement('H3');
        nombre.classList.add('carrito__nombre');
        nombre.innerText=nombreArticulo;
        datosArticulo.appendChild(nombre);
        
        const precioCantidad = document.createElement('DIV');
        precioCantidad.classList.add('carrito__precio-cantidad');
        datosArticulo.appendChild(precioCantidad);
        
        const cantidad= document.createElement('P');
        cantidad.classList.add('carrito__cantidad');
        cantidad.innerText= `${cantidadArticulo}x`;
        precioCantidad.appendChild(cantidad);
        
        const precioUnidad= document.createElement('P');
        precioUnidad.classList.add('carrito__precio-unitario');
        precioUnidad.innerText= ` @${precioArticulo.toFixed(2)}` ;
        precioCantidad.appendChild(precioUnidad);
        
        const precioTotal= document.createElement('P');
        precioTotal.classList.add('carrito__subtotal');
        precioTotal.innerText = `$${(precioArticulo * cantidadArticulo).toFixed(2)}`;
        precioCantidad.appendChild(precioTotal);
               
        const eliminarProducto= document.createElement('BUTTON');
        eliminarProducto.classList.add('carrito__boton-eliminar');
        articuloCarrito.appendChild(eliminarProducto);
        
        const imagenEliminar = iconosSVG['signo-eliminar'].cloneNode(true);;
        eliminarProducto.appendChild(imagenEliminar);
        
        asignarFuncionalidadEliminar(articuloCarrito, eliminarProducto); 
    }

    //Crea la apariencia del carrito cuando NO tiene articulos dentro
    function crearCarritoVacio(){
      const carrito = document.querySelector('.carrito');
      const contenidoCarrito = document.querySelector('.carrito__contenido');
      
      const carritoVacio = document.createElement('DIV');
      carritoVacio.classList.add('carrito__vacio');

      const imgCarritoVacio = document.createElement('IMG');
      imgCarritoVacio.src = '/build/img/illustration-empty-cart.svg';
      imgCarritoVacio.alt = 'Imagen Carrito Vacio';
      carritoVacio.appendChild(imgCarritoVacio);

      const textoCarritoVacio = document.createElement('P');
      textoCarritoVacio.classList.add('carrito__vacio-texto');
      textoCarritoVacio.innerText = 'Los productos añadidos se mostraran aquí';
      carritoVacio.appendChild(textoCarritoVacio);

      carrito.appendChild(carritoVacio);   
      if(contenidoCarrito){
        contenidoCarrito.remove();
      }
    }

    //Crea la apariencia del carrito cuando tiene articulos dentro
    function crearContenidoCarrito(){
      const carrito = document.querySelector('.carrito');
      const carritoVacio = document.querySelector('.carrito__vacio');
      
      const contenidoCarrito = document.createElement('DIV');
      contenidoCarrito.classList.add('carrito__contenido');

      const listaContenidoCarrito = document.createElement('UL');
      listaContenidoCarrito.classList.add('carrito__lista');
      contenidoCarrito.appendChild(listaContenidoCarrito);

      const totalOrden = document.createElement('DIV');
      totalOrden.classList.add('carrito__total');
      const textoTotalOrden = document.createElement('P');
      textoTotalOrden.classList.add('carrito__total-texto');
      textoTotalOrden.innerText = 'Total';
      const precioFinal = document.createElement('P');
      precioFinal.classList.add('carrito__total-precio');

      totalOrden.appendChild(textoTotalOrden);
      totalOrden.appendChild(precioFinal);
      contenidoCarrito.appendChild(totalOrden);

      const botonConfirmarOrden = document.createElement('A');
      botonConfirmarOrden.href = '/checkout';
      botonConfirmarOrden.classList.add('boton');
      botonConfirmarOrden.classList.add('carrito__boton-confirmar');
      botonConfirmarOrden.innerText = 'Confirmar Pedido';

      contenidoCarrito.appendChild(botonConfirmarOrden);

      carrito.appendChild(contenidoCarrito);

      if(carritoVacio){
        carritoVacio.remove();
      }
    }

    //Crea y devuelve un mensaje de alerta
    function crearAlerta(tipo,mensaje){
      const alerta = document.createElement('DIV');
      alerta.classList.add('alerta');
      alerta.classList.add(`alerta__${tipo}`);
      alerta.innerText = mensaje;

      return alerta;
    }

      
    async function rearmarCarrito() {
      const carritoProductos = await recuperarCarrito();
      let carritoNormalizado = [];
      if(carritoProductos.error){
        console.log(carritoProductos.error);
        const carritoLocalStorage = JSON.parse(localStorage.getItem('carrito') || '[]');
        if(carritoLocalStorage.length <= 0){
          console.log('localStorage vacio');
        }else{
          if(carritoProductos.login == true){
            const carritoDB = await actualizarCarritoDB(carritoLocalStorage);
            if(carritoDB.error){
              console.log(carritoDB.error);
            }
          }
          productosPrecios = await recuperarPrecio(carritoLocalStorage);
          if(productosPrecios.error){
            const seccionProductos = document.querySelector('.productos');
            const contenedorProductos = document.querySelector('.productos__contenedor');
            const alerta = crearAlerta('error','Ocurrio un error al actualizar el carrito, por favor recargue la pagina o intentelo de nuevo mas tarde');

            seccionProductos.insertBefore(alerta,contenedorProductos);
            return;
          }else{
            const carritoRearmado = carritoLocalStorage.map(item=>{
              precio = productosPrecios.find(p => p.id === item.producto_id)
              return{
                ...item,
                nombre: precio?.nombre,
                precio: precio?.precio
            }
          });
          carritoNormalizado = normalizarListaCarrito(carritoRearmado);
          }
         
        }
      }
        
      if(carritoProductos[0]?.producto_id){
        carritoNormalizado = normalizarListaCarrito(carritoProductos);
      }
       
      carritoNormalizado.forEach(producto => {
        const cantidadArticulos = producto.cantidad;
        crearCarrito(producto,cantidadArticulos);
      });
      calcularPrecioCantidad();

      const listaCarrito = document.querySelectorAll('.carrito__articulo');
      return listaCarrito;
    }

    //Toma el carrito recuperado de la db o el localstorage y le da el formato correcto
    function normalizarListaCarrito(carritoRecuperado){
      const carritoNormalizado = Array.from(carritoRecuperado).map (({producto_id,...resto})=>({
        id: producto_id,
        ...resto
      }))

      return carritoNormalizado;
    }


    //Carga y almacena los svg para usarlos sin llamadas constantes

    async function cargarIconos() {
      const tipos = ['agregar-carrito','signo-mas', 'signo-menos', 'signo-eliminar'];

      for (let tipo of tipos) {
        const res = await fetch(`build/img/icon-${tipo}.svg`);
        const svgTxt = await res.text();
        const parser = new DOMParser();
        const svgNode = parser.parseFromString(svgTxt, "image/svg+xml").documentElement;

        iconosSVG[tipo] = svgNode;
      }
    }

    //Funciones para llamar APIS

    //luego se le pueden agregar como parametros que tipo de orden quiere y por que valor ordenarlo
    //ademas del numero de pagina donde se encuentra para rearmar el catalogo segun la pagina
    async function recuperarCatalogo() {
       const url = `/api/recuperarCatalogo`;
      const resultado = await fetch(url);
      const productos = await resultado.json();

      return (productos);
    }

    async function recuperarCarrito(){
      const url = `/api/recuperarCarrito`;
      const resultado = await fetch(url);
      const productos = await resultado.json();

      return (productos);
    }

     async function actualizarCarritoDB(carrito = []){
      const url = `/api/actualizarCarritoDB`;
      const resultado = await fetch(url, {
        method: 'POST',
        headers: { 
          'Content-Type': 'application/json' 
        },
        body: JSON.stringify(carrito)
      });
        
      const consulta = await resultado.json();

      return (consulta);
    }

    async function recuperarPrecio(carrito = []){
      const url = `/api/recuperarPrecio`;
      const resultado = await fetch(url, {
        method: 'POST',
        headers: { 
          'Content-Type': 'application/json' 
        },
        body: JSON.stringify(carrito)
      });
        
      const precios = await resultado.json();

      return (precios);
    }

    //Tengo que cambiar la manera de llamar esta api por un post como en recuperarPrecio
    async function añadirProducto(id){
      const url = `/api/añadirProducto?id=${id}`;
      const resultado = await fetch(url);
      const producto = await resultado.json();

      return (producto);
    }

     async function actualizarCantidadProductoDelCarrito(producto = []){
      const url = `/api/actualizarCantidadProductoDelCarrito`;
      const resultado = await fetch(url, {
        method: 'PUT',
        headers: { 
          'Content-Type': 'application/json' 
        },
        body: JSON.stringify(producto)
      });
        
      const precios = await resultado.json();

      return (precios);
    }

    async function eliminarProductoDelCarritoDB(productoId) {
      const url = `/api/eliminarProductoDelCarrito`;
      const resultado = await fetch(url, {
        method: 'DELETE',
        headers: { 
          'Content-Type': 'application/json' 
        },
        body: JSON.stringify(productoId)
      });
        
      const consulta = await resultado.json();

      return (consulta);
    }

  }//Fin de la verificacion que revisa estar en la pagina correcta 
})();

