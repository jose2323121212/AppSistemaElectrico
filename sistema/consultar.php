<?php
require 'conexion.php';

if ($conexion["REQUEST_METHOD"] == "GET"){
    if (isset($_GET['numero_medidor'])){
        $numero_medidor = $_GET['numero_medidor'];
        $consumo = consultarConsumoPorMedidor($pdo, $id_medidor);

    }elseif (isset($_GET['cedula_cliente'])){
        $numero_medidor = $_GET['cedula_cliente'];
        $consumo = consultarConsumoPorMedidor($pdo, $cedula);
    }
}
?>