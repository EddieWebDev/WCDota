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
            <p class="suggestion-topic">Hot right now</p>

            <h3 class="suggestion-title">
                <?php the_title(); ?>
            </h3>

            <!-- displaying sale price in red -->
            <?php if ($product) :
                $price = $product->get_regular_price();
                $sale_price = $product->get_sale_price();
                if ($sale_price) : ?>
                    <div>
                        <span class="suggestion-price overwritten">
                            <?php echo $price ?> SEK
                        </span>
                        <span class="discount-price">
                            <?php echo $sale_price ?> SEK
                        </span>
                    </div>
                <?php else : ?>
                    <p class="suggestion-price">
                        <?php echo $product->get_price(); ?> SEK
                    </p>
                <?php endif; ?>
            <?php endif ?>

            <div class="suggestion-description"> <?php the_excerpt(); ?> </div>
            <a class="suggestion-link" href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>">Read More</a>
        </div>

    <?php
    endwhile;
    wp_reset_query(); ?>

</div>