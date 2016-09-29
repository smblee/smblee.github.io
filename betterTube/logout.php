<?php
setcookie('loginCookieUser', null, -1, "/");
setcookie('loggedOut', 'yes', time() + 1, "/");
header("Location: include/loginHandler.php");
?>