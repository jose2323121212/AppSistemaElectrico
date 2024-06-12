<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "sistema";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno) {
    die("conexion fallida"  .  $conexion->connect_errno);
}
else {
    echo "conectado1";
}
// Función para registrar un cliente
function registrarCliente($conexion, $cedula, $nombre, $direccion, $telefono) {
    $sql = "INSERT INTO clientes (cedula, nombre, direccion, telefono) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$cedula, $nombre, $direccion, $telefono]);
    echo "Cliente registrado correctamente.";
}

// Función para registrar una lectura de medidor
function registrarLectura($conexion, $numero_medidor, $cedula_cliente, $lectura, $fecha) {
    $sql = "INSERT INTO lecturas (numero_medidor, cedula_cliente, lectura, fecha) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$numero_medidor, $cedula_cliente, $lectura, $fecha]);
    echo "Lectura registrada correctamente.";
}

// Función para consultar el consumo por número de medidor
function consultarConsumoPorMedidor($conexion, $numero_medidor) {
    $sql = "SELECT * FROM lecturas WHERE numero_medidor = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$numero_medidor]);
    $resultados = $stmt->fetchAll(CONEXION::FETCH_ASSOC);
    return $resultados;
}

// Función para consultar el consumo por cédula de cliente
function consultarConsumoPorCedula($conexion, $cedula_cliente) {
    $sql = "SELECT * FROM lecturas WHERE cedula_cliente = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$cedula_cliente]);
    $resultados = $stmt->fetchAll(CONEXION::FETCH_ASSOC);
    return $resultados;
}
?>
!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Clientes y Lecturas de Medidores</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Registro de Clientes y Lecturas de Medidores</h1>

        <!-- Registro de Clientes -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Registrar Cliente</h2>
            <form id="registrar">
                <div class="mb-4">
                    <label class="block text-gray-700">Cédula:</label>
                    <input type="text" id="cedula" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Nombre:</label>
                    <input type="text" id="nombre" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <button type="button" onclick="registrarCliente()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Registrar</button>
            </form>
        </div>
        <!-- Registro de Lecturas -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Registrar Lectura de Medidor</h2>
            <form id="lecturaForm">
                <div class="mb-4">
                    <label class="block text-gray-700">Número de Medidor:</label>
                    <input type="text" id="numeroMedidor" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Lectura:</label>
                    <input type="text" id="lectura" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <button type="button" onclick="registrarLectura()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Registrar</button>
            </form>
        </div>

        <!-- Consulta de Consumos -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Consultar Consumo</h2>
            <form id="consultar">
                <div class="mb-4">
                    <label class="block text-gray-700">Número de Medidor:</label>
                    <input type="text" id="consultaMedidor" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Cédula del Cliente:</label>
                    <input type="text" id="consultaCedula" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <button type="button" onclick="consultarConsumo()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Consultar</button>
            </form>
        </div>

        <div id="resultado" class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Resultado de la Consulta</h2>
            <div  class="text-gray-700"></div>
            <h2 class="text-xl font-semibold mb-4">El consumo es de:</h2>
            200

        </div>
    </div>
</body>
</html>
