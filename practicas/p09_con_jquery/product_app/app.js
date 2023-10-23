// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": null
  };
  var edit = false;
function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
    
    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
}

// FUNCIÓN CALLBACK AL CARGAR LA PÁGINA O AL AGREGAR UN PRODUCTO
function listarProductos() {
    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('GET', './backend/product-list.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            //console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                let template = '';

                productos.forEach(producto => {
                    // SE COMPRUEBA QUE SE OBTIENE UN OBJETO POR ITERACIÓN
                    //console.log(producto);

                    // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>
                            <a href="#" class="product-item" onclick="editarProducto()">${producto.nombre}</a>
                            </td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-item btn btn-primary" onclick="editarProducto()">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });
                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("products").innerHTML = template;
            }
        }
    };
    client.send();
}

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarProducto(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var search = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('GET', './backend/product-search.php?search='+search, true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            //console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                let template_bar = '';

                productos.forEach(producto => {
                    // SE COMPRUEBA QUE SE OBTIENE UN OBJETO POR ITERACIÓN
                    //console.log(producto);

                    // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>
                            <a href="#" class="product-item" onclick="editarProducto()">${producto.nombre}</a>
                            </td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-item btn btn-primary" onclick="editarProducto()">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;

                    template_bar += `
                        <li>${producto.nombre}</il>
                    `;
                });
                // SE HACE VISIBLE LA BARRA DE ESTADO
                document.getElementById("product-result").className = "card my-4 d-block";
                // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                document.getElementById("container").innerHTML = template_bar;  
                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("products").innerHTML = template;
            }
        }
    };
    client.send();
}

//MANDAMOS AL SISTEMA UNA VEZ QUE EL USARIO TECLEE ALGUNA BUSQUEDA ESTA SE VAYA MOSTRANDO INMEDIATAMENTE
document.getElementById('search').addEventListener('input', buscarProducto);

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);

    // Validación del nombre (debe ser requerido y tener 100 caracteres o menos)
    var nombre = document.getElementById('name').value;
    if (!nombre) {
        alert("El nombre del producto es requerido.");
        return;
    }
    if (nombre.length > 100) {
        alert("El nombre del producto no puede tener más de 100 caracteres.");
        return;
    }

    finalJSON['nombre'] = nombre;

    // Validación del precio (debe ser requerido y mayor a 99.99)
    var precio = parseFloat(finalJSON['precio']);
    if (isNaN(precio)) {
        alert("El precio es requerido y debe ser un número válido.");
        return;
    }
    if (precio <= 99.99) {
        alert("El precio debe ser mayor a 99.99.");
        return;
    }

    // Validación de los detalles (opcionales, si se utilizan, deben tener 250 caracteres o menos)
    var detalles = finalJSON['detalles'];
    if (detalles && detalles.length > 250) {
        alert("Los detalles no pueden tener más de 250 caracteres.");
        return;
    }

    // Validación de las unidades (deben ser requeridas y el número debe ser mayor o igual a 0)
    var unidades = parseInt(finalJSON['unidades']);
    if (isNaN(unidades)) {
        alert("Las unidades son requeridas y deben ser un número válido.");
        return;
    }
    if (unidades < 0) {
        alert("Las unidades deben ser iguales o mayores a 0.");
        return;
    }

    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/product-add.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(client.responseText);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;

            // SE HACE VISIBLE LA BARRA DE ESTADO
            document.getElementById("product-result").className = "card my-4 d-block";
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            document.getElementById("container").innerHTML = template_bar;

            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
        }
    };
    client.send(productoJsonString);
}

// FUNCIÓN CALLBACK DE BOTÓN "Eliminar"
function eliminarProducto() {
    if( confirm("De verdad deseas eliminar el Producto") ) {
        var id = event.target.parentElement.parentElement.getAttribute("productId");
        //NOTA: OTRA FORMA PODRÍA SER USANDO EL NOMBRE DE LA CLASE, COMO EN LA PRÁCTICA 7

        // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
        var client = getXMLHttpRequest();
        client.open('GET', './backend/product-delete.php?id='+id, true);
        client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        client.onreadystatechange = function () {
            // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
            if (client.readyState == 4 && client.status == 200) {
                console.log(client.responseText);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                let respuesta = JSON.parse(client.responseText);
                // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;

                // SE HACE VISIBLE LA BARRA DE ESTADO
                document.getElementById("product-result").className = "card my-4 d-block";
                // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                document.getElementById("container").innerHTML = template_bar;

                // SE LISTAN TODOS LOS PRODUCTOS
                listarProductos();
            }
        };
        client.send();
    }
}

function editarProducto() {
    if (confirm("¿De verdad deseas editar el Producto?")) {
        var id = event.target.parentElement.parentElement.getAttribute("productId");
        edit = true;
        var client = getXMLHttpRequest();
        client.open('POST', './backend/product-single.php?id=' + id, true);
        client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        client.onreadystatechange = function () {
            if (client.readyState == 4 && client.status == 200) {
                let respuesta = JSON.parse(client.responseText);

                // Crear un nuevo objeto JSON excluyendo la propiedad "id"
                var productoEditable = Object.assign({}, respuesta);
                delete productoEditable.id;

                // Mostrar el nuevo objeto JSON en el campo de descripción
                document.getElementById('name').value = respuesta.nombre || '';
                document.getElementById('description').value = JSON.stringify(productoEditable, null, 4);
                document.getElementById('productId').value = id;
                edit = true;

                // Mostrar el botón "Guardar Cambios" y ocultar el botón "Agregar Producto"
                document.getElementById('guardarCambios').style.display = 'block';
                document.getElementById('productId').style.display = 'none';
            }
        };
        client.send();
    }
}


function editarOAgregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);

    // Se establece el ID del producto para editar si es una edición
    if (edit) {
        finalJSON['id'] = document.getElementById('productId').value;
    }

    // Validación del precio (debe ser requerido y mayor a 99.99)
    var precio = parseFloat(finalJSON['precio']);
    if (isNaN(precio)) {
        alert("El precio es requerido y debe ser un número válido.");
        return;
    }
    if (precio <= 99.99) {
        alert("El precio debe ser mayor a 99.99.");
        return;
    }

    // Validación de los detalles (opcionales, si se utilizan, deben tener 250 caracteres o menos)
    var detalles = finalJSON['detalles'];
    if (detalles && detalles.length > 250) {
        alert("Los detalles no pueden tener más de 250 caracteres.");
        return;
    }

    // Validación de las unidades (deben ser requeridas y el número debe ser mayor o igual a 0)
    var unidades = parseInt(finalJSON['unidades']);
    if (isNaN(unidades)) {
        alert("Las unidades son requeridas y deben ser un número válido.");
        return;
    }
    if (unidades < 0) {
        alert("Las unidades deben ser iguales o mayores a 0.");
        return;
    }
    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();

    // La URL a la que se envía la solicitud depende de si es una edición o una adición
    var url = edit ? './backend/product-edit.php' : './backend/product-add.php';

    client.open('POST', url, true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(client.responseText);

            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                <li style="list-style: none;">status: ${respuesta.status}</li>
                <li style="list-style: none;">message: ${respuesta.message}</li>
            `;

            // SE HACE VISIBLE LA BARRA DE ESTADO
            document.getElementById("product-result").className = "card my-4 d-block";
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            document.getElementById("container").innerHTML = template_bar;

              // Limpiar el formulario
              document.getElementById('name').value = '';
              document.getElementById('description').value = '';
              document.getElementById('productId').value = '';
              
              init();
            // SE LISTAN TODOS LOS PRODUCTOS
           //listarProductos();
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