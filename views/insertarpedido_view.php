

<?php 
//este codigo es donde se va a guardad todos los datos de nuestro pedido que hicimos para despues pasarcelo al archivo pagar 


//session_start();
include 'conexion.php';
//le decimos que si no hay nada setiado en nuestra bariable carrito o en nuestro carrito que nos redireccione al index
if (!isset($_SESSION['carrito'])) {
  header("location: index.php");
}


//en caso de que si haya productos en nuestro carrito 
$arreglo = $_SESSION['carrito'];
$total = 0;
//hacemos un ciclo for para traer los datos de nuestro carrito e insertar esos datos en nuestra BD
  for ($i=0; $i <count($arreglo); $i++) { 
    //hacemos el calculo de la compra realisada para despues insertarla en nuestra BD
    $total = $total+($arreglo[$i]['precio'] * $arreglo[$i]['Cuantos']);
  }

  //ahora vamos a tarer el id de la session actual
  //le pasamos el id de la session a la variable = $id_usuario y le pasamos la funcion  cur_user()['id'] que es donde se 
  //guarda nuestra info en forma de array de los usuarios registrados y le pasamos el parametro a traer = [id]
  // que corresponde al id de la session actual
  $id_usuario = cur_user()['id'];

  //vamos a registrar las ventas
  $fecha = date('Y-m-d h:m:s');
  $mysqli -> query("INSERT INTO ventas (id_usuario, total, fecha) VALUES ($id_usuario,$total,'$fecha')")or die($mysqli->error);
  // con la funcion que viene por defecto de php = insert_id;
  //lo que hace es traer el ultimo registro que se acaba de hacer de nuestra sentencia SQL DE ACA ARRIBA linea:21
  //y con eso ya vamos a tener o traer el id de la venta de esa tabla osea que $id_venta =n a la columna id de nuestra tabla ventas
  $id_venta = $mysqli -> insert_id;

//hacemos otro ciclo for para traer los datos de nuestro carrito e insertar esos datos en nuestra BD
for ($i=0; $i <count($arreglo) ; $i++) { 
  $mysqli -> query("INSERT INTO productos_ventas (id_venta, id_producto, cantidad, precio, subtotal, id_usuario)
   VALUES ($id_venta,
   ".$arreglo[$i]['Id'].",
   ".$arreglo[$i]['Cuantos'].",
   ".$arreglo[$i]['precio'].",
   ".$arreglo[$i]['Cuantos']*$arreglo[$i]['precio'].", $id_usuario )")
   or die($mysqli->error);
   //ahora vamos hacer la funcion de decontar la cantidad de productos que compramos en neustro inventario
   //le decimos que vamos a actualizar de la tabla stock la columna cantidad que es donde se aloja la cantidad de stock que tiene cada producto
   // y le restamos -  nuestra variable Cuantos que es donde se guarda la cantidad de productos agregados de cada estock para descontarle esa cantidad al producto de nuestra  BD
   $mysqli -> query("UPDATE stock set cantidad = cantidad - ".$arreglo[$i]['Cuantos']."  WHERE id=".$arreglo[$i]['Id'] )or die($mysqli->error);
}
 //vamos hacer una insercion de datos del formulario del checkout 
 $mysqli -> query("INSERT INTO envios (nombre, apellido, email, telefono, cp, direccion1, direccion2, ciudad_estado, id_venta, id_usuario) 
 VALUES (
      '".$_POST['nombre']."',
      '".$_POST['apellido']."',
      '".$_POST['email']."',
      '".$_POST['telefono']."',
      '".$_POST['cp']."',
      '".$_POST['direccion']."',
      '".$_POST['direccion2']."',
      '".$_POST['ciudad']."',
         $id_venta,
         $id_usuario
        )

        ")or die($mysqli->error);
unset($_SESSION['carrito']);
//ahora para hacer la validacion del pago le agregamos a donde nos redireccionara va pagar el id de la venta y le concatenamos
//nuestra variable que guarda el id_venta 
//para que cuando estemos en pagar cachemos el id de la venta y ver todos esos datos de la venta que se esta realizando
header("location: pagar.php?id_venta=".$id_venta);

?>