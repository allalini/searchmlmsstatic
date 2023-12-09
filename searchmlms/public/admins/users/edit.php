<?php

require_once('../../../private/initialize.php');
// check that the current user has admin user_level, otherwise redirect
/** @var $session */
if ($session->user_level != 'a') {
    redirect_to(url_for('/public/index.php'));
}

if (!isset($_GET['id'])) {
    redirect_to(url_for('/public/admins/users/index.php'));
}
$id = $_GET['id'];
$user = User::find_by_id($id);
if (!$user) {
    redirect_to(url_for('/public/admins/users/index.php'));
}
$errors = [];
if (is_post_request()) {

    // Save record using post parameters
    $user->merge_attributes($_POST);
    $result = $user->adminUpdate();
    if ($result === true) {
        /** @var $session */
        $session->message('The user was updated successfully.');
        redirect_to(url_for('/public/admins/users/index.php'));
    } else {
        $errors = $user->errors;
    }
}

?>

<?php $page_title = 'Edit user'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?><br>

<div class="user-edit">
    <a class="back-link" href="<?php echo url_for('/public/admins/users/index.php'); ?>">&laquo; Back to List</a>

    <h1>Edit User</h1>

    <?php display_errors($user->errors); ?>

    <form action="<?php echo url_for('/public/admins/users/edit.php?id=' . h(u($id))); ?>" method="post" style="display: flex; flex-direction: column;">

        <label for="user-level">User level:</label>
        <select id="user-level" name="user_level">
            <option value="" ></option>
            <?php foreach (User::USER_LEVELS as $user_level) { ?>
                <option value="<?php echo $user_level; ?>" <?php if ($user->user_level == $user_level) {
                    echo 'selected';
                } ?>><?php echo $user_level; ?></option>
            <?php } ?>
        </select>

        <label for="user-first-name">First name:</label>
        <input type="text" required name="user_first_name" id="user-first-name" autocomplete="given_name" value="<?=$user->user_first_name ?? ''?>">
        <label for="user-last-name">Last name:</label>
        <input type="text" required name="user_last_name" id="user-last-name" autocomplete="family_name" value="<?=$user->user_last_name ?? ''?>">
        <label for="user-email">Email:</label>
        <input type="text" required id="user-email" name="user_email" value="<?=$user->user_email ?? ''?>"/>

        <input type="submit" value="Save" class="admin-submit"/>

    </form>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>
