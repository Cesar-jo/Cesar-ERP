<?php

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= productos.xls");

?>


<table class="table">
  <thead class="table-dark">
  <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Stoks</th>
      <th scope="col">Fecha</th>
    </tr>
  </thead>
  <tbody>

  <?php 

include 'conexion.php';

  $query = "SELECT v.*,
  g.genero,
  u.nombre,
  u.email
  FROM stock v
  LEFT JOIN generos g ON v.id_genero = g.id
  LEFT JOIN usuarios u ON v.id_usuario = u.id ";
  $resultado = mysqli_query($mysqli,$query); 
  while($row = mysqli_fetch_array($resultado))	{

  
  ?>

  <tr>
      <th scope="col"><?php echo $row['id']; ?></th>
      <th scope="col"><?php echo $row['Nombre']; ?></th>
      <th scope="col"><?php echo $row['cantidad']; ?></th>
      <th scope="col"><?php echo $row['creado']; ?></th>
    </tr>

    <?php  } ?>
   
  </tbody>
</table>


    


