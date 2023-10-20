<?php
require_once '../ConnectBD/ConnectBD.php';
require_once '../Migrations/CreateUsersTable.php';
require_once '../Migrations/CreateClientsTable.php';


$conexion = new ConnectBD();
$conexion->conectar();

$migracion = new CreateUsersTable();
$migracion->up($conexion->obtenerConexion());

$migracionClient = new CreateClientsTable();
$migracionClient->up($conexion->obtenerConexion());

$conexion->cerrarConexion();
