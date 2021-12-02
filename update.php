<?php 
// PHP Y SUS FUNCIONES PREDEFINIDAS ESTÁN TODAS ATRAS DE ESTO
require_once 'app/config.php';

// Validar que exista la variable $_GET['id']
if(!isset($_GET['id'])) {
  redirect('index');
}

// Validar que exista el videojuego pasado en URL en nuestra
// base de datos
if(!$game = get_game_by_id($_GET['id'])) {
  redirect('index');
}

//Vamos a proteger de que si un usuario quiere editar un producto que el no lo registro nque no lo deje editar o actualizar ese producto
// para ello le decios que si el id_usuario que es el id del usuario que registro tal producto en la tabla productos != es diferente a
//l id del usuario de la sesion registrada o es diferente al id del usuario que registro tal producto que lo redireccione al index
if($game['id_usuario'] !== cur_user()['id']) {
  redirect('index');
}

$data =
[
  'title'  => 'Actualizando '.$game['Nombre'],
  'active' => 'update',
  'g'      => $game
];

// id
// id_usuario xxx
// portada
// titulo
// id_genero
// id_plataforma
// calificacion
// opinion
// creado
// actualizado

// Renderizado de la vista
render_view('update' , $data);
