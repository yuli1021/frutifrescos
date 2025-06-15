<?php
// --- ARCHIVO: pages/logout.php ---
// Descripción: Destruye la sesión del usuario.
session_start();
session_unset();
session_destroy();
header('Location: index.php?page=home');
exit();
?>