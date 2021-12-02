<?php 
// PHP Y SUS FUNCIONES PREDEFINIDAS ESTÁN TODAS ATRAS DE ESTO
require_once 'app/config.php';

// Validar la sesión de usuario
if(!valid_session()) {
  redirect('register');
}

//esta es nuestro array   para que agregemos o subamos mas juegos
$data =
[
  'title' => 'Agregar nuevo Producto',
  'active' => 'add'
];

// id
// id_usuario xxx
// portada
// titulo
// id_genero
// id_consola
// calificacion
// opinion
// creado
// actualizado

// Renderizado de la vista en = wiews
render_view('add' , $data);
