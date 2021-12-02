<?php require_once 'includes/inc_header.php' ?>
<?php require_once 'includes/inc_navbar.php' ?>


<br><br>    
    <!-- Begin Page Content -->
    <div class="container container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Administración</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow rounded"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 shadow rounded">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Usuarios</div>
                                    <?php 
                                     require 'conexion.php';

                                     $stmt = 'SELECT * FROM usuarios ORDER BY id';
                                     $query_run = mysqli_query($mysqli, $stmt);

                                     $row = mysqli_num_rows($query_run);
                                    
                                    echo" <div class='h5 mb-0 font-weight-bold text-gray-800'>$row registrados</div>";
                                    ?>
                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">800 users</div> -->
                            </div>
                            <div class="col-auto">
                                <i style="color: #4169E1;" class="fas fa-user-plus fa-2x text-gray-300"></i>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 shadow rounded">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    ventas</div>
                                    <?php 
                                     require 'conexion.php';

                                     $query = 'SELECT SUM(total) AS count FROM ventas ';
                                     $duracion = $mysqli ->query($query);
                                     $recorrido =$duracion->fetch_array(); 
                                     $total = $recorrido['count'];
                                    echo " <div class='h5 mb-0 font-weight-bold text-gray-800'>$$total MX</div>";
                                    ?>
                            </div>
                            <div class="col-auto">
                                <i style="color: green;" class="fas fa-dollar-sign fa-2x text-green-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2 shadow rounded">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Productos
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                    <?php 
                                     require 'conexion.php';

                                     $stmt = 'SELECT * FROM stock ORDER BY id';
                                     $query_run = mysqli_query($mysqli, $stmt);

                                     $row = mysqli_num_rows($query_run);
                                    
                                    echo" <div class='h5 mb-0 mr-3 font-weight-bold text-gray-800'>$row registrados</div>";
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i style="color: #800080;" class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card border-left-warning shadow h-100 py-2 shadow rounded">
                    <div class="card-body ">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Entregas pendientes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i  style="color: #FF6347;" class="fas fa-cart-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!----------------------------------------------------------------- Content Apartado Productoa -------------------------------------------->
<div class="container">
  <div class="row">
    <!-- Game list -->
    <div class="col-xl-12">
    <h1 class="mt-4">Tabla de Productos</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="all.php">Contenido</a></li>
          <li class="breadcrumb-item active">Tabla de stock</li>
      </ol>
                   

<a href="excel.php" type="button" class="btn btn-outline-success rounded shadow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
</svg> Excel</a>

<a href="pdf.php" type="button" class="btn btn-outline-danger rounded float-center shadow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
  <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
</svg> PDF</a>
<br><br>


<div class="card mb-4 ">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Stock</div>
    <div class="card-body">
    <div class="table-responsive ">

<table class="table shadow rounded table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead class="table-active">
  <tr>
      <th scope="col">ID</th>
      <th scope="col">Foto</th>
      <th scope="col">Nombre</th>
      <th scope="col">Stoks</th>
      <th scope="col">Delete</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php 

include 'conexion.php';

  $query = "SELECT * FROM stock";
  $resultado = mysqli_query($mysqli,$query); 
  while($row = mysqli_fetch_array($resultado))	{

  ?>
  <tr>
      <th scope="col"><?php echo $row['id']; ?></th>
      <th class="img-fluid" scope="col"><img class="img-fluid" width=50 height=50 src="<?php echo get_image(UPLOADS.$row['foto']) ?>"></th>
      <th scope="col"><?php echo $row['Nombre']; ?></th>
      <th scope="col"><?php echo $row['cantidad']; ?></th>
      <th><button class="btn btn-sm btn-danger float-right do_delete_game rounded shadow" data-id="<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></button></th>
      <th><a class="btn btn-sm btn-success float-right rounded shadow" href="<?php echo 'update.php?id='.$row['id']; ?>" data-toggle="tooltip" title="Editar Producto"><i class="fas fa-edit"></i></a></th>
    </tr>
    <?php } ?>
  </tbody>
</table>

</div>
</div>
</div>
</div>

<!----------------------------------------------------------------- Fin Apartado Productoa -------------------------------------------->


<div class="container">
  <div class="row">
    <!-- Game list -->
    <div class="col-xl-12">
    <h1 class="mt-4">Tabla de Empleados</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="all.php">Contenido</a></li>
          <li class="breadcrumb-item active">Tabla de Empleados</li>
      </ol>
                   

<a href="excel_empleados.php" type="button" class="btn btn-outline-success rounded shadow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
</svg> Excel</a>

<a href="pdf_empleados.php" type="button" class="btn btn-outline-danger rounded float-center shadow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
  <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
</svg> PDF</a>
<br><br>


<div class="card mb-4 ">
    <div class="card-header"><i class="fas fa-user-plus mr-1"></i> Empleados</div>
    <div class="card-body">
    <div class="table-responsive ">

<table class="table shadow rounded table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead class="table-active">
  <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">rol</th>
      <th scope="col">Delete</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php 

include 'conexion.php';

  $query = "SELECT * FROM usuarios";
  $resultado = mysqli_query($mysqli,$query); 
  while($row = mysqli_fetch_array($resultado))	{

  ?>
  <tr>
      <th scope="col"><?php echo $row['id']; ?></th>
      <th scope="col"><?php echo $row['nombre'] ?></th>
      <th scope="col"><?php echo $row['email']; ?></th>
      <th scope="col"><?php echo $row['rol']; ?></th>
      <th><button class="btn btn-sm btn-danger float-right do_delete_user rounded shadow" data-id="<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></button></th>
     
      <th>
<a class="btn btn-sm btn-success float-right rounded shadow" href="<?php echo 'update_user.php?id='.$row['id']; ?>" title="Asignar rol de usuario"  >
<i class="fas fa-edit"></i>
</a></th>


    <?php } ?>
  </tbody>
</table>

</div>
</div>
</div>
</div>

<!----------------------------------------------------------------- Fin Apartado EMpleados roles -------------------------------------------->

</div>
</div>
</div>
</div>
</div>



    <br><br>
<?php require_once 'includes/inc_footer.php' ?>