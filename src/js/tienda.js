(function(){

    let j=window.innerWidth;
let precioFinal= 0;
let cantidadArticulos= 0;

function tamaño(j) {
  if(j>1400){
    return'desktop';
  }else{
    if(j>720){
      return 'tablet';
    }else{
      return'mobile';
    }
    
  }
}

function cambiarCantidad(articulo){
  
  articulo.forEach(element =>{
    botonResta= element.querySelector('.boton-restar');
    botonSuma = element.querySelector('.boton-sumar');

    element.querySelector('.cantidad').addEventListener('change', function(){
      suma= 0;
      
      listaCarrito = document.querySelectorAll('.articulo-carrito');
      indice = element.querySelector('.indice');
         
      if(element.querySelector('.cantidad').value == 0){
        element.querySelector('.boton-cantidad').classList.add('ocultar');
        element.querySelector('.boton-añadir').classList.remove('ocultar');
        element.querySelector('.imagen-producto').classList.remove('articulo-seleccionado');
        listaCarrito.forEach(element => {
          if(indice.value == element.querySelector('input').value){
            eliminarProductoCarrito(element);
          }
        });
      }else{
        nuevaCantidad=element.querySelector('.cantidad').value;
        calcularPrecio(suma,nuevaCantidad,listaCarrito,indice);
      }
    });
   
    botonResta.addEventListener('click', function(){
      
      if(element.querySelector('.cantidad').value > 1){
        element.querySelector('.cantidad').value --;
        

      }else{
        element.querySelector('.cantidad').value --; 
        btnCantidad = element.querySelector('.boton-cantidad');
        btnAñadir = element.querySelector('.boton-añadir');
        element.querySelector('.imagen-producto').classList.remove('articulo-seleccionado');
        ocultarContadorCantidad(btnCantidad,btnAñadir); 
        indice = element.querySelector('.indice');
        listaCarrito = document.querySelectorAll('.articulo-carrito');
        listaCarrito.forEach(element => {
          if(indice.value == element.querySelector('input').value){
            eliminarProductoCarrito(element);
          }
        });
      }
        suma= 0;
        
        nuevaCantidad=element.querySelector('.cantidad').value;
        listaCarrito = document.querySelectorAll('.articulo-carrito');
        indice = element.querySelector('.indice');
        calcularPrecio(suma,nuevaCantidad,listaCarrito,indice);
        
    });

    botonSuma.addEventListener('click', function(){
        element.querySelector('.cantidad').value ++;

        suma= 0;
        nuevaCantidad=element.querySelector('.cantidad').value;
        listaCarrito = document.querySelectorAll('.articulo-carrito');
        indice = element.querySelector('.indice');
        calcularPrecio(suma,nuevaCantidad,listaCarrito,indice);
        
    });
  });
  };
 
function calcularPrecio(suma,nuevaCantidad,listaCarrito,indice,cantidadArticulos = 0){
  listaCarrito.forEach(element => {       
    if(indice.value == element.querySelector('input').value){
      let precioUnidad = Number(element.querySelector('.precio-unidad').innerText.replace('@$ ', ''));
      let nuevoPrecioTotal = (nuevaCantidad*precioUnidad).toFixed(2);
      element.querySelector('.cantidad').innerText= `${nuevaCantidad}x`;
      element.querySelector('.precio-total').innerText= `$${nuevoPrecioTotal}`;
     
    }
    let precioTotal =parseFloat((element.querySelector('.precio-total').innerText).slice(1));
    let cantidadProducto = parseInt(element.querySelector('.cantidad').innerText);
    cantidadArticulos +=cantidadProducto;
    suma += precioTotal;
    precioFinal= document.querySelector('.precio-final');
    precioFinal.innerText= `$${suma.toFixed(2)}`
  });
  contadorCarrito(cantidadArticulos);
}

  function añadirCarrito(articulos){
    let suma= 0;
    articulos.forEach(articulo => {
      let agregar = articulo.querySelector('.boton-añadir');
      agregar.addEventListener('click', function(){
        let nombreArticulo = articulo.querySelector('h3').innerText;
        let precioArticulo = articulo.querySelector('.precio').innerText;
        let numeroArticulo = articulo.querySelector('.indice').value;
        let imagenArticulo = articulo.querySelector('.imagen-producto');
        imagenArticulo.classList.add('articulo-seleccionado');
        añadirLista(nombreArticulo,precioArticulo,numeroArticulo,articulos);
        articulo.querySelector('.cantidad').value ++;
        articulo.querySelector('.boton-añadir').classList.add('ocultar');
        articulo.querySelector('.boton-cantidad').classList.remove('ocultar');
        
        
        let listaCarrito = document.querySelectorAll('.articulo-carrito');
        let indice = articulo.querySelector('.indice');
        calcularPrecio(suma,1,listaCarrito,indice);
      });
    });
  }
  
  function añadirLista(nombreArticulo,precioArticulo,numeroArticulo,articulos){
    crearCarrito(nombreArticulo,precioArticulo,numeroArticulo,articulos);
    cantidadArticulos++;
    contadorCarrito(cantidadArticulos);
  }

  function crearCarrito(nombreArticulo,precioArticulo,numeroArticulo,articulos){
  

    let articuloCarrito = document.createElement('LI');
    articuloCarrito.classList.add('articulo-carrito');
    let articulosCarrito = document.querySelector('.articulos__carrito');
    articulosCarrito.appendChild(articuloCarrito);
    
    let datosArticulo=document.createElement('DIV');
    articuloCarrito.appendChild(datosArticulo);
    
    let nombre=document.createElement('H3');
    nombre.innerText=nombreArticulo;
    datosArticulo.appendChild(nombre);
    
    let precioCantidad = document.createElement('DIV');
    precioCantidad.classList.add('precio-cantidad');
    datosArticulo.appendChild(precioCantidad);
    
    let cantidad= document.createElement('P');
    cantidad.classList.add('cantidad');
    cantidad.innerText= '1x';
    precioCantidad.appendChild(cantidad);
    
    let precioUnidad= document.createElement('P');
    precioUnidad.classList.add('precio-unidad');
    precioUnidad.innerText= `@${precioArticulo}` ;
    precioCantidad.appendChild(precioUnidad);
    
    let precioTotal= document.createElement('P');
    precioTotal.classList.add('precio-total');
    precioTotal.innerText = precioArticulo;
    precioCantidad.appendChild(precioTotal);
    
    
    
    let eliminarProducto= document.createElement('BUTTON');
    eliminarProducto.classList.add('eliminar');
    articuloCarrito.appendChild(eliminarProducto);

    let indiceProducto=document.createElement('INPUT');
    indiceProducto.type= 'hidden';
    indiceProducto.value = numeroArticulo;
    eliminarProducto.appendChild(indiceProducto);
    
    let imagenEliminar = document.createElement('IMG');
    imagenEliminar.src='build/img/icon-remove-item.svg';
    eliminarProducto.appendChild(imagenEliminar);
    
    eliminarCarrito(articulos,articuloCarrito); 
  }


  function contadorCarrito(cantidadArticulos){
    document.querySelector('.contador-carrito').querySelector('b').innerText= cantidadArticulos;

    if(cantidadArticulos==0){
      document.querySelector('.carrito-vacio').classList.remove('ocultar');
      document.querySelector('.contenido-carrito').classList.add('ocultar');
    }else{
      document.querySelector('.carrito-vacio').classList.add('ocultar');
      document.querySelector('.contenido-carrito').classList.remove('ocultar');
    }
    
  }

  function eliminarCarrito(articulos,articulo){
    let btnBorrar = articulo.querySelector('.eliminar');
    let idBtnBorrar = btnBorrar.querySelector('input[type="hidden"]').value
    btnBorrar.addEventListener('click',function(){
      
      articulos.forEach(articuloTienda => {
        let idArticuloTienda = articuloTienda.querySelector('.indice').value;
        
        if(idArticuloTienda === idBtnBorrar){
          let producto = articuloTienda.querySelector('.cantidad');
          let btnAñadir = articuloTienda.querySelector('.boton-añadir');
          let btnCantidad = articuloTienda.querySelector('.boton-cantidad');
          producto.value = 0;

          imagenArticulo= articuloTienda.querySelector('.imagen-producto');
          imagenArticulo.classList.remove('articulo-seleccionado');
      
          ocultarContadorCantidad(btnCantidad,btnAñadir);
      
          eliminarProductoCarrito(articulo);

        }
      });
   
      });     
  }

  function ocultarContadorCantidad(btnCantidad,btnAñadir){
    btnCantidad.classList.add('ocultar');
    btnAñadir.classList.remove('ocultar');
  }

  function eliminarProductoCarrito(producto){
    let cantidadProducto = parseInt(producto.querySelector('.cantidad').innerText);
    let precioTotalProducto = parseFloat((producto.querySelector('.precio-total').innerText).slice(1));
    let precioFinal = parseFloat((document.querySelector('.precio-final').innerText).slice(1));
    let elementoPrecioFinal = document.querySelector('.precio-final');
    let nuevoPrecioFinal = (precioFinal-precioTotalProducto).toFixed(2);
    elementoPrecioFinal.innerText=`$${nuevoPrecioFinal}`;
    
    let cantidadArticulos= parseInt(document.querySelector('.contador-carrito').querySelector('b').innerText);
    cantidadArticulos-=cantidadProducto;
    contadorCarrito(cantidadArticulos);
    producto.remove();

  }
  
  function confirmarPedido(json){
    confirmar =document.querySelector('.confirmar-orden');
    if(confirmar){
      confirmar.addEventListener('click',function(){
        orden= document.querySelectorAll('.articulo-carrito');
        precioFinalConfirmado = document.querySelector('.carrito').querySelector('.precio-final');
        
        ordenConfirmada = document.createElement('DIV');
        ordenConfirmada.classList.add('orden-confirmada');
        document.body.appendChild(ordenConfirmada);
  
        resumenOrden = document.createElement('DIV');
        resumenOrden.classList.add('resumen-orden');
        ordenConfirmada.appendChild(resumenOrden);
  
        cabeceraResumen = document.createElement('DIV');
        cabeceraResumen.classList.add('cabecera-resumen');
        resumenOrden.appendChild(cabeceraResumen);
  
        imgCabecera = document.createElement('IMG');
        imgCabecera.src='build/img/icon-order-confirmed.svg';
        cabeceraResumen.appendChild(imgCabecera);
  
        mensajeCabecera = document.createElement('H2');
        mensajeCabecera.innerText= 'Order Confirmed';
        cabeceraResumen.appendChild(mensajeCabecera);
  
        textoCabecera = document.createElement('P');
        textoCabecera.innerText ='We hope you enjoy you food!';
        cabeceraResumen.appendChild(textoCabecera);
  
        resumenPrecio =document.createElement('DIV');
        resumenPrecio.classList.add('resumen-precio');
        resumenOrden.appendChild(resumenPrecio);
  
        listaConfirmada= document.createElement('UL');
        listaConfirmada.classList.add('lista-confirmada');
        resumenPrecio.appendChild(listaConfirmada);
  
        orden.forEach(element => {
          
          console.log(element);
          indiceArticuloConfirmado= element.querySelector('input').value; 
          imagenUltraPequeña= json[indiceArticuloConfirmado]['image']['thumbnail'];
          nombreArticuloConfirmado = element.querySelector('h3').innerText;
          cantidadArticuloConfirmado = element.querySelector('.cantidad').innerText;
          precioArticuloConfirmado = element.querySelector('.precio-unidad').innerText;
          precioTotalArticuloConfirmado = element.querySelector('.precio-total').innerText;
  
          articuloConfirmado = document.createElement('LI');
          articuloConfirmado.classList.add('articulo-carrito');
          listaConfirmada.appendChild(articuloConfirmado);
  
          info = document.createElement('DIV');
          info.classList.add('info');
          articuloConfirmado.appendChild(info);
  
          imgInfo = document.createElement('IMG');
          imgInfo.src= imagenUltraPequeña;
          info.appendChild(imgInfo);
  
          datosArticulo= document.createElement('DIV');
          datosArticulo.classList.add('datos-articulo');
          info.appendChild(datosArticulo);
  
          datosArticuloTexto= document.createElement('H3');
          datosArticuloTexto.innerText = nombreArticuloConfirmado;
          datosArticulo.appendChild(datosArticuloTexto);
  
  
          precioCantidad = document.createElement('DIV');
          precioCantidad.classList.add('precio-cantidad');
          datosArticulo.appendChild(precioCantidad);
  
          cantidad = document.createElement('P');
          cantidad.classList.add('cantidad');
          cantidad.innerText= cantidadArticuloConfirmado;
          precioCantidad.appendChild(cantidad);
  
          precioUnidad = document.createElement('P');
          precioUnidad.classList.add('precio-unidad');
          precioUnidad.innerText= precioArticuloConfirmado;
          precioCantidad.appendChild(precioUnidad);
          
          precioTotal = document.createElement('P');
          precioTotal.classList.add('precio-total');
          precioTotal.innerText = precioTotalArticuloConfirmado;
          articuloConfirmado.appendChild(precioTotal);
        });
  
  
        totalOrden = document.createElement('DIV');
        totalOrden.classList.add('total-orden');
        resumenPrecio.appendChild(totalOrden);
  
        textoTotalOrden= document.createElement('P');
        textoTotalOrden.innerText= 'Order Total';
        totalOrden.appendChild(textoTotalOrden);
  
        precioFinalOrden= document.createElement('P');
        precioFinalOrden.classList.add('precio-final');
        precioFinalOrden.innerText = `${precioFinalConfirmado.innerText}`;
        totalOrden.appendChild(precioFinalOrden);
  
        nuevoPedidoBtn = document.createElement('BUTTON');
        nuevoPedidoBtn.classList.add('boton');
        nuevoPedidoBtn.classList.add('confirmar-orden');
        nuevoPedidoBtn.innerText='Star New Order';
        resumenOrden.appendChild(nuevoPedidoBtn);
  
        nuevoPedidoBtn.addEventListener('click',function(){
          location.reload();
        });
      });
    }
    
    
  }

  //getData();
  json = '';
  articulos=document.querySelectorAll('.articulo');

      añadirCarrito(articulos);

      cambiarCantidad(articulos);

      confirmarPedido(json);
  
  

 })();

