<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['suggestion'])) {
    $database = new Database();
    $db = $database->getConnection();

    try {
        $stmt = $db->prepare("INSERT INTO suggestions (suggestion) VALUES (:suggestion)");
        $stmt->bindParam(':suggestion', $_POST['suggestion']);

        if ($stmt->execute()) {
            $message = '<p class="form-message success">¡Gracias por tu sugerencia! La tendremos en cuenta.</p>';
        } else {
            $message = '<p class="form-message error">No se pudo enviar tu sugerencia. Inténtalo de nuevo.</p>';
        }
    } catch (PDOException $e) {
        $message = '<p class="form-message error">Error: ' . $e->getMessage() . '</p>';
    }
}
?>
<div class="form-container wide">
    <form action="index.php?page=suggestions" method="POST">
        <h2>Buzón de Sugerencias</h2>
        <p>Nos encanta mejorar. ¿Tienes alguna idea para nosotros? ¡Compártela!</p>
        <?php echo $message; ?>
        <div class="form-group">
            <label for="suggestion">Tu sugerencia:</label>
            <textarea id="suggestion" name="suggestion" rows="6" required
                placeholder="Me gustaría que vendieran..."></textarea>
        </div>
        <button type="submit" class="btn-form">Enviar Sugerencia</button>
    </form>
</div>