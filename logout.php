<?php
session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();

header("Location: index.php");
?>



<!--<!DOCTYPE html>
<html>
<body>
<?php
// remove all session variables
session_unset();
// destroy the session
session_destroy();
header("Location: index.php");
?>
You have successfully logged out.<br>
<a href="index.php">Go back to Main Page</a>
</body>
</html>-->