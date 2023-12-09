<?php require_once('../../private/initialize.php');
include(SHARED_PATH . '/public_header.php');

$mlm_id = $_REQUEST['mlm_id'] ?? '1';

if (is_post_request()) {
    /** @var $session */
    $user_id = $session->user_id;
    $_POST['user_id'] = $user_id;
    $post = new Post($_POST);
    $result = $post->save();

    if ($result === true) {
        $new_id = $post->post_id;
        /** @var $session */
        $session->message('The post was created successfully.');
        redirect_to(url_for('/public/posts/show.php?post_id=' . $new_id));
    }
}
?>

<form method="post" action="<?= url_for('public/posts/new.php') ?>">
    <input type="hidden" name="mlm_id" value="<?= $mlm_id ?>"/>
    <label for="post-title"></label><input type="text" name="post_title" placeholder="Post Title"
                                             id="post-title"
                                             style="display: none;" required>
    <label for="post-body"></label>
    <textarea rows="10" name="post" cols="80" style="vertical-align: top; display:none;"
                                               wrap="soft" id="post-body" required></textarea>
    <button type="submit" id="submit-button" style="display: none;">Submit</button>
</form>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
