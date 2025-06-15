<?php
$user_logged_in = isset($_SESSION['user_id']);
$user_name = $user_logged_in ? $_SESSION['user_name'] : '';
$user_pic = $user_logged_in && isset($_SESSION['user_pic']) ? 'assets/uploads/' . $_SESSION['user_pic'] : 'https://placehold.co/40x40/EFEFEF/AAAAAA?text=User';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrutiFresco - Calidad Directo a tu Hogar</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
</head>

<body>
    <header class="main-header">
        <div class="container">
            <a href="index.php?page=home" class="logo">
                <h1>🍉 FrutiFresco</h1>
            </a>
            <nav class="main-nav">
                <?php if ($user_logged_in): ?>
                    <div class="user-menu">
                        <a href="index.php?page=profile">
                            <img src="<?php echo htmlspecialchars($user_pic); ?>" alt="[Foto de perfil]"
                                class="profile-pic-small">
                            <span>Hola, <?php echo htmlspecialchars($user_name); ?></span>
                        </a>
                        <a href="index.php?page=logout" class="btn btn-outline">Cerrar Sesión</a>
                    </div>
                <?php else: ?>
                    <button id="login-modal-btn" class="btn btn-outline">Login</button>
                    <button id="signup-modal-btn" class="btn btn-primary">Registrarse</button>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main>