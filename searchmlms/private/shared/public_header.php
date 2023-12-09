<?php


$page = $_SERVER['REQUEST_URI'];
$page = explode('/', $page);
$page = end($page);
?>

<!doctype html>

<html lang="en">

<head>
    <title>Search MLMs <?php if (isset($page_title)) {
            echo '- ' . h($page_title);
        } ?></title>
    <link rel="stylesheet" media="all" href="<?php echo url_for('/styles/styles.css'); ?>"/>

    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/x-icon" href=<?= url_for("/favicon.ico") ?>>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/02db314e57.js" crossorigin="anonymous"></script>
</head>

<body>
<?php if ($page == 'index.php') { ?>
    <a href="#mlm-search" id="skip-link">Skip to search</a>
    <?php
}

/** @var $session */
if ($session->user_level == 'a') {
    require(SHARED_PATH . '/admin_header.php');
}
?>
<header>
    <input id="nav-box" type="checkbox">
    <label for="nav-box" id="nav-trigger">Menu</label>
    <div id="nav-collapse">
        <nav>

            <a href="<?= url_for('/public/index.php') ?>" id="logo-link"><img
                        src="<?= url_for('images/logo.120.png') ?>" id="logo" alt="search mlms logo"></a>
            <ul>
                <li class="mobile-home"><a href="<?= url_for('/public/index.php') ?>">Home</a></li>
                <li><a class="<?= $page == 'mlms.php' ? 'active' : '' ?>" href="<?= url_for('/public/mlms.php') ?>">All
                        MLMs</a></li>
                <li><a class="<?= $page == 'posts.php' ? 'active' : '' ?>" href="<?= url_for('/public/posts.php') ?>">Recent
                        Posts</a></li>
                <li><a href="<?= url_for('/public/index.php') ?>" id="home-logo">
                        <img src="<?= url_for('images/logo-light.120.png') ?>" alt="search mlms logo"/></a>
                </li>
                <li><a href="https://consumer.ftc.gov/articles/multi-level-marketing-businesses-pyramid-schemes"
                       target="_blank">FTC Article <i class="fa-solid fa-arrow-up-right-from-square fa-xs"></i></a>
                </li>
                <li>
                    <?php
                    /** @var $session */
                    if ($session->user_first_name) { ?>
                    <a class="<?= $page == 'logout.php' ? 'active' : '' ?>"
                       href="<?= url_for('/public/users/logout.php') ?>" id="login-link">
                        Logout <?= h($session->user_first_name) ?></a><?php
                    }
                    else { ?>
                    <a class="<?= $page == 'login.php' ? 'active' : '' ?>"
                       href="<?= url_for('/public/users/login.php') ?>" id="login-link">Login</a></li>
                <?php }
                ?>
            </ul>
        </nav>
    </div>
</header>
