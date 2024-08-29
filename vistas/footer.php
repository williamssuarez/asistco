    <footer class="home-section">
      <div class="pull-right hidden-xs">

      </div>
    </footer>

    <!-- jQuery 3 -->
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../public/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../public/js/app.min.js"></script>

    <!-- DATATABLES -->
    <script src="../public/datatables/jquery.dataTables.min.js"></script>
    <script src="../public/datatables/dataTables.buttons.min.js"></script>
    <script src="../public/datatables/buttons.html5.min.js"></script>
    <script src="../public/datatables/buttons.colVis.min.js"></script>
    <script src="../public/datatables/jszip.min.js"></script>
    <script src="../public/datatables/pdfmake.min.js"></script>
    <script src="../public/datatables/vfs_fonts.js"></script>


    <!-- Bootbox -->
    <script src="../public/js/bootbox.min.js"></script>

    <!-- Select -->
    <script src="../public/js/bootstrap-select.min.js"></script>

    <!-- SweetAlert2 11.11.0 JS -->
    <script src="../public/plugins/sweetalert2/js/sweetalert2.js"></script>

  <!-- script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const arrows = document.querySelectorAll(".arrow");

      arrows.forEach(function(arrow) {
        arrow.addEventListener("click", function() {
          // Cierra todos los menús abiertos antes de abrir el nuevo
          const allMenus = document.querySelectorAll(".nav-links li.showMenu");
          allMenus.forEach(function(menu) {
            if (menu !== arrow.parentElement.parentElement) {
              menu.classList.remove("showMenu");
            }
          });

          const arrowParent = arrow.parentElement.parentElement; // Selecciona el elemento padre de la flecha (li)
          arrowParent.classList.toggle("showMenu"); // Alterna la clase para mostrar el menú desplegable
        });
      });

      const sideBar = document.querySelector(".sideBar");
      const sideBarBtn = document.querySelector(".toggle");

      if (sideBarBtn) {
        sideBarBtn.addEventListener("click", function() {
          sideBar.classList.toggle("Close");
          sideBar.classList.toggle("toggle-active"); // Alterna la clase para la rotación
        });
      }
    });

    // Manejo del logout con Bootbox y jQuery
    $(document).ready(function() {
      $('#logout-link').on('click', function(e) {
        e.preventDefault(); // Evita la acción predeterminada del enlace

        bootbox.confirm({
          size: "big",
          message: "¿Estás seguro de que deseas salir?",
          callback: function(result) {
            if (result) {
              // Muestra el diálogo de carga
              bootbox.dialog({
                message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Cargando...</div>',
                backdrop: true,
                closeButton: false // Desactiva el botón de cerrar para que el diálogo se mantenga abierto
              });

              // Espera un breve momento para que el usuario vea el mensaje de carga
              setTimeout(function() {
                // Redirige al enlace
                window.location.href = $('#logout-link').attr('href');
              }, 4000); // Ajusta el tiempo si es necesario
            }
            // Si el usuario hace clic en "Cancel", no se hace nada
          }
        });
      });
    });
  </script>

    </body>

    </html>