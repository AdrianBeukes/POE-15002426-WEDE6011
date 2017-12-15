<?php
session_start();
?>
<?php
include "NavBar.html";
?>
<html>
<head>
<title>Admin Shop</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<h2 style = "text-align:center"> Online Admin Shop </h2> 
		<form name = "Shop" action = "shop.php" method = "post">
<?php

//calls method/class
include  "DBCon.php";         
          
          
//create table
     echo ("<Table>");
     
//create table headings
     echo ("<tr><th> Item ID </th><th> Description </th><th> CostPrice </th><th> Quantity </th><th> SellPrice</th><th>Image</th><th> cart </th><th> Add/Delete/Edit  </th><tr>");
     
//fills table
     for($a = 0; $a < 15; $a ++)
     {
             $imageID = $a + 1;
             
             $sql = "select * from tbl_Item where ItemID = '$imageID' ";
             
             $result = $DBConnect -> query($sql);
             
             if ($result -> num_rows > 0)
             {
             
                     while ( $row = $result -> fetch_assoc())
                     {
                             echo "<tr><td>" . $row ["ItemID"]. "</td><td>" . $row ["Description"]. "</td><td>" . $row ["CostPrice"]. "</td><td>" . $row ["Quantity"]. "</td><td>" . $row ["SellPrice"]. "</td><td><img style='width:50px;height:50px;' src ='images/$imageID.jpg'/>".
                             "</td>     <td><input type='submit' name = 'Submit' value = 'Add To Cart'onclick='getId(this)' /></td>   <td><input type='submit' name = 'Submit' value = 'ADD'/>    <input type='submit' name = 'Submit' value = 'DELETE'/>    <input type='submit' name = 'Submit' value = 'EDIT'/></td>        </tr>";
                     }
             }
     }
     echo ("</Table>");
        