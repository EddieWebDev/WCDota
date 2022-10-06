<div class="random-products-container">
    <?php
        global $post; // setup_postdata will not work without this being set (outside of the foreach loop)

        $args = array(
            'posts_per_page'   => 1,
            'orderby'          => 'rand',
            'post_type'        => 'product' ); 

        $random_products = get_posts( $args );

        foreach ( $random_products as $post ) : setup_postdata( $post ); ?>
        <div class="random-product">
            <div class="random-product-text">
                <div class="random-product-title-small">
                    <h2></h2><?php the_title(); ?>
                </div>
                <div class="random-product-title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="random-product-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <div class="random-product-button-container">
                    <a class="random-product-link" href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>">Read More</a>
                </div>
            </div>

            <div class="random-product-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
                </div>
        <?php endforeach; 
        
        wp_reset_postdata();

        $random_products = get_posts( $args );

        foreach ( $random_products as $post ) : setup_postdata( $post ); ?>
        <div class="random-product">
            <div class="random-product-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>

            <div class="random-product-text">
                <div class="random-product-title-small">
                    <?php the_title(); ?>
                </div>
                <div class="random-product-title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="random-product-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <div class="random-product-button-container">
                    <a class="random-product-link" href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>">Read More</a>
                </div>
            </div>

            
                </div>
        <?php endforeach; 
        
        wp_reset_postdata();
    ?>
</div>