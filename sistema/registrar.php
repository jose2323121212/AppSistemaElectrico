<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    registrarCliente($conexion, $cedula, $nombre, $direccion, $telefono);
}
?>