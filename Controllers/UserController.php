<?php
require_once '../ConnectBD/ConnectBD.php';
require_once '../Models/User.php';
require('../Libraries/fpdf/fpdf.php');
// Permite solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");

class UserController
{

    public function __construct()
    {
    }


    public function generatePDF()
    {

        // Crear una instancia de FPDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Agregar contenido al PDF
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Mi primer PDF en PHP con FPDF');

        // Definir el nombre del archivo PDF
        $filename = "mi_pdf.pdf";

        // Generar el PDF en una variable
        $pdf_content = $pdf->Output('', 'S');

        // Enviar los encabezados HTTP para forzar la descarga
        header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Content-Length: ' . strlen($pdf_content));

        // Imprimir el contenido del PDF
        echo $pdf_content;
    }


    public function index()
    {

        // Configuración de la base de datos
        $conexionDB = new ConnectBD();
        $conexionDB->conectar();

        // Consultar todos los registros de los usuarios
        $user = new User();
        $users = $user->all($conexionDB->obtenerConexion());
        $conexionDB->cerrarConexion();

        // Devuelve una respuesta JSON

        if (count($users) > 0) {
            echo json_encode($users);
        } else {
            echo json_encode([]);
        }
    }

    /* ------funcion shoiw------ */

    public function show()
    {

        // Verifica si la solicitud es GET y si contiene un ID
        if (!isset($_GET['id'])) {
            http_response_code(400); // Respuesta de error 400 Bad Request
            echo "Error, no se recibió el ID.";
            return;
        }

        // Configuración de la base de datos
        $conexionDB = new ConnectBD();
        $conexionDB->conectar();

        // Consultar un registro
        $user = new User();
        $user = $user->find($_GET['id'], $conexionDB->obtenerConexion());
        $conexionDB->cerrarConexion();

        // Devuelve una respuesta JSON
        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode([]);
        }
    }


    public function store()
    {

        // Verifica si la solicitud es POST y si el cuerpo de la solicitud contiene datos JSON
        // Lee el cuerpo de la solicitud como JSON
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if ($data === null) {
            // Error al decodificar el JSON
            http_response_code(400); // Respuesta de error 400 Bad Request
            echo "Error en los datos JSON.";
            return;
        }

        // Configuración de la base de datos
        $conexionDB = new ConnectBD();
        $conexionDB->conectar();

        // Crear una instancia de la clase User
        $user = new User();

        // Insertar un nuevo registro
        $result = $user->create($data, $conexionDB->obtenerConexion());
        $conexionDB->cerrarConexion();

        // Devuelve una respuesta adecuada
        if ($result) {
            echo "Registro insertado con éxito.";
        } else {
            echo "Error al insertar el registro.";
        }
    }


    /* -------funcion para editar -------- */

    public function update()
    {

        // Verifica si la solicitud es POST y si el cuerpo de la solicitud contiene datos JSON
        // Lee el cuerpo de la solicitud como JSON
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if ($data === null) {
            // Error al decodificar el JSON
            http_response_code(400); // Respuesta de error 400 Bad Request
            echo "Error en los datos JSON.";
            return;
        }

        // Configuración de la base de datos
        $conexionDB = new ConnectBD();
        $conexionDB->conectar();

        // Crear una instancia de la clase User
        $user = new User();

        // Actualizar un registro
        $result = $user->update($data, $conexionDB->obtenerConexion());
        $conexionDB->cerrarConexion();

        // Devuelve una respuesta adecuada
        if ($result) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar el registro.";
        }
    }


    /* -------funcion para liminar ------- */

    public function delete()
    {

        /* -------obtener el id ------- */

        $json = file_get_contents('php://input');

        $data = json_decode($json);



        if ($data === null) {
            // Error al decodificar el JSON
            http_response_code(400); // Respuesta de error 400 Bad Request
            echo "Error en los datos JSON.";
            return;
        }

        // Configuración de la base de datos
        $conexionDB = new ConnectBD();
        $conexionDB->conectar();

        // Crear una instancia de la clase User
        $user = new User();

        // Eliminar un registro
        $result = $user->delete($data->id, $conexionDB->obtenerConexion());
        $conexionDB->cerrarConexion();

        // Devuelve una respuesta adecuada
        if ($result) {
            echo "Registro eliminado con éxito.";
        } else {
            echo "Error al eliminar el registro.";
        }
    }
}
