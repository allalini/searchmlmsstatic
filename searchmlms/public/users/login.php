<?php
/** @var $session */
require_once('../../private/initialize.php');
include(SHARED_PATH . '/public_header.php');

$errors = [];
$user_email = '';
$password = '';

if (is_post_request()) {

    $user_email = $_POST['user_email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validations
    if (is_blank($user_email)) {
        $errors[] = "Email cannot be blank.";
    }
    if (is_blank($password)) {
        $errors[] = "Password cannot be blank.";
    }

    // if there were no errors, try to log in
    if (empty($errors)) {
        $user = user::find_by_username($user_email);
        // test if user found and password is correct
        if ($user && $user->verify_password($password)) {
            // Mark user as logged in

            $session->login($user);
            redirect_to(url_for('/index.php'));

        } else {
            // username not found or password does not match
            $errors[] = "Login was unsuccessful.";
        }
    }
}

?>
<div id="login">
    <div id="login-style">
        <?php $page_title = 'Log in'; ?>
        <?php if (isset($_GET['redirected']) && $_GET['redirected'] == '1') { ?>
            <div role="alert">You must be signed in to access forum content.</div>
        <?php } ?>

        <h1>Log in</h1>
        <?php display_errors($errors); ?>

        <form action="login.php" name="login" method="post">
            <div>
                <label for="user-email">Email:</label>
                <input id="user-email" type="text" name="user_email" value="<?php echo h($user_email); ?>"/>
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" value=""/>
            </div>
            <div>
                <input type="submit" name="submit" id="login-button" value="Log in"/>
            </div>
        </form>

        <h2>Don't have an account? Click <a href="signup.php" id="signup-link">here</a> to sign up and join
            conversations about MLMs.
        </h2>
    </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
