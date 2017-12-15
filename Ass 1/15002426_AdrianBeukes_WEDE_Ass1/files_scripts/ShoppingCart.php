<?php
// Start the session
session_start();
?>
<?php
include "NavBar.html";
?>
<html>
<head>
<title>Shop</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<h2 style = "text-align:center"> Online Shop Cart</h2> 
		<form name = "ShoppingCart" action = "ShoppingCart.php" method = "post">

<?php

//calls method/class
include  "DBCon.php"; 

//create table
     echo ("<Table>");
     
//create table headings
     echo ("<tr><th> Item ID </th><th> Description </th><th> Price </th><th> Quantity </th><th> Total</th><th> Add/remove </th><tr>");
     
     
     
     echo ("</Table>");
   
if ($_SESSION['loggedIn'] =="true")
{
        echo "<a href=\"PayPal.php\">Checkout</a><br>"; 
}
else
{
        echo "checkout not available, login first";
        echo "<a href=\"login.php\">Login</a><br>"
}
echo "<a href=\"shop.php\">Cancel Order</a>";   


//else if (cancel is pressed)
        //{
        // drop database
        // then go back to shop 
        //}