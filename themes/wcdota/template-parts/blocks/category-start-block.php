<?php
$args = array(
    "taxonomy" => "product_cat",
    "hide_empty" => false,
);

$categories = get_terms($args);
?>



<div>
    <div>
        <?php
        foreach($categories as $category){
            if("Uncategorized" !== $category->name){
                //var_dump($category);
                $term_link = get_term_link($category, "product_cat");
                $term_id = $category->term_id;
                $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
                var_dump($thumbnail_id);
                $image = wp_get_attachment_url( $thumbnail_id );
                var_dump($image);
                echo "<img src='{$image}' alt='' width='762' height='365' />";
                ?>
                    <a href="<?php echo $term_link?>">
                        <?php echo $category->name?>
                    </a> 
                <?php
                

            }
        }
        ?>
    </div>
</div>

