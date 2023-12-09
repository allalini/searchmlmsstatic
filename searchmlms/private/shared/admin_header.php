<?php

$page = $_SERVER['REQUEST_URI'];
$page = explode('/', $page);
$page = end($page);
?>

<header>
    <nav id="admin-nav">
        <span><i class="fa-solid fa-screwdriver-wrench fa-beat fa-xl" style="color: #fff"></i>&nbsp; Admin Tools</span>
        <div class="user-dropdown">
            <button class="dropbtn" onclick="showUserDropdown()">Users</button>
            <ul class="dropdown-content" id="userDropdown">
                <li><a class="<?= $page == 'index.php' ? 'active' : '' ?>"
                       href="<?php echo url_for('/public/admins/users/index.php'); ?>">Edit Users</a></li>
                <li><a class="<?= $page == 'delete_users.php' ? 'active' : '' ?>"
                       href="<?php echo url_for('/public/admins/users/delete_users.php'); ?>">Delete Users</a></li>
            </ul>
        </div>

        <div class="post-dropdown">
            <button class="dropbtn" onclick="showPostDropdown()">Posts</button>
            <ul class="dropdown-content" id="postDropdown">
                <li><a class="<?= $page == 'index.php' ? 'active' : '' ?>"
                       href="<?php echo url_for('/public/admins/posts/index.php'); ?>">Edit Posts</a></li>
                <li><a class="<?= $page == 'posts_delete.php' ? 'active' : '' ?>"
                       href="<?php echo url_for('/public/admins/posts/posts_delete.php'); ?>">Delete Posts</a></li>
            </ul>
        </div>

        <div class="mlm-dropdown">
            <button class="dropbtn" onclick="showMlmDropdown()">MLMs</button>
            <ul class="dropdown-content" id="mlmDropdown">
                <li><a class="<?= $page == 'new.php' ? 'active' : '' ?>"
                       href="<?php echo url_for('/public/admins/mlms/new.php'); ?>">Add Company</a></li>
                <li><a class="<?= $page == 'index.php' ? 'active' : '' ?>"
                       href="<?php echo url_for('/public/admins/mlms/index.php'); ?>">Edit MLMs</a></li>
                <li><a class="<?= $page == 'mlms_delete.php' ? 'active' : '' ?>"
                       href="<?php echo url_for('/public/admins/mlms/mlms_delete.php'); ?>">Delete MLMs</a></li>
            </ul>
        </div>

    </nav>
</header>

<script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    // User dropdown menu
    function showUserDropdown() {
        document.getElementById("userDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.addEventListener('click', function (e) {
        if (!e.target.matches('.user-dropdown .dropbtn')) {
            let adminDropdown = document.getElementById("userDropdown");
            adminDropdown.classList.remove('show');
        }
    });

    // Post dropdown menu
    function showPostDropdown() {
        document.getElementById("postDropdown").classList.toggle("show");
    }

    window.addEventListener('click', function (e) {
            if (!e.target.matches('.post-dropdown .dropbtn')) {
                let adminDropdown = document.getElementById("postDropdown");
                adminDropdown.classList.remove('show');
            }
        }
    );

    // MLM dropdown menu
    function showMlmDropdown() {
        document.getElementById("mlmDropdown").classList.toggle("show");
    }

    // Close the dropdown if the post clicks outside of it
    window.addEventListener('click', function (e) {
            if (!e.target.matches('.mlm-dropdown .dropbtn')) {
                let adminDropdown = document.getElementById("mlmDropdown");
                adminDropdown.classList.remove('show');
            }
        }
    );
</script>