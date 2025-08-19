(function(){
    const checkout = document.querySelector('.checkout');
    if(checkout){
        if(carritoVacio()){
                checkoutCarritoVacio();
        }else{
            elegirMetodoEntrega();
            recuperarCarritoLocal();
        }
       

        //Revisa si hay algo en el carrito del usuario y devuelve true o false
        function carritoVacio(){
            const carritoRecuperado = JSON.parse(localStorage.getItem('carrito') || '[]');
            if(carritoRecuperado.length <= 0){
                return true;
            }else{
                return false;
            }
        }

        //Reemplaza el contenido normal del checkout por un aviso de agregar algo al carrito
        function checkoutCarritoVacio(){
            checkout.innerHTML = `
                <div class="carrito-vacio-alerta">
                    <h2>Su carrito esta vacio</h2>
                    <p><a href="/tienda">Haga click aqui</a> para ir a la tienda y agregar algo</p>
                </div>
            
            `;
        }

        async function elegirMetodoEntrega(){
            const usuarioLogueado = await verificarLogin();
            funcionalidadMetodoEntrega(usuarioLogueado);
        }

        function funcionalidadMetodoEntrega(usuarioLogueado){
            const recogerEnTienda = document.getElementById('tienda');
            const envioDomilicio = document.getElementById('domicilio');
            let listaDirecciones = [];
            recogerEnTienda.addEventListener('click',function(){
                const formularioDireccion = document.querySelector('.contenedor__direccion-entrega');
                const contenedorListaDirecciones = document.querySelector('.contenedor__lista-direcciones');
                if (formularioDireccion){
                    formularioDireccion.remove();
                }
                 if (contenedorListaDirecciones){
                    contenedorListaDirecciones.remove();
                }
            });

            envioDomilicio.addEventListener('click', async function(){
                const formularioDireccion = document.querySelector('.contenedor__direccion-entrega');
                const contenedorListaDirecciones = document.querySelector('.contenedor__lista-direcciones');
                
                if (!formularioDireccion && !contenedorListaDirecciones){
                    const formulario = document.querySelector('.checkout__formulario');
                    if(usuarioLogueado){
                        if(listaDirecciones.length == 0){
                            listaDirecciones = await recuperarDirecciones();
                        }

                        //Tal ves una validación para revisar si se recuperó con exito las direcciones
                        crearListaDirecciones(listaDirecciones.direcciones);

                    }else{
                        const contenedorDireccionEntrega = crearFormularioDireccion(); 
                        formulario.appendChild(contenedorDireccionEntrega);
                    }
                }   
            });
            
        }

        function crearListaDirecciones(listaDirecciones){
            const formulario = document.querySelector('.checkout__formulario');
            const contenedorListaDirecciones = document.createElement('DIV');
            contenedorListaDirecciones.classList.add('contenedor__lista-direcciones');

            listaDirecciones.forEach(direccion => {
               const direccionLabel = crearElementoListaDirecciones(direccion);
                
                contenedorListaDirecciones.appendChild(direccionLabel);
            });

            if(listaDirecciones.length <= 0){
                const mensajeListaVacia = document.createElement('P');
                mensajeListaVacia.classList.add('direcciones-vacia');
                mensajeListaVacia.innerText = 'No Tienes ninguna direccion guardada';
                contenedorListaDirecciones.appendChild(mensajeListaVacia);
            }

            formulario.appendChild(contenedorListaDirecciones);

            const botonNuevaDireccion = document.createElement('button');
            botonNuevaDireccion.classList.add('boton');
            botonNuevaDireccion.classList.add('boton__nueva-direccion');
            botonNuevaDireccion.type = 'button';
            botonNuevaDireccion.innerText = 'Agregar Nueva Direccion';
            contenedorListaDirecciones.appendChild(botonNuevaDireccion);

            agregarFuncionalidadNuevaDireccion(botonNuevaDireccion, listaDirecciones)
            
        }

        function crearElementoListaDirecciones(direccion){
            const direccionLabel = document.createElement('LABEL');
            direccionLabel.classList.add('campo-direccionElegida');

            const direccionInputRadio = document.createElement('INPUT');
            direccionInputRadio.type = 'radio';
            direccionInputRadio.name = 'direccionElegida';
            direccionInputRadio.value = direccion.id;
            if(direccion.predeterminada == 1){
                direccionInputRadio.checked = true;
            }
                
            direccionLabel.appendChild(direccionInputRadio);

            const direccionDatos = document.createElement('P');
            direccionDatos.innerText = `${direccion.calle}, ${direccion.codigo_postal}, ${direccion.ciudad}, ${direccion.provincia}, ${direccion.pais}`;
            direccionLabel.appendChild(direccionDatos);

            return direccionLabel;
        }

        function agregarFuncionalidadNuevaDireccion(boton, listaDireccionesActual){
            boton.addEventListener('click',function(e){
                e.preventDefault();
                const modalExistente = document.querySelector('.modal');
                if(!modalExistente){
                    const body =  document.querySelector('body');
                    body.classList.add('modal--abierto');
                    crearModalNuevaDireccion(body,listaDireccionesActual);
                }
            });
        }

        function crearModalNuevaDireccion(body, listaDireccionesActual){
            const modal = document.createElement('DIV');
            modal.classList.add('modal');
            
            const formulario = document.createElement('FORM');
            formulario.classList.add('formulario');
            formulario.classList.add('modal__formulario');

            const formularioDireccion = crearFormularioDireccion();
            formulario.appendChild(formularioDireccion);

            const botonesModal = document.createElement('DIV');
            botonesModal.classList.add('modal__botones');

            const botonGuardar = document.createElement('BUTTON');
            botonGuardar.classList.add('boton');
            botonGuardar.type = 'button';
            botonGuardar.innerText = 'Guardar Direccion';
            botonesModal.appendChild(botonGuardar);

            const botonCancelar = document.createElement('BUTTON');
            botonCancelar.classList.add('boton');
            botonCancelar.type = 'button';
            botonCancelar.innerText = 'Cancelar';
            botonesModal.appendChild(botonCancelar);
            formulario.appendChild(botonesModal);

            modal.appendChild(formulario);

            botonGuardar.addEventListener('click',function(e){
                e.preventDefault();
                guardarDireccion(formulario, listaDireccionesActual);
            });

            botonCancelar.addEventListener('click', function(e){
                e.preventDefault();
                body.classList.remove('modal--abierto');
                modal.remove();
            });
            modal.addEventListener('click',function(e){
                if(e.target == modal){
                    body.classList.remove('modal--abierto');
                    modal.remove();
                }
            });

            body.appendChild(modal);
        }

        async function guardarDireccion(formulario, listaDireccionesActual){
            const modal = document.querySelector('.modal');
            const datosFormulario = new FormData(formulario);
            const resultado = await guardarNuevaDireccion(datosFormulario);
        
            limpiarAlertasFormulario(formulario);

            if(resultado.error){
                Object.entries(resultado.errores).forEach(([campo, mensaje]) => {
                    const input = formulario.querySelector(`[name = "${campo}"]`);
                    input.classList.add('input__error');
                    const contenedorInput = input.parentElement;
                    const mensajeError = contenedorInput.querySelector('.mensaje__error');
                    if(!mensajeError){
                        crearAlertaFormulario(contenedorInput,input,mensaje)
                    }
                });
            }else{
                const mensajeListaVacia = document.querySelector('.direcciones-vacia');
                const contenedorListaDirecciones = document.querySelector('.contenedor__lista-direcciones');
                const botonNuevaDireccion = document.querySelector('.boton__nueva-direccion');
                   
                actualizarListaDireccionesActual(listaDireccionesActual, resultado.direccion)
                if(contenedorListaDirecciones){
                const nuevaDireccion = crearElementoListaDirecciones(resultado.direccion);
                const input = nuevaDireccion.querySelector('input');
                input.checked = true;
                contenedorListaDirecciones.insertBefore(nuevaDireccion,botonNuevaDireccion);
                }   
                const body =  document.querySelector('body');
                body.classList.remove('modal--abierto');
                modal.remove();
                if(mensajeListaVacia){
                    mensajeListaVacia.remove();
                }
            }

        }

        function actualizarListaDireccionesActual(listaDirecciones, direccionAgregada){
            const nuevaDireccion = {
                id: `${direccionAgregada.id}`,
                usuario_id: '',
                calle: direccionAgregada.calle,
                ciudad: direccionAgregada.ciudad,
                provincia: direccionAgregada.provincia,
                codigo_postal: direccionAgregada.codigo_postal,
                pais: direccionAgregada.pais,
                fecha_creacion: null,
                fecha_actualizacion: null,
                predeterminada: '0'
            }
            listaDirecciones.push(nuevaDireccion)
            console.log(nuevaDireccion);
            console.log(listaDirecciones);
        }


        function crearFormularioDireccion(){
            
            const contenedorDireccionEntrega = document.createElement('DIV');
            contenedorDireccionEntrega.classList.add('contenedor__direccion-entrega');

            const legend = document.createElement('LEGEND');
            legend.innerText = 'Direccion de entrega';
            contenedorDireccionEntrega.appendChild(legend);

            //
            const contenedorCalle = document.createElement('DIV');
            contenedorCalle.classList.add('formulario__campo');

            const calleLabel = document.createElement('LABEL');
            calleLabel.htmlFor= 'calle';
            calleLabel.classList.add('formulario__label');
            calleLabel.innerText = 'Calle';
            contenedorCalle.appendChild(calleLabel);

            const calleInput = document.createElement('INPUT');
            calleInput.type = 'text';
            calleInput.name = 'calle';
            calleInput.id = 'calle';
            calleInput.placeholder = 'Ingresa tu direccion'
            calleInput.classList.add('formulario__input')
            calleInput.classList.add('campo-calle')
            contenedorCalle.appendChild(calleInput);
            contenedorDireccionEntrega.appendChild(contenedorCalle);

            //
            const contenedorCiudad = document.createElement('DIV');
            contenedorCiudad.classList.add('formulario__campo');

            const ciudadLabel = document.createElement('LABEL');
            ciudadLabel.htmlFor= 'ciudad';
            ciudadLabel.classList.add('formulario__label');
            ciudadLabel.innerText = 'ciudad';
            contenedorCiudad.appendChild(ciudadLabel);

            const ciudadInput = document.createElement('INPUT');
            ciudadInput.type = 'text';
            ciudadInput.name = 'ciudad';
            ciudadInput.id = 'ciudad';
            ciudadInput.placeholder = 'Ingresa tu ciudad'
            ciudadInput.classList.add('formulario__input')
            ciudadInput.classList.add('campo-ciudad')
            contenedorCiudad.appendChild(ciudadInput);
            contenedorDireccionEntrega.appendChild(contenedorCiudad);

            //
            const contenedorProvincia = document.createElement('DIV');
            contenedorProvincia.classList.add('formulario__campo');

            const provinciaLabel = document.createElement('LABEL');
            provinciaLabel.htmlFor= 'provincia';
            provinciaLabel.classList.add('formulario__label');
            provinciaLabel.innerText = 'provincia';
            contenedorProvincia.appendChild(provinciaLabel);

            const provinciaInput = document.createElement('INPUT');
            provinciaInput.type = 'text';
            provinciaInput.name = 'provincia';
            provinciaInput.id = 'provincia';
            provinciaInput.placeholder = 'Ingresa tu provincia'
            provinciaInput.classList.add('formulario__input')
            provinciaInput.classList.add('campo-provincia')
            contenedorProvincia.appendChild(provinciaInput);
            contenedorDireccionEntrega.appendChild(contenedorProvincia);

            //
            const contenedorCodigoPostal = document.createElement('DIV');
            contenedorCodigoPostal.classList.add('formulario__campo');

            const codigoPostalLabel = document.createElement('LABEL');
            codigoPostalLabel.htmlFor= 'codigo_postal';
            codigoPostalLabel.classList.add('formulario__label');
            codigoPostalLabel.innerText = 'codigo Postal';
            contenedorCodigoPostal.appendChild(codigoPostalLabel);

            const codigoPostalInput = document.createElement('INPUT');
            codigoPostalInput.type = 'text';
            codigoPostalInput.name = 'codigo_postal';
            codigoPostalInput.id = 'codigo_postal';
            codigoPostalInput.placeholder = 'Ingresa tu codigo postal'
            codigoPostalInput.classList.add('formulario__input')
            codigoPostalInput.classList.add('campo-codigo_postal')
            contenedorCodigoPostal.appendChild(codigoPostalInput);
            contenedorDireccionEntrega.appendChild(contenedorCodigoPostal);

            //
            const listaPaises = [
                {codigo:"ES", nombre:"España"}, 
                {codigo:"PT", nombre:"Portugal"}, 
                {codigo: "FR", nombre:"Francia"}
            ];

            const contenedorPais = document.createElement('DIV');
            contenedorPais.classList.add('formulario__campo');

            const paisLabel = document.createElement('LABEL');
            paisLabel.htmlFor= 'pais';
            paisLabel.classList.add('formulario__label');
            paisLabel.innerText = 'pais';
            contenedorPais.appendChild(paisLabel);

            const paisSelect = document.createElement('SELECT');
            paisSelect.name = 'pais';
            paisSelect.id = 'pais';
            paisSelect.classList.add('formulario__input')
            paisSelect.classList.add('campo-pais')
            paisSelect.required = true;

            const paisOption = document.createElement('OPTION');
            paisOption.value = '';
            paisOption.disabled = true;
            paisOption.selected = true;
            paisOption.innerText= 'Seleccione un país';
            paisSelect.appendChild(paisOption);

            crearOptionsPais(listaPaises,paisSelect);

            contenedorPais.appendChild(paisSelect);
            contenedorDireccionEntrega.appendChild(contenedorPais);

            return contenedorDireccionEntrega;
        }

        function crearOptionsPais(listaPaises,paisSelect){
             listaPaises.forEach(pais=>{
                const paisOption = document.createElement('OPTION');
                paisOption.value = pais.codigo;
                paisOption.innerText= pais.nombre;
                paisSelect.appendChild(paisOption);
             });
        }
        //Crea una alerta y la inserta antes del input afectado
        function crearAlertaFormulario(contenedor,input,mensaje){
            console.log('no olvides cambiar los datos aqui para terminar de definir las alertas nuevas');
            const alerta = document.createElement('P');
            alerta.classList.add('mensaje__error');
            alerta.innerText = mensaje;

            contenedor.insertBefore(alerta,input);
        }

        //Limpia los mensajes ya existentes y quita la clase error a los input para volver a validar
        function limpiarAlertasFormulario(formulario){
            const mensajesError = formulario.querySelectorAll('.mensaje__error');
            const inputsError = formulario.querySelectorAll('.input__error');
            if(mensajesError){
                    mensajesError.forEach(mensaje => {
                    mensaje.remove();
                });
            }
            if(inputsError){
                    inputsError.forEach(input => {
                    input.classList.remove('input__error');
                });
            }
        }
          

        async function recuperarCarritoLocal(){
            const carritoRecuperado = JSON.parse(localStorage.getItem('carrito') || '[]');
            const productos_id = carritoRecuperado.map(carrito_producto=>{
                return{
                    producto_id: carrito_producto.producto_id
                }
            });

            const datosProductos = await recuperarDatosProductos(productos_id);

            const carritoRearmado = (datosProductos.productos).map(producto=>{

                const cantidadBuscada = carritoRecuperado.find(productoRecuperado => productoRecuperado.producto_id === producto.id)
                return{
                    ...producto,
                    cantidad: cantidadBuscada.cantidad
                }
            });
            crearResumenCompra(carritoRearmado);
            botonPaypal(carritoRecuperado);
        }

        function crearResumenCompra(carrito){
            let cantidadTotal = 0;
            let totalAPagar = 0;
            carrito.forEach(producto=>{
                cantidadTotal += producto.cantidad;
                totalAPagar += (producto.cantidad * Number(producto.precio));
            });

            const contenedorCarrito = document.querySelector('.carrito');
            
            const resumenCarrito = document.createElement('DIV');
            resumenCarrito.classList.add('carrito__resumen');
            
            const contenedorResumenPrecioFinal= document.createElement('DIV');
            contenedorResumenPrecioFinal.classList.add('carrito__resumen-precio');

            const contadorCarrito = document.createElement('P');
            contadorCarrito.classList.add('contador-carrito');
            const cantidadContador = document.createElement('B');
            cantidadContador.innerText = `${cantidadTotal}`;
            contadorCarrito.appendChild(cantidadContador);
            contadorCarrito.append(' articulos en tu pedido');
            contenedorResumenPrecioFinal.appendChild(contadorCarrito);

            const precioFinal = document.createElement('P');
            precioFinal.classList.add('precio-final');
            precioFinal.innerText =  `$ ${totalAPagar.toFixed(2)}`
            contenedorResumenPrecioFinal.appendChild(precioFinal);

            resumenCarrito.appendChild(contenedorResumenPrecioFinal);

            const carritoDetallado = document.createElement('BUTTON');
            carritoDetallado.type = 'button';
            carritoDetallado.classList.add('boton');
            carritoDetallado.innerText = 'Expandir Carrito';
            funcionalidadCarritoDetallado(carritoDetallado,carrito);

            resumenCarrito.appendChild(carritoDetallado);

            contenedorCarrito.appendChild(resumenCarrito);
        }

        function funcionalidadCarritoDetallado(boton, carrito = []){
            const bodyPagina = document.querySelector('body');
            const modalExistente = document.querySelector('.modal');
            boton.addEventListener('click', function(e){
                e.preventDefault;
         
                if(!modalExistente){
                    let precioTotal = 0;
                    bodyPagina.classList.add('modal--abierto');
                    const modal = document.createElement('DIV');
                    modal.classList.add('modal');

                    const botonCerrar = document.createElement('BUTTON');
                    botonCerrar.classList.add('boton');
                    botonCerrar.innerText = 'Cerrar';
                    modal.appendChild(botonCerrar);

                    const contenedorCarritoDetallado = document.createElement('DIV');
                    contenedorCarritoDetallado.classList.add('carrito__detallado');

                    const carritoDetallado = document.createElement('UL');
                    carritoDetallado.classList.add('carrito__lista');
                    contenedorCarritoDetallado.appendChild(carritoDetallado);

                    carrito.forEach(producto=>{
                        const articuloCarrito = crearArticuloCarrito(producto);
                        carritoDetallado.appendChild(articuloCarrito);
                        precioTotal += Number(producto.precio) * producto.cantidad;

                    });

                    const contenedorPrecioTotal = document.createElement('DIV');
                    contenedorPrecioTotal.classList.add('contenedor__precio-total');
                    
                    const textoPrecioTotal = document.createElement('P');
                    textoPrecioTotal.innerText = 'Total a pagar:'
                    contenedorPrecioTotal.appendChild(textoPrecioTotal);

                    const valorPrecioTotal = document.createElement('P');
                    valorPrecioTotal.innerText = `$${precioTotal.toFixed(2)}`;
                    contenedorPrecioTotal.appendChild(valorPrecioTotal);

                    contenedorCarritoDetallado.appendChild(contenedorPrecioTotal);


                    modal.addEventListener('click',function(e){
                        if(e.target == modal){
                            bodyPagina.classList.remove('modal--abierto');
                            modal.remove();
                        }
                    });

                    botonCerrar.addEventListener('click',function(e){       
                        bodyPagina.classList.remove('modal--abierto');
                        modal.remove();
                    });

                    modal.appendChild(contenedorCarritoDetallado);

                    bodyPagina.appendChild(modal);
                }
                
            });
        }

        function crearArticuloCarrito(producto){
            const articuloCarrito = document.createElement('LI');
            articuloCarrito.classList.add('carrito__articulo')
            articuloCarrito.classList.add('articulo')

            const contenedorImagenDatos = document.createElement('DIV');
            contenedorImagenDatos.classList.add('contenedor__imagen-datos');

            const imagenArticulo = document.createElement('IMG');
            imagenArticulo.src = `/img/productos/${producto.imagen}_thumb.webp`;
            imagenArticulo.alt = 'Imagen Producto';
            imagenArticulo.classList.add('articulo__imagen');
            contenedorImagenDatos.appendChild(imagenArticulo);

            const contenedorDatosArticulo = document.createElement('DIV');
            contenedorDatosArticulo.classList.add('articulo__datos');

            const nombreArticulo = document.createElement('P');
            nombreArticulo.classList.add('articulo__nombre');
            nombreArticulo.innerText = producto.nombre;
            contenedorDatosArticulo.appendChild(nombreArticulo);

            const contenedorCantidadPrecio = document.createElement('DIV');
            contenedorCantidadPrecio.classList.add('articulo__cantidad-precio');
            
            const cantidadArticulo = document.createElement('P');
            cantidadArticulo.classList.add('articulo__cantidad');
            cantidadArticulo.innerText = `X${producto.cantidad}`;
            contenedorCantidadPrecio.appendChild(cantidadArticulo);

            const precioArticulo = document.createElement('P');
            precioArticulo.classList.add('articulo__precio');
            precioArticulo.innerText = `@${producto.precio}`;
            contenedorCantidadPrecio.appendChild(precioArticulo);

            contenedorDatosArticulo.appendChild(contenedorCantidadPrecio);

            contenedorImagenDatos.appendChild(contenedorDatosArticulo);

            articuloCarrito.appendChild(contenedorImagenDatos);

            const subtotalArticulo = document.createElement('P');
            subtotalArticulo.classList.add('articulo__subtotal');
            subtotalArticulo.innerText = `$${(Number(producto.precio) * producto.cantidad).toFixed(2)}`;
            articuloCarrito.appendChild(subtotalArticulo);

            return articuloCarrito;
        }

        function normalizarDatosPedido(carrito,datosFormulario, orderId){
            const datosClienteNormalizado = {
                        nombre: datosFormulario.datosCliente.nombre,
                        apellido: datosFormulario.datosCliente.apellido,
                        email: datosFormulario.datosCliente.email,
                        telefono: datosFormulario.datosCliente.telefono
                    }

            let datosPedido = {
                datosCarrito: carrito, 
                datosCliente: datosClienteNormalizado, 
                tipoEntrega: datosFormulario.tipoEntrega,
                pedidoIdPaypal: orderId
            };

            if(datosFormulario.tipoEntrega == 'domicilio'){
                const direccionClienteNormalizada = {
                calle: datosFormulario.direccionCliente.calle,
                ciudad: datosFormulario.direccionCliente.ciudad,
                provincia: datosFormulario.direccionCliente.provincia,
                codigo_postal: datosFormulario.direccionCliente.codigo_postal,
                pais: datosFormulario.direccionCliente.pais
                }

                datosPedido.direccionCliente = direccionClienteNormalizada;
            }
            return datosPedido;
        }

        async function validarFormulario(){
            let error = false;
            
            const formulario = document.querySelector('.checkout__formulario');

            limpiarAlertasFormulario(formulario);
            const datosCliente = new FormData(formulario);
            error = await validarEntradasFormularios(datosCliente);
            if(error == true){
                return 'error';
            }else{
                const resultado= await validarDatosFormulario(datosCliente);
                if(resultado.error ==true){
                    
                    Object.entries(resultado.errores).forEach(([campo,mensaje]) => {
                        const input = document.querySelector(`.campo-${campo}`);
                        const contenedorInput = input.parentElement;

                        input.classList.add('input__error');
                        crearAlertaFormulario(contenedorInput,input,mensaje);
                    });       
                }     
                return resultado;
            }
        }

        async function validarEntradasFormularios(formulario){
            const usuarioLogueado = await verificarLogin();
            let error = false;
            let inputPais = false;
            let inputDireccionElegida = false;
            let tipoEntrega = 'tienda';
            formulario.forEach((valor,campo)=>{
                
                if(valor.trim() == ''){
                    error = true;
                    insertarMensajeError(campo);
                }
                
                if (campo == 'email' && valor.trim() !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor)){
                    error = true;
                    insertarMensajeError(campo, 'emailFormato');
                }
                

                if(campo == 'telefono' && valor.trim() !== ''){
                    const telefonoNormalizado = valor.replace(/\D/g, '')
                    if(!/^\+?[0-9\s\-()]+$/.test(valor)){
                        error = true;
                        insertarMensajeError(campo, 'telefonoFormato');
                    }else if(telefonoNormalizado.length < 7 || telefonoNormalizado.length > 15){
                        error = true;
                        insertarMensajeError(campo, 'telefonoLongitud');
                    }
                }
                

                if(campo == 'entrega' && valor != 'tienda' && valor != 'domicilio'){
                    error = true;
                        insertarMensajeError(campo, 'entregaNoValida');
                }
                

                if(campo == 'entrega' && valor == 'domicilio'){
                    tipoEntrega = 'domicilio';
                }

                if(campo == 'direccionElegida' && usuarioLogueado == true){
                    inputDireccionElegida = true;
                }
                if(campo == 'pais' && usuarioLogueado == false ){
                    inputPais = true;
                    const codigosPaises = ['ES', 'PT', 'FR'];
                    if(!codigosPaises.includes(valor)){
                        error = true;
                        insertarMensajeError(campo, 'paisNoValido');
                    }
                }

            });

            if(tipoEntrega == 'domicilio'){
                if(usuarioLogueado == false && inputPais == false){
                    error = true;
                    insertarMensajeError('pais', 'paisVacio');
                }
                
                if(usuarioLogueado == true && inputDireccionElegida == false){
                    error = true;
                    insertarMensajeError('direccionElegida', 'direccionElegidaVacia');
                }
            }
            return error;
        }

        function insertarMensajeError(campo, campoAfectado = campo){
                const input = document.querySelector(`.campo-${campo}`);
                const contenedorInput = input.parentElement;
                const mensajeError = generarMensajeError(campoAfectado);

                input.classList.add('input__error');
                crearAlertaFormulario(contenedorInput,input,mensajeError);
        }

        function generarMensajeError(campo){
            let mensaje;
            switch(campo){
                case 'nombre':
                    mensaje = 'El nombre no puede ir vacio'
                break;

                case 'apellido':
                    mensaje = 'El apellido no puede ir vacio'
                break;

                case 'email':
                    mensaje = 'El email no puede ir vacio'
                break;

                case 'emailFormato':
                    mensaje = 'Formato de e-mail erroneo'
                break;

                case 'telefono':
                    mensaje = 'El telefono no puede ir vacio'
                break;

                case 'telefonoFormato':
                    mensaje = 'Formato de telefono erroneo. Solo se aceptan numeros, espacios y guiones'
                break;

                case 'telefonoLongitud':
                    mensaje = 'El telefono debe contener entre 7 y 15 numeros'
                break;

                case 'entregaNoValida':
                    mensaje = 'La opcion de entrega es invalida por favor recargue la pagina o intentelo mas tarde'
                break;

                case 'calle':
                    mensaje = 'La calle no puede ir vacia'
                break;

                case 'ciudad':
                    mensaje = 'La ciudad no puede ir vacia'
                break;

                case 'provincia':
                    mensaje = 'La provincia no puede ir vacia'
                break;

                case 'codigo_postal':
                    mensaje = 'El codigo postal no puede ir vacio'
                break;

                case 'paisVacio':
                    mensaje = 'Debe seleccionar un país'
                break;

                case 'paisNoValido':
                    mensaje = 'Error con la opcion elegida, recargue la pagina e intentelo de nuevo'
                break;

                case 'direccionElegidaVacia':
                    mensaje = 'Elija una dirección de envio o cree una nueva'
                break;
            }

            return mensaje;
        }

        function botonPaypal(carritoRecuperado){
            let datosFormulario = '';
            const paypalButtons = window.paypal.Buttons({
                style: {
                    shape: "rect",
                    layout: "vertical",
                    color: "gold",
                    label: "paypal",
                },
                
                async onClick(data, actions){
                    datosFormulario = await validarFormulario();
                    if(datosFormulario.error == true || datosFormulario == 'error'){
                        return actions.reject();
                    } 
               
                    return actions.resolve(); 
                },
                async createOrder() {
                        try {
                            const response = await fetch("/api/orders", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                },
                                body: JSON.stringify({
                                    cart: carritoRecuperado,
                                    shipping: datosFormulario['direccionCliente'],
                                    clientName: datosFormulario['datosCliente']['nombre'] + ' ' + datosFormulario['datosCliente']['apellido']
                                }),
                            });

                            const orderData = await response.json();

                            if (orderData.id) {
                                return orderData.id;
                            }
                            const errorDetail = orderData?.details?.[0];
                            const errorMessage = errorDetail
                                ? `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})`
                                : JSON.stringify(orderData);

                            throw new Error(errorMessage);
                        } catch (error) {
                            console.error(error);
                            // resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
                        }
                    },
                async onApprove(data, actions) {
                        try {
                            const response = await fetch(
                                `/api/orders/capture`,
                                {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                    },
                                    body: JSON.stringify({
                                    orderID: data.orderID,
                                    }),
                                }
                            );

                            const orderData = await response.json();
                            // Three cases to handle:
                            //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                            //   (2) Other non-recoverable errors -> Show a failure message
                            //   (3) Successful transaction -> Show confirmation or thank you message

                            const errorDetail = orderData?.details?.[0];

                            if (errorDetail?.issue === "INSTRUMENT_DECLINED") {
                                // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                                // recoverable state, per
                                // https://developer.paypal.com/docs/checkout/standard/customize/handle-funding-failures/
                                return actions.restart();
                            } else if (errorDetail) {
                                // (2) Other non-recoverable errors -> Show a failure message
                                throw new Error(
                                    `${errorDetail.description} (${orderData.debug_id})`
                                );
                            } else if (!orderData.purchase_units) {
                                throw new Error(JSON.stringify(orderData));
                            } else {
                                // (3) Successful transaction -> Show confirmation or thank you message
                                // Or go to another URL:  actions.redirect('thank_you.html');
                                const transaction =
                                    orderData?.purchase_units?.[0]?.payments?.captures?.[0] ||
                                    orderData?.purchase_units?.[0]?.payments
                                        ?.authorizations?.[0];
                                resultMessage(
                                    `Transaction ${transaction.status}: ${transaction.id}<br>
                        <br>See console for all available details`
                                );
                                // console.log(
                                //     "Capture result",
                                //     orderData,
                                //     JSON.stringify(orderData, null, 2)
                                // );
                                const datosPedido = normalizarDatosPedido(carritoRecuperado,datosFormulario,data.orderID);
                                resultadoGuardar = await guardarDatosPedido(datosPedido);

                                if(resultadoGuardar.error === true){
                                    throw new Error(`${resultadoGuardar.mensaje}`);
                                }else{
                                    console.log('gracias por su compra')
                                    localStorage.removeItem('carrito')
                                }
                            }
                        } catch (error) {
                            console.error(error);
                            resultMessage(
                                `Sorry, your transaction could not be processed...<br><br>${error}`
                            );
                        }
                    },

                
            });
            paypalButtons.render("#paypal-button-container");


            // Example function to show a result to the user. Your site's UI library can be used instead.
            function resultMessage(message) {
                const container = document.querySelector("#result-message");
                container.innerHTML = message;
            }
        }

        //Funciones para llamar APIS
        async function verificarLogin(){
            const url = `/api/verificarLogin`;
            resultado = await fetch(url);
            respuesta = await resultado.json();

            return respuesta;
        }

        async function recuperarDirecciones(){
            const url = `/api/recuperarDirecciones`;
            resultado = await fetch(url);
            respuesta = await resultado.json();

            return respuesta;
        }

        async function guardarNuevaDireccion(direccion){
            const url = `/api/guardarNuevaDireccion`;
            resultado = await fetch(url,{
                method: 'POST',
                body: direccion
            });
            respuesta = await resultado.json();
            return respuesta;
        }

        async function recuperarDatosProductos(productos){
            const url = `/api/recuperarDatosProductos`;
            resultado = await fetch(url,{
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json' 
                },
                body: JSON.stringify(productos)
            });
            respuesta = await resultado.json();
            return respuesta;
        }

        async function validarDatosFormulario(datosFormulario){
            const url = `/api/validarDatosFormulario`;
            resultado = await fetch(url,{
                method: 'POST',
                body: datosFormulario
            });
            respuesta = await resultado.json();
            return respuesta;
        }

          async function guardarDatosPedido(datosPedido){
            const url = `/api/guardarDatosPedido`;
            resultado = await fetch(url,{
                method: 'POST',
                 headers: { 
                    'Content-Type': 'application/json' 
                },
                body: JSON.stringify(datosPedido)
            });
            respuesta = await resultado.json();
            return respuesta;
        }

    }//Fin de la verificacion que revisa estar en la pagina correcta 
})();