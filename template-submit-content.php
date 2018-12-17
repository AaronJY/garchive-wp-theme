<?php

/**
 * Template Name: Submit Content
 */

get_header();

?>

<?php while(have_posts()): the_post() ?>

<div class="container">
    <h1><?php the_title() ?></h1>
    <div><?php the_content(); ?></div>
    <hr/>
    <form action="">
        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" required maxlength="30" />
            <small class="form-text text-muted">Please provide a short title. It may be no longer than 30 characters.</small>
        </div>

        <div class="form-group">
            <label for="title">Body</label>
            <div class="alert alert-info">
               <small>This is the main content of the submission. Please describe the content and provide any guides/sources.</small>
            </div>
            <textarea name="content" class="rte" required></textarea>
        </div>

         <div class="form-group">
            <label for="title">Creators</label>
            <input type="text" name="creators" class="form-control" required></textarea>
            <small class="form-text text-muted">
               Provide a list of the original creators in a comma-separated format. For example: <i>Emera, Astram</i>
            </small>
        </div>

        <div class="form-group">
            <label for="title">Source</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-link"></i></div>
                </div>
                <input type="url" name="creators" class="form-control" id="inlineFormInputGroupUsername" />
            </div>
            <small class="form-text text-muted">
               If applicable, please provide a link to the original source. For example, if your content was originally posted on a forum, you would enter the thread URL here.
            </small>
        </div>

        <div class="form-group">
            <button type="submit" class="gar-btn">Submit</button>
        </div>
    </form>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>