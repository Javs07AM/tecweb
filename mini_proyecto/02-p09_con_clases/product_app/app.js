// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "region": "NA",
    "genero": "NA",
    "titulo": "NA",
    "duracion": 0,
};

$(document).ready(function(){
    let edit = false;

    let JsonString = JSON.stringify(baseJSON,null,2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                const productos = JSON.parse(response);
            
                if(Object.keys(productos).length > 0) {
                    let template = '';

                    productos.forEach(producto => {
                        let descripcion = '';
                        descripcion += '<li>region: ' + producto.region +'</li>';
                        descripcion += '<li>genero: ' + producto.genero +'</li>';
                        descripcion += '<li>titulo: ' + producto.titulo +'</li>';
                        descripcion += '<li>duracion: ' + producto.duracion +'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.titulo}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        const productos = JSON.parse(response);
                        
                        if(Object.keys(productos).length > 0) {
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                let descripcion = '';
                                descripcion += '<li>region: ' + producto.region + '</li>';
                                descripcion += '<li>genero: ' + producto.genero + '</li>';
                                descripcion += '<li>titulo: ' + producto.titulo + '</li>';
                                descripcion += '<li>duracion: ' + producto.duracion + '</li>';
                            
                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.titulo}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.titulo}</il>
                                `;
                            });

                            $('#product-result').show();
                            $('#container').html(template_bar);
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        let postData = JSON.parse( $('#description').val() );
        postData['titulo'] = $('#name').val();
        postData['id'] = $('#productId').val();

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        $.post(url, postData, (response) => {
            console.log(response);
            let respuesta = JSON.parse(response);
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            $('#name').val('');
            $('#description').val(JsonString);
            $('#product-result').show();
            $('#container').html(template_bar);
            listarProductos();
            edit = false;
        });
    });

    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', {id}, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            let product = JSON.parse(response);
            $('#name').val(product.titulo);
            $('#productId').val(product.id);
            delete(product.titulo);
            delete(product.eliminado);
            delete(product.id);
            let JsonString = JSON.stringify(product,null,2);
            $('#description').val(JsonString);
            edit = true;
        });
        e.preventDefault();
    });    
});

