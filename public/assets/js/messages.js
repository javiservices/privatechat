// Enviamos el mensaje
$('#message-form').submit(function (event) {
    event.preventDefault();
    var $form = $("#message-form");
    var data = getFormData($form);
    $.ajax('/chat/post.php', {
        type: 'POST', // http method
        data: data, // data to submit
        success: function (data, status, xhr) {
            data = JSON.parse(data);
            if (data.status === 'OK') {
                $('#message-form').find("input[type=text]").val("");
            } else {
                $.alert({
                    title: '¡Error!',
                    content: 'No se ha tramitado el mensaje correctamente, intentelo de nuevo.',
                });
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            $.alert({
                title: '¡Error!',
                content: 'No se ha podido enviar el mensaje.',
            });
        }
    });
});
// Obtenemos los datos del formulario en modo json para los datos
function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
// Generamos un intervalo de obtención de mensajes
setInterval(getMeesagesFromJSON, 1500);
// getMeesagesFromJSON()
function getMeesagesFromJSON() {
    $.getJSON("chat/messages.json", function (data) {
        var items = [];
        $.each(data, function (key, message) {
            var messages = '';
            if (message.user === username) {
                messages += "<div class='text-muted ms-1'>"+ message.user +"</div>";
                messages += `<div class="row border rounded m-1 message-box user">`
            } else {
                messages += "<div class='text-end text-muted me-1'>"+ message.user +"</div>";
                messages += `<div class="row text-end border rounded m-1 message-box ms-auto">`
            }
            // messages += '<h3>'+ message.user +'</h3>'
            messages += '<p class="my-auto mt-1 mb-1">'+ message.msg +'</p>'
            // if (message.user === username) {
            //     messages += '<span class="text-end">'+ message.time +'</span>'
            // } else {
            //     messages += '<span class="text-start">'+ message.time +'</span>'
            // }
            messages += '</div>'     
            items.push(messages);
        });
        $("#chatbox .container").html(items.join(""));
    });
}

// Mandamos ajax de borra conversación
$("#clear-chatbox").click(function() {
    $.confirm({
        title: 'Borrar mensajes',
        content: '¿Esta seguro de esta acción?',
        buttons: {
            Aceptar: function () {
                $.ajax('/chat/delete.php', {
                    type: 'GET', // http method
                    success: function (data, status, xhr) {
                        data = JSON.parse(data);
                        if (data.status === 'OK') {
                            $.alert('Confirmed!');
                            location.reload(true);
                        }
                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        $.alert('Ha habido un error y no se ha podido borrar, intentelo de nuevo');
                    }
                });
            },
            Cancelar: function () {
                $.alert('Operación cancelada.');
            }
        }
    });
})


// Go to bottom of chatbox div
setInterval(goToBottom, 5000);
function goToBottom() {
    $("#chatbox").animate({ scrollTop: $('#chatbox').prop("scrollHeight")}, 1000);
}