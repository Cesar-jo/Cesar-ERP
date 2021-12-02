<?php require_once 'includes/inc_header.php' ?>
<?php require_once 'includes/inc_navbar.php' ?>

<!-- Content -->

<div class="container" style="padding: 150px 20px;"
  <div class="row">
    <!-- Game list -->
    <div class="col-xl-12">
      <h1 class="text-center mb-5 "><?php echo $data['title']; ?></h1>
      <?php if ($data['games']): ?>

        <!-- Caja de busqueda = search box-->
        <div class="row">
          <div class="col-12 py-5">
          <form id="do_search_game">
            <div class="input-group">
              <input type="text" class="rounded shadow form-control" name="search_query" id="search_query" placeholder="Buscar productos...">
            <div class="input-group-append">
              <button class="btn btn-primary rounded shadow" type="submit"><i class="fas fa-search"></i></button>
            </div>
            </div>
          </form>
          </div>
         
        </div>
       
        <!--  Fin de Caja de busqueda = search box-->

        
        <!-- Lista de videojuegos-->
<div class="wrapper-search-videojuegos"></div>
      <div class="row">
        <?php foreach ($data['games'] as $g): ?>
        <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
          <div class="card shadow rounded">
            <img src="<?php echo get_image(UPLOADS.$g['foto']); ?>" alt="<?php echo $g['Nombre']; ?>" class="card-img-top" style="height: 350px; object-fit: cover;">
            <div class="card-body p-2">
              <h5 class="card-title text-truncate mb-0"><?php echo $g['Nombre']; ?></h5>
              <small class="d-block text-muted m-0"><?php echo 'Por '.$g['nombre'].' el '.format_date($g['creado']); ?></small>
            <?php if ($g['id_usuario'] == cur_user()['id']): ?> 
                <a class="btn btn-sm btn-success float-right" href="<?php echo 'update.php?id='.$g['id']; ?>" data-toggle="tooltip" title="Editar Producto"><i class="fas fa-edit"></i></a>
                <button class="btn btn-sm btn-primary float-right do_view_game" data-id="<?php echo $g['id']; ?>" data-toggle="tooltip" title="Ver producto"><i class="fas fa-eye"></i></button>
              <?php endif; ?>
              <?php if (cur_user()['rol'] == 0 || cur_user()['rol'] == 2): ?><br>
              <!--<button class="btn btn-sm btn-primary float-right do_view_game" data-id="<?php echo $g['id']; ?>" data-toggle="tooltip" title="Ver producto"><i class="fas fa-eye"></i></button> -->
              <button class="btn btn-sm btn-success float-right do_view_game rounded shadow" data-id="<?php echo $g['id']; ?>" data-toggle="tooltip" title="Agregar Producto"><i class="fas fa-cart-plus"></i> Agregar</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      

        <!-- paginacion-->
      <div class="row">
        <div class="col-xl-12 col-12">
          <?php if ($data['pagination']): ?>
          <?php echo $data['pagination']; ?>
          <?php endif; ?>
        </div>
      </div>
      </div>
      <?php else: ?>

                <!-- empty state-->
      <div class="text-center py-5">
        <img class="img-fluid" src="<?php echo IMAGES.'winner.png' ?>" alt="No hay productos" style="width: 140px;">
        <p class="mt-3 text-muted">Lo sentimos, por el momento no hay productos</p>
        <?php if (valid_session()): ?>
          <a href="add.php" class="mt-5 text-white btn btn-primary btn-lg">Agregar nuevo producto</a>
        <?php else: ?>
          <a href="register.php" class="mt-5 text-white btn btn-primary btn-lg">Regístrate gratis</a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      
    </div>
  </div>
</div>
<!-- END Content -->

<?php require_once 'includes/inc_footer.php' ?>