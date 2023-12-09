<?php require_once('../../../private/initialize.php');
// check that the current user has admin user_level, otherwise redirect
/** @var $session */
if ($session->user_level != 'a') {
    redirect_to(url_for('/public/index.php'));
}

// Find all users
$users = User::find_all();

?>
<?php $page_title = 'Users'; ?>
<?php require(SHARED_PATH . '/public_header.php'); ?>

<div>
    <div class="content">
        <h1>Edit Users</h1>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>User level</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
            </tr>

            <?php foreach ($users as $user) { ?>
                <tr class="admin-tables">
                    <td><?php echo h($user->id); ?></td>
                    <td><?php echo h($user->user_level); ?></td>
                    <td><?php echo h($user->user_first_name); ?></td>
                    <td><?php echo h($user->user_last_name); ?></td>
                    <td><?php echo h($user->user_email); ?></td>
                    <td><a class="action" id="edit-user"
                           href="<?php echo url_for('/public/admins/users/edit.php?id=' . h(u($user->id))); ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
