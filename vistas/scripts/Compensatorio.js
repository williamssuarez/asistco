var tabla;
var tabla2;
var calendar;

$(document).ready(function() {

    // Iniciar FullCalendar
    var calendarEl = document.getElementById('calendar');

    if (calendarEl) {
        calendar = new FullCalendar.Calendar(calendarEl, {
            customButtons: {
                addEventBtn: {
                    text: 'Programar Compensatorio',
                    icon: 'bx bx-calendar-plus',
                    click: function () {
                        $.ajax({
                            url: '../controlador/Compensatorio.php?op=getcompensatorioform',
                            type: 'GET',
                            beforeSend: function() {
                                Swal.fire({
                                    heightAuto: false, //Evita que la pagina suba cuando se cierra la alerta
                                    title: 'Cargando...',
                                    text: 'Cargando formulario.',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading(); // Mostrar gif de cargando
                                    }
                                });
                            },
                            success: function (response) {
                                Swal.fire({
                                    heightAuto: false, //Evita que la pagina suba cuando se cierra la alerta
                                    title: 'Programa un compensatorio',
                                    html: response,
                                    showCancelButton: true,
                                    confirmButtonText: 'Enviar',
                                    confirmButtonColor: '#3C8DBC',
                                    cancelButtonText: 'Cancelar',
                                    cancelButtonColor: '#DC3545',
                                    didOpen: () => { //Hay que reinicializar las dependencias del formulario dentro del sweetalert
                                        $.post('../controlador/Usuario.php?op=select_usuario', function(r) {
                                            $('#user_id').html(r);
                                            $('#user_id').selectpicker('refresh');
                                        });
                                    },
                                }).then((result) => {
                                    if (result.isConfirmed){

                                        let formData = new FormData($('#formulario')[0]);

                                        $.ajax({
                                            url: '../controlador/Compensatorio.php?op=guardaryeditar',
                                            type: 'POST',
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            beforeSend: function() {
                                                Swal.fire({
                                                    heightAuto: false, //Evita que la pagina suba cuando se cierra la alerta
                                                    title: 'Enviando...',
                                                    text: 'Enviando formulario.',
                                                    allowOutsideClick: false,
                                                    didOpen: () => {
                                                        Swal.showLoading(); // Mostrar gif de cargando
                                                    }
                                                });
                                            },
                                            success: function (respuesta) {
                                                //Manejar exito
                                                calendar.refetchEvents(); //Refrescar calendario
                                                listar(); //Refrescar datatable1
                                                listar2(); //Refrescar datatable1

                                                Swal.fire({
                                                    heightAuto: false, //Evita que la pagina suba cuando se cierra la alerta
                                                    title: 'Programado Correctamente',
                                                    text: 'Tu compensatorio ha sido programada correctamente',
                                                    icon: 'success',
                                                    showConfirmButton: true,
                                                    confirmButtonText: 'Aceptar',
                                                    confirmButtonColor: '#3C8DBC',
                                                });
                                            },
                                            error: function (error2) {
                                                //Manejar errores
                                                let errorResponse = JSON.parse(error2.responseText);

                                                console.log(errorResponse.errors.join("\n"));

                                                Swal.fire({
                                                    heightAuto: false, //Evita que la pagina suba cuando se cierra la alerta
                                                    title: 'Error en el formulario',
                                                    text: errorResponse.errors.join(", "),
                                                    icon: 'error',
                                                    showConfirmButton: true,
                                                    confirmButtonText: 'Aceptar',
                                                    confirmButtonColor: '#3C8DBC',
                                                });
                                            }
                                        });

                                    }
                                });
                            }
                        })
                    },
                },
            },
            initialView: 'dayGridMonth', //Vista inicial: Por meses
            themeSystem: 'bootstrap',
            height: 650,
            locale: 'es', // Español
            bootstrapFontAwesome: {
                close: 'fa-times',
                prev: 'fa-arrow-left',      // ICONOS DE FONT AWESOME
                next: 'fa-arrow-right',
                prevYear: 'fa-backward',
                nextYear: 'fa-forward',
                addEventBtn: 'fa-calendar'
            },
            headerToolbar: {
                left: 'prev,next prevYear,nextYear today addEventBtn',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            dayMaxEventRows: true, // limitar el maximo de compensatorios que se muestran en una sola columna antes de comprimir la vista
            views: {
                dayGridMonth: {
                    dayMaxEventRows: 4
                }
            },
            buttonText: { 
                year: "Año",
                /*today: "Hoy",
                month: "Mes",
                week: "Semana", //Formatear el texto de los botones en caso de que sea necesario
                day: "Dia",
                list: "Lista"*/
            },
            buttonHints: {
                prev:"Anterior $0",
                next:"Siguiente $0",
                listWeek: "Vista de la agenda"
            },
            events: '../controlador/Compensatorio.php?op=compensatoriosCalendario', //API o Endpoint de donde obtiene las guardias
        });

        calendar.render(); //Renderizar calendario
    }
});

function init() {
    listar();
    listar2();

    function init() {
        listar();
        listar2();
    }
}

function listar() {
    tabla = $('#tbllistado').DataTable({
        // Corregido: "datatable" a "DataTable" con "D" mayúscula
        processing: true, // Corregido: "aProcessing" a "processing"
        serverSide: true, // Corregido: "aServerSide" a "serverSide"
        dom: 'Bfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        ajax: {
            url: '../controlador/Compensatorio.php?op=listar',
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

function listar2() {
    tabla2 = $('#tbllistado2').DataTable({
        // Corregido: "datatable" a "DataTable" con "D" mayúscula
        processing: true, // Corregido: "aProcessing" a "processing"
        serverSide: true, // Corregido: "aServerSide" a "serverSide"
        dom: 'Bfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        ajax: {
            url: '../controlador/Compensatorio.php?op=listarCompensatorioUsuarios',
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

function cancelar(idcompensatorio) {
    bootbox.confirm('¿Está seguro de cancelar este compensatorio?', function (result) {
        if (result) {
            $.post(
                '../controlador/Compensatorio.php?op=cancelar',
                { idcompensatorio: idcompensatorio },
                function (e) {
                    bootbox.alert(e);
                    calendar.refetchEvents(); //Refrescar el calendario
                    listar();//Refrescar la tabla
                    listar2();
                }
            );
        }
    });
}

function terminar(idcompensatorio) {
    bootbox.confirm('¿Está seguro de marcar como cumplido este compensatorio?', function (result) {
        if (result) {
            $.post(
                '../controlador/Compensatorio.php?op=terminar',
                { idcompensatorio: idcompensatorio },
                function (e) {
                    bootbox.alert(e);
                    calendar.refetchEvents(); //Refrescar el calendario
                    listar();//tabla.ajax.reload(); //Refrescar la tabla
                    listar2();
                }
            );
        }
    });
}

init(); // Llamada a la función init