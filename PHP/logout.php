<?php
session_start();
session_destroy();
header('Location: /Meets-main/view/login.php');
exit;
