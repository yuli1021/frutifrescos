<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=home');
    exit();
}

$database = new Database();
$db = $database->getConnection();
$user_id = $_SESSION['user_id'];
$update_message = '';
$delete_message = '';

// Lógica para actualizar datos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $password = $_POST['password'];

    $query = "UPDATE users SET name = :name";
    $params = [':name' => $name, ':id' => $user_id];

    // Actualizar contraseña si se proporcionó una nueva
    if (!empty($password)) {
        $query .= ", password = :password";
        $params[':password'] = password_hash($password, PASSWORD_BCRYPT);
    }

    // Manejo de subida de foto
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $target_dir = "assets/uploads/";
        if (!is_dir($target_dir))
            mkdir($target_dir, 0755, true);
        $file_ext = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);
        $new_filename = $user_id . '_' . time() . '.' . $file_ext;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $query .= ", profile_pic = :pic";
            $params[':pic'] = $new_filename;
            $_SESSION['user_pic'] = $new_filename;
        }
    }

    $query .= " WHERE id = :id";
    $stmt = $db->prepare($query);

    if ($stmt->execute($params)) {
        $_SESSION['user_name'] = $name;
        $update_message = '<p class="form-message success">¡Perfil actualizado con éxito!</p>';
    } else {
        $update_message = '<p class="form-message error">Hubo un error al actualizar.</p>';
    }
}

// Lógica para eliminar cuenta
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
    if ($stmt->execute([':id' => $user_id])) {
        session_unset();
        session_destroy();
        header('Location: index.php?page=home');
        exit();
    } else {
        $delete_message = '<p class="form-message error">No se pudo eliminar la cuenta.</p>';
    }
}

// Obtener datos actuales del usuario
$stmt = $db->prepare("SELECT name, email FROM users WHERE id = :id");
$stmt->execute([':id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div class="container profile-page">
    <h2>Mi Perfil</h2>
    <div class="profile-layout">
        <!-- FORMULARIO DE ACTUALIZACIÓN -->
        <div class="profile-card">
            <h3>Actualizar mis datos</h3>
            <form action="index.php?page=profile" method="POST" enctype="multipart/form-data">
                <?php echo $update_message; ?>
                <div class="form-group">
                    <label>Nombre de Usuario (no se puede cambiar)</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="profile_pic">Foto de Perfil (opcional)</label>
                    <input type="file" id="profile_pic" name="profile_pic" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="password">Nueva Contraseña (dejar en blanco para no cambiar)</label>
                    <input type="password" id="password" name="password">
                </div>
                <button type="submit" name="update_profile" class="btn btn-primary btn-block">Guardar Cambios</button>
            </form>
        </div>

        <!-- ZONA DE PELIGRO -->
        <div class="profile-card danger-zone">
            <h3>Zona de Peligro</h3>
            <p>La eliminación de la cuenta es permanente e irreversible.</p>
            <form action="index.php?page=profile" method="POST"
                onsubmit="return confirm('¿Estás SEGURO de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.');">
                <?php echo $delete_message; ?>
                <button type="submit" name="delete_account" class="btn btn-danger btn-block">Eliminar mi Cuenta</button>
            </form>
        </div>
    </div>
</div>