<?php
// --- ARCHIVO: index.php (Controlador Principal) ---
// -- ACTUALIZADO --
session_start();

// --- CIERRE DE SESIÓN POR INACTIVIDAD ---
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 180)) { // 3 minutos
    session_unset();
    session_destroy();
}
$_SESSION['last_activity'] = time();

try {
    require_once 'config/database.php';

    $page = isset($_GET['page']) ? basename($_GET['page']) : 'home';
    $page_path = 'pages/' . $page . '.php';

    $ajax_pages = ['add_to_cart'];

    if (in_array($page, $ajax_pages)) {
        if (file_exists($page_path)) {
            include $page_path;
        }
    } else {
        include 'includes/header.php';
        if (file_exists($page_path)) {
            include $page_path;
        } else {
            include 'pages/404.php';
        }
        include 'includes/footer.php';
    }

} catch (PDOException $e) {
    $error_title = "Error de Conexión";
    $error_message = "No podemos conectarnos a la base de datos en este momento. Por favor, inténtalo más tarde.";
    include 'pages/error.php';
}
?>