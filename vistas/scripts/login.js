$('#frmAcceso').on('submit', function (e) {
  e.preventDefault();

  logina = $('#logina').val();
  clavea = $('#clavea').val();

  if ($('#logina').val() == '' || $('#clavea').val() == '') {
    bootbox.alert('Asegúrate de llenar todos los campos');
  } else {
    $.post(
      '../controlador/Usuario.php?op=verificar',
      { logina: logina, clavea: clavea },
      function (data) {
        if (data && data.idusuario) {
          $(location).attr('href', 'escritorio.php');
        } else {
          bootbox.alert('Usuario y/o contraseña incorrectos');
        }
      },
      'json'
    ).fail(function () {
      bootbox.alert('Error en la solicitud. Intenta de nuevo.');
    });
  }
});
