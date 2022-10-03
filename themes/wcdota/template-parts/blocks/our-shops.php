<div class="shops">
    <h2 class="shops-header"><?= the_field("header"); ?> </h2>

    <section class="shops-section">
        <!-- looping through custom post type shop -->
        <div class="shops-array">
            <?php
            $args = array(
                'post_type' => 'shop',
                'posts_per_page' => 9
            );
            $the_query = new WP_Query($args); ?>

            <?php if ($the_query->have_posts()) : ?>

                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <div class="shop-container">

                        <h3 class="shop-name"><?php the_title(); ?></h3>

                        <?php the_content(); ?>

                    </div>
                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>

            <?php endif; ?>
        </div>
    </section>
</div>