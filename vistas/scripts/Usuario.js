var tabla;

function init() {
  mostrarform(false);
  listar();
  $('#formulario').on('submit', function (e) {
    guardaryeditar(e);
  });
}

function limpiar() {
  $('#Nombre').val('');
  $('#Apellido').val('');
  $('#Email').val('');
  $('#Login').val('');
  $('#Clave').val('');
  $('#imagenmuestra').attr('src', '');
  $('#imagenactual').val('');
  $('#idusuario').val('');
}

function mostrarform(flag) {
  limpiar();
  if (flag) {
    $('#listadoregistros').hide();
    $('#formularioregistro').show();
    $('#btnGuardar').prop('disabled', false);
    $('#btnAgregar').hide();
  } else {
    $('#listadoregistros').show();
    $('#formularioregistro').hide();
    $('#btnAgregar').show();
  }
}

function cancelarform() {
  limpiar();
  mostrarform(false);
}

function listar() {
  tabla = $('#tbllistado').DataTable({
    aProcessing: true,
    aServerSide: true,
    // dom: 'Bfrtip',
    // buttons: [
    //   'copyHtml5',
    //   'excelHtml5',
    //   'csvHtml5',
    //   {
    //     extend: 'pdfHtml5',
    //     text: 'Generar PDF',
          
    //   }
    // ],
    ajax: {
      url: '../controlador/Usuario.php?op=listar',
      type: 'GET',
      dataType: 'json',
      error: function (e) {
        console.log(e.responseText);
      },
    },
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, 'desc']],
  });
}


function guardaryeditar(e) {
  e.preventDefault();
  $('#btnGuardar').prop('disabled', true);
  var formData = new FormData($('#formulario')[0]);

  $.ajax({
    url: '../controlador/Usuario.php?op=guardaryeditar',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      bootbox.alert(datos);
      mostrarform(false);
      tabla.ajax.reload();
    },
  });
  limpiar();
}

function mostrar(idusuario) {
  $.post(
    '../controlador/Usuario.php?op=mostrar',
    { idusuario: idusuario },
    function (data, status) {
      data = JSON.parse(data);
      mostrarform(true);
      $('#nombre').val(data.nombre || '');
      $('#apellido').val(data.apellido || '');
      $('#email').val(data.email || '');
      $('#login').val(data.login || '');
      $('#imagenmuestra').show();
      $('#imagenmuestra').attr(
        'src',
        '../files/usuarios/' + (data.imagen || 'default.png')
      );
      $('#imagenactual').val(data.imagen || '');
      $('#idusuario').val(data.id || '');
    }
  );
}

function desactivar(idusuario) {
  bootbox.confirm('¿Está seguro de desactivar este dato?', function (result) {
    if (result) {
      $.post(
        '../controlador/Usuario.php?op=desactivar',
        { idusuario: idusuario },
        function (e) {
          bootbox.alert(e);
          tabla.ajax.reload();
        }
      );
    }
  });
}

function activar(idusuario) {
  bootbox.confirm('¿Está seguro de activar este dato?', function (result) {
    if (result) {
      $.post(
        '../controlador/Usuario.php?op=activar',
        { idusuario: idusuario },
        function (e) {
          bootbox.alert(e);
          tabla.ajax.reload();
        }
      );
    }
  });
}



// Llamamos a la función init para inicializar el script
init();
