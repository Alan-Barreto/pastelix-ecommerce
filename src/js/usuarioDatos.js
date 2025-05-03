(function(){

        usuario = document.querySelector('.usuario');
        if(usuario){
            miCuenta = document.querySelector('.datos__contenedor')
            if(miCuenta){

                datos = document.querySelector('.formulario__datos').parentNode
                abrirDatos = document.querySelector('.modificar')
                cerrarDatos =  document.querySelector('.formulario__datos').nextElementSibling

                correo = document.querySelector('.formulario__correo').parentNode
                abrirCorreo = document.querySelector('.correo')
                cerrarCorreo =  document.querySelector('.formulario__correo').nextElementSibling

                contraseña = document.querySelector('.formulario__contraseña').parentNode
                abrirContraseña = document.querySelector('.contraseña')
                cerrarContraseña =  document.querySelector('.formulario__contraseña').nextElementSibling
                
                abrirDatos.addEventListener('click', function(){
                   
                    datos.classList.toggle('formulario--ocultar')
                    correo.classList.add('formulario--ocultar')
                    contraseña.classList.add('formulario--ocultar')
                    
                })
                
                cerrarDatos.addEventListener('click', function(){
                    datos.classList.add('formulario--ocultar')
                })

                abrirCorreo.addEventListener('click', function(){
                   
                    datos.classList.add('formulario--ocultar')
                    correo.classList.toggle('formulario--ocultar')
                    contraseña.classList.add('formulario--ocultar')
                    
                })

                cerrarCorreo.addEventListener('click', function(){
                    correo.classList.add('formulario--ocultar')
                })

                abrirContraseña.addEventListener('click', function(){
                   
                    datos.classList.add('formulario--ocultar')
                    correo.classList.add('formulario--ocultar')
                    contraseña.classList.toggle('formulario--ocultar')
                    
                })

                cerrarContraseña.addEventListener('click', function(){
                    contraseña.classList.add('formulario--ocultar')
                })


            }
           
        }
       
})();
