document.addEventListener('DOMContentLoaded', function () {

    // --- MANEJO DE MODALES ---
    const modalTriggers = {
        'login-modal-btn': 'login-modal',
        'signup-modal-btn': 'signup-modal',
        'contact-modal-btn': 'contact-modal',
        'faq-modal-btn': 'faq-modal',
        'sitemap-modal-btn': 'sitemap-modal'
    };

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) modal.style.display = 'block';
    }

    function closeModal(modal) {
        if (modal) modal.style.display = 'none';
    }

    Object.keys(modalTriggers).forEach(btnId => {
        const btn = document.getElementById(btnId);
        if (btn) {
            btn.addEventListener('click', () => openModal(modalTriggers[btnId]));
        }
    });

    // Delegación de eventos para links dentro de modales
    document.body.addEventListener('click', function (event) {
        if (event.target.classList.contains('modal-link')) {
            const targetModalId = event.target.dataset.modal;
            // Cerrar modal actual
            closeModal(event.target.closest('.modal'));
            // Abrir nuevo modal
            openModal(targetModalId);
        }
    });

    // Cerrar modales
    document.querySelectorAll('.modal .close-btn').forEach(btn => {
        btn.addEventListener('click', () => closeModal(btn.closest('.modal')));
    });

    window.addEventListener('click', (event) => {
        if (event.target.classList.contains('modal')) {
            closeModal(event.target);
        }
    });

    // --- LÓGICA DEL CARRITO DE COMPRAS ---
    let shoppingCart = [];
    const cartContainer = document.getElementById('cart-items-container');
    const cartEmptyMsg = document.getElementById('cart-empty-msg');
    const cartSummary = document.getElementById('cart-summary');
    const cartTotalPriceEl = document.getElementById('cart-total-price');

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            const card = e.target.closest('.product-card');
            const product = {
                id: card.dataset.id,
                name: card.dataset.name,
                price: parseFloat(card.dataset.price),
                img: card.querySelector('img').src,
            };
            addToCart(product);
        });
    });

    function addToCart(product) {
        shoppingCart.push(product);
        renderCart();
    }

    function removeFromCart(index) {
        shoppingCart.splice(index, 1);
        renderCart();
    }

    function renderCart() {
        cartContainer.innerHTML = ''; // Limpiar carrito
        if (shoppingCart.length === 0) {
            cartContainer.appendChild(cartEmptyMsg);
            cartEmptyMsg.classList.remove('hidden');
            cartSummary.classList.add('hidden');
        } else {
            cartEmptyMsg.classList.add('hidden');
            cartSummary.classList.remove('hidden');
            let total = 0;
            shoppingCart.forEach((item, index) => {
                total += item.price;
                const cartItemEl = document.createElement('div');
                cartItemEl.classList.add('cart-item');
                cartItemEl.innerHTML = `
                    <img src="${item.img}" alt="[${item.name}]">
                    <div class="cart-item-info">
                        <h5>${item.name}</h5>
                        <p>$${item.price.toFixed(2)}</p>
                    </div>
                    <button class="cart-item-remove" data-index="${index}">&times;</button>
                `;
                cartContainer.appendChild(cartItemEl);
            });
            cartTotalPriceEl.textContent = `$${total.toFixed(2)}`;
        }
    }

    // Delegación de eventos para eliminar del carrito
    cartContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('cart-item-remove')) {
            const index = e.target.dataset.index;
            removeFromCart(index);
        }
    });

    renderCart(); // Render inicial

    // --- LÓGICA DEL CHATBOT (sin cambios significativos) ---
    const chatbotIcon = document.getElementById("chatbot-icon"), chatbotWindow = document.getElementById("chatbot-window"), closeChatbot = document.getElementById("close-chatbot"), chatbotBody = document.getElementById("chatbot-body"), chatbotInput = document.getElementById("chatbot-input"), chatbotSend = document.getElementById("chatbot-send"); chatbotIcon && chatbotIcon.addEventListener("click", () => { chatbotWindow.classList.toggle("hidden") }), closeChatbot && closeChatbot.addEventListener("click", () => { chatbotWindow.classList.add("hidden") }); const sendMessage = () => { const t = chatbotInput.value.trim(); "" !== t && (appendMessage(t, "user"), chatbotInput.value = "", setTimeout(() => { const e = getBotResponse(t); appendMessage(e, "bot") }, 1e3)) }; chatbotSend && chatbotSend.addEventListener("click", sendMessage), chatbotInput && chatbotInput.addEventListener("keypress", t => { "Enter" === t.key && sendMessage() }); function appendMessage(t, e) { const o = document.createElement("div"); o.classList.add("chat-message", e), o.textContent = t, chatbotBody.appendChild(o), chatbotBody.scrollTop = chatbotBody.scrollHeight } function getBotResponse(t) { const e = t.toLowerCase(); return e.includes("hola") ? "¡Hola! ¿En qué puedo ayudarte?" : e.includes("envío") || e.includes("reparto") ? "Realizamos envíos a toda la ciudad. El costo es de $50, pero es gratis en pedidos mayores a $500." : e.includes("pago") ? "Aceptamos todas las tarjetas y PayPal." : e.includes("productos") || e.includes("frutas") ? "¡Tenemos las mejores frutas de temporada y exóticas! Explora nuestra página de inicio." : e.includes("gracias") ? "¡De nada! Estoy para servirte." : "Lo siento, no entendí. Pregúntame sobre envíos, pagos o productos." }
});
