<?php

require_once('../../../private/initialize.php');
// check that the current user has admin user_level, otherwise redirect
/** @var $session */
if ($session->user_level != 'a') {
    redirect_to(url_for('/public/index.php'));
}

if (!isset($_GET['id'])) {
    redirect_to(url_for('/public/admins/mlms/index.php'));
}
$id = $_GET['id'];
$mlm = Mlm::find_by_id($id);
if (!$mlm) {
    redirect_to(url_for('/public/admins/mlms/index.php'));
}
$errors = [];
if (is_post_request()) {

    // Save record using post parameters
    $mlm->merge_attributes($_POST);
    $result = $mlm->save();

    if ($result === true) {
        /** @var $session */
        $session->message('The entry was updated successfully.');
        redirect_to(url_for('/public/admins/mlms/index.php'));
    } else {
        $errors = $mlm->errors;
    }
}

?>

<?php $page_title = 'Edit MLM'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?><br>

<div class="user-edit">
    <a class="back-link" href="<?php echo url_for('/public/admins/mlms/index.php'); ?>">&laquo; Back to List</a>

    <h1>Edit MLM</h1>

    <?php display_errors($errors); ?>
    <form action="<?php echo url_for('/public/admins/mlms/edit.php?id=' . h(u($id))); ?>" method="post"
          style="display: flex; flex-direction: column;">
        <label for="mlm_name">MLM Name:</label>
        <input type="text" required id="mlm_name" name="mlm_name" value="<?= $mlm->mlm_name ?? '' ?>"/>

        <label for="is-mlm">Is MLM:</label>
        <div>
            <input type="radio" id="mlm-yes" name="is_mlm" value="1" <?= $mlm->is_mlm == "1" ? 'checked' : '' ?>/><label
                    for="mlm-yes">Yes</label></div>
        <div><input type="radio" id="mlm-no" name="is_mlm" value="0" <?= $mlm->is_mlm == "0" ? 'checked' : '' ?>/><label
                    for="mlm-no">No</label></div>
        <input type="submit" value="Save" class="admin-submit"/>

    </form>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>
