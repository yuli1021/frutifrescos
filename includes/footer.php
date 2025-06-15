</main>
<footer class="main-footer">
    <div class="container">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> FrutiFresco. Calidad y frescura garantizada.</p>
            <div class="footer-links">
                <button class="link-button" id="contact-modal-btn">Contacto</button>
                <button class="link-button" id="faq-modal-btn">FAQ</button>
                <button class="link-button" id="sitemap-modal-btn">Mapa del Sitio</button>
            </div>
        </div>
    </div>
</footer>

<!-- MODALS -->
<?php if (!$user_logged_in): ?>
    <!-- Modal Login -->
    <div id="login-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <?php include 'pages/login.php'; ?>
        </div>
    </div>
    <!-- Modal Signup -->
    <div id="signup-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <?php include 'pages/signup.php'; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Modal Contacto -->
<div id="contact-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <?php include 'pages/contact.php'; ?>
    </div>
</div>
<!-- Modal FAQ -->
<div id="faq-modal" class="modal">
    <div class="modal-content wide">
        <span class="close-btn">&times;</span>
        <?php include 'pages/faq.php'; ?>
    </div>
</div>
<!-- Modal Sitemap -->
<div id="sitemap-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <?php include 'pages/sitemap.php'; ?>
    </div>
</div>

<!-- CHATBOT -->
<?php include 'includes/chatbot.php'; ?>

<script src="assets/js/main.js"></script>
</body>

</html>