<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login2.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Bienvenido, <?= $_SESSION['usuario'] ?></h2>
    <p>Estás dentro del sistema.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>