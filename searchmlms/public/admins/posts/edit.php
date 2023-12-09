<?php

require_once('../../../private/initialize.php');
// check that the current user has admin user_level, otherwise redirect
/** @var $session */
if ($session->user_level != 'a') {
    redirect_to(url_for('/public/index.php'));
}

if (!isset($_GET['id'])) {
    redirect_to(url_for('/public/admins/posts/index.php'));
}
$id = $_GET['id'];
$post = Post::find_by_id($id);
if (!$post) {
    redirect_to(url_for('/public/admins/posts/index.php'));
}
$errors = [];
if (is_post_request()) {

    // Save record using post parameters
    $post->merge_attributes($_POST);
    $result = $post->save();

    if ($result === true) {
        /** @var $session */
        $session->message('The post was updated successfully.');
        redirect_to(url_for('/public/admins/posts/index.php'));
    } else {
        $errors = $post->errors;
    }
}

?>

<?php $page_title = 'Edit post'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?><br>

<div class="user-edit">
    <a class="back-link" href="<?php echo url_for('/public/admins/posts/index.php'); ?>">&laquo; Back to List</a>

    <h1>Edit Post</h1>

    <?php display_errors($errors); ?>

    <form action="<?php echo url_for('/public/admins/posts/edit.php?id=' . h(u($id))); ?>" method="post" style="display: flex; flex-direction: column;">
        <label for="post_title">Post title:</label>
        <input type="text" required id="post_title" name="post_title" value="<?=$post->post_title ?? ''?>"/>
        <label for="post">Post:</label>
        <input type="text" required id="post" name="post" value="<?=$post->post ?? ''?>"/>
        <input type="submit" value="Save" class="admin-submit"/>

    </form>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>
