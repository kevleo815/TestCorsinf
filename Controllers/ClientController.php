<?php
require_once '../ConnectBD/ConnectBD.php';
require_once '../Models/Client.php';

class ClientController
{
    public function index()
    {
        // Configuración de la base de datos

        $conexionDB = new ConnectBD();
        $conexionDB->conectar();

        /* ------consultar todos los registros de los clientes------- */

        $clients = Client::all($conexionDB->obtenerConexion());
    }
}
