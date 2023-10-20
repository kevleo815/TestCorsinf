<?php

class Client
{
    /* ------atributos ------ */
    public $name;
    public $ci_ruc;
    public $address;
    public $phone;
    public $email;

    /* -----constructor  */

    public function __construct($name = '', $ci_ruc = '', $address = '', $phone = '', $email = '')
    {
        $this->name = $name;
        $this->ci_ruc = $ci_ruc;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
    }

    /* ------metodos o funciones ---- */

    /* ------obtener todos los registros de lcientes ------ */

    public static function all($connection)
    {
        $sql = "SELECT * FROM clients";
        $result = $connection->query($sql);

        $users = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user = new User($row['id'], $row['name'], $row['ci_ruc'], $row['address'], $row['phone'], $row['email']);
                $user->id = $row['id'];
                array_push($users, $user);
            }
            $result->free_result(); // Libera el resultado
        }

        return $users;
    }

    /* -------procedimiento alamcenado para copiar los registro de la tabla usuarios a la tabla cliente----- */

    public static function copy($connection)
    {
        $sql = "CALL copy_users_to_clients()";
        $result = $connection->query($sql);

        if ($result) {
            echo "Se copiaron los registros correctamente";
        } else {
            echo "Error al copiar los registros";
        }
    }
}
