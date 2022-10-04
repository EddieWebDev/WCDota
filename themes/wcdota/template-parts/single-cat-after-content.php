<?php
$args = array(
    "taxonomy" => "product_cat",
    "hide_empty" => false,
);

$categories = get_terms($args);
array_shift($categories);
shuffle( $categories );
$categories = array_slice( $categories, 0, 2 );

?>

<div class="categories-wrapper">

    <div class="categories-intro">
        <h2>
            Två andra kategorier
        </h2>
        <p>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
    </div>  

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
                        <div class="category-image">
                            <a href="<?php echo $term_link?>">
                                <img src="<?php echo $image; ?>" alt="">
                            </a>
                        </div>
                        <div class="category-text">
                            <h2 class="category-name"><?php echo $category->name?></h2>
                            <p class="category-description"><?php echo $category->description;?></p>
                            <a class="category-link" href="<?php echo $term_link?>">VIEW COLLECTION</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
    </div>
</div>