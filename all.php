<?php 
// PHP Y SUS FUNCIONES PREDEFINIDAS ESTÁN TODAS ATRAS DE ESTO
require_once 'app/config.php';

// Cargar los juegos que tenga el usuario
$games = get_games();

$data =
[
  'title' => 'Todos los Productos',
  'active' => 'all',
  'games' => $games[0],
  'pagination' => $games[1]
];

// Renderizado de la vista
render_view('todos_los_juegos' , $data);
