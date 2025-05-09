<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About ELJIN</h3>
                <p>Premium bakery offering fresh bread, cakes, and pastries since 1990. Quality and tradition in every bite.</p>
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                }
                ?>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class' => 'footer-menu',
                    'fallback_cb' => false,
                ));
                ?>
            </div>
            
            <div class="footer-section">
                <h3>Contact Info</h3>
                <ul>
                    <li>123 Bakery Street, City</li>
                    <li>Phone: +1 (555) 123-4567</li>
                    <li>Email: info@eljin-bakery.com</li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Business Hours</h3>
                <ul>
                    <li>Monday - Friday: 8:00 AM - 8:00 PM</li>
                    <li>Saturday: 9:00 AM - 9:00 PM</li>
                    <li>Sunday: 9:00 AM - 6:00 PM</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> ELJIN BWSUPERBAKESHOP. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>