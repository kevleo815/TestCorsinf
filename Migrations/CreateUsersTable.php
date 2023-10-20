<?php

class CreateUsersTable
{
    public function up($connection)
    {
        // Define las instrucciones SQL para crear la tabla de usuarios
        $sql = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            ci_ruc VARCHAR(13),
            address VARCHAR(255),
            phone VARCHAR(10),
            email VARCHAR(255)
        )";

        $connection->query($sql);
    }

    public function down($connection)
    {
        // Define las instrucciones SQL para deshacer la migración (eliminar la tabla)
        $sql = "DROP TABLE users";

        $connection->query($sql);
    }
}
