<?php

/**
 * Template Name: Submit Content
 */

get_header();

require_once 'FormHelper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'ContentSubmitter.php';

    $errors = array();

    if (empty($_POST['title'])) 
        $errors[] = 'Your must provide a title.';

    if (empty($_POST['content'])) 
        $errors[] = 'Your must provide some content.';

    if (empty($_POST['creators'])) 
        $errors[] = 'You must provide the creators.';

    if (count($errors) === 0) {
        try
        {
            $submission = new ContentSubmission(
                $_POST['title'],
                $_POST['content'],
                $_POST['creators']
            );

            ContentSubmitter::submit($submission);

            $success = true;
        }
        catch (InvalidSubmissionTitleException $ex)
        {
            $errors[] = 'Your submission title is invalid. Please provide a title.';
        }
        catch (InvalidSubmissionContentException $ex)
        {
            $errors[] = 'Your submission title is invalid. Please provide some content.';
        }
        catch (InvalidSubmissionCreatorsException $ex)
        {
            $errors[] = 'Your submitted creators field is invalid. Please provide the creators.';
        }
        catch (SubmissionTitleExistsException $ex)
        {
            $errors[] = 'A post already exists with the name \'' . $submission->title . '\', please choose another.';
        }
    }
}

?>

<?php while(have_posts()): the_post() ?>

<div class="container">
    <h1><?php the_title() ?></h1>
    <div><?php the_content(); ?></div>
    <hr/>
    <?php if (isset($success) && $success === true): ?>
        <div class="alert alert-success">Thank you! Your submission is now with us. You will be notified of any updates to your submission via email.</div>
    <?php else: ?>
        <?php if (isset($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger"><?php echo sanitize_text_field($error) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control" required maxlength="30" />
                <small class="form-text text-muted">Please provide a short title. It may be no longer than 30 characters.</small>
            </div>

            <div class="form-group">
                <label for="content">Body</label>
                <div class="alert alert-info">
                <small>This is the main content of the submission. Please describe the content and provide any guides/sources.</small>
                </div>
                <textarea name="content" class="rte" required></textarea>
            </div>

            <div class="form-group">
                <label for="creators">Creators</label>
                <input type="text" name="creators" class="form-control" required></textarea>
                <small class="form-text text-muted">
                Provide a list of the original creators in a comma-separated format. For example: <i>Emera, Astram</i>
                </small>
            </div>

            <div class="form-group">
                <label for="source">Source</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-link"></i></div>
                    </div>
                    <input type="url" name="source" class="form-control" id="inlineFormInputGroupUsername" />
                </div>
                <small class="form-text text-muted">
                If applicable, please provide a link to the original source. For example, if your content was originally posted on a forum, you would enter the thread URL here.
                </small>
            </div>

            <div class="form-group">
                <input type="submit" class="gar-btn" value="Submit"/>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>