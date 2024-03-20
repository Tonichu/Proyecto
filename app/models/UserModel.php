<?php

class UserModel {
    public function getAllUsers() {
        // Aquí iría la lógica para conectarse a la base de datos y obtener los datos de los usuarios
        // En este ejemplo, simplemente se devuelve un array de usuarios simulado
        return array(
            array('id' => 1, 'name' => 'John'),
            array('id' => 2, 'name' => 'Jane'),
            array('id' => 3, 'name' => 'Alice')
        );
    }
}

?>