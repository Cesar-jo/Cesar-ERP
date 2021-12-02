<?php 
//le decimos que si existe por el metodo get id_venta y metodo, entonces vamos a insertar el id de la venta y el metodo de pago
if (isset($_GET['id_venta']) && isset($_GET['metodo'])){
include 'conexion.php';
$id_usuario = cur_user()['id'];
$mysqli->query("INSERT INTO pagos (id_venta, metodo, id_usuario) VALUES (".$_GET['id_venta'].",'".$_GET['metodo']."',$id_usuario)")or die($mysqli->error);
header("location: thankyou.php?id_venta=".$_GET['id_venta']);
}
?>
<div class="site-wrap">
<?php require_once 'includes/inc_header.php' ?>
<?php require_once 'includes/inc_navbar.php' ?>

<br><br><br><br><br><br>
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
          <span class="icon-check_circle display-3 text-success">✅</span>
            <h3 class="display-3 text-black">Thank you!</h3>
            <p class="lead mb-5">You order was successfuly completed.</p>
            <a href="verpedido.php?id_venta=<?php echo $_GET['id_venta'];?>" class="btn btn-sm btn-primary shadow rounded">Ver pedido</a>
          </div>
        </div>
      </div>
    </div>


  </div>
<br><br><br><br><br><br>
  <?php require_once 'includes/inc_footer.php' ?>