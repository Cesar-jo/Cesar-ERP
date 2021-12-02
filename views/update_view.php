<?php require_once 'includes/inc_header.php' ?>
<?php require_once 'includes/inc_navbar.php' ?>

<!-- Content -->
<div class="container" style="padding: 150px 0px;">
  <div class="row">
    <div class="offset-xl-3 col-xl-6">
      <div class="card shadow rounded">
        <div class="card-body">
          <h2 class="text-center mb-5"><?php echo $data['title']; ?></h2>
          <form id="do_update_game">
            <input type="hidden" name="id" value="<?php echo $data['g']['id']; ?>">
            <input type="hidden" name="portada_anterior" value="<?php echo $data['g']['foto']; ?>">
            <div class="form-group">
              <img src="<?php echo get_image(UPLOADS.$data['g']['foto']); ?>" alt="<?php echo $data['g']['Nombre'] ?>" class="img-fluid img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;" data-toggle="tooltip" title="<?php echo 'Portada actual: '.$data['g']['Nombre']; ?>">
            </div>
            <div class="form-group">
              <label for="portada">Imagen del producto</label>
              <input type="file" class="form-control-file" id="portada" name="foto" accept="image/*">
            </div>
            <div class="form-group">
              <label for="titulo">Nombre</label>
              <input type="text" class="form-control" id="titulo" name="Nombre" value="<?php echo $data['g']['Nombre'] ?>">
            </div>
            <div class="form-group">
              <label for="id_genero">Tipo</label>
              <select type="email" class="form-control" id="id_genero" name="id_genero">
                <option value="">Seleciona una opción...</option>
                <?php foreach (get_genders() as $p): ?>
                  <?php if ($p['id'] == $data['g']['id_genero']): ?>
                    <option value="<?php echo $p['id'] ?>" selected><?php echo $p['genero'] ?></option>
                  <?php else: ?>
                    <option value="<?php echo $p['id'] ?>"><?php echo $p['genero'] ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="cantidad">Cantidad de stoks</label>
              <input type="text" class="form-control" id="cantidad" name="cantidad" value="<?php echo $data['g']['cantidad'] ?>">
            </div>
            <div class="form-group">
              <label for="opinion">Descripción/Opinión</label>
              <textarea name="descripcion" id="opinion" cols="30" rows="10" class="form-control"><?php echo $data['g']['descripcion'] ?></textarea>
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
