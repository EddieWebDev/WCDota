<div class="our-vision">
    <div class="vision-header-div">
        <h3 class="vision-header">
            <?php the_field("header"); ?>
        </h3>
    </div>
    <div class="vision-text">
        <p>
            <?php the_field("text"); ?>
        </p>
    </div>

    <?php
    $link = get_field("link");
    if ($link) :
        $link_url = $link["url"];
        $link_title = $link["title"]; ?>
        <div class="vision-button-div">
            <a class="vision-button" href="<?= $link_url ?>">
                <?= $link_title ?>
            </a>
        </div>
    <?php endif; ?>

</div>