$(document).ready(function() {

    // Iniciar FullCalendar
    var calendarEl = document.getElementById('calendar');

    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            customButtons: {
                addEventBtn: {
                    text: 'Programar Guardia',
                    icon: 'bx bx-calendar-plus',
                    click: function () {
                        $.ajax({
                            //url: '/class/api/getForm',
                            url: '../controlador/Guardia.php?op=getguardiaform',
                            type: 'GET',
                            beforeSend: function() {
                                Swal.fire({
                                    heightAuto: false, //Evita que la pagina suba cuando se cierra la alerta
                                    title: 'Cargando...',
                                    text: 'Cargando formulario.',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading(); // Show the loading spinner
                                    }
                                });
                            },
                            success: function (response) {
                                Swal.fire({
                                    heightAuto: false, //Evita que la pagina suba cuando se cierra la alerta
                                    title: 'Programa una Guardia',
                                    html: response,
                                    showCancelButton: true,
                                    confirmButtonText: 'Enviar',
                                    confirmButtonColor: '#3C8DBC',
                                    cancelButtonText: 'Cancelar',
                                    cancelButtonColor: '#DC3545',
                                    didOpen: () => { //Hay que reinicializar el formulario dentro del sweetalert
                                        $.post('../controlador/Usuario.php?op=select_usuario', function(r) {
                                            $('#user_id').html(r);
                                            $('#user_id').selectpicker('refresh');
                                        });
                                    },
                                }).then((result) => {
                                    if (result.isConfirmed){
                                        //let formData = $('#formulario').serialize();

                                        let formData = new FormData($('#formulario')[0]);

                                        $.ajax({
                                            url: '../controlador/Guardia.php?op=guardaryeditar',
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
                                                        Swal.showLoading(); // Show the loading spinner
                                                    }
                                                });
                                            },
                                            success: function (respuesta) {
                                                calendar.refetchEvents();
                                                refreshTable();
                                                Swal.fire({
                                                    heightAuto: false, //Evita que la pagina suba cuando se cierra la alerta
                                                    title: 'Programado Correctamente',
                                                    text: 'Tu guardia ha sido programada correctamente',
                                                    icon: 'success',
                                                    showConfirmButton: true,
                                                    confirmButtonText: 'Aceptar',
                                                    confirmButtonColor: '#3C8DBC',
                                                    timer: 2000
                                                });
                                            },
                                            error: function (error2) {
                                                // Handle error
                                                Swal.fire({
                                                    heightAuto: false, //Evita que la pagina suba cuando se cierra la alerta
                                                    title: 'Error',
                                                    text: error2.formErrors,
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
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap',
            height: 650,
            locale: 'es',
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
            dayMaxEventRows: true, // for all non-TimeGrid views
            views: {
                dayGridMonth: {
                    dayMaxEventRows: 4
                }
            },
            buttonText: {
                year: "Año",
                /*today: "Hoy",
                month: "Mes",
                week: "Semana",
                day: "Dia",
                list: "Lista"*/
            },
            buttonHints: {
                prev:"Anterior $0",
                next:"Siguiente $0",
                listWeek: "Vista de la agenda"
            },
            //events: '/class/api/classess', // You can fetch events from an API or define them here
            events: '../controlador/Guardia.php?op=guardiasCalendario',
        });

        calendar.render();
    }
});