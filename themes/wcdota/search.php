<?php get_header(); ?>

<header class="header">
</header>
<section>
    <div class="search-div">
        <h2 class="search-header">Sök</h2>
        <span>Vad letar du efter?</span>
        <?php get_search_form(); ?>
    </div>
    <div class="productsearch-results">
        <h4 class="productsearch-header">Resultat</h4>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="search-post">
                    <h3>
                        <?php the_title(); ?>
                    </h3>
                    <p>
                        <?php the_excerpt(); ?>
                    </p>
                    <a class="search-link" href="<?php the_permalink(); ?>">
                        VIEW COLLECTION
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else :
            _e('Inga resultat hittades.', 'textdomain'); ?>
        <?php endif; ?>
    </div>
</section>
<?php get_footer();
