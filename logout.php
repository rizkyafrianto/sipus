<?php
session_start();

// fungsi untuk menghilangkan session
session_unset();
session_destroy();

header("Location: login.php");
exit;
