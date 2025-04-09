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
    
    $stmt = $conn->query("SELECT id, nombre, puntuacion FROM Comites");
    $comites = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - SOE</title>
    <link rel="stylesheet" href="assets/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Cerrar Sesión</a>
            </li>
        </ul>
    </nav>

    <div class="content-wrapper">
        <div class="content">
            <div class="container">
                <h1>Administrar Puntos de Comités</h1>
                <form action="actualizar_puntos.php" method="post">
                    <div class="form-group">
                        <label for="comite">Seleccionar Comité:</label>
                        <select name="comite_id" class="form-control">
                            <?php foreach ($comites as $comite) { ?>
                                <option value="<?= $comite['id'] ?>">
                                    <?= $comite['nombre'] ?> (Puntuación actual: <?= $comite['puntuacion'] ?>)
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="puntos">Puntos a agregar:</label>
                        <input type="number" name="puntos" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Puntos</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
