<?php
require 'session_handler.php';
echo "Welcome User ID: " . $_SESSION['user_id'] . "<br>";
echo "Session ID: " . session_id();
?>
