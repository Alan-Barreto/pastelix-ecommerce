(function(){
    usuario = document.querySelector('.usuario');

    if(usuario){
        miCuenta = document.querySelector('.datos__contenedor')
        if(miCuenta){
            const abrirDatos = document.querySelector('.modificar')

            const abrirCorreo = document.querySelector('.correo')

            const abrirContraseña = document.querySelector('.contraseña')
            
            abrirDatos.addEventListener('click', function(){
                crearFormulario('datos');
            });

            abrirCorreo.addEventListener('click', function(){
                crearFormulario('correo');             
            });

            abrirContraseña.addEventListener('click', function(){
                crearFormulario('contraseña');
            });


            function crearFormulario(tipo){
                const existente = document.querySelector(`.formulario-${tipo}`);

                if(existente){
                    existente.remove();
                    return
                }

                limpiarFormularios();

                switch(tipo){
                    case 'datos':
                        crearFormularioDatos();
                        break;

                    case 'correo':
                        crearFormularioCorreo();
                        break;

                    case 'contraseña':
                        crearFormularioContraseña();
                        break;
                }
            }

            function limpiarFormularios(){
                document.querySelector(".formulario-datos")?.remove();
                document.querySelector(".formulario-correo")?.remove();
                document.querySelector(".formulario-contraseña")?.remove();
            }

            function crearFormularioDatos(){
                const elementoNombre = document.querySelector('.usuario__nombre');
                const datoNombre = elementoNombre.innerText.split(":")[1]?.trim();

                const elementoApellido = document.querySelector('.usuario__apellido');
                const datoApellido = elementoApellido.innerText.split(":")[1]?.trim()

                const elementoTelefono = document.querySelector('.usuario__telefono');
                const datoTelefono = elementoTelefono.innerText.split(":")[1]?.trim()

                const formularioDatos = document.createElement('FORM');
                formularioDatos.classList.add('formulario');
                formularioDatos.classList.add('formulario-datos');
                formularioDatos.method = 'POST';

                const formularioContenedor = document.createElement('DIV');
                console.log('Arreglar esta linea cuando se termine la apariencia del contenedor');
                formularioContenedor.classList.add('formulario__contenedor.');

                const campoNombre = document.createElement('DIV');
                campoNombre.classList.add('formulario__campo');

                const labelNombre = document.createElement('LABEL');
                labelNombre.classList.add('formulario__label');
                labelNombre.htmlFor = 'nombre';
                labelNombre.innerText = 'Nombre';
                campoNombre.appendChild(labelNombre);

                const inputNombre = document.createElement('INPUT');
                inputNombre.classList.add('formulario__input');
                inputNombre.type = 'text';
                inputNombre.name = 'nombre';
                inputNombre.id = 'nombre';
                inputNombre.placeholder = 'Ingresa tu nombre';
                inputNombre.value = datoNombre;
                campoNombre.appendChild(inputNombre);

                formularioContenedor.appendChild(campoNombre);

                const campoApellido = document.createElement('DIV');
                campoApellido.classList.add('formulario__campo');

                const labelApellido = document.createElement('LABEL');
                labelApellido.classList.add('formulario__label');
                labelApellido.htmlFor = 'apellido';
                labelApellido.innerText = 'Apellido';
                campoApellido.appendChild(labelApellido);

                const inputApellido = document.createElement('INPUT');
                inputApellido.classList.add('formulario__input');
                inputApellido.type = 'text';
                inputApellido.name = 'apellido';
                inputApellido.id = 'apellido';
                inputApellido.placeholder = 'Ingresa tu apellido';
                inputApellido.value = datoApellido;
                campoApellido.appendChild(inputApellido);

                formularioContenedor.appendChild(campoApellido);

                const campoTelefono = document.createElement('DIV');
                campoTelefono.classList.add('formulario__campo');

                const labelTelefono = document.createElement('LABEL');
                labelTelefono.classList.add('formulario__label');
                labelTelefono.htmlFor = 'telefono';
                labelTelefono.innerText = 'Telefono';
                campoTelefono.appendChild(labelTelefono);

                const inputTelefono = document.createElement('INPUT');
                inputTelefono.classList.add('formulario__input');
                inputTelefono.type = 'text';
                inputTelefono.name = 'telefono';
                inputTelefono.id = 'telefono';
                inputTelefono.placeholder = 'Ingresa tu Telefono';
                inputTelefono.value = datoTelefono;
                campoTelefono.appendChild(inputTelefono);

                formularioContenedor.appendChild(campoTelefono);

                formularioDatos.appendChild(formularioContenedor);

                const contenedorAcciones = document.createElement('DIV');
                contenedorAcciones.classList.add('formulario__acciones');

                const botonSubmit = document.createElement('INPUT');
                botonSubmit.classList.add('formulario__submit');
                botonSubmit.type = 'submit';
                botonSubmit.value = 'Actualizar';
                contenedorAcciones.appendChild(botonSubmit);

                const botonCancelar = document.createElement('BUTTON');
                botonCancelar.classList.add('formulario__submit');
                botonCancelar.classList.add('boton-cancelar');
                botonCancelar.innerText = 'Cancelar';
                contenedorAcciones.appendChild(botonCancelar);

                formularioDatos.appendChild(contenedorAcciones);

                botonSubmit.addEventListener('click', (e) =>{
                    e.preventDefault();

                    limpiarAlertas();

                    const datosActuales = {nombre: elementoNombre, apellido: elementoApellido, telefono: elementoTelefono};
                    validarFormularioDatos(formularioDatos, datosActuales);
                });

                botonCancelar.addEventListener('click', function(e){
                    e.preventDefault();
                    formularioDatos.remove();
                })

                document.querySelector('.datos__contenedor').appendChild(formularioDatos);
            }

            function crearFormularioCorreo(){
                const elementoCorreo = document.querySelector('.usuario__email');
                const datoCorreo = elementoCorreo.innerText.split(":")[1]?.trim();


                const formularioCorreo = document.createElement('FORM');
                formularioCorreo.classList.add('formulario');
                formularioCorreo.classList.add('formulario-correo');
                formularioCorreo.method = 'POST';

                const campoCorreo = document.createElement('DIV');
                campoCorreo.classList.add('formulario__campo');

                const labelCorreo = document.createElement('LABEL');
                labelCorreo.classList.add('formulario__label');
                labelCorreo.htmlFor = 'correo';
                labelCorreo.innerText = 'Correo';
                campoCorreo.appendChild(labelCorreo);

                const inputCorreo = document.createElement('INPUT');
                inputCorreo.classList.add('formulario__input');
                inputCorreo.type = 'email';
                inputCorreo.name = 'correo';
                inputCorreo.id = 'correo';
                inputCorreo.placeholder = 'Ingresa tu Correo';
                inputCorreo.value = datoCorreo;
                campoCorreo.appendChild(inputCorreo);

                formularioCorreo.appendChild(campoCorreo);


                const contenedorAcciones = document.createElement('DIV');
                contenedorAcciones.classList.add('formulario__acciones');

                const botonSubmit = document.createElement('INPUT');
                botonSubmit.classList.add('formulario__submit');
                botonSubmit.type = 'submit';
                botonSubmit.value = 'Actualizar';
                contenedorAcciones.appendChild(botonSubmit);

                const botonCancelar = document.createElement('BUTTON');
                botonCancelar.classList.add('formulario__submit');
                botonCancelar.classList.add('boton-cancelar');
                botonCancelar.innerText = 'Cancelar';
                contenedorAcciones.appendChild(botonCancelar);

                formularioCorreo.appendChild(contenedorAcciones);


                botonCancelar.addEventListener('click', function(e){
                    e.preventDefault();
                    formularioCorreo.remove();
                })

                botonSubmit.addEventListener('click', (e) =>{
                    e.preventDefault();

                    limpiarAlertas();

                    validarFormularioCorreo(formularioCorreo);
                });

                document.querySelector('.datos__contenedor').appendChild(formularioCorreo);
            }

            function crearFormularioContraseña(){
            
                const formularioContraseña = document.createElement('FORM');
                formularioContraseña.classList.add('formulario');
                formularioContraseña.classList.add('formulario-contraseña');
                formularioContraseña.method = 'POST';

                const campoContraseñaActual = document.createElement('DIV');
                campoContraseñaActual.classList.add('formulario__campo');

                const labelContraseñaActual = document.createElement('LABEL');
                labelContraseñaActual.classList.add('formulario__label');
                labelContraseñaActual.htmlFor = 'contraseñaActual';
                labelContraseñaActual.innerText = 'Contraseña Actual';
                campoContraseñaActual.appendChild(labelContraseñaActual);

                const inputContraseñaActual = document.createElement('INPUT');
                inputContraseñaActual.classList.add('formulario__input');
                inputContraseñaActual.type = 'password';
                inputContraseñaActual.name = 'contraseñaActual';
                inputContraseñaActual.id = 'contraseñaActual';
                inputContraseñaActual.placeholder = 'Ingresa tu Contraseña';
                campoContraseñaActual.appendChild(inputContraseñaActual);

                formularioContraseña.appendChild(campoContraseñaActual);

                const campoContraseñaNueva = document.createElement('DIV');
                campoContraseñaNueva.classList.add('formulario__campo');

                const labelContraseñaNueva = document.createElement('LABEL');
                labelContraseñaNueva.classList.add('formulario__label');
                labelContraseñaNueva.htmlFor = 'contraseñaNueva';
                labelContraseñaNueva.innerText = 'Nueva Contraseña';
                campoContraseñaNueva.appendChild(labelContraseñaNueva);

                const inputContraseñaNueva = document.createElement('INPUT');
                inputContraseñaNueva.classList.add('formulario__input');
                inputContraseñaNueva.type = 'password';
                inputContraseñaNueva.name = 'contraseñaNueva';
                inputContraseñaNueva.id = 'contraseñaNueva';
                inputContraseñaNueva.placeholder = 'Elige tu nueva Contraseña';
                campoContraseñaNueva.appendChild(inputContraseñaNueva);

                formularioContraseña.appendChild(campoContraseñaNueva);

                const contenedorAcciones = document.createElement('DIV');
                contenedorAcciones.classList.add('formulario__acciones');

                const botonSubmit = document.createElement('INPUT');
                botonSubmit.classList.add('formulario__submit');
                botonSubmit.type = 'submit';
                botonSubmit.value = 'Actualizar';
                contenedorAcciones.appendChild(botonSubmit);

                const botonCancelar = document.createElement('BUTTON');
                botonCancelar.classList.add('formulario__submit');
                botonCancelar.classList.add('boton-cancelar');
                botonCancelar.innerText = 'Cancelar';
                contenedorAcciones.appendChild(botonCancelar);

                formularioContraseña.appendChild(contenedorAcciones);


                botonCancelar.addEventListener('click', function(e){
                    e.preventDefault();
                    formularioContraseña.remove();
                });

                botonSubmit.addEventListener('click', (e) =>{
                    e.preventDefault();

                    limpiarAlertas();

                    validarFormularioContraseña(formularioContraseña);
                });

                document.querySelector('.datos__contenedor').appendChild(formularioContraseña);
            }

            function validarFormularioDatos(formulario, datosActuales){
                const inputNombre =formulario.querySelector('#nombre');
                const nombreNuevo = inputNombre.value.trim();
                const inputApellido = formulario.querySelector('#apellido');
                const apellidoNuevo = inputApellido.value.trim();
                const inputTelefono = formulario.querySelector('#telefono');
                const telefonoNuevo = inputTelefono.value.trim();

                const datosFormulario = new FormData(formulario);
                datosFormulario.append('tipo_formulario', 'datos');
                validarFormularioUsuario(datosFormulario)
                    .then(resultado => {    
                        if(resultado['error'] == true){

                            if(resultado['errores']?.general){
                                crearAlertaGeneral(formulario, resultado['errores'].general);
                            }else{
                                Object.entries(resultado['errores']).forEach(([campo, mensaje])=> {
                                    const input = formulario.querySelector(`#${campo}`);
                                    crearAlertaCampo(input, mensaje);
                                });
                            }
                            
                        }else{
                            guardarNuevosDatos(datosFormulario)
                            .then(resultado => {                          
                                if(resultado.error == true){
                                    generarMensaje(resultado.mensaje, 'error');
                                }else {
                                    generarMensaje(resultado.mensaje, 'exito');
                                    formulario.remove();
                                    datosActuales.nombre.childNodes[2].nodeValue = nombreNuevo;
                                    datosActuales.apellido.childNodes[2].nodeValue = apellidoNuevo;
                                    datosActuales.telefono.childNodes[2].nodeValue = telefonoNuevo;
                                    
                                }

                            });
                        }
                });
            }

            function validarFormularioCorreo(formulario){

                const datosFormulario = new FormData(formulario);
                datosFormulario.append('tipo_formulario', 'correo');
                validarFormularioUsuario(datosFormulario)
                    .then(resultado => {    
                        if(resultado['error'] == true){
                            Object.entries(resultado['errores']).forEach(([campo, mensaje])=> {
                                const input = formulario.querySelector(`#${campo}`);
                                crearAlertaCampo(input, mensaje);
                            });
                        }else{
                            guardarNuevosDatos(datosFormulario)
                            .then(resultado => {                          
                                if(resultado.error == true){
                                    generarMensaje(resultado.mensaje, 'error');
                                }else {
                                    generarMensaje(resultado.mensaje, 'exito');
                                    formulario.remove();
                                }

                            });
                        }
                });
            }

            function validarFormularioContraseña(formulario){           

                const datosFormulario = new FormData(formulario);
                datosFormulario.append('tipo_formulario', 'contraseña');
                validarFormularioUsuario(datosFormulario)
                    .then(resultado => {    
                        if(resultado['error'] == true){
                            Object.entries(resultado['errores']).forEach(([campo, mensaje])=> {
                                const input = formulario.querySelector(`#${campo}`);
                                crearAlertaCampo(input, mensaje);
                            });
                        }else{
                            guardarNuevosDatos(datosFormulario)
                            .then(resultado => {                          
                                if(resultado.error == true){
                                    generarMensaje(resultado.mensaje, 'error');
                                }else {
                                    generarMensaje(resultado.mensaje, 'exito');
                                    formulario.remove();
                                }

                            });
                        }
                    });
            }

            function crearAlertaCampo(input, mensaje){
                const campo = input.parentElement;
                const alerta = generarAlerta(mensaje);

                input.classList.add('formulario__input--error');
                campo.appendChild(alerta);
            }

            function crearAlertaGeneral(formulario, mensaje){
                const contenedorAcciones = formulario.querySelector('.formulario__acciones');

                const alerta = generarAlerta(mensaje);
                alerta.classList.add('mensaje__error--general');

                formulario.insertBefore(alerta, contenedorAcciones);
            }

            function generarAlerta(mensaje){
                const alerta = document.createElement('P');
                alerta.classList.add('mensaje__error');
                alerta.innerText = mensaje;

                return alerta;
            }

            function generarMensaje(mensaje, tipo){
                const contenedor = document.querySelector('.datos__contenedor');
                const alerta = document.createElement('DIV');
                alerta.classList.add('alerta');
                alerta.classList.add(`alerta__${tipo}`);
                alerta.innerText = mensaje;
                    
                contenedor.appendChild(alerta);

                if(tipo == 'exito'){
                    setTimeout(() => alerta.remove(), 3000);   
                }
            }

            function limpiarAlertas(){
                const listaAlertas = document.querySelectorAll('.mensaje__error');

                listaAlertas.forEach(error => {
                    error.remove();                   
                });

                const listaCampos = document.querySelectorAll('.formulario__input')

                listaCampos.forEach(campo => {
                    campo.classList.remove('formulario__input--error');               
                });

                const mensajeError = document.querySelector('.alerta__error');
                if(mensajeError){
                    mensajeError.remove();
                }
            }


            async function validarFormularioUsuario(datosFormulario){
                const url = `/api/validarFormularioUsuario`;
                resultado = await fetch(url,{
                    method: 'POST',
                    body: datosFormulario
                });
                respuesta = await resultado.json();
                return respuesta;
            }

            async function guardarNuevosDatos(datosFormulario){
                const url = `/api/guardarNuevosDatos`;
                resultado = await fetch(url,{
                    method: 'POST',
                    body: datosFormulario
                });
                respuesta = await resultado.json();
                return respuesta;
            }
        }
    }
})();
