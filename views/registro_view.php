<?php require_once 'includes/inc_header.php' ?>
<?php require_once 'includes/inc_navbar2.php' ?>

<!-- Content -->
<div class="container" style="padding: 200px 0px;">
  <div class="row">
    <div class="offset-xl-3 col-xl-6">
      <div class="card shadow rounded">
        <div class="card-body">
          <h2 class="text-center mb-5">Regístrate</h2>
          <!--- creamos un formulario para el registroo----->
          <form id="do_register_user">
            <div class="form-group">
              <label for="user_name">Nombre de usuario</label>
              <input type="text" class="form-control" id="user_name" name="user_name" required>
            </div>
            <div class="form-group">
              <label for="user_email">Correo electrónico</label>
              <input type="email" class="form-control" id="user_email" name="user_email" required>
            </div>
            <div class="form-group">
              <label for="user_password">Contraseña</label>
              <input type="password" class="form-control" id="user_password" name="user_password" required>
            </div>
            <div class="form-group">
              <label for="user_password_conf">Confirma tu contraseña</label>
              <input type="password" class="form-control" id="user_password_conf" name="user_password_conf" required>
            </div>
            <div class="form-group">
              <button class="btn btn-outline-success">Registrarse ahora</button>
            </div>
            <small class="text-muted float-right">¿Ya tienes cuenta?, ingresa <a href="login.php">aquí</a></small>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END Content -->

<?php require_once 'includes/inc_footer.php' ?>