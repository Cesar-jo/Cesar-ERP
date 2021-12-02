<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URL; ?>"><?php echo COMPANY_NAME; ?></a>
    <button class="navbar-toggler rounded" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
    
      </ul>
      <ul class="navbar-nav">
      <!--le decimos si esta validada una sesion pues que aparesca un apartado de cerrar sesion, -->
      <!--si no pues que no aparesca en el nav cerrar sesion y va a parecer ingresar -->
        <?php if (valid_session()): ?>
          <li class="nav-item">
          <!-- si esta validada la sesion, nos va a traer nuestro nombre de la base de datos -->
            <a class="nav-link" href="#"><?php echo cur_user()['nombre'] ?></a>
          </li>
          <!-- Como habia dicho si esta validada una sesion va a parecer en el navbar cerrar sesion-->
          <li class="nav-item <?php echo (isset($data['active']) && $data['active'] == 'logout' ? 'active' : '') ?>">
            <a class="nav-link" href="logout.php">Cerrar sesión</a>
          </li>
        <?php else: ?>
          <li class="nav-item <?php echo (isset($data['active']) && $data['active'] == 'register' ? 'active' : '') ?>">
            <a class="nav-link" href="register.php">Registrarse</a>
          </li>
          <li class="nav-item <?php echo (isset($data['active']) && $data['active'] == 'login' ? 'active' : '') ?>">
            <a class="nav-link" href="login.php">Ingresar</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<!-- END Navbar -->