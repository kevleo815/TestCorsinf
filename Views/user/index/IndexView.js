$(document).ready(function () {
  // Llama a la función para obtener los datos de los usuarios cuando la página esté lista
  getUsers();
});

function getUsers() {
  $.ajax({
    type: "GET",
    url: "http://localhost/TestCorsinf/api/ApiUser.php?action=index",
    contentType: "application/json",
    dataType: "json",
    success: function (response) {
      console.log(response);
      // Limpia el contenido actual de la tabla
      $("#usersTable tbody").empty();

      // Itera sobre los datos de los usuarios y crea filas en la tabla
      $.each(response, function (index, user) {
        var row = "<tr>";
        row += "<td>" + user.name + "</td>";
        row += "<td>" + user.ci_ruc + "</td>";
        row += "<td>" + user.address + "</td>";
        row += "<td>" + user.phone + "</td>";
        row += "<td>" + user.email + "</td>";
        /* -----agregar botones de editar y eliminar------ */

        row +=
          "<td><button class='btn btn-warning' onclick='editUser(" +
          user.id +
          ")'>Editar</button></td>";

        row +=
          "<td><button class='btn btn-danger' onclick='deleteUser(" +
          user.id +
          ")'>Eliminar</button></td>";

        row += "</tr>";

        // Agrega la fila a la tabla
        $("#usersTable tbody").append(row);
      });
    },
    error: function (xhr, textStatus, errorThrown) {
      console.log(xhr);
      console.error(textStatus);
    },
  });
}

/* ------metodo para  edituser y cambiar la pagina con lso datos consultados */

function editUser(id) {
  window.location.href =
    "http://localhost/TestCorsinf/Views/user/edit/EditView.php?id=" + id;
}

/* ------funcion para la solicitud de deleteUSer */

function deleteUser(id) {
  $.ajax({
    type: "POST",
    url: "http://localhost/TestCorsinf/api/ApiUser.php?action=delete",
    contentType: "application/json",
    data: JSON.stringify({ id: id }), // Convierte el objeto en una cadena JSON
    success: function (response) {
      console.log(response);
      getUsers(); // Actualiza la lista de usuarios después de eliminar uno
    },
    error: function (xhr, textStatus, errorThrown) {
      console.log(xhr);
      console.error(textStatus);
    },
  });
}

/* -----metodos en el cual se da click al boton de pdf y se va a la ruta de pdf ---- */

// Agrega un manejador de eventos al botón
var btnPDF = document.getElementById("btnPDF");
$(document).ready(function () {
  $("#btnPDF").click(function () {
    $.ajax({
      type: "GET",
      url: "http://localhost/TestCorsinf/api/ApiUser.php?action=pdf",
      xhrFields: {
        responseType: "blob", // Indica que la respuesta es un objeto blob
      },
      success: function (data) {
        const blob = new Blob([data], { type: "application/pdf" });
        const url = window.URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.href = url;
        a.download = "mi_pdf.pdf"; // Nombre del archivo a descargar
        document.body.appendChild(a);
        a.click(); // Simula el clic en el enlace
        window.URL.revokeObjectURL(url); // Limpia el objeto URL
      },
      error: function (xhr, textStatus, errorThrown) {
        console.log(xhr);
        console.error(textStatus);
      },
    });
  });
});
