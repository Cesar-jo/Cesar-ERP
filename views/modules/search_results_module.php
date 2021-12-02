    
    <?php if (!empty($results)): ?>
    <!-- Caja de busqueda = search box-->
    <div class="row">
          <div class="col-12">
          <p><?php echo 'Mostrando '.(count($results) > 1 ? count($results). ' resultados' : '1 resultado.'); ?></p>
          </div>
        <?php foreach ($results as $r): ?>
        <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
          <div class="card">
            <img src="<?php echo get_image(UPLOADS.$r['foto']); ?>" alt="<?php echo $r['Nombre']; ?>" class="card-img-top" style="height: 350px; object-fit: cover;">
            <div class="card-body p-2">
              <h5 class="card-title text-truncate mb-0"><?php echo $r['Nombre']; ?></h5>
              <small class="d-block text-muted m-0"><?php echo 'Por '.$r['nombre'].' el '.format_date($r['creado']); ?></small>
              <?php if ($r['id_usuario'] == cur_user()['id']): ?>
                <a class="btn btn-sm btn-success float-right" href="<?php echo 'update.php?id='.$r['id']; ?>" data-toggle="tooltip" title="Editar juego"><i class="fas fa-edit"></i></a>
              <?php endif; ?>
              <!-- sI EL USUARIO LOGEADO TIENE UN ROL DE USUARIO = A 0 QUE APARESCA EL BOTON AGREGAR AL CARRITO-->
              <?php if (cur_user()['rol'] == 0): ?><br>
              <button class="btn btn-sm btn-success float-right do_view_game rounded shadow" data-id="<?php echo $g['id']; ?>" data-toggle="tooltip" title="Agregar Producto"><i class="fas fa-cart-plus"></i> Agregar</button>
              <?php endif; ?>
               <!--  FIN sI EL USUARIO LOGEADO TIENE UN ROL DE USUARIO = A 0 QUE APARESCA EL BOTON AGREGAR AL CARRITO-->
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- En caso de no cargar los juegos buscados, nos aparecera esto-->
      <?php else: ?>
                <!-- empty state-->
      <div class="text-center py-5">
        <img class="img-fluid" src="<?php echo IMAGES.'winner.png' ?>" alt="No hay productos" style="width: 140px;">
        <p class="mt-3 text-muted">Lo sentimos, por el momento no hay resultados para "<?php echo $query; ?>"</p>
        <?php if (valid_session()): ?>
          <a href="add.php" class="mt-5 text-white btn btn-primary btn-lg">Agregar nuevo producto</a>
        <?php else: ?>
          <a href="register.php" class="mt-5 text-white btn btn-primary btn-lg">Regístrate gratis</a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      