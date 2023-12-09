<?php

require_once('../../../private/initialize.php');
require(SHARED_PATH . '/public_header.php');

// check that the current user has admin user_level, otherwise redirect
/** @var $session */
if ($session->user_level != 'a') {
    redirect_to(url_for('/public/index.php'));
}


if (!isset($_GET['id'])) {
    redirect_to(url_for('/public/admins/users/delete_users.php'));
}

$id = $_GET['id'];
$user = User::find_by_id($id);
if (!$user) {
    redirect_to(url_for('/public/admins/users/delete_users.php'));
}

if (is_post_request()) {

    // Delete user
    $result = $user->delete();
    $_SESSION['message'] = 'The user was deleted successfully.';
    redirect_to(url_for('/public/admins/users/delete_users.php'));

}

?>

<?php $page_title = 'Delete User'; ?>
<div id="delete">

    <a class="back-link" href="<?php echo url_for('/public/admins/users/delete_users.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Delete User</h1>
        <p>Are you sure you want to delete this user?</p>
        <p class="item"><?php echo h($user->full_name()); ?></p>

        <form action="<?php echo url_for('/public/admins/users/delete.php?id=' . h(u($id))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete User" class="admin-submit"/>
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
