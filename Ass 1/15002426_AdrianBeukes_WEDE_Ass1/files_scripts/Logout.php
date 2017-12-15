<?php
// Start the session
session_start();
?>
<?php
include "NavBar.html";
?>
<html>
<head>
<title>Logout Form</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<h2 style = "text-align:center">Online Shop Logout Form </h2> 

<?php
        session_unset();
        echo "<p> You have successfully Logged out </p>";