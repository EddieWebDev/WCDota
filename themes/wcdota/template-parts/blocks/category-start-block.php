<?php
$args = array(
    "taxonomy" => "product_cat",
    "hide_empty" => false,
);

$categories = get_terms($args);
?>



<div class="categories-container">
        <?php
        foreach($categories as $category){
            if("Uncategorized" !== $category->name){
                $term_link = get_term_link($category, "product_cat");
                $term_id = $category->term_id;
                $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
                $image = wp_get_attachment_url( $thumbnail_id );
                ?>
                <div class="category">
                    <a href="<?php echo $term_link?>">
                        <img src="<?php echo $image; ?>" alt="">
                    </a>

                    <a href="<?php echo $term_link?>">
                        <h2><?php echo $category->name?></h2>
                    </a>
                    <p><?php echo $category->description;?></p>
                    <a class="category-link" href="/wcdota/product-category/<?php echo $category->slug; ?>">Read More</a>
                </div>
                <?php
            }
        }
        ?>
</div>

