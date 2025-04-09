<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: index.php");
    exit();
}

// Conexión a la base de datos
$serverName = "db15020.public.databaseasp.net";
$database = "db15020";
$username = "db15020";
$password = "6g!B#5FcX=b9";

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database;Encrypt=yes;TrustServerCertificate=yes;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $comite_id = $_POST['comite_id'];
    $puntos = $_POST['puntos'];

    $sql = "UPDATE Comites SET puntuacion = puntuacion + :puntos WHERE id = :comite_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':puntos', $puntos, PDO::PARAM_INT);
    $stmt->bindParam(':comite_id', $comite_id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: dashboard.php?success=1");
    exit();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
