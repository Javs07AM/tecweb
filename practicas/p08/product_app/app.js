// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () { //esta propiedad cambia cuando se regrese una respuesta
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let template = '';
                productos.forEach(function (producto) {/* va iterando entre cada elemento del productos y cada elemento se le llama
                producto*/
                    // SE CREA LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    // SE llena la PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });
                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
            else{
                let template = '';
                template += `
                    <tr>
                        <td>No se encontraron resultados</td>
                        <td></td>
                        <td></td>
                    </tr>
                `;
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("id="+id);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);
    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    finalJSON['nombre'] = document.getElementById('name').value;

    console.log(finalJSON['precio']);


    var nombre=finalJSON['nombre'];
    var marca = finalJSON['marca'];
    var modelo=finalJSON['modelo'];
    var precio=finalJSON['precio'];
    var detalles=finalJSON['detalles'];
    var unidades=finalJSON['unidades'];
    var imagen=finalJSON['imagen'];

    if(nombre.length<=0 || nombre.length>100){
        alert('EL nombre no debe de tener menos o 0 caracteres ni tampoco tener mas de 100!!!');
        return; 
        /*con return, la función agregarProducto se detendrá inmediatamente en ese punto y no ejecutará el código restante en la función. */
    }
    else{
        /*se verifica el modelo*/
        var modelo = modelo.trim();
        var esAlfanumerico = /^[A-Z]{2}-\d{3}$/.test(modelo); 

        if (!esAlfanumerico) {
            alert('El campo "modelo" es obligatorio y no puede estar en blanco.');
            return; 
        }
        else{
            var esPrecioValido = !isNaN(parseFloat(precio)) && isFinite(precio) && parseFloat(precio) > 99.99;
            if (!esPrecioValido) {
                alert('El precio ingresado no es un número válido o debe de ser mayor a 99.99.');
                return; 
            } 
            else {
                if(detalles.length >= 250){
                    alert('Los detalles deben de ser menos de 250 caracteres');
                    return; 
                }
                else{
                    if(parseInt(unidades) == 0){
                        alert('debe ingresar una cantidad unidades');
                        return; 
                    }
                    else{
                        var unidadesNumericas = parseInt(unidades);
                        if (isNaN(unidadesNumericas) || unidadesNumericas < 0) {
                            alert('Las unidades ingresadas no son un número válido o son menores que 0.');
                            return; 
                        } else {
                            if (imagen.trim() === "") {
                                imagen = 'img/default.png';

                                finalJSON['imagen'] = imagen;
                                alert('agregaremos una imagen por defecto');
                            }
                        }
                    }
                }
            }
        }
    }

    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON,null,2);
    /*Entonces, en resumen, este código toma un JSON en formato de cadena, lo convierte en un objeto JavaScript, agrega 
    un nuevo campo "nombre" a ese objeto y luego lo convierte nuevamente en una cadena JSON formateada antes de enviarlo
    al servidor. */
    console.log(productoJsonString);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            window.alert(client.responseText);
        }
    };
    
    client.send(productoJsonString);
    
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}