<?php
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

<h2 style = "text-align:center"> Online Shop </h2> 
		<form name = "Shop" action = "shop.php" method = "post">
<?php

//calls method/class
include  "DBCon.php";         
          
          
//create table
     echo ("<Table>");
     
//create table headings
     echo ("<tr><th> Item ID </th><th> Description </th><th> CostPrice </th><th> Quantity </th><th> SellPrice</th><th>Image</th><th> cart </th><tr>");
     
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
                             echo "<tr><td>" . $row ["ItemID"]. "</td><td>" . $row ["Description"]. "</td><td>" . $row ["CostPrice"]. "</td><td>" . $row ["Quantity"]. "</td><td>" . $row ["SellPrice"]. "</td><td><img style='width:50px;height:50px;' src ='images/$imageID.jpg'/>"."</td>     <td><input type='submit' name = 'Submit' value = 'Add To Cart'onclick='getId(this)' /></td>           </tr>";
                     }
             }
     }
     echo ("</Table>");
     
if ($_SESSION['loggedIn'] == "true")
{
        echo "<a href=\"ShoppingCart.php\">Click me to Go to Cart Checkout</a>";
}     
else
{
        echo "You must login first before you can visit your cart for checkout";
        echo "<a href=\"login.php\">Login</a>"
}
        
?>


<script>

function  getId(element) {

//var n=document.getElementById(element).childNodes[3].value;
    //var p=document.getElementById(element).childNodes[4].value;
    // alert("n="+n);
    //alert("p="+p);
 var name = element.parentNode.parentNode.innerText;
 var res  = name.split(" ");
   alert(name);
  
   //element.getElementById(' ');
   
   
}

</script>
                
                
                
                
                
                
                
                
                
                
