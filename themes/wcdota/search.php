<?php get_header(); ?>

<header class="header">
</header>

<div>
    search.php
    <?php get_search_form(); ?>
</div>

<?php if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <div class="search-post">
            <h1><?php the_title(); ?></h1>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('full'); ?>
            </a>
            <p><?php the_excerpt(); ?></p>
        </div>
<?php endwhile;
else :
    _e('Inga resultat hittades.', 'textdomain');
endif; ?>

<?php get_footer();
