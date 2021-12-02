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

    // ----------------------
    //
    // SESIONES DE USUARIO
    //
    // ----------------------

    // Registrar un nuevo usuario
    //creamos una funcion que se llamara do_register_user que le creamos un id en el formulario de registro
    //lo que hara esta funcion es registrar un usuario 
    $('#do_register_user').on('submit', do_register_user);

    function do_register_user(event) {
        event.preventDefault(); // Prevenir el registro = (submit) regular
        var form = $(this),
            data = form.serialize(),
            action = 'register_user';

        // Validación antes de mandar la información
        //le decimos que si user nombre osea que si nombre esta basio
        if ($('#user_name').val() == '') {
            //que nos lance un mensaje de que ntroduzcamos el nombre completo
            toast('Ingresa tu nombre completo', 'error');
            return false;
        }
        //le decimos que si email esta basio
        if ($('#user_email').val() == '') {
            //que nos lance un mensage de que ingresemos el correo
            toast('Ingresa tu correo electrónico', 'error');
            return false;
        }

        //vamos a validar que la confirmacion de la contraseña sea igual
        //entonces le decimos que si user_password es diferente a user_password_conf, 
        if ($('#user_password').val() !== $('#user_password_conf').val()) {
            //que nos mande un mensaje de error que no coincide la contraseña
            toast('Las contraseñas no coinciden', 'error');
            //con el return hace la indicacion que es falsa, que no coincide la contraseña
            return false;
        }

        // Mandar la petición a ajax.php
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                action,
                data
            },
            beforeSend: function() {
                    $('body').waitMe();
                }
                //todos esos mensajes on toast, se le añadiran a ajax para sus peticiones de respuestas, para que las vea el usuario 
                //por que si no hacemos eso no sabrian que error pasaria y solo se veria en la consola 
        }).done(function(res) {
            //le decimos que si el estatus de registro es de 201
            if (res.status === 201) {
                //que nos lance un mensaje que se crea con toast de succes de registro exitoso
                toast(res.msg);
                //con el  form.trigger('reset'); lo que hace es limpiar de texto el formulario o resetiar el formulario
                form.trigger('reset');
                setTimeout(() => {
                    //una vez que se haya hecho el registro, con windows.location lo que hacemos es mandarnos al login 
                    //para que automaticamente iniciemos sesion
                    window.location = 'login.php';
                }, 2000);
            } else {
                toast(res.msg, 'error');
            }
        }).fail(function(err) {

        }).always(function() {
            $('body').waitMe('hide');
        });

    }

    // Login de un usuario
    //creamos la funcion para el login 
    $('#do_login_user').on('submit', do_login_user);

    function do_login_user(event) {
        event.preventDefault();

        var form = $(this),
            data = form.serialize(),
            action = 'login_user';

        // Hacemos la petición a ajax.php
        // Mandar la petición a ajax.php
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                action,
                data
            },
            //el waitme es nuestro pauloader de carga
            beforeSend: function() {
                $('body').waitMe();
            }
        }).done(function(res) {
            //le decimos que si esta bienel logeo, que nos mande una peticion de 200
            if (res.status === 200) {
                //nos lanzara un mensage de bienvenido de succes
                toast(res.msg);
                form.trigger('reset');
                setTimeout(() => {
                    //y nos mandara al index donde se encuentran los juegos
                    window.location = 'index.php';
                }, 2000);
                //pero si no se hizo el logeo con el email correcto o contraseña correcta
            } else {
                //que nos lance un mensage de error
                toast(res.msg, 'error');
            }
            //en caso de que la peticion, si la funcion no funcione que nos arroge un mensaje de hubo un error en la peticion
        }).fail(function(err) {
            toast('Hubo un error en la petición', 'error');
            return;
        }).always(function() {
            $('body').waitMe('hide');
        });
    }
    //----------------------------------------- hasta aqui termina la validacion del login y registro  -----------------------------------//


    // ----------------------
    //
    // PRODUCTOS
    //
    // ----------------------

    // Procesar el formulario de agregar nuevo juego
    $('#do_add_game').on('submit', do_add_game);

    function do_add_game(event) {
        //con la funcion preventDefault hacemos que cuando le demis registrar al juego no se envie la peticion aun, lo previene
        event.preventDefault();

        // Validar el titulo
        // le decimos que si titulo se encuentra vacio = '' o = || la longitud del titulo es menos a < 5
        if ($('#titulo').val() == '' || $('#titulo').val().length < 5) {
            //que nos imprima una alerta de que ingresemos el titulo
            toast('Ingresa el nombre del producto', 'warning');
            return;
        }

        // Validar el genero del videojuego
        //le decimos que si genero se encuentra vacio = ''
        if ($('#id_genero').val() == '') {
            // que nos imprima una alerta de que selecciones un genero
            toast('Selecciona un genero válido', 'warning');
            return;
        }


        // Validar la opinión del usuario
        if ($('#opinion').val() == '' || $('#opinion').val().length < 10) {
            toast('Ingresa una opinión/descripción válida para el producto, debe contener 10 o más caracteres', 'warning');
            return;
        }

        // ahora toda esa informacion del formulario la mandaremos a ajax para que haga las petoiciones

        // Mandar la información a ajax
        //LE DECIMOS O SIGUIENTE, CREAMOS UNA VARIABLE LLAMADA FORM DE FORMULARIO QUE VA HACER IGUAL A ESTO, ESO LO DE ABAJO DE ESTA LINEA DE CODIGO
        var form = $(this),
            //cuando trabajamos con archivos utilizaremos = FormData y no = serialize, ese seria para puro texto
            // le decimos lo siguiente que data sera igual l formulario de arriva que creamos osea el de agregar juego
            data = new FormData($('form').get(0)),
            //y la accion sera guardar los datos del formulario
            action = 'add_game';

        // Agregar la acción al array de data
        //con esto agreggamos la accion a data para que solo llamemos a data en ajax 
        data.append('action', action);

        // Petición ajax
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            //ahora como trabajaremos con archivos utilizaremos estas 3 funciones ajax
            contentType: false,
            cache: false,
            processData: false,
            // y a data le vamos a pasar la informacion del formulario osea la que creamos en la linea 219
            //=  data = new FormData($('form').get(0)),
            data: data,
            beforeSend: function() {
                //le pasamos un payloder al formulario cuando cargamos o registramos un juego
                form.waitMe();
            }
        }).done(function(res) {
            //ahora si se hace el registro exitozamente que nos lance un estatus 201  de que se hizo el registro
            // todas estas peticionmes las manegamos con el payloader
            if (res.status === 201) {
                // nos lansara un mensaje de success en verde
                toast(res.msg);
                //con esta funcion =  .trigger('reset'); hacemos que se recete algo, en este caso el formulario
                form.trigger('reset');
                setTimeout(() => { // le damos u tiempo de 1500 milisegundos
                    // y que nos redireccione a nuestro index si se cumple la peticion osean donde tenemos nuestros juegos
                    window.location = 'index.php';
                }, 1500);
            } else {
                // en caso de n error que nos lance un mensaje de error  
                toast(res.msg, 'error');
                return false;
            }
        }).fail(function(err) {
            toast('Hubo un error, intenta de nuevo', 'error');
        }).always(function() {
            form.waitMe('hide');
        });
    }

    // Cargar un juego en ventana modal
    $('.do_view_game').on('click', do_view_game);

    function do_view_game(e) {
        e.preventDefault();
        var boton = $(this),
            id = boton.data('id'),
            action = 'get_game';

        // Petición para cargar la información
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                action,
                id
            },
            beforeSend: function() {
                $('body').waitMe();
            }
        }).done(function(res) {
            if (res.status === 200) {
                $('#single_game_modal').remove();
                $('body').append(res.data);
                $('#single_game_modal').modal('show');
            } else {
                toast(res.msg, 'error');
            }
        }).fail(function(err) {
            toast('Hubo un error, intenta de nuevo', 'error');
        }).always(function() {
            $('body').waitMe('hide');
        })
    }

    // Actualizar un videojuego
    $('#do_update_game').on('submit', do_update_game);

    function do_update_game(e) {
        e.preventDefault();

        // Validar el titulo
        if ($('#titulo').val() == '' || $('#titulo').val().length < 5) {
            toast('Ingresa el nombre del producto', 'warning');
            return;
        }

        // Validar el genero del videojuego
        if ($('#id_genero').val() == '') {
            toast('Selecciona un genero válido', 'warning');
            return;
        }

        // Validar la opinión del usuario
        if ($('#opinion').val() == '' || $('#opinion').val().length < 10) {
            toast('Ingresa una opinión/descripcion válida para el producto, debe contener 10 o más caracteres', 'warning');
            return;
        }

        // Mandar la información a ajax
        var form = $(this),
            data = new FormData($('form').get(0)),
            submit = $('#submit'),
            action = 'update_game';

        // Agregar la acción al array de data
        data.append('action', action);

        // Petición ajax
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            data: data,
            beforeSend: function() {
                //form.waitMe();
                submit.attr('disabled', true);
            }
        }).done(function(res) {
            if (res.status === 200) {
                toast(res.msg);
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
                return true;
            } else {
                toast(res.msg, 'error');
                return false;
            }
        }).fail(function(err) {
            toast('Hubo un error, intenta de nuevo', 'error');
        }).always(function() {
            //form.waitMe('hide');
            setTimeout(() => {
                submit.attr('disabled', false);
            }, 1500);
        });
    }

    //------
    // Actualizar usuario
    //-----

    // Actualizar un usuario
    $('#do_update_user').on('submit', do_update_user);

    function do_update_user(e) {
        e.preventDefault();

        // Validar el nombre del usuario
        if ($('#nombre').val() == '' || $('#nombre').val().length < 5) {
            toast('Ingresa un nombre de usuario', 'warning');
            return;
        }

        // Validar el rol del usuario
        if ($('#rol').val() == '') {
            toast('Selecciona un rol válido', 'warning');
            return;
        }

        if ($('#email').val() == '') {
            toast('Escriba un email', 'warning');
            return;
        }


        // Mandar la información a ajax
        var form = $(this),
            data = new FormData($('form').get(0)),
            submit = $('#submit'),
            action = 'update_usu';

        // Agregar la acción al array de data
        data.append('action', action);

        // Petición ajax
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            data: data,
            beforeSend: function() {
                //form.waitMe();
                submit.attr('disabled', true);
            }
        }).done(function(res) {
            if (res.status === 200) {
                toast(res.msg);
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
                return true;
            } else {
                toast(res.msg, 'error');
                return false;
            }
        }).fail(function(err) {
            toast('Hubo un error, intenta de nuevo', 'error');
        }).always(function() {
            //form.waitMe('hide');
            setTimeout(() => {
                submit.attr('disabled', false);
            }, 1500);
        });
    }



    //------
    //-------
    //-----

    // Borrando un videojuego del usuario
    $('body').on('click', '.do_delete_game', do_delete_game);

    function do_delete_game(e) {
        e.preventDefault();

        var confirmation = confirm('¿Estás seguro?');

        if (!confirmation) return false;

        // Nuestras variables
        var boton = $(this),
            id = boton.data('id'),
            action = 'delete_game';

        // Petición a ajax.php
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                action,
                id
            },
            beforeSend: function() {
                $('body').waitMe();
                boton.attr('disabled', true);
            }
        }).done(function(res) {
            if (res.status === 200) {
                toast(res.msg);
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                toast(res.msg, 'error');
                return false;
            }
        }).fail(function(err) {
            toast('Hubo un error, intenta de nuevo', 'error');
        }).always(function() {
            $('body').waitMe('hide');
            setTimeout(() => {
                boton.attr('disabled', false);
            }, 1500);
        });
    }

    //---------------------
    //Borrar-eliminar un usuario
    //---------------------

    // Borrando un videojuego del usuario
    $('body').on('click', '.do_delete_user', do_delete_user);

    function do_delete_user(e) {
        e.preventDefault();

        var confirmation = confirm('¿Estás seguro?');

        if (!confirmation) return false;

        // Nuestras variables
        var boton = $(this),
            id = boton.data('id'),
            action = 'delete_user';

        // Petición a ajax.php
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                action,
                id
            },
            beforeSend: function() {
                $('body').waitMe();
                boton.attr('disabled', true);
            }
        }).done(function(res) {
            if (res.status === 200) {
                toast(res.msg);
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                toast(res.msg, 'error');
                return false;
            }
        }).fail(function(err) {
            toast('Hubo un error, intenta de nuevo', 'error');
        }).always(function() {
            $('body').waitMe('hide');
            setTimeout(() => {
                boton.attr('disabled', false);
            }, 1500);
        });
    }




    //-----------
    //Fin eliminar usuario
    //---------------



    // Cargar modal de "compartir"
    $('body').on('click', '.do_share_game', do_share_game);

    function do_share_game(e) {
        e.preventDefault();

        var boton = $(this),
            id = boton.data('id'),
            action = 'share_modal';

        // Petición ajax
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                action,
                id
            },
            beforeSend: function() {
                //$(this).waitMe();
            }
        }).done(function(res) {
            if (res.status === 200) {
                $('#share_game_modal').remove();
                $('body').append(res.data);
                $('#share_game_modal').modal('show');
            } else {
                toast(res.msg, 'error');
                return false;
            }
        }).fail(function(err) {
            toast('Hubo un error, intenta de nuevo', 'error');
        }).always(function() {

        });
    }

    // Enviar mensaje de "compartir"
    $('body').on('submit', '#do_submit_share_game', do_submit_share_game);

    function do_submit_share_game(e) {
        e.preventDefault();

        var form = $(this),
            data = form.serialize(),
            action = 'submit_share_game';

        // Validar que no esten vacios los campos
        if ($('#mensaje').val().length < 5) {
            toast('Tu mensaje debe contener mínimo 5 caracteres', 'warning');
            return false;
        }

        // Petición ajax
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                action,
                data
            },
            beforeSend: function() {
                $('body').waitMe();
            }
        }).done(function(res) {
            if (res.status === 200) {
                form.trigger('reset');
                toast(res.msg);
                return true;
            } else {
                toast(res.msg, 'error');
                return false;
            }
        }).fail(function(err) {
            toast('Hubo un error, intenta de nuevo', 'error');
        }).always(function() {
            $('body').waitMe('hide');
        });
    }


    // enviar query en "todos los videojuegos" para busqueda
    $('body').on('submit', '#do_search_game', do_search_game);

    function do_search_game(e) {
        e.preventDefault();


        var search_query = $('#search_query').val(),
            wrapper = $('.wrapper-search-videojuegos'),
            action = 'search_games';

        // Petición para cargar la información
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data:

            {
                //que vamos a mandar en ajax pues la accion y el search query la consulta de busqueda
                action,
                search_query
            },
            beforeSend: function() {
                //creamos el tiempo de carga que sera de  200 milisegundos
                wrapper.waitMe();
            }
        }).done(function(res) {
            if (res.status === 200) {
                setTimeout(() => {
                    // y queremos que salga el payloader el wrapper
                    wrapper.waitMe('hide');
                    wrapper.html(res.data);
                }, 1500);
            } else {
                toast(res.msg, 'error');

            }
        }).fail(function(err) {
            toast('Hubo un error, intenta de nuevo', 'error');
        }).always(function() {

        })

    }




})