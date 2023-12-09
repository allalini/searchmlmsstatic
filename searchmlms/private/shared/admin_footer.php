<?php
/** @var $database */
db_disconnect($database);
display_session_message();

?>
<footer>
  &copy; <?php echo date('Y'); ?> Search MLMs
</footer>
<script src="<?= url_for('public/js/main.js')?>"></script>
</body>
</html>

