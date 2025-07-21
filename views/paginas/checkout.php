
<main class="checkout">
    <form class="checkout__formulario formulario">
        <legend>Datos del cliente</legend>
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Ingresa tu Nombre" class="formulario__input campo-nombre" value="<?php echo $usuario->nombre ?? '' ;?>">
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Ingresa tu Apellido" class="formulario__input campo-apellido" value="<?php echo $usuario->apellido ?? '' ; ?>">
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario__label">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Ingresa tu E-mail" class="formulario__input campo-email" value="<?php echo $usuario->email ?? '' ; ?>">
        </div>

        <div class="formulario__campo">
            <label for="telefono" class="formulario__label">Telefono</label>
            <input type="tel" name="telefono" id="telefono" placeholder="Ingresa tu Telefono" class="formulario__input campo-telefono" value="<?php echo $usuario->telefono ?? '' ; ?>">
        </div>

        <legend>Metodo de entrega</legend>
        <div class="contenedor__metodo-entrega">
            <div class="formulario__campo campo-entrega">
                <label for="tienda" class="formulario__label">
                    Recoger en tienda
                    <input type="radio" name="entrega" id="tienda"  class="formulario__input" value="tienda" checked>
                </label>
            </div>

            <div class="formulario__campo">
                <label for="domicilio" class="formulario__label">
                    Envio a domicilio
                    <input type="radio" name="entrega" id="domicilio"  class="formulario__input" value="domicilio">
                </label>
                
            </div>
        </div>
        
    </form>

    <div class="checkout__resumen">
        <div class="carrito">
            
        </div>
        <div class="boton__paypal">
    
            <div id="paypal-button-container"></div>
            <p id="result-message"></p>
        </div>
    </div>
</main>
                                               
<script
    src="https://www.paypal.com/sdk/js?client-id=<?php echo $_ENV['PAYPAL_CLIENT_ID']; ?>&buyer-country=US&currency=USD&components=buttons&enable-funding=venmo,paylater,card"
    data-sdk-integration-source="developer-studio"
></script>

