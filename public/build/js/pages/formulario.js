
const inputFile = document.querySelector('input.hidden');
const contenedorInputFile = document.querySelector('.formulario__input--file').parentElement;
const inputFileText = document.querySelector('.formulario__input-text')
let URLPreview;

inputFile.addEventListener('change', function(){
    const imagen = inputFile.files[0];
    const previewActual = contenedorInputFile.querySelector('.formulario__img');
    
    if(imagen){
        crearPreview(imagen, contenedorInputFile);
        inputFileText.innerText = imagen.name;
    }else{
        inputFileText.innerText = 'Ningún archivo selecionado';
    }

    if(previewActual){
        previewActual.remove();
    }
});

function crearPreview(imagen, contenedor){

    if(URLPreview){
        URL.revokeObjectURL(URLPreview);
    }

    URLPreview = URL.createObjectURL(imagen);
    const imagenPreview = document.createElement('IMG');
    imagenPreview.src = URLPreview;
    imagenPreview.classList.add('formulario__img');

    contenedor.append(imagenPreview);

}