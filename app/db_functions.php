<?php 

// Realizar una conexión a la base de datos
//creamos una funcion que la llamaremos make_con, que lo que hara es hacer la conexion a la base de datos
//y establecemos los parametros que creamos en config y le ponemos unas variables que seran = a los parametros de conexion que pusimos en config.php  
function make_con(
$db_engine  = DB_ENGINE , 
$db_host    = DB_HOST , 
$db_name    = DB_NAME , 
$db_user    = DB_USER , 
$db_pass    = DB_PASS , 
$db_charset = DB_CHARSET) {

  //Ahora establecemos la conexion (creamos un objeto que se llamara PDO(donde aqui adenntro tendra nuestros parametros de conexion establecidas))
// le decimos con nuestro objeto y nuestras variables que establecimos que 
//$db_engine.' = nuestro motor es mysql
//:host='.$db_host.'; nuestro host es = localhost o 127.1....
//dbname='.$db_name.'; = que esta es nuestra base de datos 'erp'
//charset='.$db_charset , = es nuestro lenjuage que es españos utf 8
// $db_user , = este es nuestro usuario root
// $db_pass); = y contraseña que no tenemos contraseña
  try {
    $connection = new PDO($db_engine.':host='.$db_host.';dbname='.$db_name.';charset='.$db_charset , $db_user , $db_pass);
    //echo 'Conectado con éxito';
    return $connection;
  //con el (PDOException $e) acemos que nos regrese los datos de nuestro objeto que creamos PDO
  } catch (PDOException $e) {
    die('No hay conexión con la base de datos<br><span style="color: red;"> '.$e->getMessage().'</span>');
  }
}
//---------------------------------Aqui termina nuestra funcion de conexion (make_con) ------------------------------------//

// Petición a la base de datos
// SELECT * FROM usuarios;
// INSERT -> $ID
// UPDATE -> 
// DELETE -> 
//--
//creamos un statement por nombre $stmt(que los statemens son las consultas que hacemos en sql como, insert into, select from, delete from, update fron)
//creamos unos parametros que queremso que pasen cosas o elementos que cuando queramos insertar datos ocupamos esa variable $params = []
//los parametros son lo que queremos insertar en esas consultas sql en statemenst stmt
// y un ultimo parametro que queramos que pase tambien es el $debug = que es igual a false para nos mostre errores
function query_db($stmt, $params = [] , $debug = false) {
  //llamamos nuestra funcion de conexion para poder hacer las peticiones de insert, update y delete
  $con = make_con();

  // Necesitamos preparar nuestro enunciado o consulta
  //le decimos que query es igual a nuestra conexion, lo que hara es preparar con el prepare, y que va a preparar? pues los statements ($stmt)
  $query = $con->prepare($stmt);

  // Vamos a ejecutar la información dentro de query ($stmt)= que seran los insert, update y delete los statement

  // INSERT INTO usuarios (nombre , email) VALUES (:nombre , :email)
  //le decimos que si nuestro query es diferente, entonces con  execute lo que hace es ejecutar los parametros
  //lo que hara es pasarnos los parametros que son  (nombre , email) etc
  // para ello va evaluar los datos  (nombre , email) values  (nombre , email) , si son los mismos datos que queremos traer pues nos traeran los parametros
  if(!$query->execute($params)) {
    //Pero si  TODO  SALE MAL
    // NO PUDO INSERTARSE
    // NO PUDO BORRARSE
    // NO PUDO ACTUALIZARSE
    // NO PUDO EJECUTARSE LA SELECCIÓN
    //y si no son los datos iguales en su evalues, pues que nos lance los errores
    if($debug) {
      // le decimos que nos regrese si hay algun error en nuestra conexion que ahora es = $query, todo eso con la funcion  = errorInfo();
      $error = $query->errorInfo();
      echo $error[0].'<br>';
      echo $error[1].'<br>';
      echo $error[2];
    }

    return false;
  }

  // pero si todo sale bien entonces

  // TODO SI SALE BIEN
  // HAY O NO HAY RESULTADOS
  // SE INSERTO EL REGISTRO
  // SE ACTUALIZO 0 O MÁS COLUMNAS
  // SE BORRO ÉXITO 0 MÁS COLUMNAS
  // CRUD

  //creamos una variable que va hacer inicializada en cero su conteo
  $count = 0;
  //lo que hace rowcount es contar las filas
  //entonces count es igual a query que es lo que se  ejecucion
  //entonces lo que hara es si se insertaron 2 registros que nos mande el conteo de cuantos registros se hicieron, al igual que cuantos se borraron, cuantos se buscaron, etc
  $count = $query->rowCount();

  //el (strpos) es una funcion que viene por defecto en php es un string position, 
  //lo que hace es buscar la posicion de una palabra o estring que nosotros le especifiquemos

  // entonces le decimos que queremos buscar en statement (stmt) y que queremos buscar, pues queremos buscar la palabra SELECT 
  // que en select podemos buscar desde id, nombre etct
  //entonces le decimos que si existe la palabra select que queramos buscar en statement nos traiga lo que etsamos buscando
  // y le decimos con  !== false que necesitamos que no sea igaul a false,
  // osea que si encuentra selec nos traiga los datos y si no lo encuentra que nos ejecute un false de que no existe
  // para ello utilizamos la funcion strpos = string position = if(strpos) con esto nos buscara el numero de veces que encuentre la palabra select
  if(strpos($stmt , 'SELECT') !== false) {
    // Selección o busqueda de información
    // Necesitamos contar los resultados encontrados y regresarlos
    //entonces le decimos que si count es mayor a 0 entonces si hay resultados (si se encontraron los datos)
    if($count > 0) {
      //entonces lo que hara es traernos o regresar las filas seleccionadas
      //lo que hace (fetchAll) es agarrar todos los datos que se hayan encontrado y nos lo regresa con un array
      return $query->fetchAll();
    }
    //si no encuentra resultados que nos lance un fase de que no se encontro
    return false;

    //le decimos entonses si busca la palabra insert into, que nos haga un registro y si no encuentra esa palabra que nos lance un false osea que no haga un regisro
  } elseif(strpos($stmt , 'INSERT INTO') !== false) {
    //entonces le decimos que si count es mayor a 0 entonces si hay resultados (si se insertaron los datos)
    if($count > 0) {
      // Necesitamos regresar el id de la fila insertada
      //con este return lo que hacemos es que si se inserta un registro nos va a regresar un id 
      //con esta funcion de php que viene por defecto ->lastInsertId(); 
      return $con->lastInsertId();
    }
    //si no se inserta nos traera un false
    return false;

    //le decimos entonses si busca la palabra update, que nos haga una actualizacion y si no encuentra esa palabra que nos lance un false osea que no haga una actualizacion
  } elseif(strpos($stmt , 'UPDATE') !== false) {
    // Necesitamos contar cuantos registros se actualizaron y si son 0 o más
    // regresamos true
    //entonces le decimos que si count es mayor a 0 entonces si hay resultados (si se actualizaron los datos)
    if($count >= 0) {
      return true;
    }

    //le decimos entonses si busca la palabra delete, que nos haga un delete y si no encuentra esa palabra que nos lance un false osea que no haga un borrado
  } elseif(strpos($stmt , 'DELETE') !== false) {
    // Regresar true si son 0 o más filas afectadas
    //entonces le decimos que si count es mayor a 0 entonces si hay resultados (si se eliminaron los datos)
    if($count > 0) {
      return true;
    }
    return false;

  }
  return true;
}