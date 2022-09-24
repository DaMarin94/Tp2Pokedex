<?php
require_once("conexion.php");
require_once("funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!--Etiquetas para visualizar cambios de css en tiempo real-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/pokedex.css?v=<?php echo time(); ?>"/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-danger navbar-custom" >
        <div class="container-fluid">
            <div class="navbar-brand ">
                <img src="imagenes/pokemon-logo.png" width="250px"><img>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form action="validar.php" method="POST" enctype="multipart/form-data"
                      class="d-flex form-head ml-auto">
                    <input class="form-control me-2" type="text" name="user" placeholder="Usuario">
                    <input class="form-control me-2" type="password" name="password" placeholder="Contraseña">
                    <button type="submit" name="enviar" class="btn btn-primary btn-custom btn-lg btn-custom">Log in
                    </button>
                </form>
            </div>
        </div>
    </nav>

</header>

<main>
    <div class="container-fluid">
        <form action="index.php" method="POST" enctype="multipart/form-data" class="form-search">
            <input type="text" name="search" placeholder="Ingrese el nombre, tipo o número de pokemon">
            <button class="btn-primary" type="submit" name="buscar">¿Quién es este pokemon?</button>
        </form>
        <div class="table-responsive ">
            <table class="tabla breakpoint-sm">
                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Tipo</th>
                    <th>Numero</th>
                    <th>Nombre</th>
                </tr>
                </thead>
                <tbody>
                <!-- Agregar filtros (los filtros deben estar contenidos en un metodo que reciba por parametro el valor
                y si este es nulo, no recibe nada, que se muestre toda la lista de pokemon) -->
                <?php if (empty($_POST['search'])) {
                    $buscador = '';
                    foreach (funciones::listarPokemon() as $fila) {
                        $imagen = funciones::getImagen($fila['imagen']);
                        $tipo = funciones::getTipo($fila['tipo']);

                        echo "<tr>
                    <td><img src='imagenes/$imagen'></td>
                    <td><img src='imagenes/$tipo'></td>
                    <td>$fila[numero]</td>
                    <td><a class='detalle' href='detalle.php?nombre=$fila[nombre]'>$fila[nombre]</a></td>
                </tr>";
                    }
                } else {
                    $buscador = $_POST['search'];
                    foreach (funciones::listarResultadosFiltrados($buscador) as $fila) {
                        $imagen = $fila['imagen'];
                        $tipo = $fila['tipo'];
                        $nombre = $fila['nombre'];
                        $numero = $fila['numero'];
                        echo "<tr>
                    <td><img src='imagenes/$imagen'></td>
                    <td><img src='imagenes/$tipo'></td>
                    <td>$numero</td>
                    <td><a class='detalle' href='detalle.php?nombre=$nombre'>$nombre</a></td>
                </tr>";
                    }
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>