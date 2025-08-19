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
                        console.log(arrayPedidos[pedidoId]);
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
            detallesPedido.classList.add('pedido__detalles');

            const datosPedido = document.createElement('DIV');

            const numeroPedido = document.createElement('P');
            numeroPedido.innerText = `Nº pedido: ${pedido.datos.numeroPedido}`;

            datosPedido.appendChild(numeroPedido);
            
            const fechaPedido = document.createElement('P');
            fechaPedido.innerText = `Fecha: ${pedido.datos.fecha}`;

            datosPedido.appendChild(fechaPedido);


            detallesPedido.appendChild(datosPedido);

            const listaProductos = document.createElement('UL');
        
            pedido.productos.forEach(producto => {
                const productoContenedor = document.createElement('LI');

                const productoImagen = document.createElement('IMG');
                productoImagen.src = `/img/productos/${producto.imagen}_thumb.webp`;
                productoImagen.alt = 'Imagen Producto';
                productoImagen.loading = 'lazy';

                productoContenedor.appendChild(productoImagen);

                const productoNombre = document.createElement('P');
                productoNombre.innerText = producto.nombre;
                productoContenedor.appendChild(productoNombre);

                const contenedorPrecioCantidad = document.createElement('DIV');

                const productoPrecio = document.createElement('P');
                productoPrecio.innerText = `$ ${producto.precio}`;
                contenedorPrecioCantidad.appendChild(productoPrecio);

                const productoCantidad = document.createElement('P');
                productoCantidad.innerText = producto.cantidad;
                contenedorPrecioCantidad.appendChild(productoCantidad);

                productoContenedor.appendChild(contenedorPrecioCantidad);

                const productoSubtotal = document.createElement('P');
                productoSubtotal.innerText = `$ ${producto.subtotal}`;

                productoContenedor.appendChild(productoSubtotal);

                listaProductos.appendChild(productoContenedor);
            });

            detallesPedido.appendChild(listaProductos);

     
            const totalPagado = document.createElement('DIV');
            const textoTotalPagado = document.createElement('P');
            textoTotalPagado.innerText = 'Total: ';
            totalPagado.appendChild(textoTotalPagado);

            const valorTotalPagado = document.createElement('P');
            valorTotalPagado.innerText = `$ ${pedido.datos.total}`;
            totalPagado.appendChild(valorTotalPagado);

            detallesPedido.appendChild(totalPagado);


            if(pedido.direccion !== ''){
                const direccionPedido = document.createElement('DIV');

                const textoDireccionPedido = document.createElement('P');
                textoDireccionPedido.innerText = 'Direccion';
                direccionPedido.appendChild(textoDireccionPedido);

                const datosDireccionPedido = document.createElement('DIV');
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

                detallesPedido.appendChild(direccionPedido);
            }

            
            
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