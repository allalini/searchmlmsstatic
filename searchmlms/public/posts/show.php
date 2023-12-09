<?php
require_once('../../private/initialize.php');
include(SHARED_PATH . '/public_header.php');
/** @var $session */
if (!$session->is_logged_in()) {
    redirect_to(url_for('public/users/login.php?redirected=1'));
}

$is_admin = ($session->user_level == 'a');

$id = $_GET['post_id'] ?? '1';
$post = Post::find_by_id($id);
$comments = Comment::find_by_post_id($id);

function get_child_comments($parent_id, $comments) {
    global $is_admin;
    if (!empty($comments)) {
        foreach ($comments as $comment) {
            if ($comment->parent_comment_id == $parent_id) {
                ?>

                <div class="comment-and-reply-btn">
                    <p> <?= h($comment->user_comment) ?>
                        <span>By <?= h($comment->user_first_name) ?> <?= h($comment->user_last_name) ?></span></p>
                    <a href="<?= url_for('public/comments/new.php?post_id=' . $comment->post_id . '&parent_comment_id=' . $comment->comment_id) ?>"
                       class="replies">Reply</a>
                    <?php if ($is_admin) { ?>
                        <a href="<?= url_for('public/admins/comments/delete.php?id=' . $comment->comment_id) ?>">
                            Delete</a>
                    <?php } ?>
                </div>
                <div style='margin-left:1rem;'>
                    <?php get_child_comments($comment->comment_id, $comments); ?>
                </div>
                <?php
            }
        }
    } else {
        echo "<div>There are no comments yet. Yours could be the first!</div>";
    }
}

?>

    <!--// lookup the Post in the database w/ related comments (left join) and users (left join)-->

    <article class="single-post">
        <a class="back-link"
           href="<?php echo url_for('/public/posts.php'); ?>">&laquo; Back to
            Posts</a>
        <h1><?= h($post->post_title) ?></h1>
        <span>By <?= h($post->user_first_name) ?> <?= h($post->user_last_name) ?></span>
        <p><?= h($post->post) ?></p>
        <a href="<?= url_for('public/comments/new.php?post_id=' . $id) ?>" class="replies">Reply</a><br>
        <hr>
        <!-- recursively print comments-->
        <div id="comments">
            <?php get_child_comments(null, $comments) ?>
        </div>
    </article>

<?php
include(SHARED_PATH . '/public_footer.php');