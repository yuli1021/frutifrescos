<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_submit'])) {
    $database = new Database();
    $db = $database->getConnection();

    $stmt = $db->prepare("SELECT id, name, email, password, profile_pic FROM users WHERE email = :email");
    $stmt->execute([':email' => $_POST['email']]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_pic'] = $user['profile_pic'];
            header('Location: index.php?page=home');
            exit;
        } else {
            $message = '<p class="form-message error">La contraseña es incorrecta.</p>';
        }
    } else {
        $message = '<p class="form-message error">Usuario no encontrado.</p>';
    }
}
?>
<div class="form-container">
    <form action="index.php?page=login" method="POST">
        <h2>Iniciar Sesión</h2>
        <?php echo $message; ?>
        <div class="form-group">
            <label for="email">Correo (Usuario):</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" name="login_submit" class="btn btn-primary btn-block">Entrar</button>
    </form>
</div>