<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Compartiendo | Códigos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="../public/css/styles.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/css/font-awesome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">
  <!-- Favicon and Apple touch icon -->
  <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
  <link rel="shortcut icon" href="../public/img/favicon.ico">

  <!-- DataTables -->
  <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
  <link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">

  <!-- Bootstrap Select -->
  <link rel="stylesheet" href="../public/css/bootstrap-select.min.css">

  <!-- Sweetalert2 11.11.0 JS -->
  <link rel="stylesheet" href="../public/plugins/sweetalert2/css/sweetalert2.css" >

  <!-- FullCalendar 5.11.5 JS -->
  <link rel="stylesheet" href="../public/plugins/fullcalendar-5.11.5/lib/main.css">
  <script src="../public/plugins/fullcalendar-5.11.5/lib/main.js"></script>
  <script src="../public/plugins/fullcalendar-5.11.5/lib/locales-all.js"></script>

</head>

<body>
  <div class="sideBar">
    <div class="logo-details">
      <i class="bx bxl-c-plus-plus"></i>
      <span class="logo_name">ASISTCO</span>
    </div>
    <i class="bx bx-chevron-right toggle"></i>
    <ul class="nav-links">
      <li>
        <a href="Escritorio.php">
          <i class="bx bx-home-alt"></i>
          <span class="link_name">Escritorio</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="Empleado.php">Escritorio</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link">
          <a href="#">
            <i class="bx bx-collection"></i>
            <span class="link_name">Asistencia</span>
          </a>
          <i class="bx bxs-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Asistencia:</a></li>
          <li><a href="Asistencia.php">Asistencia</a></li>
          <li><a href="rpasistencia.php">Reporte Asistencia</a></li>
        </ul>
      </li>
    <li>
        <div class="icon-link">
            <a href="#">
                <i class="bx bx-calendar-plus"></i>
                <span class="link_name">Guardia</span>
            </a>
            <i class="bx bxs-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
            <li><a class="link_name" href="#">Guardia:</a></li>
            <li><a href="Guardia.php">Guardias</a></li>
            <li><a href="Compensatorio.php">Compensatorios</a></li>
        </ul>
    </li>
      <li>
        <div class="icon-link">
          <a href="#">
            <i class="bx bx-user"></i>
            <span class="link_name">Empleados</span>
          </a>
          <i class="bx bxs-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Empleados:</a></li>
          <li><a href="Empleado.php">Empleados</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link">
          <a href="#">
            <i class="bx bx-list-plus"></i>
            <span class="link_name">Usuarios</span>
          </a>
          <i class="bx bxs-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Usuarios:</a></li>
          <li><a href="Usuario.php">Usuarios</a></li>
        </ul>
      </li>
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="../public/images/supervisor.png" alt="Supervisor">
          </div>
          <div class="name-job">
            <div class="profile-name">Nombre</div>
            <div class="job">Cargo</div>
          </div>
          <i class="bx bx-log-out"></i>
        </div>
      </li>
    </ul>
  </div>

  <section class="home-section">
    <div class="home-content">
      <div>
        <img src="../public/images/encabezado.jpg" alt="Encabezado" style="width: 100%;height: 75px; left: 260px;transition: all 0.5s ease;">
      </div>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      let arrows = document.querySelectorAll(".arrow");

      arrows.forEach(function(arrow) {
        arrow.addEventListener("click", function() {
          let arrowParent = arrow.parentElement.parentElement;
          arrowParent.classList.toggle("showMenu");
        });
      });

      let sideBar = document.querySelector(".sideBar");
      let sideBarBtn = document.querySelector(".toggle");

      if (sideBarBtn) {
        sideBarBtn.addEventListener("click", function() {
          sideBar.classList.toggle("Close");
          sideBar.classList.toggle("toggle-active"); // Alterna la clase para la rotación
        });
      }
    });
  </script>
</body>

</html>