

<?php 
include 'conexion.php';
//verificamos si existe o no una variable por el metodo get id_venta 
if (!isset($_GET['id_venta'])) {
    header("location: index.php");

}

$datos = $mysqli->query("SELECT 
ventas.*,
usuarios.nombre,.usuarios.email
FROM ventas
INNER JOIN usuarios on ventas.id_usuario = usuarios.id
WHERE ventas.id=".$_GET['id_venta'])or die($mysqli -> error);

$datosUsuario = mysqli_fetch_row($datos);
$datos2 = $mysqli->query("SELECT * FROM envios WHERE id_venta =".$_GET['id_venta'])or die($mysqli -> error);
$datosEnvio = mysqli_fetch_row($datos2);

$datos3 = $mysqli->query("SELECT productos_ventas.*,
                 stock.Nombre as nombre_producto, stock.foto
                 FROM productos_ventas inner join stock on productos_ventas.id_producto = stock.id
                 WHERE id_venta =".$_GET['id_venta'])or die($mysqli -> error);

?>
  
  <div class="site-wrap">
  <?php require_once 'includes/inc_header.php' ?>
 <?php require_once 'includes/inc_navbar.php' ?>
<br>
    <div class="site-section">    
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Estado del pedido</h2>
          </div>
          <div class="col-md-7">

            <form action="#" method="post">
              
              <div class="p-3 p-lg-5 border">

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black">Venta #<?php echo $_GET['id_venta'];?> </label>
                  </div>
                  </div>

                  <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black">Nombre: <?php echo $datosUsuario[4];?></label>
                  </div>
                </div>
               
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black">Email: <?php echo $datosEnvio[3];?></label>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black">Telefono: <?php echo $datosEnvio[4];?></label>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black">Direccion: <?php echo $datosEnvio[6];?></label>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black">CP: <?php echo $datosEnvio[5];?></label>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_lname" class="text-black">Ciudad: <?php echo $datosEnvio[8];?></label>
                  </div>
                </div>

                
                </div>
              
              

            </form>
          </div>
          <div class="col-md-5 ml-auto">

          <?php 
          while ($f = mysqli_fetch_array($datos3)) {
           
          
          ?>
            <div class="p-4 border mb-3">
            <img class="img-fluid" width=100 height=100 src="<?php echo get_image(UPLOADS.$f['foto']); ?>"><br>
            <p class="mb-0"><strong>Producto: </strong><?php echo $f['nombre_producto']; ?></span></p><br>
              <p class="mb-0"><strong>Cantidad: </strong><?php echo $f['cantidad']; ?></span></p>
              <p class="mb-0"><strong>precio: </strong>$<?php echo $f['precio']; ?></span></p>
              <p class="mb-0"><strong>subtotal: </strong>$<?php echo $f['subtotal']; ?></span></p>
            </div>
            <?php }  ?>
          <h4>Total: $<?php echo number_format($datosUsuario[2], 2, '.', ''); ?></h4>


          </div>
        </div>
      </div>
    </div>

    <br><br><br>
    <?php require_once 'includes/inc_footer.php' ?>
  </div>