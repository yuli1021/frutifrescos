<div class="container error-page">
    <div class="error-box">
        <h1><?php echo isset($error_title) ? $error_title : 'Error'; ?></h1>
        <p><?php echo isset($error_message) ? $error_message : 'Ha ocurrido un error inesperado.'; ?></p>
        <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
    </div>
</div>