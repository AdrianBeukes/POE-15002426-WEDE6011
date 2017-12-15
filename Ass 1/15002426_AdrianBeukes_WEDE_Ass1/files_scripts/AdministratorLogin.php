<?php
// Start the session
session_start();
?>
<?php
include "NavBar.html";
?>
<html>
<head>
<title>Admin Login Form</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<h2 style = "text-align:center">Online Shop Administrator Login Form </h2> 
		<form name = "Adminlogin" action = "AdministratorLogin.php" method = "post">
			<label> Email:  </label> <input type = "text" name= "Email" required /> <br><br>
			<label> Password :</label> <input type = "password" name = "Pass" required />
			<p> <input type = "reset" value ="Clear Form"/>&nbsp;
			<p> <input type = "submit" name = "Submit" value = "Send Form" /> </p>
                </form>


<?php

//getsinformationin variables

if(isset($_POST["Submit"])) {	
	$Email = stripslashes($_POST['Email']); 
	$pWord= stripslashes($_POST['Pass']);
        //$pHash = hash('sha512', $_POST['Pass']);     Hash kept breaking program, tried md5, sha256 as well, doesnt match register hatch
        
        
// calls class/method

include "DBCon.php";
	
      
                //validation of users entry, matching it to database
                
			$SQL = "SELECT Email FROM CustTest WHERE Email  = '$Email' AND Pass = '$pWord'";
			
			$QueryResult = mysqli_query ($DBConnect , $SQL);
                       
                        $row = mysqli_fetch_array($QueryResult, MYSQLI_ASSOC); 
                       
                       $active = $row['active'];
                        
                        $count = mysqli_num_rows($QueryResult);
                        
			if ($count == 1) 
			{
				echo "<p> Welcome back </p>\n ".
                                        "<p> You now have access to admin privelages</p>\n ".
                                        "<a href=\"Adminshop.php\">Click here to Enter the Admin shop for editing the items</a>";
                                // Set session variables
                                $_SESSION['AdminLoggedIn'] = "true";
                                $_SESSION['AdminEmail'] = $Email;
                                $_SESSION['loggedIn'] = "true";
                                $_SESSION['Email'] = $Email;
			} 
			
			else 
			{
				echo " <p>Your credentials did not match any entries in our Admin Database </p>\n";
			}
           }            
?>                 		  
</body>
</html>