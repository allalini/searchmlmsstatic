<?php
/** @var $database */
db_disconnect($database);
display_session_message();

?>
<footer>
    <a class="footer-img" href="<?=url_for("/index.php")?>"><img src="<?= url_for('images/logo-dark.120.png') ?>" alt="search mlms logo" ></a>
    <ul>
        <li>Links</li>
<!--        <li><a href="#">Account settings</a></li>-->
        <li><a href="https://www.reddit.com/r/antiMLM/" target="_blank">Anti-MLM Reddit <i class="fa-solid fa-arrow-up-right-from-square fa-xs"></i></a></li>
        <li><a href="https://www.youtube.com/results?search_query=mlms" target="_blank">YouTube <i class="fa-solid fa-arrow-up-right-from-square fa-xs"></i></a></li>
        <li><a href="https://mlmtruth.org/help/" target="_blank">Get help <i class="fa-solid fa-arrow-up-right-from-square fa-xs"></i></a></li>
    </ul>

    <p>Copyright &copy; 2023 Search MLMs</p>
</footer>
<script src="<?= url_for('public/js/main.js')?>"></script>
</body>
</html>
