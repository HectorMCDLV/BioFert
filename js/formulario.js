const formulario = document.getElementById('formulario') //id del formulario al que queremos afectar
const inputs = document.querySelectorAll('#formulario'); //Arreglo de los inputs que tenemos el formulario

const expresiones = {
    usuario: /^[a-zA-Z0-9_-]{4,16}$/, // Letras, numeros, guion y guionbajo
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    password: /^.{4,12}$/, // 4 a 12 digitos.
    correo: /^[a-zA-Z0-9.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{7,14}$/ // 7 a 14 numeros.
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombres":
            if(expresiones.nombre.test(e.target.value)){
                document.getElementById('grupo__usuario').classList.remove('formulario__grupo-incorrecto');
                document.getElementById('grupo__usuario').classList.add('formulario__grupo-correcto');
            } else {
                document.getElementById('grupo__usuario').classList.add('formulario__grupo-incorrecto');
            }
        break;
        case "apellido":

        break;
        case "email":

        break;
        case "contraseña":

        break;
        case "confirma_contraseña":

        break;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario)
    input.addEventListener('blur', validarFormulario)
});

formulario.addEventListener('submit', (e) => {
    e.preventDefault();
})

