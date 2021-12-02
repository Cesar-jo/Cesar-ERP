<?php require_once 'includes/inc_header.php' ?>
<?php require_once 'includes/inc_navbar.php' ?>



<?php 
//session_start();
include "conexion.php";
//le decimos que si existe la variable de sesion que creamos llamada carrito se va asignificar que ya hay un producto agregado al carrito
if (isset($_SESSION['carrito'])) {

  if (isset($_GET['id'])) {
   $arreglo = $_SESSION['carrito'];
   $encontro = false;
   $numero = 0;
   for ($i=0; $i < count($arreglo); $i++) { 
     //le decimos que si el ID de nuestro arreglo coincide con el id del producto a seleccionar significa que encontro el producto
  if ($arreglo[$i]['Id'] == $_GET['id']) {
  $encontro = true;
  $numero = $i;
  }
   }
   //ahora si encontro es verdadero
   if ($encontro == true) {
     //lo que va hacer es que cada que le demos en agregar el mismo producto se nos va a sumar uno, si tengo 1 producto llamado antena y agrego una vez mas ahora trendre 2 productos, esto hace este funcion
  $arreglo[$numero]['Cuantos'] = $arreglo[$numero]['Cuantos']+1;
  //y ahora lo obtenido de nuestro carrito se me va a guardar en la variable $arreglo
  $_SESSION['carrito'] = $arreglo;
  header("location: index.php"); // esto para que cuando le demos actualizar al carrito ya no se duplique el producto

   }else{
     // Si en caso de que no estaba el registro 
    $Nombre = "";
    $foto = "";
    $cantidad = "";
    $precioio = "";

    $res = $mysqli->query('SELECT * FROM stock WHERE id='.$_GET['id'])or die($mysqli->error);
    $g = mysqli_fetch_row($res);
    //ahora le decimos que esaas variables seran igual a la columna de nuestra bd que le corresponde eje3mplo:
    $nombre = $g['2']; //la columna 2 es la columna donde se guarda el nombre del producto
    $foto = $g['3'];
    $cantidad = $g['6'];
    $precio = $g['8']; 
    //le quitamos los corchetes ya que si se lo dejamos indica que sera de muchas dimenciones y solo sera de un solo dato
    $arregloNuevo = array(
      'Id' => $_GET['id'],
      'Nombre' => $nombre,
      'foto' => $foto,
      'cantidad' => $cantidad,
      'precio' => $precio,
      //esta ultima variable es parqa especificarle cuantos productos agregar  pero la empesaremos desde el 1
      'Cuantos' => 1
    );
    //con esta funcion de php array_push nos permite concatenar los arrays que hicimos o meter los arreglos nuevos que tengamos
    //ejemplo de la informacion del arreglo que viene ser el primer registro que hacemos solo nos permite agregar un producto, para hello como segundo parametro le pasamos el arreglo nuevo que hicimos que lo que hace es que cada que agregemos un producto
    //este se sume +1
    array_push($arreglo, $arregloNuevo);
    //ahora metemos en el carrito el arreglo ya modificado que tendra la funcion del arreglo nuevo tambien gracias a la funcion de php array_push
    $_SESSION['carrito'] = $arreglo;
    header("location: index.php"); // esto para que cuando le demos actualizar al carrito ya no se duplique el producto
   }
  }
 //en caso de que no exista vamos a crear las variables de los datos que queremos traer al carrito
}else{
//si no existe pues creamos la variabloe de sexion con los datos que queremos traer
   if (isset($_GET['id'])) {
     $Nombre = "";
     $foto = "";
     $cantidad = "";
     $Precio = "";

     $res = $mysqli->query('SELECT * FROM stock WHERE id='.$_GET['id'])or die($mysqli->error);
     $g = mysqli_fetch_row($res);
     //ahora le decimos que esaas variables seran igual a la columna de nuestra bd que le corresponde eje3mplo:
     $nombre = $g['2']; //la columna 2 es la columna donde se guarda el nombre del producto
     $foto = $g['3'];
     $cantidad = $g['6'];
     $precio = $g['8'];

     $arreglo[] = array(
       'Id' => $_GET['id'],
       'Nombre' => $nombre,
       'foto' => $foto,
       'cantidad' => $cantidad,
       'precio' => $precio,
       //esta ultima variable es parqa especificarle cuantos productos agregar  pero la empesaremos desde el 1
       'Cuantos' => 1
     );
     //ahor5a si creamos la variable de session del carrito que sera igual a nuestro arreglo que creamos
     $_SESSION['carrito'] = $arreglo;
     header("location: index.php"); // esto para que cuando le demos actualizar al carrito ya no se duplique el producto
    }
}

?>


<!-- Content -->
<div class="container" style="padding: 150px 20px;">
  <div class="row">
    <!-- Game list -->
    <div class="col-xl-12">
      <h1 class="text-center mb-5"><?php echo $data['title']; ?></h1>


<?php if (cur_user()['rol'] == 0 || cur_user()['rol'] == 2): ?>

<form method="POST" class="table-responsive col-md-12" >
<table class="table shadow rounded">
  <thead class="table-ligh">
  <tr>
      <th scope="col">Foto</th>
      <th scope="col">Nombre</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
      <th scope="col">Borrar</th>
    </tr>
  </thead>
  <tbody>


  <?php
  //inicializamos el total que va hacer inicializado en 0 para despues ocupar esa variable y hacer el total de la compra
$total = 0;
if (isset($_SESSION['carrito'])) {
$arreglo_carrito = $_SESSION['carrito'];
for ($i=0;$i<count($arreglo_carrito);$i++){ 
  //ahora vamos hacer el calculo del total de la compra
  // para hello multiplicamos todos los producto agregados al carrito por la cantidad de cada producto
  $total = $total +($arreglo_carrito[$i]['precio'] * $arreglo_carrito[$i]['Cuantos'])

?>

  <tr>
      <th class="img-fluid" ><img class="img-fluid" width=100 height=100 src="<?php echo get_image(UPLOADS.$arreglo_carrito[$i]['foto']) ?>"></th>
      
      <th><?php echo $arreglo_carrito[$i]['Nombre']; ?></th>

      <!-- Agregamos un data- y le ponemos como queremos que se llame esa data que sera data-precio la cual va a traer el precio de ese producto
    para despues utilizarlo y multiplicarlo con la cantidad de productos que que el usuario puso en el carrito -->
      <th>
      <div class="input-group mb-3" style="max-width: 120px;">
        <div class="input-group-prepend">
              <button class="btn btn-outline-primary js-btn-minus rounded btnIncrementar" style="max-width: 40px;" type="button">&minus;</button>
             </div>
     
              <input class="text-center form-control txt-cantidad" type="text" 
      data-precio="<?php echo $arreglo_carrito[$i]['precio']; ?>"  
      data-id="<?php echo $arreglo_carrito[$i]['Id']; ?>" 
      value="<?php echo $arreglo_carrito[$i]['Cuantos']; ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1"aria-label="Example text with button addon" aria-describedby="button-addon1">
    
      <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus rounded btnIncrementar" style="max-width: 40px;"  type="button">&plus;</button>
            </div>
        </div>
    </th>

       <th scope="col" class="cant<?php echo $arreglo_carrito[$i]['Id']; ?>">
       $<?php echo $arreglo_carrito[$i]['precio'] * $arreglo_carrito[$i]['Cuantos']; ?></th>

     

      <th><button class="btn btn-sm btn-danger rounded btnEliminar"  data-id="<?php echo $arreglo_carrito[$i]['Id']; ?>" type="button"><i class="fas fa-trash"></i></button></th>
   
          </tr>
   
    <?php }}; ?>

    
  </tbody>
  
</table>
</form>


<?php if (!isset($_SESSION['carrito'])): ?>
      <div class="text-center py-5">
        <img class="img-fluid" src="<?php echo IMAGES.'empty-cart.png' ?>" alt="No hay productos" style="width: 100px;">
        <p class="mt-3 text-muted">No tienes Productos Agregados, intenta agregando el primero</p>
        <a href="all.php" class="mt-5 btn btn-primary btn-lg rounded">Agregar nuevo producto</a>
      </div>

      <?php endif; ?>
      
    <div class="container">
      <?php //incluimos nuestro apartado de ver el total de nuestra compra o carrito
        include 'total_views.php'?>
         </div>

<?php endif; ?>





<?php if (cur_user()['rol'] == 1): ?>
      <?php if ($data['games']): ?>
      <div class="row">
        <?php foreach ($data['games'] as $g): ?>
        <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
          <div class="card shadow rounded">
          <!-- Upload es  la carpeta que creamos y tambien en settins en config, 
          en si se va a basar en que el usuario suba las imagenes, en este caso los juegos que son images en si,
          lo que hara es cargar las imagenes subirlas -->
            <img src="<?php echo get_image(UPLOADS.$g['foto']); ?>" alt="<?php echo $g['Nombre']; ?>" class="card-img-top" style="height: 350px; object-fit: cover;">
            <div class="card-body p-2">
              <h5 class="card-title text-truncate"><?php echo $g['Nombre']; ?></h5>
              <button class="btn btn-sm btn-primary float-right do_view_game" data-id="<?php echo $g['id']; ?>" data-toggle="tooltip" title="Ver producto"><i class="fas fa-eye"></i></button>
              <a class="btn btn-sm btn-success float-right" href="<?php echo 'update.php?id='.$g['id']; ?>" data-toggle="tooltip" title="Editar Producto"><i class="fas fa-edit"></i></a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="row">
        <div class="col-xl-12 col-12">
          <?php if ($data['pagination']): ?>
            <?php echo $data['pagination']; ?>
          <?php endif; ?>
        </div>
      </div>
      <?php else: ?>
      <div class="text-center py-5">
        <img class="img-fluid" src="<?php echo IMAGES.'empty-cart.png' ?>" alt="No hay productos" style="width: 100px;">
        <p class="mt-3 text-muted">No tienes Productos Agregados, intenta agregando el primero</p>
        <a href="all.php" class="mt-5 btn btn-primary btn-lg rounded">Agregar nuevo producto</a>
      </div>
      <?php endif; ?>


      <?php endif; ?>
    </div>
  </div>
</div>
<br><br><br>
<!-- END Content -->

<?php require_once 'includes/inc_footer.php' ?>