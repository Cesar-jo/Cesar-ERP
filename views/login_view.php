<?php require_once 'includes/inc_header.php' ?>
<?php require_once 'includes/inc_navbar2.php' ?>

<!-- Content -->
<div class="container" style="padding: 200px 0px;">
  <div class="row">
    <div class="offset-xl-3 col-xl-6">
      <div class="card shadow rounded">
        <div class="card-body">
          <h2 class="text-center mb-5">Ingresa</h2>
          <form id="do_login_user">
            <div class="form-group">
              <label for="user_email">Correo electrónico</label>
              <input type="email" class="form-control" id="user_email" name="user_email">
            </div>
            <div class="form-group">
              <label for="user_password">Contraseña</label>
              <input type="password" class="form-control" id="user_password" name="user_password">
            </div>
            <div class="form-group">
              <button class="btn btn-outline-success">Ingresar ahora</button>
            </div>
            <small class="text-muted float-right">¿No tienes cuenta?, regístrate ahora <a href="register.php">aquí</a></small>
          <!-- <small class="text-muted float-left">Iniciar sesion como <a href="admin.php">Admin</a></small> -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END Content -->

<?php require_once 'includes/inc_footer.php' ?>