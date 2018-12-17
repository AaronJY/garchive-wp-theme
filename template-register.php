<?php

/**
 * Template Name: Register
 */

require_once 'FormHelper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'RegistrationManager.php';

    $errors = array();

    if (!isset($_POST['username'])) 
        $errors[] = 'Your must provide a username!';

    if (!isset($_POST['email'])) 
        $errors[] = 'Your must provide an email!';

    if (!isset($_POST['password'])) 
        $errors[] = 'Your must provide a password!';

    if ($_POST['password'] !== $_POST['password_repeated']) {
        $errors[] = 'Your passwords do not match!';
    }

    if (count($errors) === 0) {
        try
        {
            RegistrationManager::register($_POST['username'], $_POST['email'], $_POST['password']);

            $success = true;
        }
        catch (InvalidPasswordException $ex)
        {
            $errors[] = 'Your password is invalid. Please ensure your password is ' . RegistrationManager::MIN_PASS_LENGTH . ' or more characters long';
        }
        catch (InvalidEmailException $ex)
        {
            $errors[] = 'Your email is invalid. Please submit a valid email address.';
        }
        catch (InvalidUsernameException $ex)
        {
            $errors[] = 'Your username is invalid. Please ensure your username is less than ' . RegistrationManager::MAX_USERNAME_LENGTH . ' characters long.';
        }
        catch (LoginTakenException $ex)
        {
            $errors[] = 'Your username or email address is already taken.';
        }
    }
}

get_header();

?>

<div class="container container-sm">
    <h1>Register</h1>
    <?php if (isset($success) && $success === true): ?>
        <div class="alert alert-success">Your account has been registered!</div>
    <?php endif; ?>

    <?php if (isset($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger"><?php echo sanitize_text_field($error) ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" required maxlength="40" value="<?php echo FormHelper::post_val('username') ?>" />
            <small class="form-text text-muted">Your usename will be visible to other users.</small>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required value="<?php echo FormHelper::post_val('email') ?>" />
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required />
        </div>

        <div class="form-group">
            <label for="username">Password (Repeated)</label>
            <input type="password" class="form-control" name="password_repeated" required />
        </div>

        <?php echo apply_filters('gglcptch_display_recaptcha', ''); ?>

        <input type="submit" class="gar-btn" value="Submit" />
    </form>
</div>

<?php get_footer(); ?>