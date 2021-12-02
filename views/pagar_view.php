

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
  <!-- script de la api de pypal este scrib de pypal deve de ir siempre abago del body y en nuestro heder empieza el BODY -->
  <script src="https://www.paypal.com/sdk/js?client-id=AYq0F0lZpfvpiz5RWVDYGJ_I5r90LOXEhNznCweDmoydFfX54VUHHNh4Naf6mObpi2wUrlAmtQzJCcYp&currency=MXN"></script>
  
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
         
          <h2>Total: $<?php echo number_format($datosUsuario[2], 2, '.', ''); ?></h2><br><br>
          <?php if (cur_user()['rol'] == 2): ?>
          <a class="btn btn-primary" href="thankyou.php?id_venta=<?php echo $_GET['id_venta'];?>&metodo=efectivo";>Pago en efectivo</a>
          <br> <br>
          <?php endif; ?>
          <div id="paypal-button-container"></div>
        
          </div>
        </div>
      </div>
    </div>

    <br><br><br>

    <?php require_once 'includes/inc_footer.php' ?>
  </div>

  <!-- Script de la api de pypal -->
  <script>
      paypal.Buttons({

        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '<?php echo $datosUsuario[2];?>', // Can reference variables or functions. Example: `value: document.getElementById('...').value`
              },
            }]
          });
        },

        // Finalize the transaction after payer approval
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {

           if (orderData.status == 'COMPLETED') {
            location.href="thankyou.php?id_venta=<?php echo $_GET['id_venta'];?>&metodo=paypal";
            
            //Successful capture! For dev/demo purposes:
            //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
               // var transaction = orderData.purchase_units[0].payments.captures[0];
              // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
            

          }
          });
        }
      }).render('#paypal-button-container');

    </script>
 