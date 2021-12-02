
<?php 
// PHP Y SUS FUNCIONES PREDEFINIDAS ESTÁN TODAS ATRAS DE ESTO
require_once 'app/config.php';

//-------------------- este apartado de logout es para la cerrada de sesion --------------------------------------------------//

//para ello llamamos nuestra funcion para destruir sesion que lo que hara es sacarnos de una sesion
destroy_user_session();

//y nos redireccionara al login para iniciar de nuevo sesion
header('Location: '.URL.'login.php');
die;