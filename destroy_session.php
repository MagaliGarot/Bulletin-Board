<?php

// We overwrite the session table
$_SESSION = array();


// destroy cookies session if used
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// destroy the session
session_destroy();

// back to index
header('Location: index.php');
exit();
?>
