<?php get_header(); ?>

<header class="header">
</header>

<div>
    search.php
    <?php get_search_form(); ?>
</div>

<?php if (have_posts()) :
    while (have_posts()) : the_post();
    // Your loop code
    endwhile;
else :
    _e('Inga resultat hittades.', 'textdomain');
endif; ?>

<?php get_footer();
