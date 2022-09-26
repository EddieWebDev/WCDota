<nav id="header-nav">
    <?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
    <div class="header-title">
        <h1 class="site-name">
            <?php echo get_bloginfo( 'name' ); ?>
        </h1>
    </div>
</nav>