<?php

require_once(ABSPATH . 'wp-admin/includes/post.php');

class ContentSubmitter
{
    public static function submit(ContentSubmission $submission)
    {
        if (!isset($submission)) {
            throw new Exception("submission isn't set");
        }

        // Validation
        if (!self::is_title_valid($submission->title))
            throw new InvalidSubmissionTitleException();
        if (!self::is_content_valid($submission->content))
            throw new InvalidSubmissionContentException();
        if (!self::is_creators_valid($submission->content))
            throw new InvalidSubmissionCreatorsException();
        if (self::is_title_in_use($submission->title))
            throw new SubmissionTitleExistsException();
        
        // Create post object
        $submission_post = array(
            'post_title' => $submission->title,
            'post_content' => $submission->content,
            'post_status' => 'publish',
            'post_author' => get_current_user_id(),
            'post_type' => 'content_submission'
        );

        $post_id = wp_insert_post($submission_post);

        update_post_meta($post_id, 'garchive_metabox_creators', $submission->creators);
        update_post_meta($post_id, 'garchive_metabox_source', $submission->source);

        return $post_id;
    }

    public static function is_title_in_use($title)
    {
        return post_exists($title);
    }

    public static function is_content_valid($content)
    {
        if (empty($content))
            return false;

        return true;
    }

    public static function is_creators_valid($creators)
    {
        if (empty($creators))
            return false;

        return true;
    }

    public static function is_title_valid($title)
    {
        if (empty($title))
            return false;

        return true;
    }
}

class ContentSubmission
{
    public $title;
    public $content;
    public $creators;
    public $source;

    public function __construct($title, $content, $creators, $source = '')
    {
        $this->title = trim(sanitize_text_field($title));
        $this->content = trim(self::sanitize_content($content));
        $this->creators = trim(sanitize_text_field($creators));
        $this->source = trim(esc_url($source));
    }

    private static function sanitize_content($title) {
        $allowd_title_tags = array(
            'h2' => array(),
            'h3' => array(),
            'h4' => array(),
            'h5' => array(),
            'h6' => array(),
            'ul' => array(),
            'li' => array(),
            'ol' => array(),
            'p' => array(),
            'a' => array(
                'href' => true,
                'title' => true,
            ),
            'abbr' => array(
                'title' => true,
            ),
            'acronym' => array(
                'title' => true,
            ),
            'b' => array(),
            'blockquote' => array(
                'cite' => true,
            ),
            'cite' => array(),
            'code' => array(),
            'del' => array(
                'datetime' => true,
            ),
            'em' => array(),
            'i' => array(),
            'q' => array(
                'cite' => true,
            ),
            'strike' => array(),
            'strong' => array(),
        );

        return wp_kses($title, $allowd_title_tags);
    }
}

class InvalidSubmissionTitleException extends Exception
{
}
class InvalidSubmissionContentException extends Exception
{
}
class InvalidSubmissionCreatorsException extends Exception
{
}

class SubmissionTitleExistsException extends Exception
{

}