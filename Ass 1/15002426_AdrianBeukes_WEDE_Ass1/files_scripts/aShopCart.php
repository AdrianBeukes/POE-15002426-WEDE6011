<?php
// Start the session
session_start();
?>
<?php
include "NavBar.html";
?>
<html>
<head>
<title>Login Form</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>


<?php
include "DBCon.php";

$order_array = $db_handle->runQuery("SELECT * FROM tbl_Order ORDER BY ItemID ASC");
if (!empty($order_array)) 
{ 
        foreach($order_array as $key=>$value)
        {
?>
<div class="product-item">
	<form method="post" action="index.php?action=add&code=<?php echo $order_array[$key]["code"]; ?>">
	<div class="product-image"><img src="<?php echo $order_array[$key]["image"]; ?>"></div>
	<div><strong><?php echo $order_array[$key]["name"]; ?></strong></div>
	<div class="product-price"><?php echo "$".$order_array[$key]["price"]; ?></div>
	<div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
	</form>
</div>

<?php
// when add button is pressed
case "add":
	if(!empty($_POST["quantity"])) 
        {
                $productByCode = $db_handle->runQuery("SELECT * FROM tbl_Order WHERE code='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
		if(!empty($_SESSION["cart_item"])) 
                {
			if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"])))
                        {
				foreach($_SESSION["cart_item"] as $k => $v) 
                                {
						if($productByCode[0]["code"] == $k)
                                                {
							if(empty($_SESSION["cart_item"][$k]["quantity"]))
                                                        {                
								$_SESSION["cart_item"][$k]["quantity"] = 0;
							}
							$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
						}
				}
			}
                        else 
                        {
				$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
			}
		}
                else 
                {
			$_SESSION["cart_item"] = $itemArray;
		}
	}
break;

//when removed button is pressed
case "remove":
	if(!empty($_SESSION["cart_item"]))
        {
		foreach($_SESSION["cart_item"] as $k => $v)
                {
			if($_GET["code"] == $k)	unset($_SESSION["cart_item"][$k]);				
			if(empty($_SESSION["cart_item"])) unset($_SESSION["cart_item"]);                                 
		}
	}
break;
case "empty":
        //empty sessions
	unset($_SESSION["cart_item"]);
break;


<?php }} ?>