<!-- Calling php files-->
<?php
include('helpers.php');
include_once ('register.php');

check_post_only();
validate();
include('file_upload.php');

?>