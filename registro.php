<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $clave = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $clave);

    if ($stmt->execute()) {
        header("Location: login2.php");
    } else {
        $error = "El usuario ya existe.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Registro</title></head>
<body>
    <h2>Registro de usuario</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        Usuario: <input type="text" name="username" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit">Registrar</button>
    </form>
    <a href="login2.php">Iniciar sesión</a>
</body>
</html>