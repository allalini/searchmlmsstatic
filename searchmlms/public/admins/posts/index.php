<?php require_once('../../../private/initialize.php');
// check that the current user has admin user_level, otherwise redirect
/** @var $session */
if ($session->user_level != 'a') {
    redirect_to(url_for('/public/index.php'));
}

// Find all users
$posts = Post::find_all();

?>
<?php $page_title = 'Posts'; ?>
<?php require(SHARED_PATH . '/public_header.php'); ?>

<div>
    <div class="content">
        <h1>Edit Posts</h1>

        <table class="list">
            <tr>
                <th>Post ID</th>
                <th>User ID</th>
                <th>Post Date</th>
                <th>Post</th>
            </tr>

            <?php foreach($posts as $post) { ?>
                <tr class="admin-tables">
                    <td><?php echo h($post->id); ?></td>
                    <td><?php echo h($post->user_id); ?></td>
                    <td><?php echo h($post->post_date); ?></td>
                    <td><?php echo h($post->post_title); ?></td>
                    <td><a class="action" id="edit-post" href="<?php echo url_for('/public/admins/posts/edit.php?id=' . h(u($post->id))); ?>">Edit</a></td>
                </tr>
            <?php } ?>
        </table>

    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
