<?php get_header() ?>

<div class="container">
    <div id="postGrid">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post() ?>
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
            <?php endwhile; ?>
        <?php else: ?>
            <div class="text-center">
                <h1>Uhhh...</h1>
                <p>There are no posts to show right now! Check back later.</p>
            </div>
        <?php endif; ?>
    </div>
    <?php if (get_next_posts_link()): ?>
        <div class="text-center">
            <span class="gar-btn gar-load-more"><?php next_posts_link('Next Page'); ?></span>
        </div>
    <?php endif; ?>
</div>

<?php get_footer() ?>