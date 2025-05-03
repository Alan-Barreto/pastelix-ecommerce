/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/app.js":
/*!***********************!*\
  !*** ./src/js/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _tienda_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./tienda.js */ "./src/js/tienda.js");
/* harmony import */ var _tienda_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_tienda_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _usuarioDatos_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./usuarioDatos.js */ "./src/js/usuarioDatos.js");
/* harmony import */ var _usuarioDatos_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_usuarioDatos_js__WEBPACK_IMPORTED_MODULE_1__);



/***/ }),

/***/ "./src/js/tienda.js":
/*!**************************!*\
  !*** ./src/js/tienda.js ***!
  \**************************/
/***/ (() => {

(function () {
  var j = window.innerWidth;
  var precioFinal = 0;
  var cantidadArticulos = 0;
  function tamaño(j) {
    if (j > 1400) {
      return 'desktop';
    } else {
      if (j > 720) {
        return 'tablet';
      } else {
        return 'mobile';
      }
    }
  }
  function cambiarCantidad(articulo) {
    articulo.forEach(function (element) {
      botonResta = element.querySelector('.boton-restar');
      botonSuma = element.querySelector('.boton-sumar');
      element.querySelector('.cantidad').addEventListener('change', function () {
        suma = 0;
        listaCarrito = document.querySelectorAll('.articulo-carrito');
        indice = element.querySelector('.indice');
        if (element.querySelector('.cantidad').value == 0) {
          element.querySelector('.boton-cantidad').classList.add('ocultar');
          element.querySelector('.boton-añadir').classList.remove('ocultar');
          element.querySelector('.imagen-producto').classList.remove('articulo-seleccionado');
          listaCarrito.forEach(function (element) {
            if (indice.value == element.querySelector('input').value) {
              eliminarProductoCarrito(element);
            }
          });
        } else {
          nuevaCantidad = element.querySelector('.cantidad').value;
          calcularPrecio(suma, nuevaCantidad, listaCarrito, indice);
        }
      });
      botonResta.addEventListener('click', function () {
        if (element.querySelector('.cantidad').value > 1) {
          element.querySelector('.cantidad').value--;
        } else {
          element.querySelector('.cantidad').value--;
          btnCantidad = element.querySelector('.boton-cantidad');
          btnAñadir = element.querySelector('.boton-añadir');
          element.querySelector('.imagen-producto').classList.remove('articulo-seleccionado');
          ocultarContadorCantidad(btnCantidad, btnAñadir);
          indice = element.querySelector('.indice');
          listaCarrito = document.querySelectorAll('.articulo-carrito');
          listaCarrito.forEach(function (element) {
            if (indice.value == element.querySelector('input').value) {
              eliminarProductoCarrito(element);
            }
          });
        }
        suma = 0;
        nuevaCantidad = element.querySelector('.cantidad').value;
        listaCarrito = document.querySelectorAll('.articulo-carrito');
        indice = element.querySelector('.indice');
        calcularPrecio(suma, nuevaCantidad, listaCarrito, indice);
      });
      botonSuma.addEventListener('click', function () {
        element.querySelector('.cantidad').value++;
        suma = 0;
        nuevaCantidad = element.querySelector('.cantidad').value;
        listaCarrito = document.querySelectorAll('.articulo-carrito');
        indice = element.querySelector('.indice');
        calcularPrecio(suma, nuevaCantidad, listaCarrito, indice);
      });
    });
  }
  ;
  function calcularPrecio(suma, nuevaCantidad, listaCarrito, indice) {
    var cantidadArticulos = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : 0;
    listaCarrito.forEach(function (element) {
      if (indice.value == element.querySelector('input').value) {
        var _precioUnidad = Number(element.querySelector('.precio-unidad').innerText.replace('@$ ', ''));
        var nuevoPrecioTotal = (nuevaCantidad * _precioUnidad).toFixed(2);
        element.querySelector('.cantidad').innerText = "".concat(nuevaCantidad, "x");
        element.querySelector('.precio-total').innerText = "$".concat(nuevoPrecioTotal);
      }
      var precioTotal = parseFloat(element.querySelector('.precio-total').innerText.slice(1));
      var cantidadProducto = parseInt(element.querySelector('.cantidad').innerText);
      cantidadArticulos += cantidadProducto;
      suma += precioTotal;
      precioFinal = document.querySelector('.precio-final');
      precioFinal.innerText = "$".concat(suma.toFixed(2));
    });
    contadorCarrito(cantidadArticulos);
  }
  function añadirCarrito(articulos) {
    var suma = 0;
    articulos.forEach(function (articulo) {
      var agregar = articulo.querySelector('.boton-añadir');
      agregar.addEventListener('click', function () {
        var nombreArticulo = articulo.querySelector('h3').innerText;
        var precioArticulo = articulo.querySelector('.precio').innerText;
        var numeroArticulo = articulo.querySelector('.indice').value;
        var imagenArticulo = articulo.querySelector('.imagen-producto');
        imagenArticulo.classList.add('articulo-seleccionado');
        añadirLista(nombreArticulo, precioArticulo, numeroArticulo, articulos);
        articulo.querySelector('.cantidad').value++;
        articulo.querySelector('.boton-añadir').classList.add('ocultar');
        articulo.querySelector('.boton-cantidad').classList.remove('ocultar');
        var listaCarrito = document.querySelectorAll('.articulo-carrito');
        var indice = articulo.querySelector('.indice');
        calcularPrecio(suma, 1, listaCarrito, indice);
      });
    });
  }
  function añadirLista(nombreArticulo, precioArticulo, numeroArticulo, articulos) {
    crearCarrito(nombreArticulo, precioArticulo, numeroArticulo, articulos);
    cantidadArticulos++;
    contadorCarrito(cantidadArticulos);
  }
  function crearCarrito(nombreArticulo, precioArticulo, numeroArticulo, articulos) {
    var articuloCarrito = document.createElement('LI');
    articuloCarrito.classList.add('articulo-carrito');
    var articulosCarrito = document.querySelector('.articulos__carrito');
    articulosCarrito.appendChild(articuloCarrito);
    var datosArticulo = document.createElement('DIV');
    articuloCarrito.appendChild(datosArticulo);
    var nombre = document.createElement('H3');
    nombre.innerText = nombreArticulo;
    datosArticulo.appendChild(nombre);
    var precioCantidad = document.createElement('DIV');
    precioCantidad.classList.add('precio-cantidad');
    datosArticulo.appendChild(precioCantidad);
    var cantidad = document.createElement('P');
    cantidad.classList.add('cantidad');
    cantidad.innerText = '1x';
    precioCantidad.appendChild(cantidad);
    var precioUnidad = document.createElement('P');
    precioUnidad.classList.add('precio-unidad');
    precioUnidad.innerText = "@".concat(precioArticulo);
    precioCantidad.appendChild(precioUnidad);
    var precioTotal = document.createElement('P');
    precioTotal.classList.add('precio-total');
    precioTotal.innerText = precioArticulo;
    precioCantidad.appendChild(precioTotal);
    var eliminarProducto = document.createElement('BUTTON');
    eliminarProducto.classList.add('eliminar');
    articuloCarrito.appendChild(eliminarProducto);
    var indiceProducto = document.createElement('INPUT');
    indiceProducto.type = 'hidden';
    indiceProducto.value = numeroArticulo;
    eliminarProducto.appendChild(indiceProducto);
    var imagenEliminar = document.createElement('IMG');
    imagenEliminar.src = 'build/img/icon-remove-item.svg';
    eliminarProducto.appendChild(imagenEliminar);
    eliminarCarrito(articulos, articuloCarrito);
  }
  function contadorCarrito(cantidadArticulos) {
    document.querySelector('.contador-carrito').querySelector('b').innerText = cantidadArticulos;
    if (cantidadArticulos == 0) {
      document.querySelector('.carrito-vacio').classList.remove('ocultar');
      document.querySelector('.contenido-carrito').classList.add('ocultar');
    } else {
      document.querySelector('.carrito-vacio').classList.add('ocultar');
      document.querySelector('.contenido-carrito').classList.remove('ocultar');
    }
  }
  function eliminarCarrito(articulos, articulo) {
    var btnBorrar = articulo.querySelector('.eliminar');
    var idBtnBorrar = btnBorrar.querySelector('input[type="hidden"]').value;
    btnBorrar.addEventListener('click', function () {
      articulos.forEach(function (articuloTienda) {
        var idArticuloTienda = articuloTienda.querySelector('.indice').value;
        if (idArticuloTienda === idBtnBorrar) {
          var producto = articuloTienda.querySelector('.cantidad');
          var _btnAñadir = articuloTienda.querySelector('.boton-añadir');
          var _btnCantidad = articuloTienda.querySelector('.boton-cantidad');
          producto.value = 0;
          imagenArticulo = articuloTienda.querySelector('.imagen-producto');
          imagenArticulo.classList.remove('articulo-seleccionado');
          ocultarContadorCantidad(_btnCantidad, _btnAñadir);
          eliminarProductoCarrito(articulo);
        }
      });
    });
  }
  function ocultarContadorCantidad(btnCantidad, btnAñadir) {
    btnCantidad.classList.add('ocultar');
    btnAñadir.classList.remove('ocultar');
  }
  function eliminarProductoCarrito(producto) {
    var cantidadProducto = parseInt(producto.querySelector('.cantidad').innerText);
    var precioTotalProducto = parseFloat(producto.querySelector('.precio-total').innerText.slice(1));
    var precioFinal = parseFloat(document.querySelector('.precio-final').innerText.slice(1));
    var elementoPrecioFinal = document.querySelector('.precio-final');
    var nuevoPrecioFinal = (precioFinal - precioTotalProducto).toFixed(2);
    elementoPrecioFinal.innerText = "$".concat(nuevoPrecioFinal);
    var cantidadArticulos = parseInt(document.querySelector('.contador-carrito').querySelector('b').innerText);
    cantidadArticulos -= cantidadProducto;
    contadorCarrito(cantidadArticulos);
    producto.remove();
  }
  function confirmarPedido(json) {
    confirmar = document.querySelector('.confirmar-orden');
    if (confirmar) {
      confirmar.addEventListener('click', function () {
        orden = document.querySelectorAll('.articulo-carrito');
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
        imgCabecera.src = 'build/img/icon-order-confirmed.svg';
        cabeceraResumen.appendChild(imgCabecera);
        mensajeCabecera = document.createElement('H2');
        mensajeCabecera.innerText = 'Order Confirmed';
        cabeceraResumen.appendChild(mensajeCabecera);
        textoCabecera = document.createElement('P');
        textoCabecera.innerText = 'We hope you enjoy you food!';
        cabeceraResumen.appendChild(textoCabecera);
        resumenPrecio = document.createElement('DIV');
        resumenPrecio.classList.add('resumen-precio');
        resumenOrden.appendChild(resumenPrecio);
        listaConfirmada = document.createElement('UL');
        listaConfirmada.classList.add('lista-confirmada');
        resumenPrecio.appendChild(listaConfirmada);
        orden.forEach(function (element) {
          console.log(element);
          indiceArticuloConfirmado = element.querySelector('input').value;
          imagenUltraPequeña = json[indiceArticuloConfirmado]['image']['thumbnail'];
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
          imgInfo.src = imagenUltraPequeña;
          info.appendChild(imgInfo);
          datosArticulo = document.createElement('DIV');
          datosArticulo.classList.add('datos-articulo');
          info.appendChild(datosArticulo);
          datosArticuloTexto = document.createElement('H3');
          datosArticuloTexto.innerText = nombreArticuloConfirmado;
          datosArticulo.appendChild(datosArticuloTexto);
          precioCantidad = document.createElement('DIV');
          precioCantidad.classList.add('precio-cantidad');
          datosArticulo.appendChild(precioCantidad);
          cantidad = document.createElement('P');
          cantidad.classList.add('cantidad');
          cantidad.innerText = cantidadArticuloConfirmado;
          precioCantidad.appendChild(cantidad);
          precioUnidad = document.createElement('P');
          precioUnidad.classList.add('precio-unidad');
          precioUnidad.innerText = precioArticuloConfirmado;
          precioCantidad.appendChild(precioUnidad);
          precioTotal = document.createElement('P');
          precioTotal.classList.add('precio-total');
          precioTotal.innerText = precioTotalArticuloConfirmado;
          articuloConfirmado.appendChild(precioTotal);
        });
        totalOrden = document.createElement('DIV');
        totalOrden.classList.add('total-orden');
        resumenPrecio.appendChild(totalOrden);
        textoTotalOrden = document.createElement('P');
        textoTotalOrden.innerText = 'Order Total';
        totalOrden.appendChild(textoTotalOrden);
        precioFinalOrden = document.createElement('P');
        precioFinalOrden.classList.add('precio-final');
        precioFinalOrden.innerText = "".concat(precioFinalConfirmado.innerText);
        totalOrden.appendChild(precioFinalOrden);
        nuevoPedidoBtn = document.createElement('BUTTON');
        nuevoPedidoBtn.classList.add('boton');
        nuevoPedidoBtn.classList.add('confirmar-orden');
        nuevoPedidoBtn.innerText = 'Star New Order';
        resumenOrden.appendChild(nuevoPedidoBtn);
        nuevoPedidoBtn.addEventListener('click', function () {
          location.reload();
        });
      });
    }
  }

  //getData();
  json = '';
  articulos = document.querySelectorAll('.articulo');
  añadirCarrito(articulos);
  cambiarCantidad(articulos);
  confirmarPedido(json);
})();

/***/ }),

/***/ "./src/js/usuarioDatos.js":
/*!********************************!*\
  !*** ./src/js/usuarioDatos.js ***!
  \********************************/
/***/ (() => {

(function () {
  usuario = document.querySelector('.usuario');
  if (usuario) {
    miCuenta = document.querySelector('.datos__contenedor');
    if (miCuenta) {
      datos = document.querySelector('.formulario__datos').parentNode;
      abrirDatos = document.querySelector('.modificar');
      cerrarDatos = document.querySelector('.formulario__datos').nextElementSibling;
      correo = document.querySelector('.formulario__correo').parentNode;
      abrirCorreo = document.querySelector('.correo');
      cerrarCorreo = document.querySelector('.formulario__correo').nextElementSibling;
      contraseña = document.querySelector('.formulario__contraseña').parentNode;
      abrirContraseña = document.querySelector('.contraseña');
      cerrarContraseña = document.querySelector('.formulario__contraseña').nextElementSibling;
      abrirDatos.addEventListener('click', function () {
        datos.classList.toggle('formulario--ocultar');
        correo.classList.add('formulario--ocultar');
        contraseña.classList.add('formulario--ocultar');
      });
      cerrarDatos.addEventListener('click', function () {
        datos.classList.add('formulario--ocultar');
      });
      abrirCorreo.addEventListener('click', function () {
        datos.classList.add('formulario--ocultar');
        correo.classList.toggle('formulario--ocultar');
        contraseña.classList.add('formulario--ocultar');
      });
      cerrarCorreo.addEventListener('click', function () {
        correo.classList.add('formulario--ocultar');
      });
      abrirContraseña.addEventListener('click', function () {
        datos.classList.add('formulario--ocultar');
        correo.classList.add('formulario--ocultar');
        contraseña.classList.toggle('formulario--ocultar');
      });
      cerrarContraseña.addEventListener('click', function () {
        contraseña.classList.add('formulario--ocultar');
      });
    }
  }
})();

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	__webpack_require__("./src/js/app.js");
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	__webpack_require__("./src/js/tienda.js");
/******/ 	var __webpack_exports__ = __webpack_require__("./src/js/usuarioDatos.js");
/******/ 	
/******/ })()
;
//# sourceMappingURL=main.js.map