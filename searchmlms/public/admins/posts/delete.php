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
$post = Post::find_by_id($id);
if (!$post) {
    redirect_to(url_for('/public/index.php'));
}

if (is_post_request()) {

    // Delete post
    $result = $post->delete();
    $_SESSION['message'] = 'The post was deleted successfully.';
    redirect_to(url_for('/public/admins/posts/posts_delete.php'));

}

?>

<?php $page_title = 'Delete Post'; ?>
<div id="delete">

    <a class="back-link" href="<?php echo url_for('/public/admins/posts/posts_delete.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Delete Post</h1>
        <p>Are you sure you want to delete this post?</p>
        <p class="item"><?php echo h($post->post_title); ?></p>

        <form action="<?php echo url_for('/public/admins/posts/delete.php?id=' . h(u($id))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Post" class="admin-submit"/>
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
