<div class="container">
    <section class="hero">
        <div class="hero-text">
            <h2>La fruta más fresca, directo a tu puerta.</h2>
            <p>Calidad y sabor garantizados en cada pedido que realizas con nosotros.</p>
        </div>
    </section>

    <div class="home-layout">
        <div class="product-container">
            <!-- FRUTAS DE TEMPORADA -->
            <section class="product-category">
                <h3>Frutas de Temporada</h3>
                <div class="product-grid">
                    <div class="product-card" data-id="1" data-name="Mango Ataulfo" data-price="45.50">
                        <img src="https://placehold.co/300x200/FFC300/4F4F4F?text=Mango" alt="[Imagen de Mango]">
                        <h4>Mango Ataulfo</h4>
                        <p class="price">$45.50 / kg</p>
                        <button class="btn btn-secondary add-to-cart-btn">Añadir al Carrito</button>
                    </div>
                     <div class="product-card" data-id="2" data-name="Fresa" data-price="80.00">
                        <img src="https://placehold.co/300x200/E53E3E/FFFFFF?text=Fresa" alt="[Imagen de Fresa]">
                        <h4>Fresa Premium</h4>
                        <p class="price">$80.00 / kg</p>
                        <button class="btn btn-secondary add-to-cart-btn">Añadir al Carrito</button>
                    </div>
                </div>
            </section>
            
            <!-- FRUTAS EXÓTICAS -->
            <section class="product-category">
                <h3>Frutas Exóticas</h3>
                <div class="product-grid">
                    <div class="product-card" data-id="3" data-name="Lichi" data-price="120.00">
                        <img src="https://placehold.co/300x200/D95384/FFFFFF?text=Lichi" alt="[Imagen de Lichi]">
                        <h4>Lichi</h4>
                        <p class="price">$120.00 / kg</p>
                        <button class="btn btn-secondary add-to-cart-btn">Añadir al Carrito</button>
                    </div>
                     <div class="product-card" data-id="4" data-name="Pitahaya" data-price="95.00">
                        <img src="https://placehold.co/300x200/ED4599/FFFFFF?text=Pitahaya" alt="[Imagen de Pitahaya]">
                        <h4>Pitahaya (Fruta del Dragón)</h4>
                        <p class="price">$95.00 / pza</p>
                        <button class="btn btn-secondary add-to-cart-btn">Añadir al Carrito</button>
                    </div>
                </div>
            </section>
        </div>
        
        <aside class="shopping-cart-aside">
            <h3>Mi Carrito</h3>
            <div id="cart-items-container">
                <p id="cart-empty-msg">Tu carrito está vacío.</p>
                <!-- Los items del carrito se añadirán aquí con JS -->
            </div>
            <div id="cart-summary" class="hidden">
                <div class="cart-total">
                    <span>Total:</span>
                    <span id="cart-total-price">$0.00</span>
                </div>
                <button class="btn btn-primary btn-block">Proceder al Pago</button>
            </div>
        </aside>
    </div>
</div>