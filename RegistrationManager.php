<?php

class RegistrationManager
{
    const MIN_PASS_LENGTH = 8;
    const MAX_USERNAME_LENGTH = 40;

    public static function register($username, $email, $password)
    {
        // Sanitize
        $username_safe = sanitize_text_field($username);
        $email_safe = sanitize_email($email);

        // Validate inputs
        if (!self::is_valid_password($password))
            throw new InvalidPasswordException();
        if (!self::is_valid_email($email))
            throw new InvalidEmailException();
        if (!self::is_valid_username($username))
            throw new InvalidUsernameException();
        
        // Check for used data
        if (self::is_email_taken($email_safe))
            throw new LoginTakenException('Username is already taken.');
        if (self::is_username_taken($username_safe))
            throw new LoginTakenException('Email is already taken.');

        $userdata = array(
            'user_login' => $username_safe,
            'user_pass' => $password,
            'user_email' => $email_safe,
            'role' => 'subscriber'
        );

        $user_id = wp_insert_user($userdata);

        return $user_id;
    }

    public static function is_username_taken($username)
    {
        if (username_exists($username))
            return true;

        return false;
    }

    public static function is_email_taken($email)
    {
        if (email_exists($email))
            return true;

        return false;
    }

    public static function is_valid_password($password)
    {
        if (strlen($password) < self::MIN_PASS_LENGTH)
            return false;

        return true;
    }

    public static function is_valid_email($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public static function is_valid_username($username)
    {
        if (strlen($username) > self::MAX_USERNAME_LENGTH)
            return false;

        return true;
    }
}

class LoginTakenException extends Exception
{
}

class InvalidPasswordException extends Exception
{
}

class InvalidEmailException extends Exception
{
}

class InvalidUsernameException extends Exception
{
}