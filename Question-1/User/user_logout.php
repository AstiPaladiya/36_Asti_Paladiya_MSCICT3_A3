<?php
session_start();
session_destroy();
header("Location:User_login.php");
exit;
