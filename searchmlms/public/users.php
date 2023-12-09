<?php require_once('../private/initialize.php');

$users = User::find_all();

foreach ($users as $user) { ?>

    <?= h($user->user_id); ?>
    <?= h($user->user_level); ?>
    <?= h($user->user_first_name); ?>
    <?= h($user->user_last_name); ?>
    <?= h($user->user_email); ?>
    <?= h($user->bio); ?>

<?php } ?>

