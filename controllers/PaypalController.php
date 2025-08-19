<?php

namespace Controllers;

use Exception;
use Model\Producto;

use PaypalServerSdkLib\Environment;

use PaypalServerSdkLib\Models\Builders\ItemBuilder;
use PaypalServerSdkLib\Models\Builders\MoneyBuilder;

use PaypalServerSdkLib\PaypalServerSdkClientBuilder;

use PaypalServerSdkLib\Models\Builders\OrderRequestBuilder;

use PaypalServerSdkLib\Models\Builders\AmountBreakdownBuilder;

use PaypalServerSdkLib\Models\Builders\AmountWithBreakdownBuilder;
use PaypalServerSdkLib\Models\Builders\PurchaseUnitRequestBuilder;

use PaypalServerSdkLib\Authentication\ClientCredentialsAuthCredentialsBuilder;

class PaypalController{


    protected static $client = null;

    public static function getClient(){

        if (!self::$client) {
            self::$client = PaypalServerSdkClientBuilder::init()
                ->clientCredentialsAuthCredentials(
                    ClientCredentialsAuthCredentialsBuilder::init(
                        $_ENV['PAYPAL_CLIENT_ID'],
                        $_ENV['PAYPAL_CLIENT_SECRET']
                    )
                )
                ->environment(Environment::SANDBOX)
                ->build();
        }

        return self::$client;
    }

    public static function handleResponse($response){
        $jsonResponse = json_decode($response->getBody(), true);
        return [
            "jsonResponse" => $jsonResponse,
            "httpStatusCode" => $response->getStatusCode(),
        ];
    }

    /**
     * Create an order to start the transaction.
     *
     */
    public static function createOrder($cart,$shipping,$clientName){
        
        $shippingPreference = $shipping === [] ? 'NO_SHIPPING' : 'SET_PROVIDED_ADDRESS';
        $client = self::getClient();


        $orderArray = self::buildOrder($cart, $shippingPreference, $shipping, $clientName);

        $orderBody = ["body" => $orderArray];


        $apiResponse = $client->getOrdersController()->createOrder($orderBody);

        return self::handleResponse($apiResponse);
    }

    public static function buildOrder($cart, $shippingPreference, $shipping = [], $clientName = ''){
        $pedido = [];
        $precioTotal = 0;
        
        foreach($cart as $producto){
            $precioTotal += ($producto['precio'] * $producto['cantidad']);
            $pedido[] = ItemBuilder::init(
                            $producto['nombre'],
                            MoneyBuilder::init("USD", $producto['precio'])->build(),
                            $producto['cantidad']
                        )
                        ->sku($producto['id'])
                        ->build();
        }

        if($shippingPreference == 'NO_SHIPPING' ){


            $orderObject = 
                OrderRequestBuilder::init("CAPTURE", [
                    PurchaseUnitRequestBuilder::init(
                        AmountWithBreakdownBuilder::init("USD", $precioTotal)
                            ->breakdown(
                                AmountBreakdownBuilder::init()
                                    ->itemTotal(
                                        MoneyBuilder::init("USD", $precioTotal)->build()
                                    )
                                    ->build()
                            )
                            ->build()
                    )
                        ->items($pedido)

                        ->build(),
                ])
                ->build();

            $orderArray = json_decode(json_encode($orderObject), true);

            $orderArray["application_context"] = [
            "return_url" => "https://tusitio.com/checkout/exito",
            "cancel_url" => "https://tusitio.com/checkout/cancelado",
            "shipping_preference" => $shippingPreference
            ];
        }else if($shippingPreference == 'SET_PROVIDED_ADDRESS'){

            $purchaseUnit = PurchaseUnitRequestBuilder::init(
                AmountWithBreakdownBuilder::init("USD", $precioTotal)
                    ->breakdown(
                        AmountBreakdownBuilder::init()
                            ->itemTotal(
                                MoneyBuilder::init("USD", $precioTotal)->build()
                            )
                            ->build()
                    )
                    ->build()
            )
            ->items($pedido)
            ->build();

            $purchaseUnitArray = json_decode(json_encode($purchaseUnit), true);

            $purchaseUnitArray['shipping'] = [
                'name' => ['full_name' => $clientName],
                'address' => [
                    'address_line_1' => $shipping['calle'],
                    'admin_area_2' => $shipping['ciudad'],
                    'admin_area_1' => $shipping['provincia'],
                    'postal_code' => $shipping['codigo_postal'],
                    'country_code' => $shipping['pais']
                ]
            ];

            $orderArray = [
                'intent' => 'CAPTURE',
                'purchase_units' => [$purchaseUnitArray],
                'application_context' => [
                    'return_url' => 'https://tusitio.com/checkout/exito',
                    'cancel_url' => 'https://tusitio.com/checkout/cancelado',
                    'shipping_preference' => $shippingPreference
                ]
            ];

        }
        return $orderArray;
    }

    public static function recuperarDatosProductos($carrito){

        $productosIds = [];
        if(!is_array($carrito)){
            http_response_code(400);
            echo json_encode(['error' => true, 'mensaje' => 'El dato recibido no es un array']);
            exit;
        }

        foreach($carrito as $producto){
            if(!isset($producto['producto_id']) || filter_var($producto['producto_id'], FILTER_VALIDATE_INT) === false
               || !isset($producto['cantidad']) || filter_var($producto['cantidad'], FILTER_VALIDATE_INT) === false){
                http_response_code(400);
                echo json_encode(['error' => true, 'mensaje' => 'El dato recibido no contiene enteros']);
                exit;
            }
                
            if($producto['producto_id'] <= 0 || $producto['cantidad'] <= 0){
                http_response_code(422);
                echo json_encode(['error' => true, 'mensaje' => 'El dato recibido no es valido (menor o igual a cero)']);
                exit;
            }

            $productosIds[] = $producto['producto_id'];
        }

        $productosIds = implode(", ", $productosIds);
        $productosDatos = Producto::thisWhere(['id', 'nombre', 'precio', 'imagen'], 'id', $productosIds, 'IN');

        if(count($carrito) !== count($productosDatos)){
            http_response_code(404);
            echo json_encode(['error' => true, 'mensaje' => 'No se pudo encontrar algún elemento del carrito']);
            exit;
        }

        $carritoReordenado = self::reordenarDatosCarrito($productosDatos);

        $carritoRearmado = self::rearmarCarrito($carrito, $carritoReordenado);
       
        return $carritoRearmado;
    }

    public static function reordenarDatosCarrito($carritoDesordenado){
        $carritoReordenado = [];

        foreach($carritoDesordenado as $producto){
            $carritoReordenado[$producto->id]= [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio
            ];
        }
        return $carritoReordenado;
    }

    public static function rearmarCarrito($carrito, $carritoReordenado){
        $carritoRearmado = [];
        foreach($carrito as $producto){
            $carritoRearmado[] = [
                'id' => $producto['producto_id'],
                'nombre' => $carritoReordenado[$producto['producto_id']]['nombre'],
                'precio' => $carritoReordenado[$producto['producto_id']]['precio'],
                'cantidad' => $producto['cantidad']
            ];
        }
        return $carritoRearmado;
    }

    public static function crearPedido(){
        $data = json_decode(file_get_contents("php://input"), true);
        $cart = $data["cart"];
        $shipping = $data["shipping"];
        $clientName = $data["clientName"];
        header("Content-Type: application/json");
        $carritoRearmado = self::recuperarDatosProductos($cart);
        
        try {
            $orderResponse = self::createOrder($carritoRearmado,$shipping,$clientName);
            echo json_encode($orderResponse['jsonResponse']);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
            http_response_code(500);
        }
    }


    /**
     * Capture payment for the created order to complete the transaction.
     * @see https://developer.paypal.com/docs/api/orders/v2/#orders_capture
     */
    public static function captureOrder($orderID){
        $client = self::getClient();

        $captureBody = [
            "id" => $orderID,
        ];

        $apiResponse = $client->getOrdersController()->captureOrder($captureBody);

        return self::handleResponse($apiResponse);
    }

    public static function capturarPedido(){
        $data = json_decode(file_get_contents("php://input"), true);
        $orderID = $data['orderID'];
        header("Content-Type: application/json");
        try {
            $captureResponse = self::captureOrder($orderID);
            echo json_encode($captureResponse["jsonResponse"]);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
            http_response_code(500);
        }
    }

}
