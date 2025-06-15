<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup_submit'])) {
    $database = new Database();
    $db = $database->getConnection();
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar que el email no exista
    $check_stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $check_stmt->execute([':email' => $email]);
    
    if ($check_stmt->rowCount() > 0) {
        $message = '<p class="form-message error">Este correo/usuario ya está registrado.</p>';
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $insert_stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        if ($insert_stmt->execute([':name' => $name, ':email' => $email, ':password' => $hashed_password])) {
             $message = '<p class="form-message success">¡Registro exitoso! Ya puedes iniciar sesión.</p>';
        } else {
             $message = '<p class="form-message error">Hubo un problema al crear tu cuenta.</p>';
        }
    }
}
?>
<div class="form-container">
    <form action="index.php?page=signup" method="POST">
        <h2>Crear Cuenta</h2>
        <?php echo $message; ?>
        <div class="form-group">
            <label for="name">Nombre Completo:</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Correo (Será tu usuario):</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" name="signup_submit" class="btn btn-primary btn-block">Registrarse</button>
    </form>
</div>