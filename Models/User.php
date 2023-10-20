<?php

class User
{
    /* ------atributos ------ */
    public $id;
    public $name;
    public $ci_ruc;
    public $address;
    public $phone;
    public $email;

    /* -----constructor  */

    public function __construct($id = '', $name = '', $ci_ruc = '', $address = '', $phone = '', $email = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->ci_ruc = $ci_ruc;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
    }

    /* ------metodos o funciones ---- */


    /* -------metodos para consultar todos los registros------- */

    public static function all($connection)
    {
        $sql = "SELECT * FROM users";
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

    /* -------metodo para consultar un registro------- */

    public function find($id, $connection)
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $connection->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User($row['id'], $row['name'], $row['ci_ruc'], $row['address'], $row['phone'], $row['email']);
            $user->id = $row['id'];
            $result->free_result(); // Libera el resultado
            return $user;
        } else {
            return null;
        }
    }

    /* -------metodo ingresar una nueva persona en la tabla people ----*/

    public function create($user, $connection)
    {
        $sql = "INSERT INTO users (name, ci_ruc, address, phone, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssss", $user->name, $user->ci_ruc, $user->address, $user->phone, $user->email);

            if ($stmt->execute()) {
                // La inserción se realizó con éxito
                return true;
            } else {
                // Ocurrió un error
                return false;
            }
            $stmt->close();
        } else {
            // Ocurrió un error en la preparación de la consulta
            return false;
        }
    }


    /* --------funcion  para editar -------- */

    public function update($user, $connection)
    {
        $sql = "UPDATE users SET name = ?, ci_ruc = ?, address = ?, phone = ?, email = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssssi", $user->name, $user->ci_ruc, $user->address, $user->phone, $user->email, $user->id);

            if ($stmt->execute()) {
                // La actualización se realizó con éxito
                return true;
            } else {
                // Ocurrió un error
                return false;
            }
            $stmt->close();
        } else {
            // Ocurrió un error en la preparación de la consulta
            return false;
        }
    }

    /* ---------funcion para eliminar------ */

    public function delete($id, $connection)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // La eliminación se realizó con éxito
                $stmt->close();
                return true;
            } else {
                // Ocurrió un error durante la eliminación
                $stmt->close();
                return false;
            }
        } else {
            // Ocurrió un error en la preparación de la consulta
            return false;
        }
    }
}
