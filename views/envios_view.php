<?php require_once 'includes/inc_header.php' ?>
 <?php require_once 'includes/inc_navbar.php' ?>

 <!-- Content -->
<div class="container" style="padding: 150px 20px;">
  <div class="row">
    <!-- Game list -->
    <div class="col-xl-12">
      <h1 class="text-center mb-5"><?php echo $data['title']; ?></h1>
     
<div class="container">
      <form method="POST" class="table-responsive col-md-12" >
<table class="table shadow rounded">
  <thead class="table-ligh">
  <tr>
     <!-- <th scope="col">Producto</th>
      <th scope="col">Nombre</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Subtotal</th>
      <th scope="col">Estatus</th> -->
    </tr>
  </thead>
  <tbody>
  
 <?php
include 'conexion.php';



$datos = $mysqli->query("SELECT productos_ventas.*,
              stock.Nombre as nombre_producto, stock.foto, envios.estatus
              FROM productos_ventas 
              inner join stock on productos_ventas.id_producto = stock.id
              inner join envios on productos_ventas.id_venta = envios.id_venta
              ")or die($mysqli -> error);

              
     
     ?> 

     <?php  while  ($f= mysqli_fetch_array($datos)){ ?>
          
      <tr>
            
            <th><img class="img-responsive" width=55 height=55 src="<?php echo get_image(UPLOADS.$f['foto']); ?>"></th>
            <th><p class="mb-0"><span><?php echo $f['nombre_producto']; ?></span></p></th>
            <th><p class="mb-0">$<?php echo $f['subtotal']; ?></p></th>
            <th><p class="mb-0 btn btn-outline-success btn-sm rounded"><span><?php echo $f['estatus']; ?></span></p></th>
            <th></div>

      </tr>
        
      <?php }  ?>
    

<?php if (!empty($f)): ?> 

<div class="text-center py-5">
<img class="img-fluid" src="<?php echo IMAGES.'empty-cart.png' ?>" alt="No hay productos" style="width: 100px;">
<p class="mt-3 text-muted">No tienes Productos comprados, intenta comprando el primero</p>
<a href="all.php" class="mt-5 btn btn-primary btn-lg rounded">Agregar nuevo producto</a>
</div>

<?php endif; ?>

    
  </tbody>
</table>
</form>
</div>
<!-- PAGINACION  -->
<div class="py-5">
      <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Atras</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
  </div>
<!-- PAGINACION  -->

      </div>
  </div>
</div>
  

  <?php require_once 'includes/inc_footer.php' ?>
  