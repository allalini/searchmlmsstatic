<?php
require_once('../../../private/initialize.php');
require(SHARED_PATH . '/public_header.php');

// check that the current user has admin user_level, otherwise redirect
/** @var $session */
if ($session->user_level != 'a') {
    redirect_to(url_for('/public/index.php'));
}


if (!isset($_GET['id'])) {
    redirect_to(url_for('/public/index.php'));
}

$id = $_GET['id'];
$mlm = Mlm::find_by_id($id);
if (!$mlm) {
    redirect_to(url_for('/public/index.php'));
}

if (is_post_request()) {

    // Delete mlm
    $result = $mlm->delete();
    $_SESSION['message'] = 'The entry was deleted successfully.';
    redirect_to(url_for('/public/admins/mlms/mlms_delete.php'));

}

?>

<?php $page_title = 'Delete Entry'; ?>
<div id="delete">

    <a class="back-link" href="<?php echo url_for('/public/admins/mlms/mlms_delete.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Delete Entry</h1>
        <p>Are you sure you want to delete this Entry?</p>
        <p class="item"><?php echo h($mlm->mlm_name); ?></p>

        <form action="<?php echo url_for('/public/admins/mlms/delete.php?id=' . h(u($id))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete MLM" class="admin-submit"/>
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
