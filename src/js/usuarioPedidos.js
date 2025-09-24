(function(){
    const usuarioPedidos = document.querySelector('.usuario__pedidos');
    if(usuarioPedidos){
        const tablaPedidos = document.querySelector('.tabla__pedidos');
        if(tablaPedidos){
            const botonesPedidos = tablaPedidos.querySelectorAll('.boton-detalles');
            let arrayPedidos = [];
            botonesPedidos.forEach(boton=>{
                boton.addEventListener('click', async function(){
                    const modalExistente = document.querySelector('.modal');
                    if(!modalExistente){
                        const pedidoId = boton.dataset.id;
                        if(arrayPedidos[pedidoId] === undefined){
                            const pedidoBuscado = await recuperarPedido(pedidoId);
                            if(pedidoBuscado.error == true){
                                console.log('Error al buscar el pedido');
                                return;
                            } 
                            arrayPedidos[pedidoId] = pedidoBuscado.datos
                        }
                        mostrarDetallesPedido(arrayPedidos[pedidoId]);
                    }
                });
            })

        }

        function mostrarDetallesPedido(pedido = []){
            const body = document.querySelector('body');
            body.classList.add('modal--abierto');

            const modal = document.createElement('DIV');
            modal.classList.add('modal');

            const detallesPedido = document.createElement('DIV');
            detallesPedido.classList.add('carrito');
            detallesPedido.classList.add('carrito--modal');

            const botonCerrar = document.createElement('BUTTON');
            botonCerrar.classList.add('boton');
            botonCerrar.classList.add('boton--centrado');
            botonCerrar.classList.add('boton--modal');
            botonCerrar.innerText = 'Cerrar';
            detallesPedido.appendChild(botonCerrar);

            botonCerrar.addEventListener('click', function(e){
                e.preventDefault();
                body.classList.remove('modal--abierto');
                modal.remove();
            });

            const contenidoPedido = document.createElement('DIV');
            contenidoPedido.classList.add('carrito__contenido');
            
            const datosPedido = document.createElement('DIV');
            datosPedido.classList.add('carrito__numero-fecha');

            const numeroPedido = document.createElement('P');
            numeroPedido.innerText = `Nº pedido: ${pedido.datos.numeroPedido}`;

            datosPedido.appendChild(numeroPedido);
            
            const fechaPedido = document.createElement('P');
            fechaPedido.innerText = `Fecha: ${pedido.datos.fecha}`;

            datosPedido.appendChild(fechaPedido);


            contenidoPedido.appendChild(datosPedido);

            if(pedido.direccion !== ''){
                const direccionPedido = document.createElement('DIV');
                direccionPedido.classList.add('carrito__direccion');

                const textoDireccionPedido = document.createElement('P');
                textoDireccionPedido.innerText = 'Direccion';
                direccionPedido.appendChild(textoDireccionPedido);

                const datosDireccionPedido = document.createElement('DIV');
                datosDireccionPedido.classList.add('carrito__direccion-datos');

                const calleDireccionPedido = document.createElement('P');
                calleDireccionPedido.innerText = `Calle: ${pedido.direccion.calle}`;
                datosDireccionPedido.appendChild(calleDireccionPedido);

                const ciudadDireccionPedido = document.createElement('P');
                ciudadDireccionPedido.innerText = `Ciudad: ${pedido.direccion.ciudad}`;
                datosDireccionPedido.appendChild(ciudadDireccionPedido);

                 const provinciaDireccionPedido = document.createElement('P');
                provinciaDireccionPedido.innerText = `Provincia: ${pedido.direccion.provincia}`;
                datosDireccionPedido.appendChild(provinciaDireccionPedido);

                 const codigoPostalDireccionPedido = document.createElement('P');
                codigoPostalDireccionPedido.innerText = `Codigo Postal: ${pedido.direccion.codigoPostal}`;
                datosDireccionPedido.appendChild(codigoPostalDireccionPedido);

                 const paisDireccionPedido = document.createElement('P');
                paisDireccionPedido.innerText = `Pais: ${pedido.direccion.pais}`;
                datosDireccionPedido.appendChild(paisDireccionPedido);

                direccionPedido.appendChild(datosDireccionPedido);

                contenidoPedido.appendChild(direccionPedido);
            }


            const listaProductos = document.createElement('UL');
            listaProductos.classList.add('carrito__lista');
        
            pedido.productos.forEach(producto => {
                const productoContenedor = document.createElement('LI');
                productoContenedor.classList.add('carrito__articulo');

                const productoImagen = document.createElement('IMG');
                productoImagen.classList.add('carrito__imagen');
                productoImagen.src = `/img/productos/${producto.imagen}_thumb.webp`;
                productoImagen.alt = `Imagen Producto ${producto.nombre}`;
                productoImagen.loading = 'lazy';

                productoContenedor.appendChild(productoImagen);

                const contenedorDatos = document.createElement('DIV');
                contenedorDatos.classList.add('carrito__datos');
                contenedorDatos.classList.add('carrito__datos--modal');

                const productoNombre = document.createElement('H3')
                productoNombre.classList.add('carrito__nombre');
                productoNombre.innerText = producto.nombre;
                contenedorDatos.appendChild(productoNombre);

                const contenedorPrecioCantidad = document.createElement('DIV');
                contenedorPrecioCantidad.classList.add('carrito__precio-cantidad');

                const productoCantidad = document.createElement('P');
                productoCantidad.classList.add('carrito__cantidad');
                productoCantidad.innerText = `X${producto.cantidad}`;
                contenedorPrecioCantidad.appendChild(productoCantidad);

                const productoPrecio = document.createElement('P');
                productoPrecio.classList.add('carrito__precio-unitario');
                productoPrecio.innerText = `@${producto.precio}`;
                contenedorPrecioCantidad.appendChild(productoPrecio);      

                contenedorDatos.appendChild(contenedorPrecioCantidad);

                const productoSubtotal = document.createElement('P');
                productoSubtotal.innerText = `$${(Number(producto.precio) * producto.cantidad).toFixed(2)}`;

                contenedorPrecioCantidad.appendChild(productoSubtotal);

                productoContenedor.appendChild(contenedorDatos);

                listaProductos.appendChild(productoContenedor);
            });

            contenidoPedido.appendChild(listaProductos);

     
            const totalPagado = document.createElement('DIV');
            totalPagado.classList.add('carrito__total');

            const textoTotalPagado = document.createElement('P');
            textoTotalPagado.innerText = 'Total: ';
            totalPagado.appendChild(textoTotalPagado);

            const valorTotalPagado = document.createElement('P');
            valorTotalPagado.innerText = `$ ${pedido.datos.total}`;
            totalPagado.appendChild(valorTotalPagado);

            contenidoPedido.appendChild(totalPagado);

            detallesPedido.appendChild(contenidoPedido);
            
            modal.appendChild(detallesPedido);

            body.appendChild(modal);

            modal.addEventListener('click', function(e){
                if(e.target == modal){
                    body.classList.remove('modal--abierto');
                    modal.remove();
                }
            });
        }

        async function recuperarPedido(pedidoId) {
            const url = `/api/recuperarPedido?id=${pedidoId}`;
            const consulta = await fetch(url);
            const respuesta = await consulta.json()
            return respuesta;
        }
    }
})();