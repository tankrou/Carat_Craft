<?php
session_start();

//Clear all sessions that have been created
session_unset();

//Destroy all sessions
session_destroy();
$_SESSION = array();

//Direct back to sign in page
header("Location: index.php");
?>