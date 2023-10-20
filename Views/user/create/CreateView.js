/* --------crear un objecto para alamacenar los datos de los imputs----- */

let newUser = {
  ci_ruc: "",
  name: "",
  address: "",
  phone: "",
  email: "",
};

/* ----evento click para el btnStore */

// Obtén el botón por su id
var btnStore = document.getElementById("btnStore");

// Agrega un manejador de eventos al botón
$(document).ready(function () {
  $("#btnStore").click(function () {
    //storeUser();

    newUser.ci_ruc = document.getElementById("ci_ruc").value;
    newUser.name = document.getElementById("name").value;
    newUser.address = document.getElementById("address").value;
    newUser.phone = document.getElementById("phone").value;
    newUser.email = document.getElementById("email").value;

    /* --------enviamos por ajax el objeto newuser al controlador UserController.php */

    // Convierte el objeto newUser a una cadena JSON
    let newUserJSON = JSON.stringify(newUser);

    $.ajax({
      type: "POST",
      url: "http://localhost/TestCorsinf/api/ApiUser.php?action=store",
      contentType: "application/json", // Establece el tipo de contenido a application/json
      data: newUserJSON, // Envía los datos como una cadena JSON
      success: function (response) {
        console.log(response);
        $("#resultado").html(response);
      },
      error: function (xhr, textStatus, errorThrown) {
        console.log(xhr);
        console.error(textStatus);
      },
    });
  });
});
