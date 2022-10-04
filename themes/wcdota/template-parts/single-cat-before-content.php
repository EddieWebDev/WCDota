<div class="single-cat-intro">
    <h2><?php single_term_title();?></h2>
    <?php
        global $post;
        $args  = array(
            'taxonomy' => 'product_cat'
        );
        $terms = wp_get_post_terms($post->ID, 'product_cat', $args);
        $count = count($terms);
        if ($count > 0) {

            foreach ($terms as $term) {
                echo "<p class='single-cat-intro-description'>";
                echo $term->description;
                echo "</p>";

            }
        }
        ?>  
</div>