<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$serverName = "db15020.public.databaseasp.net";
$database = "db15020";
$username = "db15020";
$password = "6g!B#5FcX=b9";

try {
    // Conectar a SQL Server con TrustServerCertificate habilitado
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database;Encrypt=yes;TrustServerCertificate=yes;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obtener los comités
    $sql = "SELECT id, nombre, puntuacion FROM Comites";
    $stmt = $conn->query($sql);

    // Obtener los resultados como un array asociativo
    $comites = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar los datos en formato JSON
    echo json_encode($comites);
} catch (PDOException $e) {
    // Manejo de errores
    http_response_code(500);
    echo json_encode(["error" => "Error en el servidor al obtener comités", "detalle" => $e->getMessage()]);
}
?>
