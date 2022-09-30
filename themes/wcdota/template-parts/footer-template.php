<div class="footer-container">
    <nav class="footer-nav">
        <div class="footer-nav-menu">
            <h2>Navigate</h2>
            <?php wp_nav_menu(array('theme_location' => 'footer-nav-menu')); ?>
        </div>
        <div class="footer-info-menu">
            <h2>Information</h2>
            <?php wp_nav_menu(array('theme_location' => 'footer-info-menu')); ?>
        </div>
    </nav>
    <div class="footer-name">
        <h2><?php echo get_bloginfo( 'name' ); ?></h2>
    </div>
</div>