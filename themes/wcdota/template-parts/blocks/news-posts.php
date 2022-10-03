<section class="news-section">
    <!-- looping through custom post type POSTS -->
    <div class="news-array">
        <?php
        $posts = get_field("number_of_posts");

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $posts
        );
        $the_query = new WP_Query($args); ?>

        <?php if ($the_query->have_posts()) : ?>

            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <div class="news-container">

                    <h3 class="news-name"><?php the_title(); ?></h3>

                    <?php the_content(); ?>

                </div>
            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
    </div>
</section>