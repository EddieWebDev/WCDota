<?php
$image = get_field("image");
$size = "full";
?>


<div class="hero-div">
    <?php if ($image) {
        echo wp_get_attachment_image($image, $size);
    } ?>
</div>