document.addEventListener("DOMContentLoaded", function () {
  $("#guardarLibro").on("click", function () {
    let datos = {
      nombre: $("#nombre").val(),
      genero: $("#genero").val(),
      autor: $("#autor").val(),
      capitulos: $("#capitulos").val(),
    };
    if ($("#id-libro").val() === "") {
      crearLibro(datos);
    } else {
      datos.id = $("#id-libro").val();
      editarLibro(datos);
    }
  });

  $("#agregarLibro").on("click", function () {
    $("#id-Libro").val("");
  });
  $(".btn-warning").on("click", function () {
    let id = $(this).data("id");
    $("#id-libro").val(id);
  });

  $(".btnEliminar").on("click", function () {
    let id= $(this).data("id");
    $("#id-libro").val(id);
  });

  $("#btnEliminarLibro").click(function () {
    let id = $("#id-libro").val();
    eliminar(id);
  });
});
//al abrir el modalverifica si hay un id valido si lo hay lo rellena para un actualizar
$("#libro").on("shown.bs.modal", function () {


  if ($("#id-libro").val() !== "") {
    $.ajax({
      type: "GET",
      url: "http://localhost/biblioteca2/back-end/get_id_libro.php",
      dataType: "JSON",
      data: { id: $("#id-libro").val() },
      success: function (respuesta) {
        
        $("#nombre").val(respuesta[0].nombre);
        $("#genero").val(respuesta[0].genero);
        $("#autor").val(respuesta[0].autor);
        $("#capitulos").val(respuesta[0].capitulos);
      },
      error: function (error) {
        // Manejar errores
        console.error("Error en la solicitud AJAX:", error);
        Swal.fire({
          title: "Error",
          text: "error:" + error,
          icon: "error",
        });
      },
    });
  }else{
    $("#nombre").val("");
        $("#genero").val("");
        $("#autor").val("");
        $("#capitulos").val("");
  }
  
});

function crearLibro(datos = {}) {
  let errores = false;

  for (let campo in datos) {
    if (datos[campo].trim() === "") {
      $("#" + campo)
        .removeClass("is-valid")
        .addClass("is-invalid");
      errores = true;
    } else {
      $("#" + campo)
        .removeClass("is-invalid")
        .addClass("is-valid");
    }
  }
  if (errores) {
    Swal.fire({
      title: "Error",
      text: "error: porfavor llene todos los campos",
      icon: "error",
    });
    return;
  }

  $.ajax({
    type: "POST",
    url: "http://localhost/biblioteca2/back-end/create_libro.php",
    data: datos,
    dataType: "json",
    success: function (respuesta) {
      $("#libro").modal("hide");

      $("#nombre").val(""),
        $("#genero").val(""),
        $("#autor").val(""),
        $("#capitulos").val(""),
        console.log(respuesta);
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    },
    error: function (error) {
      // Manejar errores
      console.error("Error en la solicitud AJAX:", error);
      Swal.fire({
        title: "Error",
        text: "error:" + error,
        icon: "error",
      });
    },
  });
}

function editarLibro(datos = {}) {
  let errores = false;

  for (let campo in datos) {
    if (datos[campo].trim() === "") {
      $("#" + campo)
        .removeClass("is-valid")
        .addClass("is-invalid");
      errores = true;
    } else {
      $("#" + campo)
        .removeClass("is-invalid")
        .addClass("is-valid");
    }
  }
  if (errores) {
    Swal.fire({
      title: "Error",
      text: "error: porfavor llene todos los campos",
      icon: "error",
    });
    return;
  }

  $.ajax({
    type: "PUT",
    url: "http://localhost/biblioteca2/back-end/update_libro.php",
    data: datos,
    dataType: "json",
    success: function (respuesta) {
      $("#libro").modal("hide");

        $("#nombre").val(""),
        $("#genero").val(""),
        $("#autor").val(""),
        $("#capitulos").val(""),
        console.log(respuesta);
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    },
    error: function (error) {
      // Manejar errores
      console.error("Error en la solicitud AJAX:", error);
      Swal.fire({
        title: "Error",
        text: "error:" + error,
        icon: "error",
      });
    },
  });
}

function eliminar(id) {
  console.log(id);  
  $.ajax({
    type: "DELETE",
    url: "http://localhost/biblioteca2/back-end/delete_libro.php?id=" + id,
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      $('modalEliminar').modal('hide')
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    },
    error: function (error) {
      // Manejar errores
      console.error("Error en la solicitud AJAX:", error);
      Swal.fire({
        title: "Error",
        text: "error:" + error,
        icon: "error",
      });
    },
  });
}
