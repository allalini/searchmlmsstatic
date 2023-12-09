<?php require_once('../../private/initialize.php');
include(SHARED_PATH . '/public_header.php');

$id = $_GET['post_id'] ?? '1';
$post_id = $_REQUEST['post_id'] ?? '1';
$parent_comment_id = $_REQUEST['parent_comment_id'] ?? '';
$post = Post::find_by_id($id);

if (is_post_request()) {
    /** @var $session */
    $user_id = $session->user_id;
    $_POST['user_id'] = $user_id;
    $comment = new Comment($_POST);
    $result = $comment->save();

    if ($result === true) {
        $new_id = $comment->parent_comment_id;
        /** @var $session */
        $session->message('The comment was created successfully.');
        redirect_to(url_for('/public/posts/show.php?post_id=' . $post_id));
    }
}
?>

<h1 id="reply-heading">Replying in thread: <?php echo h($post->post_title) ?></h1>
<form method="post" action="<?= url_for('public/comments/new.php') ?>" id="comment-form">
    <input type="hidden" name="post_id" value="<?= $post_id ?>"/>
    <input type="hidden" name="parent_comment_id" value="<?= $parent_comment_id ?>"/>
    <label for="comment"></label>
    <textarea rows="10" name="user_comment" cols="80" style="vertical-align: top;"
              wrap="soft" id="comment" required></textarea>
    <button type="submit" id="submit-button" style="">Submit</button>
</form>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
