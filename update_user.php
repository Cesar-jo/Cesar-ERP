<?php 
// PHP Y SUS FUNCIONES PREDEFINIDAS ESTÁN TODAS ATRAS DE ESTO
require_once 'app/config.php';


// Validar que exista la variable $_GET['id']
if(!isset($_GET['id'])) {
  redirect('index');
}

// Validar que exista el usuario pasado en URL en nuestra
// base de datos
if(!$user = get_user_by_id($_GET['id'])) {
  redirect('index');
}

//Vamos a proteger de que si un usuario quiere editar un producto que el no lo registro nque no lo deje editar o actualizar ese producto
// para ello le decios que si el id_usuario que es el id del usuario que registro tal producto en la tabla productos != es diferente a
//l id del usuario de la sesion registrada o es diferente al id del usuario que registro tal producto que lo redireccione al index
#if($user['id'] !== cur_user()['id']) {
 # redirect('index');
#}

$data =
[
  'title'  => 'Asignar rol de usuario',
  'active' => 'update_user',
  'u'      => $user
];



// Renderizado de la vista
//esto hace que carge todos los juegos que tenga un usuario
render_view('update_user' , $data);
