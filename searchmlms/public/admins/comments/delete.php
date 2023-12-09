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
$comment = Comment::find_by_id($id);
if (!$comment) {
    redirect_to(url_for('/public/index.php'));
}

if (is_post_request()) {

    // Delete comment
    $result = $comment->delete();
    $_SESSION['message'] = 'The comment was deleted successfully.';
    redirect_to(url_for('/public/posts/show.php?post_id=' . $comment->post_id));

}

?>

<?php $page_title = 'Delete Comment'; ?>
<div id="delete">

    <a class="back-link" href="<?php echo url_for('/public/posts/show.php?post_id=' . $comment->post_id); ?>">&laquo; Back to Post</a>

    <div>
        <h1>Delete Comment</h1>
        <p>Are you sure you want to delete this comment?</p>
        <p class="item"><?php echo h($comment->user_comment); ?></p>

        <form action="<?php echo url_for('/public/admins/comments/delete.php?id=' . h(u($id))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete comment" class="admin-submit"/>
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
