<?php

class ContentSubmitter
{
    public static function submit(ContentSubmission $submission)
    {
        if (!isset($submission)) {
            throw new Exception("submission isn't set");
        }

        // Validation
        if (self::is_title_valid($submission->title))
            throw new InvalidSubmissionTitleException();
        if (self::is_content_valid($submission->content))
            throw new InvalidSubmissionContentException();
        if (self::is_creators_valid($submission->content))
            throw new InvalidSubmissionCreatorsException();
        if (self::is_title_in_use($submission->title))
            throw new SubmissionTitleExistsException();
        
        // Create post object
        $submission_post = array(
            'post_title' => $submission->title,
            'post_content' => $submission->content,
            'post_status' => 'publish',
            'post_author' => get_current_user_id()
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
        return false;
    }
}

class ContentSubmission
{
    public $title;
    public $content;
    public $creators;
    public $source;

    public function __construct($title, $content, $creators, $source)
    {
        $this->title = trim(wp_strip_all_tags($title));
        $this->content = trim(esc_html($content));
        $this->creators = trim(sanitize_text_field($creators));
        $this->source = trim(esc_url($source));
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