<?php 
// PHP Y SUS FUNCIONES PREDEFINIDAS ESTÁN TODAS ATRAS DE ESTO
require_once 'app/config.php';

// Validar la sesión de usuario
if(valid_session()) {
  redirect('index');
}

$data =
[
  'title'  => 'Registrarse',
  'active' => 'register'
];

// -----------------------
// GamingTop
// -----------------------

// registrarse
// loging
// ver todos los juegos del usuario
// agregar nuevo juego
// actualizar juego existente
// borrar juego existente
// para ver todos los juegos de los usuarios
// configuraciones

// Renderizado de la vista
render_view('registro' , $data);
