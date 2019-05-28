<?php
session_start();
session_destroy();
header('location: http://localhost/MyOnlineStore/storeadmin/admin_login.php');
?>