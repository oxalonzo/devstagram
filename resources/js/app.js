
import Dropzone from 'dropzone';

//por defecto dropzone buscara u elemento que tenga la clase de dropzone pero uno quiere darle
//comportamiento y decirle a que ruta y a que endpoint queremos enviar las peticiones o a las imagenes en este caso 

Dropzone.autoDiscover = false;

//creo una nueva instancia de lo que se esta importando 
//la instancia toma un selector donde se colocara el dropzone en este caso tenemos tanto id como la clase en create.blade.php
//las llaves son para una configuraacion extra

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aqui tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,//permite a el usuario quitar su imagen
    dictRemoveFile: "Borrar archivos",
    maxFiles: 1,
    uploadMultiple: false,

    //una funcion que se ejecutra cuando se cree dropzone o sea cuando dropzone es inicializado
    init: function() {
        //en caso de halla algo en el input de imagen va a selecionar lo que halla y llenar a los atibutos de dropzone
        if (document.querySelector('[name="imagen"]').value.trim()) {

            const imagenPublicada = {}

            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            //opciones de dropzone, esto ya es interno de dropzone
            this.options.addedfile.call( this, imagenPublicada);

            this.options.thumbnail.call( this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add(
                'dz-success',
                'dz-complete'
            );
            
        }
    }
})

//agregando un evento de ddropzone
//ele evento sending es cuanod estas enviando un archivo
//dentro del function se pasan varios parametros que son file que es la variable, xhr que es la peticion y formData

// dropzone.on("sending", function(file, xhr, formData){
//     console.log(formData);
// });


//otro evento, este es en caso de que se suba correctamente la imagen
//este response recibe la respuesta del controlador
dropzone.on("success", function(file, response){

        // console.log(response);
        //asignando ese valor al input que esta hidden de la imagen en el formulario que subio el usuario
        //esto asigna ese valor a el input de name imagen desde la foto que se guarda en el store de la pagina
        document.querySelector('[name="imagen"]').value = response.imagen;


    });

//tambien se tiene el evento error en caso de que el codigo este bien en el backend pero no se pueda subir bien 

// dropzone.on("error", function(file, message){
//     console.log(message);
// });


//tambien se tiene el evento removefile para remover archivos 
dropzone.on("removedfile", function(){

    //resetea el valor del input hidden si eliminan la foto
    document.querySelector('[name="imagen"]').value = "";
});












