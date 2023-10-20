<?php
class ConnectBD
{
    private $host;
    private $user;
    private $password;
    private $nameDB;
    private $portDB;
    private $connection;

    public function __construct($host = '127.0.0.1', $usuario = 'root', $contrasena = 'toor', $nombreDB = 'prueba', $portDB = '3306')
    {
        $this->host = $host;
        $this->user = $usuario;
        $this->password = $contrasena;
        $this->nameDB = $nombreDB;
        $this->portDB = $portDB;
    }

    public function conectar()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->nameDB, $this->portDB);

        if ($this->connection->connect_error) {
            die("Error de conexión: " . $this->connection->connect_error);
        }
    }

    public function obtenerConexion()
    {
        return $this->connection;
    }

    public function cerrarConexion()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
