<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    try {
        $stmt = $db->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':subject', $_POST['subject']);
        $stmt->bindParam(':message', $_POST['message_content']);

        if ($stmt->execute()) {
            $message = '<p class="form-message success">¡Gracias por contactarnos! Te responderemos pronto.</p>';
        } else {
            $message = '<p class="form-message error">No se pudo enviar tu mensaje. Inténtalo de nuevo.</p>';
        }
    } catch (PDOException $e) {
        $message = '<p class="form-message error">Error: ' . $e->getMessage() . '</p>';
    }
}
?>
<div class="form-container">
    <form action="" method="POST"> 
        <h2>Formulario de Contacto</h2>
        <div class="form-group">
            <label for="contact_name">Nombre:</label>
            <input type="text" id="contact_name" name="name" required>
        </div>
        <div class="form-group">
            <label for="contact_email">Correo:</label>
            <input type="email" id="contact_email" name="email" required>
        </div>
        <div class="form-group">
            <label for="contact_message">Mensaje:</label>
            <textarea id="contact_message" name="message_content" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
    </form>
</div>