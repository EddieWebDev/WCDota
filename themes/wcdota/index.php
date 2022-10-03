<?php get_header(); ?>

<?php the_content(); ?>
<div class="posts">
    <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <div class="post-block">
                <?php get_template_part("/template-parts/news-page"); ?>
            </div>
    <?php
        endwhile;
    endif; ?>
</div>

<?php get_footer(); ?>