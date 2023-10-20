<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./IndexView.js"></script>
    <title>Todos los Registros</title>
</head>

<body>

    <header>
        <h1>Todos los Registros</h1>
    </header>
    <main>
        <!-- ------boton para descargar PDF -->
        <button type="button" id="btnPDF">Descargar PDF</button>
        <!-- Tabla para mostrar los registros -->
        <table id="usersTable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cédula o RUC</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo electrónico</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se insertarán las filas de datos de usuarios -->
            </tbody>
        </table>
    </main>
    <footer></footer>

</body>

</html>