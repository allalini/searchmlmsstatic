<?php
require_once('../../private/initialize.php');
include(SHARED_PATH . '/public_header.php');

$errors = [];
if (is_post_request()) {
    $user = new User($_POST);
    $errors = $user->validate();
    if (empty($errors)) {
        $result = $user->save();

        if ($result === true) {
            $new_id = $user->id;
            /** @var $session */
            $session->message('The user was created successfully.');
            redirect_to(url_for('/public/users/show.php?id=' . $new_id));
        } else {
            $errors = $user->errors;
        }
    }
}
?>
    <div id="signup">
        <?php $page_title = 'Sign up'; ?>
        <h1>Make an account</h1>

        <?php display_errors($errors); ?>
        <form action="signup.php" method="post" id="signup-form">
            <label for="user-first-name">First name:</label>
            <input type="text" required name="user_first_name" id="user-first-name" autocomplete="given_name"
                   value="<?= $_POST['user_first_name'] ?? '' ?>">
            <label for="user-last-name">Last name:</label>
            <input type="text" required name="user_last_name" id="user-last-name" autocomplete="family_name"
                   value="<?= $_POST['user_last_name'] ?? '' ?>">
            <label for="user-email">Email:</label>
            <input type="text" required id="user-email" name="user_email" value="<?= $_POST['user_email'] ?? '' ?>"/>
            <label for="password">Password:</label>
            <input type="password" required name="user_password" id="password"/>
            <label for="confirm-password">Confirm password:</label>
            <input type="password" required name="confirm_password" id="confirm-password" value=""/>
            <input type="submit" name="submit" id="signup-submit" value="Create account"/>
        </form>
    </div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>