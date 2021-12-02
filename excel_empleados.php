<?php

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= empleados.xls");

?>


<table class="table">
  <thead class="table-dark">
  <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">creado</th>
      <th scope="col">rol</th>
    </tr>
  </thead>
  <tbody>

  <?php 

include 'conexion.php';

$query = "SELECT id, nombre, email, creado, rol FROM usuarios";
$resultado = mysqli_query($mysqli,$query); 
  while($row = mysqli_fetch_array($resultado))	{

  
  ?>

  <tr>
      <th scope="col"><?php echo $row['id']; ?></th>
      <th scope="col"><?php echo $row['nombre']; ?></th>
      <th scope="col"><?php echo $row['email']; ?></th>
      <th scope="col"><?php echo $row['creado']; ?></th>
      <th scope="col"><?php echo $row['rol']; ?></th>
    </tr>

    <?php  } ?>
   
  </tbody>
</table>


    


