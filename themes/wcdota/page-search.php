<?php get_header(); ?>


<header class="header">
</header>

<div class="search-div">
    <h2 class="search-header">
        <?php the_title(); ?>
    </h2>
    <span>Vad letar du efter?</span>
    <?php get_search_form(); ?>
</div>

<?php get_footer(); ?>