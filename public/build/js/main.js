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
/* harmony import */ var _checkout_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./checkout.js */ "./src/js/checkout.js");
/* harmony import */ var _checkout_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_checkout_js__WEBPACK_IMPORTED_MODULE_2__);




/***/ }),

/***/ "./src/js/checkout.js":
/*!****************************!*\
  !*** ./src/js/checkout.js ***!
  \****************************/
/***/ (() => {

function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
(function () {
  var checkout = document.querySelector('.checkout');
  if (checkout) {
    //Revisa si hay algo en el carrito del usuario y devuelve true o false
    var carritoVacio = function carritoVacio() {
      var carritoRecuperado = JSON.parse(localStorage.getItem('carrito') || '[]');
      if (carritoRecuperado.length <= 0) {
        return true;
      } else {
        return false;
      }
    }; //Reemplaza el contenido normal del checkout por un aviso de agregar algo al carrito
    var checkoutCarritoVacio = function checkoutCarritoVacio() {
      checkout.innerHTML = "\n                <div class=\"carrito-vacio-alerta\">\n                    <h2>Su carrito esta vacio</h2>\n                    <p><a href=\"/tienda\">Haga click aqui</a> para ir a la tienda y agregar algo</p>\n                </div>\n            \n            ";
    };
    var elegirMetodoEntrega = /*#__PURE__*/function () {
      var _ref = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
        var usuarioLogueado;
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return verificarLogin();
            case 2:
              usuarioLogueado = _context.sent;
              funcionalidadMetodoEntrega(usuarioLogueado);
            case 4:
            case "end":
              return _context.stop();
          }
        }, _callee);
      }));
      return function elegirMetodoEntrega() {
        return _ref.apply(this, arguments);
      };
    }();
    var funcionalidadMetodoEntrega = function funcionalidadMetodoEntrega(usuarioLogueado) {
      var recogerEnTienda = document.getElementById('tienda');
      var envioDomilicio = document.getElementById('domicilio');
      var listaDirecciones = [];
      recogerEnTienda.addEventListener('click', function () {
        var formularioDireccion = document.querySelector('.contenedor__direccion-entrega');
        var contenedorListaDirecciones = document.querySelector('.contenedor__lista-direcciones');
        if (formularioDireccion) {
          formularioDireccion.remove();
        }
        if (contenedorListaDirecciones) {
          contenedorListaDirecciones.remove();
        }
      });
      envioDomilicio.addEventListener('click', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
        var formularioDireccion, contenedorListaDirecciones, formulario, contenedorDireccionEntrega;
        return _regeneratorRuntime().wrap(function _callee2$(_context2) {
          while (1) switch (_context2.prev = _context2.next) {
            case 0:
              formularioDireccion = document.querySelector('.contenedor__direccion-entrega');
              contenedorListaDirecciones = document.querySelector('.contenedor__lista-direcciones');
              if (!(!formularioDireccion && !contenedorListaDirecciones)) {
                _context2.next = 14;
                break;
              }
              formulario = document.querySelector('.checkout__formulario');
              if (!usuarioLogueado) {
                _context2.next = 12;
                break;
              }
              if (!(listaDirecciones.length == 0)) {
                _context2.next = 9;
                break;
              }
              _context2.next = 8;
              return recuperarDirecciones();
            case 8:
              listaDirecciones = _context2.sent;
            case 9:
              //Tal ves una validación para revisar si se recuperó con exito las direcciones
              crearListaDirecciones(listaDirecciones.direcciones);
              _context2.next = 14;
              break;
            case 12:
              contenedorDireccionEntrega = crearFormularioDireccion();
              formulario.appendChild(contenedorDireccionEntrega);
            case 14:
            case "end":
              return _context2.stop();
          }
        }, _callee2);
      })));
    };
    var crearListaDirecciones = function crearListaDirecciones(listaDirecciones) {
      var formulario = document.querySelector('.checkout__formulario');
      var contenedorListaDirecciones = document.createElement('DIV');
      contenedorListaDirecciones.classList.add('contenedor__lista-direcciones');
      listaDirecciones.forEach(function (direccion) {
        var direccionLabel = crearElementoListaDirecciones(direccion);
        contenedorListaDirecciones.appendChild(direccionLabel);
      });
      if (listaDirecciones.length <= 0) {
        var mensajeListaVacia = document.createElement('P');
        mensajeListaVacia.classList.add('direcciones-vacia');
        mensajeListaVacia.innerText = 'No Tienes ninguna direccion guardada';
        contenedorListaDirecciones.appendChild(mensajeListaVacia);
      }
      formulario.appendChild(contenedorListaDirecciones);
      var botonNuevaDireccion = document.createElement('button');
      botonNuevaDireccion.classList.add('boton');
      botonNuevaDireccion.classList.add('boton__nueva-direccion');
      botonNuevaDireccion.type = 'button';
      botonNuevaDireccion.innerText = 'Agregar Nueva Direccion';
      contenedorListaDirecciones.appendChild(botonNuevaDireccion);
      agregarFuncionalidadNuevaDireccion(botonNuevaDireccion, listaDirecciones);
    };
    var crearElementoListaDirecciones = function crearElementoListaDirecciones(direccion) {
      var direccionLabel = document.createElement('LABEL');
      direccionLabel.classList.add('campo-direccionElegida');
      var direccionInputRadio = document.createElement('INPUT');
      direccionInputRadio.type = 'radio';
      direccionInputRadio.name = 'direccionElegida';
      direccionInputRadio.value = direccion.id;
      if (direccion.predeterminada == 1) {
        direccionInputRadio.checked = true;
      }
      direccionLabel.appendChild(direccionInputRadio);
      var direccionDatos = document.createElement('P');
      direccionDatos.innerText = "".concat(direccion.calle, ", ").concat(direccion.codigo_postal, ", ").concat(direccion.ciudad, ", ").concat(direccion.provincia, ", ").concat(direccion.pais);
      direccionLabel.appendChild(direccionDatos);
      return direccionLabel;
    };
    var agregarFuncionalidadNuevaDireccion = function agregarFuncionalidadNuevaDireccion(boton, listaDireccionesActual) {
      boton.addEventListener('click', function (e) {
        e.preventDefault();
        var modalExistente = document.querySelector('.modal');
        if (!modalExistente) {
          var body = document.querySelector('body');
          body.classList.add('modal--abierto');
          crearModalNuevaDireccion(body, listaDireccionesActual);
        }
      });
    };
    var crearModalNuevaDireccion = function crearModalNuevaDireccion(body, listaDireccionesActual) {
      var modal = document.createElement('DIV');
      modal.classList.add('modal');
      var formulario = document.createElement('FORM');
      formulario.classList.add('formulario');
      formulario.classList.add('modal__formulario');
      var formularioDireccion = crearFormularioDireccion();
      formulario.appendChild(formularioDireccion);
      var botonesModal = document.createElement('DIV');
      botonesModal.classList.add('modal__botones');
      var botonGuardar = document.createElement('BUTTON');
      botonGuardar.classList.add('boton');
      botonGuardar.type = 'button';
      botonGuardar.innerText = 'Guardar Direccion';
      botonesModal.appendChild(botonGuardar);
      var botonCancelar = document.createElement('BUTTON');
      botonCancelar.classList.add('boton');
      botonCancelar.type = 'button';
      botonCancelar.innerText = 'Cancelar';
      botonesModal.appendChild(botonCancelar);
      formulario.appendChild(botonesModal);
      modal.appendChild(formulario);
      botonGuardar.addEventListener('click', function (e) {
        e.preventDefault();
        guardarDireccion(formulario, listaDireccionesActual);
      });
      botonCancelar.addEventListener('click', function (e) {
        e.preventDefault();
        body.classList.remove('modal--abierto');
        modal.remove();
      });
      modal.addEventListener('click', function (e) {
        if (e.target == modal) {
          body.classList.remove('modal--abierto');
          modal.remove();
        }
      });
      body.appendChild(modal);
    };
    var guardarDireccion = /*#__PURE__*/function () {
      var _ref3 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee3(formulario, listaDireccionesActual) {
        var modal, datosFormulario, resultado, mensajeListaVacia, contenedorListaDirecciones, botonNuevaDireccion, nuevaDireccion, input, body;
        return _regeneratorRuntime().wrap(function _callee3$(_context3) {
          while (1) switch (_context3.prev = _context3.next) {
            case 0:
              modal = document.querySelector('.modal');
              datosFormulario = new FormData(formulario);
              _context3.next = 4;
              return guardarNuevaDireccion(datosFormulario);
            case 4:
              resultado = _context3.sent;
              limpiarAlertasFormulario(formulario);
              if (resultado.error) {
                Object.entries(resultado.errores).forEach(function (_ref4) {
                  var _ref5 = _slicedToArray(_ref4, 2),
                    campo = _ref5[0],
                    mensaje = _ref5[1];
                  var input = formulario.querySelector("[name = \"".concat(campo, "\"]"));
                  input.classList.add('input__error');
                  var contenedorInput = input.parentElement;
                  var mensajeError = contenedorInput.querySelector('.mensaje__error');
                  if (!mensajeError) {
                    crearAlertaFormulario(contenedorInput, input, mensaje);
                  }
                });
              } else {
                mensajeListaVacia = document.querySelector('.direcciones-vacia');
                contenedorListaDirecciones = document.querySelector('.contenedor__lista-direcciones');
                botonNuevaDireccion = document.querySelector('.boton__nueva-direccion');
                actualizarListaDireccionesActual(listaDireccionesActual, resultado.direccion);
                if (contenedorListaDirecciones) {
                  nuevaDireccion = crearElementoListaDirecciones(resultado.direccion);
                  input = nuevaDireccion.querySelector('input');
                  input.checked = true;
                  contenedorListaDirecciones.insertBefore(nuevaDireccion, botonNuevaDireccion);
                }
                body = document.querySelector('body');
                body.classList.remove('modal--abierto');
                modal.remove();
                if (mensajeListaVacia) {
                  mensajeListaVacia.remove();
                }
              }
            case 7:
            case "end":
              return _context3.stop();
          }
        }, _callee3);
      }));
      return function guardarDireccion(_x, _x2) {
        return _ref3.apply(this, arguments);
      };
    }();
    var actualizarListaDireccionesActual = function actualizarListaDireccionesActual(listaDirecciones, direccionAgregada) {
      var nuevaDireccion = {
        id: "".concat(direccionAgregada.id),
        usuario_id: '',
        calle: direccionAgregada.calle,
        ciudad: direccionAgregada.ciudad,
        provincia: direccionAgregada.provincia,
        codigo_postal: direccionAgregada.codigo_postal,
        pais: direccionAgregada.pais,
        fecha_creacion: null,
        fecha_actualizacion: null,
        predeterminada: '0'
      };
      listaDirecciones.push(nuevaDireccion);
      console.log(nuevaDireccion);
      console.log(listaDirecciones);
    };
    var crearFormularioDireccion = function crearFormularioDireccion() {
      var contenedorDireccionEntrega = document.createElement('DIV');
      contenedorDireccionEntrega.classList.add('contenedor__direccion-entrega');
      var legend = document.createElement('LEGEND');
      legend.innerText = 'Direccion de entrega';
      contenedorDireccionEntrega.appendChild(legend);

      //
      var contenedorCalle = document.createElement('DIV');
      contenedorCalle.classList.add('formulario__campo');
      var calleLabel = document.createElement('LABEL');
      calleLabel.htmlFor = 'calle';
      calleLabel.classList.add('formulario__label');
      calleLabel.innerText = 'Calle';
      contenedorCalle.appendChild(calleLabel);
      var calleInput = document.createElement('INPUT');
      calleInput.type = 'text';
      calleInput.name = 'calle';
      calleInput.id = 'calle';
      calleInput.placeholder = 'Ingresa tu direccion';
      calleInput.classList.add('formulario__input');
      calleInput.classList.add('campo-calle');
      contenedorCalle.appendChild(calleInput);
      contenedorDireccionEntrega.appendChild(contenedorCalle);

      //
      var contenedorCiudad = document.createElement('DIV');
      contenedorCiudad.classList.add('formulario__campo');
      var ciudadLabel = document.createElement('LABEL');
      ciudadLabel.htmlFor = 'ciudad';
      ciudadLabel.classList.add('formulario__label');
      ciudadLabel.innerText = 'ciudad';
      contenedorCiudad.appendChild(ciudadLabel);
      var ciudadInput = document.createElement('INPUT');
      ciudadInput.type = 'text';
      ciudadInput.name = 'ciudad';
      ciudadInput.id = 'ciudad';
      ciudadInput.placeholder = 'Ingresa tu ciudad';
      ciudadInput.classList.add('formulario__input');
      ciudadInput.classList.add('campo-ciudad');
      contenedorCiudad.appendChild(ciudadInput);
      contenedorDireccionEntrega.appendChild(contenedorCiudad);

      //
      var contenedorProvincia = document.createElement('DIV');
      contenedorProvincia.classList.add('formulario__campo');
      var provinciaLabel = document.createElement('LABEL');
      provinciaLabel.htmlFor = 'provincia';
      provinciaLabel.classList.add('formulario__label');
      provinciaLabel.innerText = 'provincia';
      contenedorProvincia.appendChild(provinciaLabel);
      var provinciaInput = document.createElement('INPUT');
      provinciaInput.type = 'text';
      provinciaInput.name = 'provincia';
      provinciaInput.id = 'provincia';
      provinciaInput.placeholder = 'Ingresa tu provincia';
      provinciaInput.classList.add('formulario__input');
      provinciaInput.classList.add('campo-provincia');
      contenedorProvincia.appendChild(provinciaInput);
      contenedorDireccionEntrega.appendChild(contenedorProvincia);

      //
      var contenedorCodigoPostal = document.createElement('DIV');
      contenedorCodigoPostal.classList.add('formulario__campo');
      var codigoPostalLabel = document.createElement('LABEL');
      codigoPostalLabel.htmlFor = 'codigo_postal';
      codigoPostalLabel.classList.add('formulario__label');
      codigoPostalLabel.innerText = 'codigo Postal';
      contenedorCodigoPostal.appendChild(codigoPostalLabel);
      var codigoPostalInput = document.createElement('INPUT');
      codigoPostalInput.type = 'text';
      codigoPostalInput.name = 'codigo_postal';
      codigoPostalInput.id = 'codigo_postal';
      codigoPostalInput.placeholder = 'Ingresa tu codigo postal';
      codigoPostalInput.classList.add('formulario__input');
      codigoPostalInput.classList.add('campo-codigo_postal');
      contenedorCodigoPostal.appendChild(codigoPostalInput);
      contenedorDireccionEntrega.appendChild(contenedorCodigoPostal);

      //
      var listaPaises = [{
        codigo: "ES",
        nombre: "España"
      }, {
        codigo: "PT",
        nombre: "Portugal"
      }, {
        codigo: "FR",
        nombre: "Francia"
      }];
      var contenedorPais = document.createElement('DIV');
      contenedorPais.classList.add('formulario__campo');
      var paisLabel = document.createElement('LABEL');
      paisLabel.htmlFor = 'pais';
      paisLabel.classList.add('formulario__label');
      paisLabel.innerText = 'pais';
      contenedorPais.appendChild(paisLabel);
      var paisSelect = document.createElement('SELECT');
      paisSelect.name = 'pais';
      paisSelect.id = 'pais';
      paisSelect.classList.add('formulario__input');
      paisSelect.classList.add('campo-pais');
      paisSelect.required = true;
      var paisOption = document.createElement('OPTION');
      paisOption.value = '';
      paisOption.disabled = true;
      paisOption.selected = true;
      paisOption.innerText = 'Seleccione un país';
      paisSelect.appendChild(paisOption);
      crearOptionsPais(listaPaises, paisSelect);
      contenedorPais.appendChild(paisSelect);
      contenedorDireccionEntrega.appendChild(contenedorPais);
      return contenedorDireccionEntrega;
    };
    var crearOptionsPais = function crearOptionsPais(listaPaises, paisSelect) {
      listaPaises.forEach(function (pais) {
        var paisOption = document.createElement('OPTION');
        paisOption.value = pais.codigo;
        paisOption.innerText = pais.nombre;
        paisSelect.appendChild(paisOption);
      });
    }; //Crea una alerta y la inserta antes del input afectado
    var crearAlertaFormulario = function crearAlertaFormulario(contenedor, input, mensaje) {
      console.log('no olvides cambiar los datos aqui para terminar de definir las alertas nuevas');
      var alerta = document.createElement('P');
      alerta.classList.add('mensaje__error');
      alerta.innerText = mensaje;
      contenedor.insertBefore(alerta, input);
    }; //Limpia los mensajes ya existentes y quita la clase error a los input para volver a validar
    var limpiarAlertasFormulario = function limpiarAlertasFormulario(formulario) {
      var mensajesError = formulario.querySelectorAll('.mensaje__error');
      var inputsError = formulario.querySelectorAll('.input__error');
      if (mensajesError) {
        mensajesError.forEach(function (mensaje) {
          mensaje.remove();
        });
      }
      if (inputsError) {
        inputsError.forEach(function (input) {
          input.classList.remove('input__error');
        });
      }
    };
    var recuperarCarritoLocal = /*#__PURE__*/function () {
      var _ref6 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee4() {
        var carritoRecuperado, productos_id, datosProductos, carritoRearmado;
        return _regeneratorRuntime().wrap(function _callee4$(_context4) {
          while (1) switch (_context4.prev = _context4.next) {
            case 0:
              carritoRecuperado = JSON.parse(localStorage.getItem('carrito') || '[]');
              productos_id = carritoRecuperado.map(function (carrito_producto) {
                return {
                  producto_id: carrito_producto.producto_id
                };
              });
              _context4.next = 4;
              return recuperarDatosProductos(productos_id);
            case 4:
              datosProductos = _context4.sent;
              carritoRearmado = datosProductos.productos.map(function (producto) {
                var cantidadBuscada = carritoRecuperado.find(function (productoRecuperado) {
                  return productoRecuperado.producto_id === producto.id;
                });
                return _objectSpread(_objectSpread({}, producto), {}, {
                  cantidad: cantidadBuscada.cantidad
                });
              });
              crearResumenCompra(carritoRearmado);
              botonPaypal(carritoRecuperado);
            case 8:
            case "end":
              return _context4.stop();
          }
        }, _callee4);
      }));
      return function recuperarCarritoLocal() {
        return _ref6.apply(this, arguments);
      };
    }();
    var crearResumenCompra = function crearResumenCompra(carrito) {
      var cantidadTotal = 0;
      var totalAPagar = 0;
      carrito.forEach(function (producto) {
        cantidadTotal += producto.cantidad;
        totalAPagar += producto.cantidad * Number(producto.precio);
      });
      var contenedorCarrito = document.querySelector('.carrito');
      var resumenCarrito = document.createElement('DIV');
      resumenCarrito.classList.add('carrito__resumen');
      var contenedorResumenPrecioFinal = document.createElement('DIV');
      contenedorResumenPrecioFinal.classList.add('carrito__resumen-precio');
      var contadorCarrito = document.createElement('P');
      contadorCarrito.classList.add('contador-carrito');
      var cantidadContador = document.createElement('B');
      cantidadContador.innerText = "".concat(cantidadTotal);
      contadorCarrito.appendChild(cantidadContador);
      contadorCarrito.append(' articulos en tu pedido');
      contenedorResumenPrecioFinal.appendChild(contadorCarrito);
      var precioFinal = document.createElement('P');
      precioFinal.classList.add('precio-final');
      precioFinal.innerText = "$ ".concat(totalAPagar.toFixed(2));
      contenedorResumenPrecioFinal.appendChild(precioFinal);
      resumenCarrito.appendChild(contenedorResumenPrecioFinal);
      var carritoDetallado = document.createElement('BUTTON');
      carritoDetallado.type = 'button';
      carritoDetallado.classList.add('boton');
      carritoDetallado.innerText = 'Expandir Carrito';
      funcionalidadCarritoDetallado(carritoDetallado, carrito);
      resumenCarrito.appendChild(carritoDetallado);
      contenedorCarrito.appendChild(resumenCarrito);
    };
    var funcionalidadCarritoDetallado = function funcionalidadCarritoDetallado(boton) {
      var carrito = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
      var bodyPagina = document.querySelector('body');
      var modalExistente = document.querySelector('.modal');
      boton.addEventListener('click', function (e) {
        e.preventDefault;
        if (!modalExistente) {
          var precioTotal = 0;
          bodyPagina.classList.add('modal--abierto');
          var modal = document.createElement('DIV');
          modal.classList.add('modal');
          var botonCerrar = document.createElement('BUTTON');
          botonCerrar.classList.add('boton');
          botonCerrar.innerText = 'Cerrar';
          modal.appendChild(botonCerrar);
          var contenedorCarritoDetallado = document.createElement('DIV');
          contenedorCarritoDetallado.classList.add('carrito__detallado');
          var carritoDetallado = document.createElement('UL');
          carritoDetallado.classList.add('carrito__lista');
          contenedorCarritoDetallado.appendChild(carritoDetallado);
          carrito.forEach(function (producto) {
            var articuloCarrito = crearArticuloCarrito(producto);
            carritoDetallado.appendChild(articuloCarrito);
            precioTotal += Number(producto.precio) * producto.cantidad;
          });
          var contenedorPrecioTotal = document.createElement('DIV');
          contenedorPrecioTotal.classList.add('contenedor__precio-total');
          var textoPrecioTotal = document.createElement('P');
          textoPrecioTotal.innerText = 'Total a pagar:';
          contenedorPrecioTotal.appendChild(textoPrecioTotal);
          var valorPrecioTotal = document.createElement('P');
          valorPrecioTotal.innerText = "$".concat(precioTotal.toFixed(2));
          contenedorPrecioTotal.appendChild(valorPrecioTotal);
          contenedorCarritoDetallado.appendChild(contenedorPrecioTotal);
          modal.addEventListener('click', function (e) {
            if (e.target == modal) {
              bodyPagina.classList.remove('modal--abierto');
              modal.remove();
            }
          });
          botonCerrar.addEventListener('click', function (e) {
            bodyPagina.classList.remove('modal--abierto');
            modal.remove();
          });
          modal.appendChild(contenedorCarritoDetallado);
          bodyPagina.appendChild(modal);
        }
      });
    };
    var crearArticuloCarrito = function crearArticuloCarrito(producto) {
      var articuloCarrito = document.createElement('LI');
      articuloCarrito.classList.add('carrito__articulo');
      articuloCarrito.classList.add('articulo');
      var contenedorImagenDatos = document.createElement('DIV');
      contenedorImagenDatos.classList.add('contenedor__imagen-datos');
      var imagenArticulo = document.createElement('IMG');
      imagenArticulo.src = "/img/productos/".concat(producto.imagen, "_thumb.webp");
      imagenArticulo.alt = 'Imagen Producto';
      imagenArticulo.classList.add('articulo__imagen');
      contenedorImagenDatos.appendChild(imagenArticulo);
      var contenedorDatosArticulo = document.createElement('DIV');
      contenedorDatosArticulo.classList.add('articulo__datos');
      var nombreArticulo = document.createElement('P');
      nombreArticulo.classList.add('articulo__nombre');
      nombreArticulo.innerText = producto.nombre;
      contenedorDatosArticulo.appendChild(nombreArticulo);
      var contenedorCantidadPrecio = document.createElement('DIV');
      contenedorCantidadPrecio.classList.add('articulo__cantidad-precio');
      var cantidadArticulo = document.createElement('P');
      cantidadArticulo.classList.add('articulo__cantidad');
      cantidadArticulo.innerText = "X".concat(producto.cantidad);
      contenedorCantidadPrecio.appendChild(cantidadArticulo);
      var precioArticulo = document.createElement('P');
      precioArticulo.classList.add('articulo__precio');
      precioArticulo.innerText = "@".concat(producto.precio);
      contenedorCantidadPrecio.appendChild(precioArticulo);
      contenedorDatosArticulo.appendChild(contenedorCantidadPrecio);
      contenedorImagenDatos.appendChild(contenedorDatosArticulo);
      articuloCarrito.appendChild(contenedorImagenDatos);
      var subtotalArticulo = document.createElement('P');
      subtotalArticulo.classList.add('articulo__subtotal');
      subtotalArticulo.innerText = "$".concat((Number(producto.precio) * producto.cantidad).toFixed(2));
      articuloCarrito.appendChild(subtotalArticulo);
      return articuloCarrito;
    };
    var normalizarDatosPedido = function normalizarDatosPedido(carrito, datosFormulario, orderId) {
      var datosClienteNormalizado = {
        nombre: datosFormulario.datosCliente.nombre,
        apellido: datosFormulario.datosCliente.apellido,
        email: datosFormulario.datosCliente.email,
        telefono: datosFormulario.datosCliente.telefono
      };
      var datosPedido = {
        datosCarrito: carrito,
        datosCliente: datosClienteNormalizado,
        tipoEntrega: datosFormulario.tipoEntrega,
        pedidoIdPaypal: orderId
      };
      if (datosFormulario.tipoEntrega == 'domicilio') {
        var direccionClienteNormalizada = {
          calle: datosFormulario.direccionCliente.calle,
          ciudad: datosFormulario.direccionCliente.ciudad,
          provincia: datosFormulario.direccionCliente.provincia,
          codigo_postal: datosFormulario.direccionCliente.codigo_postal,
          pais: datosFormulario.direccionCliente.pais
        };
        datosPedido.direccionCliente = direccionClienteNormalizada;
      }
      return datosPedido;
    };
    var validarFormulario = /*#__PURE__*/function () {
      var _ref7 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee5() {
        var error, formulario, datosCliente, _resultado;
        return _regeneratorRuntime().wrap(function _callee5$(_context5) {
          while (1) switch (_context5.prev = _context5.next) {
            case 0:
              error = false;
              formulario = document.querySelector('.checkout__formulario');
              limpiarAlertasFormulario(formulario);
              datosCliente = new FormData(formulario);
              _context5.next = 6;
              return validarEntradasFormularios(datosCliente);
            case 6:
              error = _context5.sent;
              if (!(error == true)) {
                _context5.next = 11;
                break;
              }
              return _context5.abrupt("return", 'error');
            case 11:
              _context5.next = 13;
              return validarDatosFormulario(datosCliente);
            case 13:
              _resultado = _context5.sent;
              if (_resultado.error == true) {
                Object.entries(_resultado.errores).forEach(function (_ref8) {
                  var _ref9 = _slicedToArray(_ref8, 2),
                    campo = _ref9[0],
                    mensaje = _ref9[1];
                  var input = document.querySelector(".campo-".concat(campo));
                  var contenedorInput = input.parentElement;
                  input.classList.add('input__error');
                  crearAlertaFormulario(contenedorInput, input, mensaje);
                });
              }
              return _context5.abrupt("return", _resultado);
            case 16:
            case "end":
              return _context5.stop();
          }
        }, _callee5);
      }));
      return function validarFormulario() {
        return _ref7.apply(this, arguments);
      };
    }();
    var validarEntradasFormularios = /*#__PURE__*/function () {
      var _ref10 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee6(formulario) {
        var usuarioLogueado, error, inputPais, inputDireccionElegida, tipoEntrega;
        return _regeneratorRuntime().wrap(function _callee6$(_context6) {
          while (1) switch (_context6.prev = _context6.next) {
            case 0:
              _context6.next = 2;
              return verificarLogin();
            case 2:
              usuarioLogueado = _context6.sent;
              error = false;
              inputPais = false;
              inputDireccionElegida = false;
              tipoEntrega = 'tienda';
              formulario.forEach(function (valor, campo) {
                if (valor.trim() == '') {
                  error = true;
                  insertarMensajeError(campo);
                }
                if (campo == 'email' && valor.trim() !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor)) {
                  error = true;
                  insertarMensajeError(campo, 'emailFormato');
                }
                if (campo == 'telefono' && valor.trim() !== '') {
                  var telefonoNormalizado = valor.replace(/\D/g, '');
                  if (!/^\+?[0-9\s\-()]+$/.test(valor)) {
                    error = true;
                    insertarMensajeError(campo, 'telefonoFormato');
                  } else if (telefonoNormalizado.length < 7 || telefonoNormalizado.length > 15) {
                    error = true;
                    insertarMensajeError(campo, 'telefonoLongitud');
                  }
                }
                if (campo == 'entrega' && valor != 'tienda' && valor != 'domicilio') {
                  error = true;
                  insertarMensajeError(campo, 'entregaNoValida');
                }
                if (campo == 'entrega' && valor == 'domicilio') {
                  tipoEntrega = 'domicilio';
                }
                if (campo == 'direccionElegida' && usuarioLogueado == true) {
                  inputDireccionElegida = true;
                }
                if (campo == 'pais' && usuarioLogueado == false) {
                  inputPais = true;
                  var codigosPaises = ['ES', 'PT', 'FR'];
                  if (!codigosPaises.includes(valor)) {
                    error = true;
                    insertarMensajeError(campo, 'paisNoValido');
                  }
                }
              });
              if (tipoEntrega == 'domicilio') {
                if (usuarioLogueado == false && inputPais == false) {
                  error = true;
                  insertarMensajeError('pais', 'paisVacio');
                }
                if (usuarioLogueado == true && inputDireccionElegida == false) {
                  error = true;
                  insertarMensajeError('direccionElegida', 'direccionElegidaVacia');
                }
              }
              return _context6.abrupt("return", error);
            case 10:
            case "end":
              return _context6.stop();
          }
        }, _callee6);
      }));
      return function validarEntradasFormularios(_x3) {
        return _ref10.apply(this, arguments);
      };
    }();
    var insertarMensajeError = function insertarMensajeError(campo) {
      var campoAfectado = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : campo;
      var input = document.querySelector(".campo-".concat(campo));
      var contenedorInput = input.parentElement;
      var mensajeError = generarMensajeError(campoAfectado);
      input.classList.add('input__error');
      crearAlertaFormulario(contenedorInput, input, mensajeError);
    };
    var generarMensajeError = function generarMensajeError(campo) {
      var mensaje;
      switch (campo) {
        case 'nombre':
          mensaje = 'El nombre no puede ir vacio';
          break;
        case 'apellido':
          mensaje = 'El apellido no puede ir vacio';
          break;
        case 'email':
          mensaje = 'El email no puede ir vacio';
          break;
        case 'emailFormato':
          mensaje = 'Formato de e-mail erroneo';
          break;
        case 'telefono':
          mensaje = 'El telefono no puede ir vacio';
          break;
        case 'telefonoFormato':
          mensaje = 'Formato de telefono erroneo. Solo se aceptan numeros, espacios y guiones';
          break;
        case 'telefonoLongitud':
          mensaje = 'El telefono debe contener entre 7 y 15 numeros';
          break;
        case 'entregaNoValida':
          mensaje = 'La opcion de entrega es invalida por favor recargue la pagina o intentelo mas tarde';
          break;
        case 'calle':
          mensaje = 'La calle no puede ir vacia';
          break;
        case 'ciudad':
          mensaje = 'La ciudad no puede ir vacia';
          break;
        case 'provincia':
          mensaje = 'La provincia no puede ir vacia';
          break;
        case 'codigo_postal':
          mensaje = 'El codigo postal no puede ir vacio';
          break;
        case 'paisVacio':
          mensaje = 'Debe seleccionar un país';
          break;
        case 'paisNoValido':
          mensaje = 'Error con la opcion elegida, recargue la pagina e intentelo de nuevo';
          break;
        case 'direccionElegidaVacia':
          mensaje = 'Elija una dirección de envio o cree una nueva';
          break;
      }
      return mensaje;
    };
    var botonPaypal = function botonPaypal(carritoRecuperado) {
      var datosFormulario = '';
      var paypalButtons = window.paypal.Buttons({
        style: {
          shape: "rect",
          layout: "vertical",
          color: "gold",
          label: "paypal"
        },
        message: {
          amount: 100
        },
        onClick: function onClick(data, actions) {
          return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee7() {
            return _regeneratorRuntime().wrap(function _callee7$(_context7) {
              while (1) switch (_context7.prev = _context7.next) {
                case 0:
                  _context7.next = 2;
                  return validarFormulario();
                case 2:
                  datosFormulario = _context7.sent;
                  if (!(datosFormulario.error == true || datosFormulario == 'error')) {
                    _context7.next = 5;
                    break;
                  }
                  return _context7.abrupt("return", actions.reject());
                case 5:
                  return _context7.abrupt("return", actions.resolve());
                case 6:
                case "end":
                  return _context7.stop();
              }
            }, _callee7);
          }))();
        },
        createOrder: function createOrder() {
          return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee8() {
            var _orderData$details, response, orderData, errorDetail, errorMessage;
            return _regeneratorRuntime().wrap(function _callee8$(_context8) {
              while (1) switch (_context8.prev = _context8.next) {
                case 0:
                  _context8.prev = 0;
                  _context8.next = 3;
                  return fetch("/api/orders", {
                    method: "POST",
                    headers: {
                      "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                      cart: carritoRecuperado,
                      shipping: datosFormulario['direccionCliente'],
                      clientName: datosFormulario['datosCliente']['nombre'] + ' ' + datosFormulario['datosCliente']['apellido']
                    })
                  });
                case 3:
                  response = _context8.sent;
                  _context8.next = 6;
                  return response.json();
                case 6:
                  orderData = _context8.sent;
                  if (!orderData.id) {
                    _context8.next = 9;
                    break;
                  }
                  return _context8.abrupt("return", orderData.id);
                case 9:
                  errorDetail = orderData === null || orderData === void 0 || (_orderData$details = orderData.details) === null || _orderData$details === void 0 ? void 0 : _orderData$details[0];
                  errorMessage = errorDetail ? "".concat(errorDetail.issue, " ").concat(errorDetail.description, " (").concat(orderData.debug_id, ")") : JSON.stringify(orderData);
                  throw new Error(errorMessage);
                case 14:
                  _context8.prev = 14;
                  _context8.t0 = _context8["catch"](0);
                  console.error(_context8.t0);
                  // resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
                case 17:
                case "end":
                  return _context8.stop();
              }
            }, _callee8, null, [[0, 14]]);
          }))();
        },
        onApprove: function onApprove(data, actions) {
          return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee9() {
            var _orderData$details2, response, orderData, errorDetail, _orderData$purchase_u, _orderData$purchase_u2, transaction, datosPedido;
            return _regeneratorRuntime().wrap(function _callee9$(_context9) {
              while (1) switch (_context9.prev = _context9.next) {
                case 0:
                  _context9.prev = 0;
                  _context9.next = 3;
                  return fetch("/api/orders/capture", {
                    method: "POST",
                    headers: {
                      "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                      orderID: data.orderID
                    })
                  });
                case 3:
                  response = _context9.sent;
                  _context9.next = 6;
                  return response.json();
                case 6:
                  orderData = _context9.sent;
                  // Three cases to handle:
                  //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                  //   (2) Other non-recoverable errors -> Show a failure message
                  //   (3) Successful transaction -> Show confirmation or thank you message
                  errorDetail = orderData === null || orderData === void 0 || (_orderData$details2 = orderData.details) === null || _orderData$details2 === void 0 ? void 0 : _orderData$details2[0];
                  if (!((errorDetail === null || errorDetail === void 0 ? void 0 : errorDetail.issue) === "INSTRUMENT_DECLINED")) {
                    _context9.next = 12;
                    break;
                  }
                  return _context9.abrupt("return", actions.restart());
                case 12:
                  if (!errorDetail) {
                    _context9.next = 16;
                    break;
                  }
                  throw new Error("".concat(errorDetail.description, " (").concat(orderData.debug_id, ")"));
                case 16:
                  if (orderData.purchase_units) {
                    _context9.next = 20;
                    break;
                  }
                  throw new Error(JSON.stringify(orderData));
                case 20:
                  // (3) Successful transaction -> Show confirmation or thank you message
                  // Or go to another URL:  actions.redirect('thank_you.html');
                  transaction = (orderData === null || orderData === void 0 || (_orderData$purchase_u = orderData.purchase_units) === null || _orderData$purchase_u === void 0 || (_orderData$purchase_u = _orderData$purchase_u[0]) === null || _orderData$purchase_u === void 0 || (_orderData$purchase_u = _orderData$purchase_u.payments) === null || _orderData$purchase_u === void 0 || (_orderData$purchase_u = _orderData$purchase_u.captures) === null || _orderData$purchase_u === void 0 ? void 0 : _orderData$purchase_u[0]) || (orderData === null || orderData === void 0 || (_orderData$purchase_u2 = orderData.purchase_units) === null || _orderData$purchase_u2 === void 0 || (_orderData$purchase_u2 = _orderData$purchase_u2[0]) === null || _orderData$purchase_u2 === void 0 || (_orderData$purchase_u2 = _orderData$purchase_u2.payments) === null || _orderData$purchase_u2 === void 0 || (_orderData$purchase_u2 = _orderData$purchase_u2.authorizations) === null || _orderData$purchase_u2 === void 0 ? void 0 : _orderData$purchase_u2[0]);
                  resultMessage("Transaction ".concat(transaction.status, ": ").concat(transaction.id, "<br>\n                        <br>See console for all available details"));
                  // console.log(
                  //     "Capture result",
                  //     orderData,
                  //     JSON.stringify(orderData, null, 2)
                  // );
                  datosPedido = normalizarDatosPedido(carritoRecuperado, datosFormulario, data.orderID);
                  _context9.next = 25;
                  return guardarDatosPedido(datosPedido);
                case 25:
                  resultadoGuardar = _context9.sent;
                  if (!(resultadoGuardar.error === true)) {
                    _context9.next = 30;
                    break;
                  }
                  throw new Error("".concat(resultadoGuardar.mensaje));
                case 30:
                  console.log('gracias por su compra');
                  localStorage.removeItem('carrito');
                case 32:
                  _context9.next = 38;
                  break;
                case 34:
                  _context9.prev = 34;
                  _context9.t0 = _context9["catch"](0);
                  console.error(_context9.t0);
                  resultMessage("Sorry, your transaction could not be processed...<br><br>".concat(_context9.t0));
                case 38:
                case "end":
                  return _context9.stop();
              }
            }, _callee9, null, [[0, 34]]);
          }))();
        }
      });
      paypalButtons.render("#paypal-button-container");

      // Example function to show a result to the user. Your site's UI library can be used instead.
      function resultMessage(message) {
        var container = document.querySelector("#result-message");
        container.innerHTML = message;
      }
    }; //Funciones para llamar APIS
    var verificarLogin = /*#__PURE__*/function () {
      var _ref11 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee10() {
        var url;
        return _regeneratorRuntime().wrap(function _callee10$(_context10) {
          while (1) switch (_context10.prev = _context10.next) {
            case 0:
              url = "/api/verificarLogin";
              _context10.next = 3;
              return fetch(url);
            case 3:
              resultado = _context10.sent;
              _context10.next = 6;
              return resultado.json();
            case 6:
              respuesta = _context10.sent;
              return _context10.abrupt("return", respuesta);
            case 8:
            case "end":
              return _context10.stop();
          }
        }, _callee10);
      }));
      return function verificarLogin() {
        return _ref11.apply(this, arguments);
      };
    }();
    var recuperarDirecciones = /*#__PURE__*/function () {
      var _ref12 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee11() {
        var url;
        return _regeneratorRuntime().wrap(function _callee11$(_context11) {
          while (1) switch (_context11.prev = _context11.next) {
            case 0:
              url = "/api/recuperarDirecciones";
              _context11.next = 3;
              return fetch(url);
            case 3:
              resultado = _context11.sent;
              _context11.next = 6;
              return resultado.json();
            case 6:
              respuesta = _context11.sent;
              return _context11.abrupt("return", respuesta);
            case 8:
            case "end":
              return _context11.stop();
          }
        }, _callee11);
      }));
      return function recuperarDirecciones() {
        return _ref12.apply(this, arguments);
      };
    }();
    var guardarNuevaDireccion = /*#__PURE__*/function () {
      var _ref13 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee12(direccion) {
        var url;
        return _regeneratorRuntime().wrap(function _callee12$(_context12) {
          while (1) switch (_context12.prev = _context12.next) {
            case 0:
              url = "/api/guardarNuevaDireccion";
              _context12.next = 3;
              return fetch(url, {
                method: 'POST',
                body: direccion
              });
            case 3:
              resultado = _context12.sent;
              _context12.next = 6;
              return resultado.json();
            case 6:
              respuesta = _context12.sent;
              return _context12.abrupt("return", respuesta);
            case 8:
            case "end":
              return _context12.stop();
          }
        }, _callee12);
      }));
      return function guardarNuevaDireccion(_x4) {
        return _ref13.apply(this, arguments);
      };
    }();
    var recuperarDatosProductos = /*#__PURE__*/function () {
      var _ref14 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee13(productos) {
        var url;
        return _regeneratorRuntime().wrap(function _callee13$(_context13) {
          while (1) switch (_context13.prev = _context13.next) {
            case 0:
              url = "/api/recuperarDatosProductos";
              _context13.next = 3;
              return fetch(url, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(productos)
              });
            case 3:
              resultado = _context13.sent;
              _context13.next = 6;
              return resultado.json();
            case 6:
              respuesta = _context13.sent;
              return _context13.abrupt("return", respuesta);
            case 8:
            case "end":
              return _context13.stop();
          }
        }, _callee13);
      }));
      return function recuperarDatosProductos(_x5) {
        return _ref14.apply(this, arguments);
      };
    }();
    var validarDatosFormulario = /*#__PURE__*/function () {
      var _ref15 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee14(datosFormulario) {
        var url;
        return _regeneratorRuntime().wrap(function _callee14$(_context14) {
          while (1) switch (_context14.prev = _context14.next) {
            case 0:
              url = "/api/validarDatosFormulario";
              _context14.next = 3;
              return fetch(url, {
                method: 'POST',
                body: datosFormulario
              });
            case 3:
              resultado = _context14.sent;
              _context14.next = 6;
              return resultado.json();
            case 6:
              respuesta = _context14.sent;
              return _context14.abrupt("return", respuesta);
            case 8:
            case "end":
              return _context14.stop();
          }
        }, _callee14);
      }));
      return function validarDatosFormulario(_x6) {
        return _ref15.apply(this, arguments);
      };
    }();
    var guardarDatosPedido = /*#__PURE__*/function () {
      var _ref16 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee15(datosPedido) {
        var url;
        return _regeneratorRuntime().wrap(function _callee15$(_context15) {
          while (1) switch (_context15.prev = _context15.next) {
            case 0:
              url = "/api/guardarDatosPedido";
              _context15.next = 3;
              return fetch(url, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(datosPedido)
              });
            case 3:
              resultado = _context15.sent;
              _context15.next = 6;
              return resultado.json();
            case 6:
              respuesta = _context15.sent;
              return _context15.abrupt("return", respuesta);
            case 8:
            case "end":
              return _context15.stop();
          }
        }, _callee15);
      }));
      return function guardarDatosPedido(_x7) {
        return _ref16.apply(this, arguments);
      };
    }();
    if (carritoVacio()) {
      checkoutCarritoVacio();
    } else {
      elegirMetodoEntrega();
      recuperarCarritoLocal();
    }
  } //Fin de la verificacion que revisa estar en la pagina correcta 
})();

/***/ }),

/***/ "./src/js/tienda.js":
/*!**************************!*\
  !*** ./src/js/tienda.js ***!
  \**************************/
/***/ (() => {

function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
var _excluded = ["producto_id"];
function _objectWithoutProperties(e, t) { if (null == e) return {}; var o, r, i = _objectWithoutPropertiesLoose(e, t); if (Object.getOwnPropertySymbols) { var n = Object.getOwnPropertySymbols(e); for (r = 0; r < n.length; r++) o = n[r], -1 === t.indexOf(o) && {}.propertyIsEnumerable.call(e, o) && (i[o] = e[o]); } return i; }
function _objectWithoutPropertiesLoose(r, e) { if (null == r) return {}; var t = {}; for (var n in r) if ({}.hasOwnProperty.call(r, n)) { if (-1 !== e.indexOf(n)) continue; t[n] = r[n]; } return t; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
(function () {
  var tienda = document.querySelector('.tienda');
  if (tienda) {
    var renderizarPagina = /*#__PURE__*/function () {
      var _ref = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
        var _yield$Promise$all, _yield$Promise$all2, listaCatalogo, listaCarrito;
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return Promise.all([crearCatalogo(), rearmarCarrito()]);
            case 2:
              _yield$Promise$all = _context.sent;
              _yield$Promise$all2 = _slicedToArray(_yield$Promise$all, 2);
              listaCatalogo = _yield$Promise$all2[0];
              listaCarrito = _yield$Promise$all2[1];
              sincronizarBotones(listaCatalogo, listaCarrito);
              añadirFuncionalidadBotones();
            case 8:
            case "end":
              return _context.stop();
          }
        }, _callee);
      }));
      return function renderizarPagina() {
        return _ref.apply(this, arguments);
      };
    }(); //Crear el catalogo de productos
    var crearCatalogo = /*#__PURE__*/function () {
      var _ref2 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
        var listaProductos, catalogo, listaArticulos;
        return _regeneratorRuntime().wrap(function _callee2$(_context2) {
          while (1) switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return recuperarCatalogo();
            case 2:
              listaProductos = _context2.sent;
              if (!listaProductos.error) {
                _context2.next = 7;
                break;
              }
              console.log(listaProductos.error);
              _context2.next = 11;
              break;
            case 7:
              catalogo = document.querySelector('.contenedor-productos');
              listaProductos.forEach(function (producto) {
                var articulo = crearArticulo(producto);
                catalogo.appendChild(articulo);
              });
              listaArticulos = document.querySelectorAll('.articulo');
              return _context2.abrupt("return", listaArticulos);
            case 11:
            case "end":
              return _context2.stop();
          }
        }, _callee2);
      }));
      return function crearCatalogo() {
        return _ref2.apply(this, arguments);
      };
    }(); //Crear articulos para el catalogo
    var crearArticulo = function crearArticulo(producto) {
      var articulo = document.createElement('ARTICLE');
      articulo.dataset.id = producto.id;
      articulo.classList.add('articulo');
      var imagenArticulo = document.createElement('IMG');
      imagenArticulo.src = "/img/productos/".concat(producto.imagen, ".webp");
      imagenArticulo.alt = 'Imagen Producto';
      imagenArticulo.classList.add('imagen-producto');
      articulo.appendChild(imagenArticulo);
      var categoriaArticulo = document.createElement('H4');
      categoriaArticulo.innerText = producto.categoria;
      articulo.appendChild(categoriaArticulo);
      var nombreArticulo = document.createElement('H3');
      nombreArticulo.innerText = producto.nombre;
      articulo.appendChild(nombreArticulo);
      var precioArticulo = document.createElement('P');
      precioArticulo.classList.add('precio');
      precioArticulo.innerText = "$ ".concat(producto.precio);
      articulo.appendChild(precioArticulo);
      return articulo;
    }; //Añade el boton correspondiente segun los productos en el carrito
    var sincronizarBotones = function sincronizarBotones(listaCatalogo, listaCarrito) {
      listaCatalogo.forEach(function (articuloCatalogo) {
        var indiceBuscado = Number(articuloCatalogo.dataset.id);
        var articuloEncontrado = Array.from(listaCarrito).find(function (articuloCarrito) {
          return indiceBuscado == articuloCarrito.dataset.id;
        });
        if (articuloEncontrado) {
          var imagenArticuloCatalogo = articuloCatalogo.querySelector('img');
          imagenArticuloCatalogo.classList.add('articulo-seleccionado');
          var cantidadArticulo = parseInt(articuloEncontrado.querySelector('.cantidad').innerText);
          crearBtnCantidad(articuloCatalogo, cantidadArticulo);
        } else {
          crearBtnAñadir(articuloCatalogo);
        }
      });
    }; //Agrega la funcion adecuada a los botones
    var añadirFuncionalidadBotones = function añadirFuncionalidadBotones() {
      var botonesAñadir = document.querySelectorAll('.boton-añadir');
      var botonesCantidad = document.querySelectorAll('.boton-cantidad');
      añadirCarrito(botonesAñadir);
      cambiarCantidad(botonesCantidad);
    }; //Agrega la funcion "añadir" a todos los botones de este tipo que se le pasen
    var añadirCarrito = function añadirCarrito(botonesAñadir) {
      botonesAñadir.forEach(function (botonAñadir) {
        asignarFuncionalidadAñadir(botonAñadir);
      });
    }; //Agrega la funcion "cantidad" a todos los botones de este tipo que se le pasen
    var cambiarCantidad = function cambiarCantidad(botonesCantidad) {
      botonesCantidad.forEach(function (botonCantidad) {
        asignarFuncionalidadCantidad(botonCantidad);
      });
    };
    //Funciones para crear los botones de los articulos
    var crearBtnCantidad = function crearBtnCantidad(articulo) {
      var cantidadArticulo = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
      var btnCantidad = document.createElement('DIV');
      btnCantidad.classList.add('boton');
      btnCantidad.classList.add('boton-cantidad');
      var btnRestar = document.createElement('BUTTON');
      btnRestar.classList.add('boton-restar');
      var imgBtnRestar = document.createElement('IMG');
      imgBtnRestar.src = '/build/img/icon-decrement-quantity.svg';
      imgBtnRestar.alt = 'Boton Restar';
      btnRestar.appendChild(imgBtnRestar);
      btnCantidad.appendChild(btnRestar);
      var cantidadBtnCantidad = document.createElement('INPUT');
      cantidadBtnCantidad.type = 'number';
      cantidadBtnCantidad.name = 'cantidad';
      cantidadBtnCantidad.classList.add('cantidad');
      cantidadBtnCantidad.min = 0;
      cantidadBtnCantidad.value = cantidadArticulo;
      btnCantidad.appendChild(cantidadBtnCantidad);
      var btnSumar = document.createElement('BUTTON');
      btnSumar.classList.add('boton-sumar');
      var imgBtnSumar = document.createElement('IMG');
      imgBtnSumar.src = '/build/img/icon-increment-quantity.svg';
      imgBtnSumar.alt = 'Boton Sumar';
      btnSumar.appendChild(imgBtnSumar);
      btnCantidad.appendChild(btnSumar);
      var datosArticulo = articulo.querySelector('h4');
      articulo.insertBefore(btnCantidad, datosArticulo);
      return btnCantidad;
    };
    var crearBtnAñadir = function crearBtnAñadir(articulo) {
      var btnAñadir = document.createElement('BUTTON');
      btnAñadir.classList.add('boton');
      btnAñadir.classList.add('boton-añadir');
      var imgBtnAñadir = document.createElement('img');
      imgBtnAñadir.src = '/build/img/icon-add-to-cart.svg';
      imgBtnAñadir.alt = 'Icono Carrito';
      btnAñadir.appendChild(imgBtnAñadir);
      var textoBtnAñadir = document.createElement('P');
      textoBtnAñadir.innerText = 'Add to Cart';
      btnAñadir.appendChild(textoBtnAñadir);
      var datosArticulo = articulo.querySelector('h4');
      articulo.insertBefore(btnAñadir, datosArticulo);
      return btnAñadir;
    }; //Funciones para agregar funcionalidad a los botones
    var asignarFuncionalidadCantidad = function asignarFuncionalidadCantidad(botonCantidad) {
      var articulo = botonCantidad.parentElement;
      var idBuscado = articulo.dataset.id;
      var botonResta = botonCantidad.querySelector('.boton-restar');
      var botonSuma = botonCantidad.querySelector('.boton-sumar');
      var inputCantidad = botonCantidad.querySelector('.cantidad');
      inputCantidad.addEventListener('change', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee3() {
        var listaCarrito, resultado, seccionProductos, contenedorProductos, alerta, btnAñadir, articuloBuscado, _resultado, _seccionProductos, _contenedorProductos, _alerta;
        return _regeneratorRuntime().wrap(function _callee3$(_context3) {
          while (1) switch (_context3.prev = _context3.next) {
            case 0:
              listaCarrito = Array.from(document.querySelectorAll('.articulo-carrito'));
              if (!(inputCantidad.value <= 0)) {
                _context3.next = 21;
                break;
              }
              _context3.next = 4;
              return eliminarProductoDelCarritoDB(idBuscado);
            case 4:
              resultado = _context3.sent;
              if (!(resultado.error != false)) {
                _context3.next = 13;
                break;
              }
              seccionProductos = document.querySelector('.productos');
              contenedorProductos = document.querySelector('.contenedor-productos');
              alerta = crearAlerta('error', resultado.error);
              seccionProductos.insertBefore(alerta, contenedorProductos);
              return _context3.abrupt("return");
            case 13:
              btnAñadir = crearBtnAñadir(articulo);
              asignarFuncionalidadAñadir(btnAñadir);
              articulo.querySelector('.imagen-producto').classList.remove('articulo-seleccionado');
              botonCantidad.remove();
              articuloBuscado = listaCarrito.find(function (articuloCarrito) {
                return idBuscado == articuloCarrito.dataset.id;
              });
              if (articuloBuscado) {
                articuloBuscado.remove();
              }
            case 19:
              _context3.next = 33;
              break;
            case 21:
              _context3.next = 23;
              return actualizarCantidadProductoDelCarrito({
                'producto_id': idBuscado,
                'cantidad': inputCantidad.value
              });
            case 23:
              _resultado = _context3.sent;
              if (!(_resultado.error != false)) {
                _context3.next = 32;
                break;
              }
              _seccionProductos = document.querySelector('.productos');
              _contenedorProductos = document.querySelector('.contenedor-productos');
              _alerta = crearAlerta('error', 'Ocurrio un error al actualizar el carrito, por favor recargue la pagina');
              _seccionProductos.insertBefore(_alerta, _contenedorProductos);
              return _context3.abrupt("return");
            case 32:
              actualizarCantidadSubtotal(botonCantidad);
            case 33:
              calcularPrecioCantidad();
            case 34:
            case "end":
              return _context3.stop();
          }
        }, _callee3);
      })));
      botonResta.addEventListener('click', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee4() {
        var resultado, seccionProductos, contenedorProductos, alerta, _resultado2, _seccionProductos2, _contenedorProductos2, _alerta2, btnAñadir, listaCarrito, articuloBuscado;
        return _regeneratorRuntime().wrap(function _callee4$(_context4) {
          while (1) switch (_context4.prev = _context4.next) {
            case 0:
              if (!(inputCantidad.value > 1)) {
                _context4.next = 16;
                break;
              }
              inputCantidad.value--;
              _context4.next = 4;
              return actualizarCantidadProductoDelCarrito({
                'producto_id': idBuscado,
                'cantidad': inputCantidad.value
              });
            case 4:
              resultado = _context4.sent;
              if (!(resultado.error != false)) {
                _context4.next = 13;
                break;
              }
              seccionProductos = document.querySelector('.productos');
              contenedorProductos = document.querySelector('.contenedor-productos');
              alerta = crearAlerta('error', 'Ocurrio un error al actualizar el carrito, por favor recargue la pagina');
              seccionProductos.insertBefore(alerta, contenedorProductos);
              return _context4.abrupt("return");
            case 13:
              actualizarCantidadSubtotal(botonCantidad);
            case 14:
              _context4.next = 35;
              break;
            case 16:
              _context4.next = 18;
              return eliminarProductoDelCarritoDB(idBuscado);
            case 18:
              _resultado2 = _context4.sent;
              if (!(_resultado2.error != false)) {
                _context4.next = 27;
                break;
              }
              _seccionProductos2 = document.querySelector('.productos');
              _contenedorProductos2 = document.querySelector('.contenedor-productos');
              _alerta2 = crearAlerta('error', _resultado2.error);
              _seccionProductos2.insertBefore(_alerta2, _contenedorProductos2);
              return _context4.abrupt("return");
            case 27:
              inputCantidad.value--;
              btnAñadir = crearBtnAñadir(articulo);
              asignarFuncionalidadAñadir(btnAñadir);
              botonCantidad.remove();
              articulo.querySelector('.imagen-producto').classList.remove('articulo-seleccionado');
              listaCarrito = Array.from(document.querySelectorAll('.articulo-carrito'));
              articuloBuscado = listaCarrito.find(function (articuloCarrito) {
                return idBuscado == articuloCarrito.dataset.id;
              });
              if (articuloBuscado) {
                articuloBuscado.remove();
              }
            case 35:
              calcularPrecioCantidad();
            case 36:
            case "end":
              return _context4.stop();
          }
        }, _callee4);
      })));
      botonSuma.addEventListener('click', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee5() {
        var resultado, seccionProductos, contenedorProductos, alerta;
        return _regeneratorRuntime().wrap(function _callee5$(_context5) {
          while (1) switch (_context5.prev = _context5.next) {
            case 0:
              inputCantidad.value++;
              _context5.next = 3;
              return actualizarCantidadProductoDelCarrito({
                'producto_id': idBuscado,
                'cantidad': inputCantidad.value
              });
            case 3:
              resultado = _context5.sent;
              if (!(resultado.error !== false)) {
                _context5.next = 12;
                break;
              }
              seccionProductos = document.querySelector('.productos');
              contenedorProductos = document.querySelector('.contenedor-productos');
              alerta = crearAlerta('error', 'Ocurrio un error al actualizar el carrito, por favor recargue la pagina');
              seccionProductos.insertBefore(alerta, contenedorProductos);
              return _context5.abrupt("return");
            case 12:
              actualizarCantidadSubtotal(botonCantidad);
              calcularPrecioCantidad();
            case 14:
            case "end":
              return _context5.stop();
          }
        }, _callee5);
      })));
    };
    var asignarFuncionalidadAñadir = function asignarFuncionalidadAñadir(botonAñadir) {
      var articulo = botonAñadir.parentElement;
      botonAñadir.addEventListener('click', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee6() {
        var idArticulo, listaCarrito, seccionProductos, contenedorProductos, articuloRepetido, alerta, datosProducto, _alerta3, imagenArticulo, btnCantidad;
        return _regeneratorRuntime().wrap(function _callee6$(_context6) {
          while (1) switch (_context6.prev = _context6.next) {
            case 0:
              idArticulo = articulo.dataset.id;
              listaCarrito = Array.from(document.querySelectorAll('.articulo-carrito'));
              seccionProductos = document.querySelector('.productos');
              contenedorProductos = document.querySelector('.contenedor-productos');
              articuloRepetido = listaCarrito.find(function (articulo) {
                return articulo.dataset.id === idArticulo;
              });
              if (!articuloRepetido) {
                _context6.next = 10;
                break;
              }
              alerta = crearAlerta('error', 'El producto que intenta añadir ya se encuentra en el carrito');
              seccionProductos.insertBefore(alerta, contenedorProductos);
              _context6.next = 14;
              break;
            case 10:
              _context6.next = 12;
              return añadirProducto(idArticulo);
            case 12:
              datosProducto = _context6.sent;
              if (datosProducto.error) {
                _alerta3 = crearAlerta('error', datosProducto.error);
                seccionProductos.insertBefore(_alerta3, contenedorProductos);
              } else {
                imagenArticulo = articulo.querySelector('.imagen-producto');
                imagenArticulo.classList.add('articulo-seleccionado');
                console.log(datosProducto);
                crearCarrito(datosProducto);
                btnCantidad = crearBtnCantidad(articulo);
                asignarFuncionalidadCantidad(btnCantidad);
                calcularPrecioCantidad();
                botonAñadir.remove();
              }
            case 14:
            case "end":
              return _context6.stop();
          }
        }, _callee6);
      })));
    };
    var asignarFuncionalidadEliminar = function asignarFuncionalidadEliminar(articuloCarrito, botonBorrar) {
      var idBotonBorrar = articuloCarrito.dataset.id;
      botonBorrar.addEventListener('click', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee7() {
        var articulosMostrados, resultado, seccionProductos, contenedorProductos, alerta, articuloEncontrado, imagenArticulo, botonCantidad, botonAñadir;
        return _regeneratorRuntime().wrap(function _callee7$(_context7) {
          while (1) switch (_context7.prev = _context7.next) {
            case 0:
              articulosMostrados = Array.from(document.querySelectorAll('.articulo'));
              _context7.next = 3;
              return eliminarProductoDelCarritoDB(idBotonBorrar);
            case 3:
              resultado = _context7.sent;
              if (!(resultado.error != false)) {
                _context7.next = 12;
                break;
              }
              seccionProductos = document.querySelector('.productos');
              contenedorProductos = document.querySelector('.contenedor-productos');
              alerta = crearAlerta('error', resultado.error);
              seccionProductos.insertBefore(alerta, contenedorProductos);
              return _context7.abrupt("return");
            case 12:
              articuloEncontrado = articulosMostrados.find(function (articulo) {
                return articulo.dataset.id === idBotonBorrar;
              });
              if (articuloEncontrado) {
                imagenArticulo = articuloEncontrado.querySelector('.imagen-producto');
                imagenArticulo.classList.remove('articulo-seleccionado');
                botonCantidad = articuloEncontrado.querySelector('.boton-cantidad');
                if (botonCantidad) {
                  botonAñadir = crearBtnAñadir(articuloEncontrado);
                  asignarFuncionalidadAñadir(botonAñadir);
                  botonCantidad.remove();
                }
              }
              articuloCarrito.remove();
              calcularPrecioCantidad();
            case 16:
            case "end":
              return _context7.stop();
          }
        }, _callee7);
      })));
    }; //Recalcula el subtotal de un articulo al cambiar la cantidad de este
    var actualizarCantidadSubtotal = function actualizarCantidadSubtotal(articuloTienda) {
      var articulo = articuloTienda.parentElement;
      var articulosCarrito = Array.from(document.querySelectorAll('.articulo-carrito'));
      var nuevaCantidad = articuloTienda.querySelector('.cantidad').value;
      var indiceBuscado = articulo.dataset.id;
      var articuloBuscado = articulosCarrito.find(function (articuloCarrito) {
        return articuloCarrito.dataset.id == indiceBuscado;
      });
      if (!articuloBuscado) {
        var seccionProductos = document.querySelector('.productos');
        var contenedorProductos = document.querySelector('.contenedor-productos');
        var alerta = crearAlerta('error', 'Ocurrio un error al actualizar el carrito, por favor recargue la pagina');
        seccionProductos.insertBefore(alerta, contenedorProductos);
        return;
      }
      var precioUnidad = Number(articuloBuscado.querySelector('.precio-unidad').innerText.replace('@', ''));
      var cantidadActualizada = articuloBuscado.querySelector('.cantidad');
      cantidadActualizada.innerText = "".concat(nuevaCantidad, "x");
      var subtotal = articuloBuscado.querySelector('.precio-total');
      subtotal.innerText = "$".concat((precioUnidad * nuevaCantidad).toFixed(2));
    };
    var calcularPrecioCantidad = function calcularPrecioCantidad() {
      var nuevoPrecioFinal = 0;
      var nuevaCantidadCarrito = 0;
      var listaCarrito = document.querySelectorAll('.articulo-carrito');
      if (listaCarrito.length > 0) {
        listaCarrito.forEach(function (producto) {
          var precioTotal = Number(producto.querySelector('.precio-total').innerText.replace('$', ''));
          var cantidadProducto = Number(producto.querySelector('.cantidad').innerText.replace('x', ''));
          nuevoPrecioFinal += precioTotal;
          nuevaCantidadCarrito += cantidadProducto;
        });

        //Se actualiza el localStorage
        var carritoLocalStorage = Array.from(listaCarrito).map(function (productoCarrito) {
          return {
            producto_id: productoCarrito.dataset.id,
            cantidad: Number(productoCarrito.querySelector('.cantidad').innerText.replace('x', ''))
          };
        });
        localStorage.setItem('carrito', JSON.stringify(carritoLocalStorage));
        //console.log(JSON.parse(localStorage.getItem('carrito') || '[]'));
        //console.log(carritoLocalStorage);
      } else {
        //Se limpia el localstorage
        localStorage.removeItem('carrito');
      }
      var contadorCarrito = document.querySelector('.contador-carrito').querySelector('b');
      contadorCarrito.innerText = nuevaCantidadCarrito;
      if (nuevaCantidadCarrito == 0) {
        var carritoVacio = document.querySelector('.carrito-vacio');
        if (!carritoVacio) {
          crearCarritoVacio();
        }
      }
      var precioFinal = document.querySelector('.precio-final');
      if (precioFinal) {
        precioFinal.innerText = "$".concat(nuevoPrecioFinal.toFixed(2));
      }
    };
    var crearCarrito = function crearCarrito(articulo) {
      var cantidadArticulo = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
      var contenidoCarrito = document.querySelector('.contenido-carrito');
      var nombreArticulo = articulo.nombre;
      var precioArticulo = Number(articulo.precio);
      var idArticulo = articulo.id;
      if (!contenidoCarrito) {
        crearContenidoCarrito();
      }
      var articulosCarrito = document.querySelector('.articulos__carrito');
      var articuloCarrito = document.createElement('LI');
      articuloCarrito.classList.add('articulo-carrito');
      articuloCarrito.dataset.id = idArticulo;
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
      cantidad.innerText = "".concat(cantidadArticulo, "x");
      precioCantidad.appendChild(cantidad);
      var precioUnidad = document.createElement('P');
      precioUnidad.classList.add('precio-unidad');
      precioUnidad.innerText = "@".concat(precioArticulo.toFixed(2));
      precioCantidad.appendChild(precioUnidad);
      var precioTotal = document.createElement('P');
      precioTotal.classList.add('precio-total');
      precioTotal.innerText = "$".concat((precioArticulo * cantidadArticulo).toFixed(2));
      precioCantidad.appendChild(precioTotal);
      var eliminarProducto = document.createElement('BUTTON');
      eliminarProducto.classList.add('eliminar');
      articuloCarrito.appendChild(eliminarProducto);
      var imagenEliminar = document.createElement('IMG');
      imagenEliminar.src = 'build/img/icon-remove-item.svg';
      eliminarProducto.appendChild(imagenEliminar);
      asignarFuncionalidadEliminar(articuloCarrito, eliminarProducto);
    }; //Crea la apariencia del carrito cuando NO tiene articulos dentro
    var crearCarritoVacio = function crearCarritoVacio() {
      var carrito = document.querySelector('.carrito');
      var contenidoCarrito = document.querySelector('.contenido-carrito');
      var carritoVacio = document.createElement('DIV');
      carritoVacio.classList.add('carrito-vacio');
      var imgCarritoVacio = document.createElement('IMG');
      imgCarritoVacio.src = '/build/img/illustration-empty-cart.svg';
      imgCarritoVacio.alt = 'Imagen Carrito Vacio';
      carritoVacio.appendChild(imgCarritoVacio);
      var textoCarritoVacio = document.createElement('P');
      textoCarritoVacio.classList.add('texto-carrito-vacio');
      textoCarritoVacio.innerText = 'Your added items will appear here';
      carritoVacio.appendChild(textoCarritoVacio);
      carrito.appendChild(carritoVacio);
      if (contenidoCarrito) {
        contenidoCarrito.remove();
      }
    }; //Crea la apariencia del carrito cuando tiene articulos dentro
    var crearContenidoCarrito = function crearContenidoCarrito() {
      var carrito = document.querySelector('.carrito');
      var carritoVacio = document.querySelector('.carrito-vacio');
      var contenidoCarrito = document.createElement('DIV');
      contenidoCarrito.classList.add('contenido-carrito');
      var listaContenidoCarrito = document.createElement('UL');
      listaContenidoCarrito.classList.add('articulos__carrito');
      contenidoCarrito.appendChild(listaContenidoCarrito);
      var totalOrden = document.createElement('DIV');
      totalOrden.classList.add('total-orden');
      var textoTotalOrden = document.createElement('P');
      textoTotalOrden.innerText = 'Order Total';
      var precioFinal = document.createElement('P');
      precioFinal.classList.add('precio-final');
      totalOrden.appendChild(textoTotalOrden);
      totalOrden.appendChild(precioFinal);
      contenidoCarrito.appendChild(totalOrden);
      var cartelEcologico = document.createElement('DIV');
      cartelEcologico.classList.add('ecologico');
      var imgCartelEcologico = document.createElement('IMG');
      imgCartelEcologico.src = '/build/img/icon-carbon-neutral.svg';
      cartelEcologico.appendChild(imgCartelEcologico);
      var textoCartelEcologico = document.createElement('P');
      var primerTexto = document.createTextNode('This is a ');
      textoCartelEcologico.appendChild(primerTexto);
      var negritaCartelEcologico = document.createElement('B');
      negritaCartelEcologico.innerText = 'carbon-neutral';
      textoCartelEcologico.appendChild(negritaCartelEcologico);
      var segundoTexto = document.createTextNode(' delibery');
      textoCartelEcologico.appendChild(segundoTexto);
      cartelEcologico.appendChild(textoCartelEcologico);
      var botonConfirmarOrden = document.createElement('A');
      botonConfirmarOrden.href = '/checkout';
      botonConfirmarOrden.classList.add('boton');
      botonConfirmarOrden.classList.add('confirmar-orden');
      botonConfirmarOrden.innerText = 'Confirm Order';
      contenidoCarrito.appendChild(botonConfirmarOrden);
      carrito.appendChild(contenidoCarrito);
      if (carritoVacio) {
        carritoVacio.remove();
      }
    }; //Crea y devuelve un mensaje de alerta
    var crearAlerta = function crearAlerta(tipo, mensaje) {
      var alerta = document.createElement('DIV');
      alerta.classList.add('alerta');
      alerta.classList.add("alerta__".concat(tipo));
      alerta.innerText = mensaje;
      return alerta;
    };
    var rearmarCarrito = /*#__PURE__*/function () {
      var _ref8 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee8() {
        var _carritoProductos$;
        var carritoProductos, carritoNormalizado, carritoLocalStorage, seccionProductos, contenedorProductos, alerta, carritoRearmado, listaCarrito;
        return _regeneratorRuntime().wrap(function _callee8$(_context8) {
          while (1) switch (_context8.prev = _context8.next) {
            case 0:
              _context8.next = 2;
              return recuperarCarrito();
            case 2:
              carritoProductos = _context8.sent;
              carritoNormalizado = [];
              if (!carritoProductos.error) {
                _context8.next = 24;
                break;
              }
              console.log(carritoProductos.error);
              carritoLocalStorage = JSON.parse(localStorage.getItem('carrito') || '[]');
              if (!(carritoLocalStorage.length <= 0)) {
                _context8.next = 11;
                break;
              }
              console.log('localStorage vacio');
              _context8.next = 24;
              break;
            case 11:
              _context8.next = 13;
              return recuperarPrecio(carritoLocalStorage);
            case 13:
              productosPrecios = _context8.sent;
              if (!productosPrecios.error) {
                _context8.next = 22;
                break;
              }
              seccionProductos = document.querySelector('.productos');
              contenedorProductos = document.querySelector('.contenedor-productos');
              alerta = crearAlerta('error', 'Ocurrio un error al actualizar el carrito, por favor recargue la pagina o intentelo de nuevo mas tarde');
              seccionProductos.insertBefore(alerta, contenedorProductos);
              return _context8.abrupt("return");
            case 22:
              carritoRearmado = carritoLocalStorage.map(function (item) {
                var _precio, _precio2;
                precio = productosPrecios.find(function (p) {
                  return p.id === item.producto_id;
                });
                return _objectSpread(_objectSpread({}, item), {}, {
                  nombre: (_precio = precio) === null || _precio === void 0 ? void 0 : _precio.nombre,
                  precio: (_precio2 = precio) === null || _precio2 === void 0 ? void 0 : _precio2.precio
                });
              });
              carritoNormalizado = normalizarListaCarrito(carritoRearmado);
            case 24:
              if ((_carritoProductos$ = carritoProductos[0]) !== null && _carritoProductos$ !== void 0 && _carritoProductos$.producto_id) {
                carritoNormalizado = normalizarListaCarrito(carritoProductos);
              }
              carritoNormalizado.forEach(function (producto) {
                var cantidadArticulos = producto.cantidad;
                crearCarrito(producto, cantidadArticulos);
              });
              calcularPrecioCantidad();
              listaCarrito = document.querySelectorAll('.articulo-carrito');
              return _context8.abrupt("return", listaCarrito);
            case 29:
            case "end":
              return _context8.stop();
          }
        }, _callee8);
      }));
      return function rearmarCarrito() {
        return _ref8.apply(this, arguments);
      };
    }(); //Toma el carrito recuperado de la db o el localstorage y le da el formato correcto
    var normalizarListaCarrito = function normalizarListaCarrito(carritoRecuperado) {
      var carritoNormalizado = Array.from(carritoRecuperado).map(function (_ref9) {
        var producto_id = _ref9.producto_id,
          resto = _objectWithoutProperties(_ref9, _excluded);
        return _objectSpread({
          id: producto_id
        }, resto);
      });
      return carritoNormalizado;
    }; //Funciones para llamar APIS
    //luego se le pueden agregar como parametros que tipo de orden quiere y por que valor ordenarlo
    //ademas del numero de pagina donde se encuentra para rearmar el catalogo segun la pagina
    var recuperarCatalogo = /*#__PURE__*/function () {
      var _ref10 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee9() {
        var url, resultado, productos;
        return _regeneratorRuntime().wrap(function _callee9$(_context9) {
          while (1) switch (_context9.prev = _context9.next) {
            case 0:
              url = "/api/recuperarCatalogo";
              _context9.next = 3;
              return fetch(url);
            case 3:
              resultado = _context9.sent;
              _context9.next = 6;
              return resultado.json();
            case 6:
              productos = _context9.sent;
              return _context9.abrupt("return", productos);
            case 8:
            case "end":
              return _context9.stop();
          }
        }, _callee9);
      }));
      return function recuperarCatalogo() {
        return _ref10.apply(this, arguments);
      };
    }();
    var recuperarCarrito = /*#__PURE__*/function () {
      var _ref11 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee10() {
        var url, resultado, productos;
        return _regeneratorRuntime().wrap(function _callee10$(_context10) {
          while (1) switch (_context10.prev = _context10.next) {
            case 0:
              url = "/api/recuperarCarrito";
              _context10.next = 3;
              return fetch(url);
            case 3:
              resultado = _context10.sent;
              _context10.next = 6;
              return resultado.json();
            case 6:
              productos = _context10.sent;
              return _context10.abrupt("return", productos);
            case 8:
            case "end":
              return _context10.stop();
          }
        }, _callee10);
      }));
      return function recuperarCarrito() {
        return _ref11.apply(this, arguments);
      };
    }();
    var recuperarPrecio = /*#__PURE__*/function () {
      var _ref12 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee11() {
        var carrito,
          url,
          resultado,
          precios,
          _args11 = arguments;
        return _regeneratorRuntime().wrap(function _callee11$(_context11) {
          while (1) switch (_context11.prev = _context11.next) {
            case 0:
              carrito = _args11.length > 0 && _args11[0] !== undefined ? _args11[0] : [];
              url = "/api/recuperarPrecio";
              _context11.next = 4;
              return fetch(url, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(carrito)
              });
            case 4:
              resultado = _context11.sent;
              _context11.next = 7;
              return resultado.json();
            case 7:
              precios = _context11.sent;
              return _context11.abrupt("return", precios);
            case 9:
            case "end":
              return _context11.stop();
          }
        }, _callee11);
      }));
      return function recuperarPrecio() {
        return _ref12.apply(this, arguments);
      };
    }(); //Tengo que cambiar la manera de llamar esta api por un post como en recuperarPrecio
    var añadirProducto = /*#__PURE__*/function () {
      var _ref13 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee12(id) {
        var url, resultado, producto;
        return _regeneratorRuntime().wrap(function _callee12$(_context12) {
          while (1) switch (_context12.prev = _context12.next) {
            case 0:
              url = "/api/a\xF1adirProducto?id=".concat(id);
              _context12.next = 3;
              return fetch(url);
            case 3:
              resultado = _context12.sent;
              _context12.next = 6;
              return resultado.json();
            case 6:
              producto = _context12.sent;
              return _context12.abrupt("return", producto);
            case 8:
            case "end":
              return _context12.stop();
          }
        }, _callee12);
      }));
      return function añadirProducto(_x) {
        return _ref13.apply(this, arguments);
      };
    }();
    var actualizarCantidadProductoDelCarrito = /*#__PURE__*/function () {
      var _ref14 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee13() {
        var producto,
          url,
          resultado,
          precios,
          _args13 = arguments;
        return _regeneratorRuntime().wrap(function _callee13$(_context13) {
          while (1) switch (_context13.prev = _context13.next) {
            case 0:
              producto = _args13.length > 0 && _args13[0] !== undefined ? _args13[0] : [];
              url = "/api/actualizarCantidadProductoDelCarrito";
              _context13.next = 4;
              return fetch(url, {
                method: 'PUT',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(producto)
              });
            case 4:
              resultado = _context13.sent;
              _context13.next = 7;
              return resultado.json();
            case 7:
              precios = _context13.sent;
              return _context13.abrupt("return", precios);
            case 9:
            case "end":
              return _context13.stop();
          }
        }, _callee13);
      }));
      return function actualizarCantidadProductoDelCarrito() {
        return _ref14.apply(this, arguments);
      };
    }();
    var eliminarProductoDelCarritoDB = /*#__PURE__*/function () {
      var _ref15 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee14(productoId) {
        var url, resultado, consulta;
        return _regeneratorRuntime().wrap(function _callee14$(_context14) {
          while (1) switch (_context14.prev = _context14.next) {
            case 0:
              url = "/api/eliminarProductoDelCarrito";
              _context14.next = 3;
              return fetch(url, {
                method: 'DELETE',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(productoId)
              });
            case 3:
              resultado = _context14.sent;
              _context14.next = 6;
              return resultado.json();
            case 6:
              consulta = _context14.sent;
              return _context14.abrupt("return", consulta);
            case 8:
            case "end":
              return _context14.stop();
          }
        }, _callee14);
      }));
      return function eliminarProductoDelCarritoDB(_x2) {
        return _ref15.apply(this, arguments);
      };
    }();
    renderizarPagina();
    ;
  } //Fin de la verificacion que revisa estar en la pagina correcta 
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
/******/ 	__webpack_require__("./src/js/checkout.js");
/******/ 	__webpack_require__("./src/js/tienda.js");
/******/ 	var __webpack_exports__ = __webpack_require__("./src/js/usuarioDatos.js");
/******/ 	
/******/ })()
;
//# sourceMappingURL=main.js.map