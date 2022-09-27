<?php

/* One random product suggestion */
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 1,
    'orderby'          => 'rand',
);
?>
<div class="product-suggestion">
    <?php
    $product_suggestion = new WP_Query($args);
    while ($product_suggestion->have_posts()) : $product_suggestion->the_post();
        global $product;
    ?>
        <div class="suggestion-img">
            <?php if (has_post_thumbnail($product_suggestion->post->ID))
                echo get_the_post_thumbnail($product_suggestion->post->ID);
            ?>
        </div>

        <div class="suggestion-text">
            <h3>
                <?php the_title(); ?>
            </h3>
            <a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>">Read More</a>
        </div>

    <?php
    endwhile;
    wp_reset_query(); ?>

</div>