<!-- Modal -->
<div class="modal fade" id="single_game_modal" tabindex="-1" role="dialog" aria-labelledby="ModalVideojuego" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content rounded">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $g['Nombre']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-12">
          <img src="<?php echo get_image(UPLOADS.$g['foto']) ?>" alt="<?php echo $g['Nombre']; ?>" class="img-fluid img-thumbnail">
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-12">
          <p class="text-warning"><strong><?php echo $g['genero'] ?></strong></p>
          <p class="mt-3"><?php echo $g['descripcion'] ?></p>
          <p class="mt-3"><strong>Cantidad de productos: </strong>   <strong class="text-primary"><?php echo $g['cantidad'] ?></strong></p>
          <p class="mt-3"><strong>Precio: </strong>  <strong class="text-success">$<?php echo $g['precio'] ?></strong></p>
          <div class="btn-group" role="group">
            <!-- Le decimos que si el id del usuario que registro este producto producto que seleccionamos es igual al id del usuario
          de estqa sesion que pueda editar, borrar el producto y si es diferente el id que no les aparesca los botones de eliminar o editar-->
          <?php if ($g['id_usuario'] == cur_user()['id']): ?> 
            <a class="btn btn-sm btn-success" href="<?php echo 'update.php?id='.$g['id']; ?>" data-toggle="tooltip" title="Editar producto"><i class="fas fa-edit"></i></a>
            <button class="btn btn-sm btn-primary do_share_game" data-toggle="tooltip" title="Compartir producto" data-id="<?php echo $g['id']; ?>"><i class="fas fa-share"></i></button>
          </div>
          <button class="btn btn-sm btn-danger float-right do_delete_game" data-id="<?php echo $g['id']; ?>"><i class="fas fa-trash"></i> Borrar producto</button>
          <?php endif ?> 
          <?php if (cur_user()['rol'] == 0 || cur_user()['rol'] == 2): ?>
          <!--<button class="btn btn-sm btn-danger float-right do_delete_game" data-id="id"><i class="fas fa-trash"></i> Borrar producto</button> -->
          <form id="do_update_game">
            <div class="form-group">
              <a href="index.php?id=<?php echo $g['0']; ?>" id="submit" type="submit" class="btn btn-outline-success rounded shadow"><i class="fas fa-cart-plus"></i> Agregar Producto</a>
            </div>
          </form>
          <?php endif ?> 
        </div>
       </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>