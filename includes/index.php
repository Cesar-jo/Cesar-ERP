<?php 
// PHP Y SUS FUNCIONES PREDEFINIDAS ESTÁN TODAS ATRAS DE ESTO
require_once 'app/config.php';

// Validar la sesión de usuario
if(!valid_session()) {
  redirect('register');
}

// Cargar los juegos que tenga el usuario
$games = get_games_by_user(cur_user()['id']);

$data =
[
  'title'      => 'Mis juegos',
  'active'     => 'index',
  'games'      => (isset($games[0]) ? $games[0] : NULL),
  'pagination' => (isset($games[1]) ? $games[1] : NULL)
];

// Renderizado de la vista
render_view('mis_juegos' , $data);
