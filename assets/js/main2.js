$(document).ready(function() {

    function init() {
        //$('#do_get_game').modal('show');
    }
    init();

    // Funciones para mostrar notificaciones tipo toast
    // error | success | info | warning
    //creamos una funcion que la llamaremos toas, va a traer contenido y el tipo de dato sera success ya que seran alertas
    function toast(contenido, tipo = 'success', ) {
        //le creamos un switch donde les agregaremos con los case los tipos de alertas (success)
        switch (tipo) {
            case 'error':
                //asi creamos nuestra notificacion de error, la cual traera el contenido que sera el titulo que dira upps si hay un error
                toastr.error(contenido, '¡Upss!');
                break;

            case 'info':
                //si hay informacion o queremos consultar informacion, con info nos lansa una notificacion de informacion
                toastr.info(contenido, 'Atención');
                break;

            case 'warning':
                //con warning nos traera una notificacion de peligo o alvertencia
                toastr.warning(contenido, 'Cuidado');
                break;

            default:
                //y con success nos traera una notificacion de bien hecho de correcto valla la redundancia
                toastr.success(contenido, 'Bien hecho');
                break;
        }
        return true;
    }

    // Borrando un videojuego del usuario
    $(".btnEliminar").click(function(event) {

        event.preventDefault();

        // Nuestras variables
        var id = $(this).data('id'),
            action = 'delete_cart',
            boton = $(this);


        // Petición a ajax.php
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: {
                action,
                id: id
            },

        }).done(function(respuesta) {
            boton.parent('th').parent('tr').remove();
            //alert(respuesta);
        });
    });

    // multiplicar el total del precio de acuerdo a la cantidad de productos que tiene un usuario en el carrito
    $(".txt-cantidad").keyup(function() {

        var cuantos = $(this).val();
        //el precio sera igual al precio del del producto que esta en nuestra bd
        var precio = $(this).data('precio');
        //y el id sera igual al id del producto
        var id = $(this).data('id');

        incrementar(cuantos, precio, id);
        //var mult = parseFloat(cantidad) * parseFloat(precio);
        //$(".cant" + id).text("$" + mult);

    });
    $(".btnIncrementar").click(function() {
        var precio = $(this).parent('div').parent('div').find('input').data('precio');
        var id = $(this).parent('div').parent('div').find('input').data('id');
        var cuantos = $(this).parent('div').parent('div').find('input').val();
        incrementar(cuantos, precio, id);
    });


    function incrementar(cuantos, precio, id) {

        var action = 'update_cart';
        //ahora vamos a multiplicar la cantidad osea la cantidad de cada producto y lo vamos a multiplicar por el precio
        //para obtener su total
        var mult = parseFloat(cuantos) * parseFloat(precio);
        $(".cant" + id).text("$" + mult);

        // Petición a ajax.php
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: {
                id: id,
                cuantos: cuantos,
                action

            },

        }).done(function(respuesta) {

        });

    }



});