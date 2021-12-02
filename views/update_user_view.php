<?php require_once 'includes/inc_header.php' ?>
<?php require_once 'includes/inc_navbar.php' ?>

<!-- Content -->
<div class="container" style="padding: 150px 0px;">
  <div class="row">
    <div class="offset-xl-3 col-xl-6">
      <div class="card shadow rounded">
        <div class="card-body">
          <h2 class="text-center mb-5"><?php echo $data['title']; ?></h2>
          <form id="do_update_user">
            <input type="hidden" name="id" value="<?php echo $data['u']['id']; ?>">
            <div class="form-group">
              <label for="titulo">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['u']['nombre'] ?>">
            </div>
            <div class="form-group">
              <label for="id_genero">Tipo</label>
              <select type="text" class="form-control" id="rol" name="rol">
                <option value="">Seleciona una opción...</option>
                    <option value="2">Empleado</option>
                    <option value="1">Administrador</option>
                    <option value="0">Cliente</option>
              </select>
            </div>
      
            <div class="form-group">
              <label for="titulo">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['u']['email'] ?>">
            </div> 

            <div class="form-group">
              <button id="submit" type="submit" class="btn btn-success">Guardar cambios</button>
              <button type="reset" class="btn btn-default">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END Content -->

<?php require_once 'includes/inc_footer.php' ?>
