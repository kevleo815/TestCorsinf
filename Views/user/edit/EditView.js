let formUser = {
  id: "",
  ci_ruc: "",
  name: "",
  address: "",
  phone: "",
  email: "",
};

/* -----Recuperar el id de la url------ */

/* -----cuando se carga la pagina poner un alaert con el id----- */

$(document).ready(function () {
  var id = getParameterByName("id");
  getUser(id);
});

/* -----funcion para obtener el id de la url----- */

function getParameterByName(name, url = window.location.href) {
  name = name.replace(/[\[\]]/g, "\\$&");

  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);

  if (!results) return null;

  if (!results[2]) return "";

  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

/* -----funcion para obtener los datos del usuario----- */

function getUser(id) {
  $.ajax({
    type: "GET",
    url: "http://localhost/TestCorsinf/api/ApiUser.php?action=show&id=" + id,
    contentType: "application/json",
    dataType: "json",
    success: function (response) {
      console.log(response);
      formUser.id = response.id;
      $("#ci_ruc").val(response.ci_ruc);
      $("#name").val(response.name);
      $("#address").val(response.address);
      $("#phone").val(response.phone);
      $("#email").val(response.email);
    },
    error: function (xhr, textStatus, errorThrown) {
      console.log(xhr);
      console.error(textStatus);
    },
  });
}

/* -----evento click para el btnUpdate----- */

// Obtén el botón por su id

var btnUpdate = document.getElementById("btnUpdate");

// Agrega un manejador de eventos al botón

$(document).ready(function () {
  $("#btnUpdate").click(function () {
    updateUser();
  });
});

/* -----funcion para actualizar los datos del usuario----- */

function updateUser() {
  formUser.ci_ruc = document.getElementById("ci_ruc").value;
  formUser.name = document.getElementById("name").value;
  formUser.address = document.getElementById("address").value;
  formUser.phone = document.getElementById("phone").value;
  formUser.email = document.getElementById("email").value;

  // Convierte el objeto newUser a una cadena JSON

  let newUserJSON = JSON.stringify(formUser);

  $.ajax({
    type: "POST",
    url:
      "http://localhost/TestCorsinf/api/ApiUser.php?action=update&id=" +
      formUser.id,
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
}
