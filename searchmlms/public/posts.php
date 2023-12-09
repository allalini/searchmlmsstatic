<?php
require_once('../private/initialize.php');
include(SHARED_PATH . '/public_header.php');
/** @var $session */
if (!$session->is_logged_in()) {
    redirect_to(url_for('public/users/login.php?redirected=1'));
}

$mlms = Mlm::find_all();
$posts = Post::find_recent();
?>

<h1 id="forum-h1">Recent Posts on Search MLMs</h1>

<div class="posts-list">
    <?php foreach ($posts as $post) { ?>
        <article>
            <a href="<?= url_for('/public/forum.php?mlm_id=' . $post->mlm_id) ?>" class="mlm-link">
                <?= $post->mlm_name ?>
            </a>
            <h1 class="recent-titles"><?php echo h($post->post_title) ?></h1>
            <p class="recent-post"><?php echo h($post->post) ?></p>
            <a href="<?= url_for('public/posts/show.php?post_id=' . $post->post_id) ?>" class="view-comments">
                View with comments
            </a>
        </article>
    <?php } ?>
</div>
<?php include(SHARED_PATH . '/public_footer.php'); ?>
