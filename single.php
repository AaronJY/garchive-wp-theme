<?php get_header() ?>

<div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title() ?></h1>

        <?php
            $creators = GarchiveHelpers::get_creators();
            $source = GarchiveHelpers::get_source();
        ?>

        <div class="gar-post-subtitle">
            <?php if ($creators): ?>
                <p><i class="fa fa-paint-brush" data-toggle="tooltip" title="Creators"></i>&nbsp;<?php echo $creators ?></p>
            <?php endif; ?>

            <?php if ($source): ?>
                <p><i class="fa fa-link" data-toggle="tooltip" title="Source"></i>&nbsp;<a href="<?php echo $source ?>"><?php echo $source ?></a></p>
            <?php endif; ?>
        </div>

        <hr/>

        <?php the_content(); ?>
        
        <hr />
        <?php comments_template() ?>
	<?php endwhile; ?>
</div>

<?php get_footer() ?>