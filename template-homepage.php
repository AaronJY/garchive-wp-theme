<?php
    /**
     * Template Name: Homepage
     */
?>

<?php

    $posts = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'post'
    ));

?>

<?php get_header() ?>

<div class="container">
    <div id="postGrid">
        <?php if ($posts): while ($posts->have_posts()): $posts->the_post() ?>
            <div class="gar-post-box">
                <a href="<?php the_permalink() ?>">
                    <h3 class="gar-post-box-title"><?php the_title() ?></h3>
                </a>
                <div class="gar-post-box-excerpt"><?php the_excerpt() ?></div>

                <?php
                    $creators = GarchiveHelpers::get_creators();
                ?>
                <?php if ($creators): ?>
                    <div class="gar-post-box-author"><i class="fa fa-paint-brush" data-toggle="tooltip" title="Creators"></i>&nbsp;<?php echo $creators ?></div>
                <?php endif; ?>

                <div class="gar-post-box-category"><?php the_category(', ') ?></div>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>


<?php get_footer() ?>