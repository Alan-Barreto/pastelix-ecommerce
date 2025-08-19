<?php

namespace Controllers;

use MVC\Router;
use Model\Pedido;
use Model\Carrito;
use Model\Usuario;
use Model\Producto;
use Model\PedidoCliente;
use Model\PedidoProducto;
use Model\PedidoDireccion;

class AdminController{
    public static function admin(Router $router){
       if(!is_admin()){
            header('Location: /');
            exit();
        }else{

            $gananciaDelDia = Pedido::thisByDate(['total'], 'fecha');
            
            $totalGanadoHoy = 0;

            foreach($gananciaDelDia as $ganancia){
                $totalGanadoHoy += $ganancia->total;
            }

            $pedidosHoy = Pedido::countByDate('fecha');



            $ultimosPedidos = Pedido::allPaginated(5,0,'id','DESC');


            $router->render('admin/admin',[
                'titulo' => 'Administracion - Inicio',
                'totalGanadoHoy' => $totalGanadoHoy,
                'pedidosHoy' => $pedidosHoy, 
                'ultimosPedidos' => $ultimosPedidos
            ], 'adminLayout');
        }
    }

    public static function productos(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $productos = Producto::all('ASC');
       
            $router->render('admin/productos/productos',[
                'titulo' => 'Administracion - Productos',
                'productos' => $productos
            ], 'adminLayout');
        }
    }

    public static function crearProducto(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $alertas = '';
            $producto = new Producto();
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if($_FILES['imagen']['tmp_name']){
                        $nombreImagen = md5(uniqid(rand(), true));
                        $imagen = $_FILES['imagen']['tmp_name'];
                        $_POST['imagen'] = $nombreImagen;   
                        $alertas = Producto::validarImagen($imagen); 
                }
                $producto->sincronizar($_POST);
                $alertas = $producto->validarProducto(true);
                if(empty($alertas)){
                        procesarImagen($imagen,$nombreImagen, true); 
                        $producto->guardar();

                        setAlertaSession('exito', 'Producto creado con exito');
                        header('Location: /admin/productos');
                        exit;
                }
            }

            $router->render('admin/productos/crear',[
                'titulo' => 'Administracion - Nuevo Producto',
                'producto' => $producto,
                'alertas' => $alertas
            ], 'adminLayout');
        } 
    }

    public static function editarProducto(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
             $alertas = '';
        $producto = Producto::validarIdProducto();
        $imagenNueva = false;
        if(!$producto){
            setAlertaSession('error', 'Producto no encontrado');
            header('Location: /admin/productos');
            exit;
        }else{
            $imagenActual = $producto->imagen;
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if($_FILES['imagen']['tmp_name']){
                    $nombreImagen = md5(uniqid(rand(), true));
                    $imagen = $_FILES['imagen']['tmp_name'];
                    $_POST['imagen'] = $nombreImagen;   
                    $alertas = Producto::validarImagen($imagen); 
                    if(empty($alertas)){
                        $imagenNueva = true;
                        $ruta = __DIR__.'/../public/img/productos/'.$imagenActual;
                    }
                }
                $producto->sincronizar($_POST);
                $alertas = $producto->validarProducto();
                if(empty($alertas)){
                    if($imagenNueva){
                        borrarImagen($ruta);
                        procesarImagen($imagen, $nombreImagen , true);
                    }
                    $producto->guardar();
                    setAlertaSession('exito', 'Producto '. $producto->id . ' actualizado con exito');
                    header('Location: /admin/productos');
                    exit;
               }
            }
        }
            $router->render('admin/productos/editar',[
                'titulo' => 'Administracion - Editar Producto',
                'producto' => $producto,
                'alertas' => $alertas,
                'imagenActual' => $imagenActual
            ], 'adminLayout');
        }
    }

    public static function borrarProducto(){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $producto = Producto::validarIdProducto();
            if(!$producto){
                setAlertaSession('error', 'Producto no encontrado');
                header('Location: /admin/productos');
                exit();
           }else{
                $ruta = __DIR__.'/../public/img/productos/'.$producto->imagen;
                borrarImagen($ruta);
                $producto->delete();
                setAlertaSession('exito', 'Producto eliminado con exito');
                 header('Location: /admin/productos');
                 exit();
           }
        }
    }

    public static function dashboard(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $fechaVentas = '';
            $datosVentas = [];
            $gananciasTotales = 0;
            $totalProductosVendidos = 0;

            $fechaPedidos = '';
            $datosPedidos = [];

            $fechaUsuarios = '';
            $usuariosRegistrados = 0;


            if(isset($_GET['pedidos_recibidos_fecha']) && isset($_GET['ventas_fecha']) && isset($_GET['usuarios_fecha'])){
                switch($_GET['ventas_fecha']){
                    
                    case 'hoy':
                        $fechaVentas = '';
                        break;
                    
                    case 'ultima_semana':
                        $fechaVentas = '1 WEEK';
                        break;

                    case 'ultimo_mes':
                        $fechaVentas = '1 MONTH';
                        break;

                    case 'ultimos_tres_meses':
                        $fechaVentas = '3 MONTH';
                        break;

                }

                switch($_GET['pedidos_recibidos_fecha']){
                     case 'hoy':
                        $fechaPedidos = '';
                        break;
                    
                    case 'ultima_semana':
                        $fechaPedidos = '1 WEEK';
                        break;

                    case 'ultimo_mes':
                        $fechaPedidos = '1 MONTH';
                        break;

                    case 'ultimos_tres_meses':
                        $fechaPedidos = '3 MONTH';
                        break;

                }

                switch($_GET['usuarios_fecha']){
                    
                    case 'hoy':
                        $fechaUsuarios = '';
                        break;
                    
                    case 'ultima_semana':
                        $fechaUsuarios = '1 WEEK';
                        break;

                    case 'ultimo_mes':
                        $fechaUsuarios = '1 MONTH';
                        break;

                    case 'ultimos_tres_meses':
                        $fechaUsuarios = '3 MONTH';
                        break;

                }
            }

            if(isset($_GET['ventas_fecha']) && $_GET['ventas_fecha'] == 'all'){
                $datosVentas = Pedido::this(['id', 'total']);
            }else{
                $datosVentas = Pedido::thisByDate(['id', 'total'],'fecha', $fechaVentas);
            }
            
            $arrayPedidosId = [];

            foreach($datosVentas as $venta){
                $gananciasTotales += $venta->total;
                $arrayPedidosId[] = $venta->id;

            }

            $pedidosId = implode(", ", $arrayPedidosId);

            if(!empty($pedidosId)){
                $productosVendidos = PedidoProducto::thisWhere(['cantidad'],'pedido_id', $pedidosId, 'IN');
                foreach($productosVendidos as $producto){
                    $totalProductosVendidos += $producto->cantidad;
                }
            }


            if(isset($_GET['pedidos_recibidos_fecha']) && $_GET['pedidos_recibidos_fecha'] == 'all'){
                $datosPedidos = Pedido::this(['usuario_id','entrega', 'estado' ]);
            }else{
                $datosPedidos = Pedido::thisByDate(['usuario_id', 'entrega', 'estado'],'fecha', $fechaPedidos);
            }

            $tipoUsuario = ['cliente' => 0, 'invitado' => 0];
            $estadoPedido = ['pagados' => 0, 'enviados' => 0,'completados' => 0, 'cancelados' => 0];
            $tipoEntrega = ['tienda' => 0, 'domicilio' => 0];

            foreach($datosPedidos as $pedido){
                if($pedido->usuario_id == 1){
                    $tipoUsuario['invitado'] += 1;
                }else{
                    $tipoUsuario['cliente'] += 1;
                }

                switch($pedido->estado){
                    case 'pagado':
                        $estadoPedido['pagados'] += 1;
                        break;

                    case 'enviado':
                        $estadoPedido['enviados'] += 1;
                        break;

                    case 'completado':
                        $estadoPedido['completados'] += 1;
                        break;

                    case 'cancelado':
                        $estadoPedido['cancelados'] += 1;
                        break;
                }

                switch($pedido->entrega){
                    case 'tienda':
                        $tipoEntrega['tienda'] += 1;
                        break;

                    case 'domicilio':
                        $tipoEntrega['domicilio'] += 1;
                        break;
                }
            }

           

            
            if(isset($_GET['usuarios_fecha']) && $_GET['usuarios_fecha'] == 'all'){
                 $usuarios = Usuario::thisWhere(['id'], 'fecha_registro', '', 'IS NOT NULL');
                 $usuariosRegistrados = count($usuarios);
            }else{
                $usuariosRegistrados = Usuario::countByDate('fecha_registro', $fechaUsuarios);
            }

            $router->render('admin/dashboard',[
            'titulo' => 'Administracion - Dashboard',
            'gananciasTotales' => $gananciasTotales,
            'totalProductosVendidos' => $totalProductosVendidos,
            'tipoUsuario' => $tipoUsuario,
            'estadoPedidos' => $estadoPedido,
            'usuariosRegistrados' => $usuariosRegistrados,
            'tipoEntrega' => $tipoEntrega ?? ''
            ], 'adminLayout');
        }     
    }

    public static function usuarios(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $filtrar = false;
            $filtroValor = '';
            $orden = 'id';
            $sentido = 'ASC';

            switch($_GET['filtro']){    
                case 'solo_clientes':
                    $filtrar = true;
                    $filtroValor = 0;
                    break;

                case 'solo_admins':
                    $filtrar = true;
                    $filtroValor = 1;
                    break;            
            }

            switch($_GET['orden'] ?? 'id-asc'){
                case 'id-desc':
                    $orden = 'id';
                    $sentido = 'DESC';
                    break;

                case 'id-asc':
                    $orden = 'id';
                    $sentido = 'ASC';
                    break;

                case 'correo-desc':
                    $orden = 'email';
                    $sentido = 'DESC';
                    break;

                case 'correo-asc':
                    $orden = 'email';
                    $sentido = 'ASC';
                    break;

                case 'nombre_apellido-desc':
                    $orden = 'nombre DESC, apellido';
                    $sentido = 'DESC';
                    break;

                case 'nombre_apellido-asc':
                    $orden = 'nombre ASC, apellido';
                    $sentido = 'ASC';
                    break;

                case 'confirmado-desc':
                    $orden = '(confirmado != 1) DESC';
                    $sentido = ', id DESC';
                    break;

                case 'confirmado-asc':
                    $orden = '(confirmado != 1) ASC';
                    $sentido = ', id DESC';
                    break;
                
                case 'rol-desc':
                    $orden = '(admin != 1) DESC';
                    $sentido = ', id DESC';
                    break;

                case 'rol-asc':
                    $orden = '(admin != 1) ASC';
                    $sentido = ', id DESC';
                    break;

                case 'estado-desc':
                    $orden = 'baneo';
                    $sentido = 'DESC';
                    break;

                case 'estado-asc':
                    $orden = 'baneo';
                    $sentido = 'ASC';
                    break;
            }

            $limitePorPagina = 5;
            

            if($filtrar == false){  
                $totalUsuarios = Usuario::count('id', 1, '!=');
                $numeroPaginas = ceil(($totalUsuarios)/ $limitePorPagina);

                if(!isset($_GET['pagina']) || $_GET['pagina'] <= 0 || $_GET['pagina'] > $numeroPaginas ){
                    $paginaActual = 1;
                }else{
                    $paginaActual = $_GET['pagina'];
                }
                $offset = ($paginaActual - 1) * $limitePorPagina;

                $listaUsuarios = Usuario::thisWherePaginated($limitePorPagina,$offset, $orden, $sentido,
                                                                ['id', 'nombre', 'apellido', 'email', 'confirmado', 'admin', 'baneo'], 'id', 1, '!=');
            }else{

                $totalUsuarios = Usuario::count('id != 1 AND admin', $filtroValor);
                $numeroPaginas = ceil($totalUsuarios/ $limitePorPagina);

                if(!isset($_GET['pagina']) || $_GET['pagina'] <= 0 || $_GET['pagina'] > $numeroPaginas ){
                    $paginaActual = 1;
                }else{
                    $paginaActual = $_GET['pagina'];
                }
                $offset = ($paginaActual - 1) * $limitePorPagina;
                $listaUsuarios = Usuario::thisWherePaginated($limitePorPagina,$offset, $orden, $sentido,
                                                                ['id', 'nombre', 'apellido', 'email', 'confirmado', 'admin', 'baneo'], 'id != 1 AND admin', $filtroValor);
            }   
            $router->render('admin/usuarios/usuarios',[
                'titulo' => 'Administracion - Usuarios',
                'listaUsuarios' => $listaUsuarios,
                'paginaActual' => $paginaActual,
                'numeroPaginas' => $numeroPaginas,
            ], 'adminLayout');
        }     
    }

    public static function detallesUsuario(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $error = false;
            $usuarioId = $_GET['id'];
            if(!isset($usuarioId) || $usuarioId == '' || !filter_var($usuarioId, FILTER_VALIDATE_INT) || $usuarioId == 1){
                $error = true;
            }else{
                
                $datosUsuario = Usuario::thisWhere(
                    ['id', 'nombre', 'apellido', 'email', 'telefono', 'fecha_registro', 'confirmado', 'admin', 'baneo'], 
                    'id', 
                    $usuarioId);
                
                if(!$datosUsuario){
                    $error = true;
                }else{
                    $cantidadPedidos = Pedido::count('usuario_id', $usuarioId);
                    $datosPedidos = Pedido::thisWhere(['total', 'entrega', 'estado'], 'usuario_id', $usuarioId);
                    
                    $totalPagado = 0;
                    $pedidosTienda = 0;
                    $pedidosDomicilio = 0;
                    $pedidosCancelados = 0;
                    $pedidosCompletados = 0;
                    $pedidosPendientes = 0;

                    foreach($datosPedidos as $pedido){
                        if($pedido->estado != 'cancelado'){
                            $totalPagado += $pedido->total;
                        }

                        switch($pedido->estado){
                            case 'cancelado':
                                $pedidosCancelados ++;
                                break;
                            
                            case 'completado':
                                $pedidosCompletados ++;
                                break;

                            default:
                                $pedidosPendientes ++;
                                break;
                        }

                        switch($pedido->entrega){
                            case 'domicilio':
                                $pedidosDomicilio ++;
                                break;
                            
                            case 'tienda':
                                $pedidosTienda ++;
                                break;
                        }
                    }
                }   
                if($_SERVER['REQUEST_METHOD'] === 'POST'){

                    if(!isset($_POST['id']) || !filter_var($_POST['id'], FILTER_VALIDATE_INT) || $_POST['id'] == 1){
                    //terminar esta parte
                        echo 'error';
                    }else{
                        $usuarioId = $_POST['id'];
                        $resultado = Usuario::thisWhere(['admin'], 'id', $usuarioId);

                        if(!$resultado || $resultado[0]->admin == 1){
                        //terminar esta parte
                            echo 'error';

                        }else{
                            $usuarioBuscado = Usuario::where('id', $usuarioId);

                            switch($usuarioBuscado->baneo){
                                case '1':
                                    $usuarioBuscado->baneo = 0;
                                    break;

                                case '0':
                                    $usuarioBuscado->baneo = 1;
                                    break;
                            }
                            $usuarioBuscado->guardar();
                            
                            header("Location: /admin/usuarios/usuario?id=$usuarioId");
                            exit;
                        }
                    }
                    
                }
            }

            

             $router->render('admin/usuarios/detalles',[
                'titulo' => 'Administracion - Detalles Usuario',
                'error' => $error,
                'usuario' => $datosUsuario[0],
                'pagado' => $totalPagado,
                'pedidos' =>[
                    'total' => $cantidadPedidos,
                    'retiroEnTienda' => $pedidosTienda,
                    'domicilio' => $pedidosDomicilio,
                    'cancelados' => $pedidosCancelados,
                    'completados' => $pedidosCompletados,
                    'pendientes' => $pedidosPendientes
                ]
            ], 'adminLayout');
        }      
    }

    public static function ventas(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $fecha = '';

            $listaVacia = false;
            $listaPedidos = [];

            if(isset($_GET['fecha'])){
                switch($_GET['fecha']){
                         case 'hoy':
                        $fecha = '';
                        break;
                    
                    case 'ultima_semana':
                        $fecha = '1 WEEK';
                        break;

                    case 'ultimo_mes':
                        $fecha = '1 MONTH';
                        break;

                    case 'ultimos_tres_meses':
                        $fecha = '3 MONTH';
                        break;

                }
            }

            if(isset($_GET['fecha']) && $_GET['fecha'] == 'all'){
                $listaPedidos = Pedido::countAll();
            }else{
                $listaPedidos = Pedido::countByDate('fecha', $fecha);
            }

            if($listaPedidos == 0){
                $listaVacia = true;
            }else{

                switch($_GET['orden'] ?? 'cantidad-desc'){
                    case 'numero-desc':
                        $orden = 'id';
                        $sentido = 'DESC';
                        break;
                    
                    case 'numero-asc':
                        $orden = 'id';
                        $sentido = 'ASC';
                        break;

                    case 'nombre-desc':
                        $orden = 'nombre';
                        $sentido = 'DESC';
                        break;
                    
                    case 'nombre-asc':
                        $orden = 'nombre';
                        $sentido = 'ASC';
                        break;
                    
                    case 'cantidad-desc':
                        $orden = 'cantidad_vendida';
                        $sentido = 'DESC';
                        break;
                    
                    case 'cantidad-asc':
                        $orden = 'cantidad_vendida';
                        $sentido = 'ASC';
                        break;

                    case 'recaudado-desc':
                        $orden = 'dinero_recaudado';
                        $sentido = 'DESC';
                        break;
                    
                    case 'recaudado-asc':
                        $orden = 'dinero_recaudado';
                        $sentido = 'ASC';
                        break;

                    default :
                        $orden = 'cantidad_vendida';
                        $sentido = 'DESC';
                    break;
                }     
                $limitePorPagina = 3;
                $totalProductos = Producto::countAll();
                $numeroPaginas = ceil($totalProductos/ $limitePorPagina);

                if(!isset($_GET['pagina']) || $_GET['pagina'] <= 0 || $_GET['pagina'] > $numeroPaginas ){
                $paginaActual = 1;

                }else{
                $paginaActual = $_GET['pagina'];
                }
                $offset = ($paginaActual - 1) * $limitePorPagina;

                if($_GET['fecha'] == 'all'){
                    $listaProductos = Producto::paginacionVentasAll($orden,$sentido,$limitePorPagina,$offset);
                    $masVendido = Producto::masVendidoAll();

                }else{
                    $listaProductos = Producto::paginacionVentas($orden,$sentido,$limitePorPagina, $offset, $fecha);
                    $masVendido = Producto::masVendido($fecha);
                }
            }      
            $router->render('admin/ventas',[
            'titulo' => 'Administracion - Ventas',
            'listaVacia' => $listaVacia,
            'productoMasVendido' => $masVendido ?? [],
            'listaProductos' => $listaProductos ?? [],
            'paginaActual' => $paginaActual,
            'numeroPaginas' => $numeroPaginas
            ], 'adminLayout');
        }     
    }

    public static function pedidos(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit();
        }else{
            $limitePorPagina = 5;
            $totalPedidos = Pedido::countAll();
            $numeroPaginas = ceil($totalPedidos/ $limitePorPagina);

            if(!isset($_GET['pagina']) || $_GET['pagina'] <= 0 || $_GET['pagina'] > $numeroPaginas ){
                $paginaActual = 1;
            }else{
                $paginaActual = $_GET['pagina'];
            }
            $offset = ($paginaActual - 1) * $limitePorPagina;
            
            switch($_GET['orden'] ?? 'numero_pedido-desc'){
                case 'numero_pedido-desc':
                    $orden = 'id';
                    $sentido = 'DESC';
                    break;
                
                case 'numero_pedido-asc':
                    $orden = 'id';
                    $sentido = 'ASC';
                    break;

                case 'cliente_invitado-desc':
                    $orden = '(usuario_id != 1) DESC';
                    $sentido = ', usuario_id DESC';
                    break;
                
                case 'cliente_invitado-asc':
                    $orden = '(usuario_id != 1) ASC';
                    $sentido = ', usuario_id DESC';
                    break;

                case 'entrega-desc':
                    $orden = 'entrega';
                    $sentido = 'DESC';
                    break;
                
                case 'entrega-asc':
                    $orden = 'entrega';
                    $sentido = 'ASC';
                    break;

                case 'pagado-desc':
                    $orden = 'total';
                    $sentido = 'DESC';
                    break;
                
                case 'pagado-asc':
                    $orden = 'total';
                    $sentido = 'ASC';
                    break;
                
                case 'estado-desc':
                    $orden = 'estado';
                    $sentido = 'DESC';
                    break;
                
                case 'estado-asc':
                    $orden = 'estado';
                    $sentido = 'ASC';
                    break;

                case 'fecha-desc':
                    $orden = 'fecha';
                    $sentido = 'DESC';
                    break;
                
                case 'fecha-asc':
                    $orden = 'fecha';
                    $sentido = 'ASC';
                    break;
            }     

            $pedidos = Pedido::allpaginated($limitePorPagina,$offset,$orden, $sentido);
            
             $router->render('admin/pedidos',[
            'titulo' => 'Administracion - Pedidos',
            'numeroPaginas' => $numeroPaginas,
            'paginaActual' => $paginaActual,
            'pedidos' => $pedidos
            ], 'adminLayout');
        }
    }

    public static function detallesPedido(Router $router){
        if(!is_admin()){
            header('Location: /');
            exit;
        }

        if(!isset($_GET['id'])){
            header('Location: /admin/pedidos');
            exit;
        }
        $error = false;

        if(!filter_var($_GET['id'],FILTER_VALIDATE_INT) || $_GET['id'] <= 0){
            $error = true;
            $mensajeError = 'Nº pedido no valido';
            
        }

        if($error == false){
             $pedido = Pedido::where('id', $_GET['id']);

            if(!$pedido){
                $error = true;
                $mensajeError = 'Pedido no encontrado';
            }else{
                $pedidoProductos = '';
                $productosDatos = '';
                $cliente = '';
                $direccion = '';

                $db = Pedido::getDB();
                $db->autocommit(false);

                try{
                    $pedidoProductos = PedidoProducto::allWhere('pedido_id', $pedido->id);

                    $arrayProductosId = [];
                    foreach($pedidoProductos as $producto){ 
                        $arrayProductosId[] = $producto->producto_id;
                    }
                    $listaProductosId = implode(", ", $arrayProductosId);

                    $productosDatos = Producto::thisWhere(['id', 'nombre', 'imagen'], 'id', $listaProductosId, 'IN', 'FIELD');

                    $cliente = PedidoCliente::where('pedido_id', $pedido->id);

                    if($pedido->entrega == 'domicilio'){    
                        $direccion = PedidoDireccion::where('pedido_id', $pedido->id);
                    }
                    $db->commit();
                } catch(\Exception  $e){
                    $db->rollback();
                    $error = true;
                    $mensajeError = 'Hubo un error recuperando los datos del pedido';
                }

                $pedidoProductosReordenado = [];

                foreach($pedidoProductos as $producto){
                    $pedidoProductosReordenado[$producto->producto_id] = [
                        'cantidad' => $producto->cantidad,
                        'precio_unitario' => $producto->precio_unitario
                    ]; 
                }

                $listaProductos = [];

                foreach($productosDatos as $producto){
                    $subtotal = $pedidoProductosReordenado[$producto->id]['precio_unitario'] * $pedidoProductosReordenado[$producto->id]['cantidad'];
                    $listaProductos[] = [
                        'nombre' => $producto->nombre,
                        'precio' => $pedidoProductosReordenado[$producto->id]['precio_unitario'],
                        'cantidad' => $pedidoProductosReordenado[$producto->id]['cantidad'],
                        'subtotal' => $subtotal,
                        'imagen' => $producto->imagen
                    ];
                }
            }
        }
       
        
        $router->render('admin/pedido',[
            'titulo' => 'Administracion - Detalles Pedido',
            'error' => $error ?? false,
            'mensajeError' => $mensajeError ?? '',
            'pedido' => $pedido ?? '',
            'cliente' => $cliente ?? '',
            'direccion' => $direccion ?? '',
            'productos' => $listaProductos ?? ''
            
        ], 'adminLayout');
    }
}