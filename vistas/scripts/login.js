$('#frmAcceso').on('submit', function (e) {
  e.preventDefault();

  logina = $('#logina').val();
  clavea = $('#clavea').val();

  if ($('#logina').val() == '' || $('#clavea').val() == '') {
    bootbox.alert('Asegúrate de llenar todos los campos');
  } else {
    $.post(
      '../controlador/Usuario.php?op=verificar',
      { "logina": logina, "clavea": clavea },
      function (data) {
        console.log(data);
        if (data != "null") {
          $(location).attr('href', 'Escritorio.php');
        } else {
          bootbox.alert('Usuario y/o contraseña incorrectos');
        }
    });
  }
});
