var tabla;

function init() {
  mostrarform(false);
  listar();

  $('#formulario').on('submit', function (e) {
    guardaryeditar(e);
  });

  $('#btnAgregar').on('click', function () {
    mostrarform(true);
  });

  $('#btnCancelar').on('click', function () {
    cancelarform();
  });
}

function limpiar() {
  $('#empleado_id').val('');
  $('#nombre').val('');
  $('#apellido').val('');
  $('#documento_numero').val('');
  $('#telefono').val('');
  $('#codigo').val('');
}

function mostrarform(flag) {
  if (flag) {
    $('#listadoregistros').hide();
    $('#formularioregistros').show();
    $('#btnGuardar').prop('disabled', false);
    $('#btnAgregar').hide();
  } else {
    $('#listadoregistros').show();
    $('#formularioregistros').hide();
    $('#btnAgregar').show();
  }
}

function cancelarform() {
  limpiar();
  mostrarform(false);
}

function listar() {
  tabla = $('#tbllistado').DataTable({
    processing: true, // Activamos el procesamiento del DataTables
    serverSide: true, // Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip', // Definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../controlador/Empleado.php?op=listar',
      type: 'GET',
      dataType: 'json',
      error: function (e) {
        console.log(e.responseText);
      },
    },
    destroy: true,
    pageLength: 10, // Paginación
    order: [[0, 'desc']], // Ordenar (columna, orden)
  });
}

function guardaryeditar(e) {
  e.preventDefault();
  $('#btnGuardar').prop('disabled', true);
  var formData = new FormData($('#formulario')[0]);

  $.ajax({
    url: '../controlador/Empleado.php?op=guardaryeditar',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      bootbox.alert(datos);
      mostrarform(false);
      tabla.ajax.reload();
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error('Error al guardar/editar:', textStatus, errorThrown);
      $('#btnGuardar').prop('disabled', false); // Habilitar el botón en caso de error
    },
  });
}

function mostrar(empleado_id) {
  $.post(
    '../controlador/Empleado.php?op=mostrar',
    { empleado_id: empleado_id },
    function (data, status) {
      if (status === 'success') {
        try {
          data = JSON.parse(data);
          mostrarform(true);

          $('#nombre').val(data.nombre);
          $('#apellido').val(data.apellido);
          $('#documento_numero').val(data.documento_numero);
          $('#telefono').val(data.telefono);
          $('#codigo').val(data.codigo);
          $('#empleado_id').val(data.id);
        } catch (e) {
          console.error('Error al parsear la respuesta JSON:', e);
        }
      } else {
        console.error('Error al obtener datos del empleado:', status);
      }
    }
  );
}

init();
