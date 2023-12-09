<?php
require_once('../private/initialize.php');
include(SHARED_PATH . '/public_header.php');

$mlms = Mlm::find_all();
$posts = Post::find_all();

?>
<div id="forum-list">
    <h1 id="forum-h1">All MLMs &amp; Forums</h1>

    <?php
    foreach ($mlms as $mlm) { ?>
        <?php if ($mlm->is_mlm == 1) { ?>
            <div class="forum-links">

                <h3><?= $mlm->mlm_name; ?></h3>
                <?php
                $space = ' ';
                $good_space = '%20';
                $google_link = $mlm->mlm_name;
                ?>
                <a href="<?= (url_for('/public/forum.php?mlm_id=' . $mlm->mlm_id)) ?>">Go to forum</a>
                <a href="https://www.google.com/search?q=<?= str_replace($space, $good_space, $google_link); ?>"
                   target="_blank">Search in Google</a>
            </div>
        <?php }
    } ?>

    <button onclick="topFunction()" id="scroll-up" title="Go to top"><i class="fa-solid fa-arrow-up fa-xl"></i></button>

</div>
<?php include(SHARED_PATH . '/public_footer.php'); ?>
