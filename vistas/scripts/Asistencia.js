var tabla;

function init() {
  listar();
}

function listar() {
  tabla = $('#tbllistado').DataTable({
    // Corregido: "datatable" a "DataTable" con "D" mayúscula
    processing: true, // Corregido: "aProcessing" a "processing"
    serverSide: true, // Corregido: "aServerSide" a "serverSide"
    dom: 'Bfrtip',
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../controlador/Asistencia.php?op=listar',
      type: 'GET', // Corregido: "get" a "GET" (aunque en algunos entornos, "get" también funciona)
      dataType: 'json',
      error: function (e) {
        console.log(e.responseText);
      },
    },
    destroy: true, // Corregido: "bDestroy" a "destroy"
    pageLength: 10, // Corregido: "iDisplayLength" a "pageLength"
    order: [[0, 'desc']],
  });
}

init(); // Llamada a la función init
