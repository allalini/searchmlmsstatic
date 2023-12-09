<?php
require_once('../../../private/initialize.php');
include(SHARED_PATH . '/public_header.php');

$errors = [];
if (is_post_request()) {
    $mlm = new Mlm($_POST);
    $errors = $mlm->errors;
    if (empty($errors)) {
        $result = $mlm->save();

        if ($result === true) {
            /** @var $session */
            $session->message('The new entry was created successfully.');
            redirect_to(url_for('/public/admins/mlms/index.php'));
        } else {
            $errors = $mlm->errors;
        }
    }
}

?>
    <div id="new-mlm">
        <?php $page_title = 'Add Company'; ?>
        <h1>Add Company</h1>

        <?php display_errors($errors); ?>
        <form action="new.php" method="post" id="admin-pages">
            <label for="mlm_name">Company Name:</label><br/>
            <input type="text" required name="mlm_name" id="mlm_name"
                   value="<?= $_POST['mlm_name'] ?? '' ?>"><br/>

            <label for="is_mlm">Is MLM:</label>
            <div>
                <input type="radio" id="mlm-yes" name="is_mlm" value="1" checked/><label
                        for="mlm-yes">Yes</label></div>
            <div><input type="radio" id="mlm-no" name="is_mlm" value="0"/><label
                        for="mlm-no">No</label></div>

            <input type="submit" name="submit" class="admin-submit" value="Add MLM"/>
        </form>
    </div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>