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
    $loop = new WP_Query($args);
    while ($loop->have_posts()) : $loop->the_post();
        global $product;
    ?>
        <div>
            <?php if (has_post_thumbnail($loop->post->ID))
                echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
            ?>
        </div>

        <div>


            <h3>
                <?php the_title(); ?>
            </h3>
            <a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>">Read More</a>

        </div>

    <?php
    endwhile;
    wp_reset_query(); ?>

</div>