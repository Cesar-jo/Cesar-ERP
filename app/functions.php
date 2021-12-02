<?php

// ----------------------
//
// HELPERS
//
// ----------------------

//creamos una funcion para traer los generos que pusimos en nuestra tabla generos en el apartado de registrar juego
function get_genders() {
  $stmt = 'SELECT * FROM generos ORDER BY id DESC';
  return ($rows = query_db($stmt)) ? $rows : false;
}

//traer usuarios
function get_user() {
  $stmt = 'SELECT * FROM usuarios ORDER BY id DESC';
  return ($rows = query_db($stmt)) ? $rows : false;
}


// render_view(carrito_view)
function render_view($view , $data = []) {
  if(!is_file(VIEWS.$view.'_view.php')) {
    //si no existe la vista, yo quiero que nos imprima esto:
    echo 'No existe la vista '.$view;
    die;
  }
  
  require_once VIEWS.$view.'_view.php';
}

function format_currency($number, $symbol = '$') {
  if(!is_float($number) && !is_integer($number)) {
    $number = 0;
  }

  return $symbol.number_format($number,2,'.',',');
}

function json_output($status = 200, $msg = '' , $data = []) {
  //http_response_code($status);
  $r =
  [
    'status' => $status,
    'msg'    => $msg,
    'data'   => $data
  ];
  echo json_encode($r);
  die;
}

function clean_string($string) {
  $string = trim($string);
  $string = rtrim($string);
  $string = ltrim($string);
  return $string;
}

function send_email($to , $subject = 'Nuevo mensaje' , $msg = NULL) {

  if(!filter_var($to , FILTER_VALIDATE_EMAIL)) {
    return false;
  }

  if($msg == NULL) {
    $msg = "
    <html>
    <head>
    <title>HTML email</title>
    </head>
    <body>
    <p>This email contains HTML Tags!</p>
    <table>
    <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    </tr>
    <tr>
    <td>John</td>
    <td>Doe</td>
    </tr>
    </table>
    </body>
    </html>
    ";
  }

  // Always set content-type when sending HTML email
  $headers  = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From: '.COMPANY_NAME.' <'.COMPANY_EMAIL.'>' . "\r\n";
  // More headers

  mail($to,$subject,$msg,$headers);
  return true;
}

function get_date() {
  return date('Y-m-d H:i:s');
}
//esta funcion nos servira para redireccionar a una pagina ya sea login, registro, etc
function redirect($url) {
  header('Location: '.URL.$url.'.php');
  die;
}

//hacemos una funcion para generar un archivo que sea de una longitud de 8 caracteres
// en pocas palabras lo que hace esta funcion es crear nombres dinamicos cada que subnamos una imagen
function generate_filename($lng = 8 , $span = 2) {
  //le decimos que si no es integro la longitud osea entero no boleano
  if(!is_integer($lng)) {
    $lng = 8;
  }
  // y si span tampono no es integro
  if(!is_integer($span)) {
    $span = 2;
  }
  $span = ($span > 5 ? 5 : $span);

  $filename = '';
  $min = '';
  $max = '';

  for ($i=0; $i < $lng; $i++) { 
    $min .= '1' ;
    $max .= '9' ;
  }
// y lo que hace esta funcion es crear un nombre al artchivo cada que subamos 
  for ($i=0; $i < $span; $i++) { 
    $filename .= rand((int) $min,(int) $max).'_';
  }

  return substr($filename,0,-1);
}

//hacemos una funcion para traer las imagenes y le pasamos el phat donde traera las imagenes ()
function get_image($path_to_image) {
  // le decimops que si existe el archivo = podermos utilizar el is_file o exist_file pero da mas problemas este ultimo
  // le decimos que si no existe el archivo y le pasamos donde va a encontrar las imagenes = ()
  if(!is_file($path_to_image)) {
    // regresamos a la de default osea que si no encuentra la imagen que ponga una imagen de ejemplo
    // que haga referencia que no se encontro una imagen del juego y ponemos la siguiente imagen
    return IMAGES.'broken-image.png';
  }
  // y si existe que nos habra la carpeta que le pedimos y que ponga la imagen que le agregamos a ese juego
  // URL esta en nuestro config es la carpeta assets 
  return URL.$path_to_image;
}

// funcion de los puntos, las estrellas
function format_rating($rating) {
  $rating = (is_integer($rating) ? $rating : 3);

  $full = '<i class="fas fa-star"></i>';
  $empty = '<i class="far fa-star"></i>';
  //inicialñizamos las estrellas en 0
  $output = '';
  // el minimo es 1
  $min = 1;
  // el maximo es 5
  $max = 5;
  // creamos un array de mensajes de acuerdo a la cantidad de estrellas que tenga el juego
  $msg =
  [
    'Decadente',
    'Malo',
    'Regular',
    'Muy bueno',
    'Excelente'
  ];

  $output .= '<div class="text-warning d-inline" data-toggle="tooltip" title="'.$msg[$rating - 1].'">';
  // hacemos un for que indique que no pase de 5 estrellas del maximo  
  for ($i=0; $i < $max; $i++) { 
    if($rating > $i) {
      $output .= $full;
    } else {
      $output .= $empty;
    }
  }
  $output .= '</div>';

  return $output;
}

function format_date($date) {
  return date('d/m/Y' , strtotime($date));
}

// ----------------------
//
// FUNCIONES PARA INTERACTUAR CON LA DB
//
// ----------------------

// pusimos como parametro principal de esta funcion = table = por que esta funcion de insertar datos
// va a funcionar para todas las tablas que tengamos en nuestra bd
function insert_new($table, $params = []) {
  // STATEMENT = le pasamos la consulta al stmt y los parametros  que estan en la funcion =  get_column_names que estan los nombres de las
  // columnas donde se va insertar la info en nuestra bd
  $stmt = 'INSERT INTO '.$table.' 
  '.get_column_names($params).'
  VALUES '.get_placeholders($params); // y vamos a evaluarlos con los campos de nuestra bd que pusimos en nuestra funcion = get_placeholders

  // Ejecutamos el query y se inserta el registro
  return ($id = query_db($stmt , $params)) ? $id : false;
}

function update_record($table , $keys = [] , $params = []) {
  // UPDATE tabla SET columna=:placeholder, columna=:placeholder WHERE id=:id;
  $placeholders = '';
  $cols = '';

  foreach ($params as $k => $v) {
    $placeholders .= $k.'=:'.$k.',';
  }
  $placeholders = substr($placeholders, 0 , -1);
  
  $stmt = 'UPDATE '.$table.' SET '.$placeholders;

  // Si hay keys pues vamos a agregarlas al query o statement
  if(!empty($keys)) {
    $stmt .= ' WHERE ';
    foreach ($keys as $k => $v) {
      $cols .= $k.'=:'.$k.' AND';
    }
    $cols = substr($cols,0,-3);
    $stmt .= $cols;
  }

  // Ejecutar el statement o el query
  return (query_db($stmt , array_merge($keys , $params))) ? true : false;
}

function delete_record($table , $keys = []) {
  
  // Si hay keys pues vamos a agregarlas al query o statement
  if(empty($keys)) {
    return false;
  }

  $cols = '';
  $stmt = 'DELETE FROM '.$table;
  $stmt .= ' WHERE ';
  foreach ($keys as $k => $v) {
    $cols .= $k.'=:'.$k.' AND';
  }
  $cols = substr($cols,0,-3);
  $stmt .= $cols.' LIMIT 1';

  return (query_db($stmt , $keys , true)) ? true : false;
}

// USUARIOS VIDEOJUEGOS PLATAFORMAS GENEROS 50 100
// INSERT INTO tabla (COLUMNAS) VALUES (VALORES A INSERTAR);
function get_column_names($params) {
  // (nombre,email,password,navbar_color,creado)
  $cols = '';
  if(empty($params)) {
    return false;
  }

  $cols .= '(';
  foreach ($params as $k => $v) {
    $cols .= $k.',';
  }
  $cols = substr($cols,0,-1);
  $cols .= ')';

  return $cols;
}

function get_placeholders($params) {
  // (:nombre,:email,:password,:navbar_color,:creado)
  $placeholders = '';
  if(empty($params)) {
    return false;
  }

  $placeholders .= '(';
  foreach ($params as $k => $v) {
    $placeholders .= ':'.$k.',';
  }
  $placeholders = substr($placeholders,0,-1);
  $placeholders .= ')';

  return $placeholders;
}

// ----------------------
//
// FUNCIONES PARA SESIÓN DE USUARIO
//
// ----------------------

// Para crear la sesión de usuario y en los () le pasaremos la informacion del usuario
function init_user_session($inf_usuario) {
  // Cargar la información del usuario en login desde la base de datos
  // lo que queremos traer o gurdar sera el Nombre , email , navbar_color , y la fecha de creado
  // $_SESSION['current_user']; y nuestra variable de sesion la llamaremos current_user
  //entonses vamos a validar si existe una sesion anterior, le decimos que si esta setiado una sesion pues que nos regrese un false
  if(isset($_SESSION['current_user'])) {
    //de que ya no haga nada nuevo por que ya esta setiada una sesion
    return false;
  }

  //en caso de que no haya ninguna sesion setiada

//creamos un array de informacion con los elementos que tenemos en nuestra base de datos y le decimos..
  $usuario =
  [                    //si existe  id que noss traiga id || si no exsite que nos traiga un valor nulo
    'id'           => (isset($inf_usuario['id']) ? $inf_usuario['id'] : NULL),
                      //si existe nombre que nos traiga nombre || si no exsite que nos traiga un valor nulo
    'nombre'       => (isset($inf_usuario['nombre']) ? $inf_usuario['nombre'] : NULL),
                      //si existe email que noss traiga email || si no exsite que nos traiga un valor nulo
    'email'        => (isset($inf_usuario['email']) ? $inf_usuario['email'] : NULL),
                      //si existe  nav que noss traiga nav || si no exsite que nos traiga un valor nulo
    'navbar_color' => (isset($inf_usuario['navbar_color']) ? $inf_usuario['navbar_color'] : NULL),
                      //si existe  creado que noss traiga creado || si no exsite que nos traiga un valor nulo
    'creado'       => (isset($inf_usuario['creado']) ? $inf_usuario['creado'] : NULL),
    //  existe  rol que noss traiga el rol || si no exsite que nos traiga un valor nulo
    'rol'        => (isset($inf_usuario['rol']) ? $inf_usuario['rol'] : NULL),
    'active'       => TRUE
  ];


  //todo eso si esta setiado un usuario lo guardaremos en current_user, que sera = nuestro usuario que se guardara en nuestra variable de sesion
  $_SESSION['current_user'] = $usuario;
  return true;

  $_SESSION['current_admin'] = $usuario;
  return true;


}


// Para verificar que la sesión está activa o validada
function valid_session() {
  //entonses le decimos con el !isset que si no esta setiada o si no existe una sesion current_user= que es nuestro usuario logeado si es que esta logeado
  if(!isset($_SESSION['current_user'])) {
    //pues que nos regrese un false de que no esta registrado
    return false;
  }
//lo mismo aqui si no esta setiado, no existe una sesion logeada y no esta activo que nos regrese un false de que no esta registrado
  if(!isset($_SESSION['current_user']['active'])) {
    return false;
  }


//pero si si existe una sesion

  $current_user = $_SESSION['current_user'];
//si un usario = sesion current_user(active) no es igual (!==) a que esta activo pues, pues que nos lance un true de que no esta activo
  if($current_user['active'] !== TRUE) {
    //de lo contrario si esta activo en ves de que no este activo nos lance un falce de que esta activo
    return false;
  }
//y dira que la sesion esta activa
  return true;
}

// creamos una funcion Para cargar la información del usuario
function cur_user() {
  //entonces llamamos nuestra funcion para validar una sesion o usuario
  // y le decimos que si no esta validada una sesion o usuario
  if(!valid_session()) {
    //que nos regrese un false de que no esta validada una sesion, que no existe esa sesion
    return false;
  }
//en cambio si esta validada una sesion nos traera nuestra variable de sesion del usuario current_user donde se aloja la informacion de un usuario
//como id,nombre, correo,etc
  return $_SESSION['current_user'];
}

// Para destruir la sesión
function destroy_user_session() {
  //lo que hara unset es formatiar la sesion
  unset($_SESSION['current_user']);
  //y con el session_destroy la destruye, esto para cerrar sesion
  session_destroy();
  return true;


}



// ----------------------
//
// USUARIOS
//
// ----------------------

// get | insert | update | delete
//esta funcion es para traer el email de nuestra base de datos y que queremos traer ($email)
//para validar el correo
function get_user_by_email($email) {
  // entonces le decimos que seleccione (u. = es todo) from = de la tabla usuario where = email es igual a la columna email de nuestra bd
  $stmt = 'SELECT u.* FROM usuarios u WHERE u.email = :email LIMIT 1';
//le decimos que nos returne las columnas de nuestra base de datos= query db y le paamos los parametros de que columnas queremos que nos la traiga
//la columna que queremos sera la de el email [email => email] con ? $row le indicamos si no existe esa columna que no nos traiga nada osea false
  return ($rows = query_db($stmt , ['email' => $email])) ? $rows[0] : false;
}


// ----------------------
//
// Productos
//
// ----------------------

// Cargar todos los juegos
function get_games() {

  // Para paginación de registros
  $stmt              = 'SELECT COUNT(v.id) AS total FROM stock v';
  $total_records = query_db($stmt)[0]['total'];
  $offset            = NULL;
  $pagination        = NULL;
  $limit             = NULL;
  if($offset = create_offset($total_records)) {
    $limit = $offset[0];
    $pagination = $offset[1];
  }

  $stmt = 
  'SELECT 
  v.*,
  g.genero,
  u.nombre,
  u.email
  FROM stock v
  LEFT JOIN generos g ON v.id_genero = g.id
  LEFT JOIN usuarios u ON v.id_usuario = u.id '.$limit;
  return ($rows = query_db($stmt)) ? [$rows,$pagination] : false;
}

//apartado busqueda de juegos
//le pasamos nuestra $query que va hacer nuestra busqueda
//ahora para la busqueda sql = WHERE v.titulo LIKE CONCAT('%', :query, '%') "; utilizamos LIKE
//PARA QUE HAGA LA BUSQUEDA NO PERFECTAMENTE COMO ESTA EL JUEGO SI NO ESCRIBIR ALGUNAS PALABRAS 
//QUE CONTENGA ESE JUEGO Y NOS ARROJE LOS DATOS DE LOS JUEGOS CON ESAS LETRAS A BUSCAR
function search_games($query){
  $stmt = 
  "SELECT 
  v.*,
  g.genero,
  u.nombre,
  u.email
  FROM stock v
  LEFT JOIN generos g ON v.id_genero = g.id
  LEFT JOIN usuarios u ON v.id_usuario = u.id 
  WHERE v.Nombre LIKE CONCAT('%', :query, '%') ";
  return ($rows = query_db($stmt, ['query' => $query])) ? $rows : false;
}

//fin busqueda de juegos

function create_offset($registros_totales) {
  // Saber si está seteada la variable $_GET
  if($registros_totales == 0) {
    return false;
  }
  
  $offset = '';

  // Cantidad total de registros en la db
  $registros_totales = (int) $registros_totales;

  // Los registros que queremos mostrar por página
  $registros_pagina = RECORDS_PER_PAGE;

  // La cantida de páginas necesarias
  $paginas_totales = ceil($registros_totales/$registros_pagina);

  // Si get no es número lo pones como 1, y si get es mayor al total de páginas pues obviamente debería ser igual al total de páginas
  $pagina_actual = (isset($_GET['page']) ? $_GET['page']  : 1);
  
  if(!is_numeric($pagina_actual) || $pagina_actual < 1) {
    $pagina_actual = 1;
  }

  if($pagina_actual > $paginas_totales) {
    $pagina_actual = $paginas_totales;
  }
  
  $offset .= 'LIMIT '.($registros_pagina*($pagina_actual-1)).','.$registros_pagina;

  // Creamos la páginación o links de páginas
  $pagination = create_pagination($paginas_totales);

  return [$offset,$pagination];
}

function create_pagination($paginas_totales) {
  $paginas_totales = ($paginas_totales == 0 ? 1 : (int) $paginas_totales);
  // Si get no es número lo pones como 1, y si get es mayor al total de páginas pues obviamente debería ser igual al total de páginas
  $pagina_actual = (isset($_GET['page']) ? $_GET['page']  : 1);
  
  if(!is_numeric($pagina_actual) || $pagina_actual < 1) {
    $pagina_actual = 1;
  }

  if($pagina_actual > $paginas_totales) {
    $pagina_actual = $paginas_totales;
  }

  // HTML que representará nuestros links de navegación
  $links = '<ul class="pagination float-right">';
  $links .= 
  '<li class="page-item">
    <a class="page-link" href="'.basename($_SERVER['PHP_SELF']).'?page='.($pagina_actual == 1 ? 1 : $pagina_actual-1).'" aria-label="Anterior">
      <span aria-hidden="true">&laquo;</span>
    </a>
  </li>';
  // Loop entre todos los links
  for ($i = 1; $i <= $paginas_totales; $i++) {
    $links .= ($i != $pagina_actual ) 
    ? '<li class="page-item"><a class="page-link" href="'.basename($_SERVER['PHP_SELF']).'?page='.$i.'">'.$i.'</a></li>' 
    : '<li class="page-item active"><a class="page-link" href="'.basename($_SERVER['PHP_SELF']).'?page='.$pagina_actual.'" tabindex="-1" aria-disabled="true">'.$pagina_actual.'</a></li>';
  }
  $links .= 
  '<li class="page-item">
    <a class="page-link" href="'.basename($_SERVER['PHP_SELF']).'?page='.($pagina_actual == $paginas_totales ? $paginas_totales : $pagina_actual+1).'" aria-label="Siguiente">
      <span aria-hidden="true">&raquo;</span>
    </a>
  </li></ul>';

  return $links;
}

// Cargar todos los videojuegos de el usuario actual
function get_games_by_user($id_usuario) {
  // Para paginación de registros
  $stmt              = 'SELECT COUNT(v.id) AS total FROM stock v WHERE v.id_usuario=:id_usuario';
  $total_records     = query_db($stmt , ['id_usuario' => $id_usuario])[0]['total'];
  $offset            = NULL;
  $pagination        = NULL;
  $limit             = NULL;
  if($offset = create_offset($total_records)) {
    $limit = $offset[0];
    $pagination = $offset[1];
  }

  // Quiero seleccionar TODAS las columnas de la tabla videojuegos del usuario que 
  // corresponda al $id_usuario pasado
  $stmt = 'SELECT v.* FROM stock v WHERE v.id_usuario=:id_usuario ORDER BY v.id DESC '.$limit;

  return ($rows = query_db($stmt , ['id_usuario' => $id_usuario])) ? [$rows,$pagination] : false;
}

// Cargar un juego con id
// vamosw hacer anexiones ya que tenemos varias tablas compartiendo id referentes a esas tablas para conectar su informacion
  // para ello utilizamos el JOING PARA conectar diferentes tablas 
  // para ello utilizamos los joins y seleccionamos, = traemos de la tabla generos, de la tabla usuarios y de la tabla plataforma, etc el apartado de genero, plataforma, id del usuario que registro ese producto
  // para mostrar el el modal la informacion completa y no harcodeada del producto registrado
function get_game_by_id($id) {
  $stmt = 
  'SELECT 
  v.*,
  g.genero,
  u.nombre,
  u.email
  FROM stock v
  JOIN generos g ON v.id_genero = g.id
  JOIN usuarios u ON v.id_usuario = u.id
  WHERE v.id=:id 
  LIMIT 1';
  return ($rows = query_db($stmt , ['id' => $id])) ? $rows[0] : false;
}

function get_user_by_id($id) {
  $stmt = 
  'SELECT *FROM usuarios WHERE id=:id  LIMIT 1';
  return ($rows = query_db($stmt , ['id' => $id])) ? $rows[0] : false;
}


