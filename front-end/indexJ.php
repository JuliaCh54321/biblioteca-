<?php


$ch = curl_init();

$url = "http://localhost/ApiRestJulia/get_all_libro.php";


curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);


if ($response === false) {

  echo "Error en la solicitud cURL: " . curl_error($ch);
} else {

  $response = json_decode($response, true);

}

curl_close($ch);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>LIBRO</title>
</head>

<body>
  <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">LIBRO</a>
    </div>
  </nav>

  <div class="container">
    <div class=" mt-5">
      <button type="button" class="btn btn-outline-black" data-bs-toggle="modal" data-bs-target="#libro"
        id="agregarLibro">
        <i class="fas fa-plus me-1"></i> Agregar Libro
      </button>
    </div>
    
    <div class="contenedor">
      <h1 class="mb-4">LIBRO</h1>
      <div class="table-responsive">
        <table id="tabla-conteiner" class="table table-bordered table-hover">
          <thead >
            <tr class="table-info">
              <th class="sorting">#</th>
              <th class="sorting" style="width: 150px;">NOMBRE</th>
              <th class="sorting" style="width: 200px;">GENERO</th>
              <th class="sorting" style="width: 150px;">AUTOR</th>
              <th class="sorting" style="width: 150px;">CAPITULOS</th>
              <th class="sorting">ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($response as $key => $libro) {
              echo '<tr>
                                <td>' . $libro['id'] . '</td>
                                <td>' . $libro['nombre'] . '</td>
                                <td>' . $libro['genero'] . '</td>
                                <td>' . $libro['autor'] . '</td>
                                <td>' . $libro['capitulos'] . '</td>
                                <td>
                                    <button type="button" class="btn btn-warning btnEditar" data-id="' . $libro['id'] . '" data-bs-toggle="modal" data-bs-target="#libro">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btnEliminar" data-id="' . $libro['id'] . '" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <input type="text" id="id-libro" hidden>

  <div class="modal fade" id="libro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title mx-auto font-weight-bold h2">Registrar Libro</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="nuevo_form">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="form-group mb-2">
                <label for="nombre">
                  <i class="fas fa-film"></i> Nombre del libro
                </label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                  placeholder="Nombre del libro">
              </div>
              <div class="form-group mb-2">
                <label for="genero">
                  <i class="fas fa-calendar-alt"></i> Genero
                </label>
                <input type="text" name="genero" id="genero" class="form-control" placeholder="Genero">
              </div>
              <div class="form-group mb-2">
                <label for="autor">
                  <i class="fas fa-user"></i> Autor
                </label>
                <input type="text" name="autor" id="autor" class="form-control" placeholder="Autor">
              </div>
              <div class="form-group mb-2">
                <label for="capitulos">
                  <i class="fas fa-building"></i> Capitulos
                </label>
                <input type="number" name="capitulos" id="capitulos" class="form-control" placeholder="Capitulos">
              </div>
            </div>
          </div>
          <div class="modal-footer mb-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times mr-3"></i>Cancelar
            </button>
            <button type="button" class="btn btn-success" id="guardarLibro">
              <i class="fas fa-save mr-3"></i>Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class=" modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Deseas eliminar este libro?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="btnEliminarLibro">Si</button>
      </div>
    </div>
  </div>
  </div>


  <script src="./jquery.js"> </script>
  <script src="./script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/16d70f32b6.js" crossorigin="anonymous"></script>

</body>

</html>