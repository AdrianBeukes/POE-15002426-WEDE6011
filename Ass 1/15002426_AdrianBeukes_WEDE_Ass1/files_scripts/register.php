<?php
include "NavBar.html";
?>
<html>
<head>
<title>Register Form</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<h2 style = "text-align:center">Online Shop Register Form </h2> 
		<form name = "register" action = "register.php" method = "post">
			<label> First Name : </label><input type = "text" name="FName"/> <br> <br>
			<label> Last Name:  </label><input type = "text" name= "LName" /> <br> <br>
			<label> Email:  </label><input type = "text" name= "Email" /> <br> <br>
			<label> Password :</label><input type = "password" name = "Pass" /> <br> <br>
                        <label> Confirm Password :</label><input type = "password" name = "ConPass" />
			<p> <input type = "reset" value ="Clear Form"/>&nbsp;
			<p> <input type = "submit" name = "Submit" value = "Send Form" /> </p>
                </form>
</body>
</html>

<?php
// filling variables with information

if(isset($_POST["Submit"])) { 	
        $firsName = stripslashes ($_POST ['FName']);
	$lastName =stripslashes($_POST['LName']); 
	$EMail = stripslashes($_POST['Email']); 
	$pWord= stripslashes($_POST['Pass']);
        $ConPass = stripslashes($_POST['ConPass']);
        //$pHash = hash('sha512', $_POST['Pass']);     Hash kept breaking program, tried md5, sha256 as well, doesnt match login hash

//calls method/class
include "DBCon.php";
	
//compare string values to validation
        
 if (empty ($firstName =stripslashes($_POST['FName'])))
                 echo " <p>You need to enter your First Name<p> ";
 	 
 else  if (!preg_match ("/^([A-Za-z+])*$/i" , $firstName   ) )
	echo  "<p> Please only enter the letters A-Z or a-z  in the first name field </p>";
		
	
		 if (empty ($lastName =stripslashes($_POST['LName'])))
                        echo " <p>You need to enter your Last Name</p>  ";
                        
		 else if (!preg_match ("/^([A-Za-z+])*$/i" , $lastName   ) )
			echo  "<p> Please only enter the letters A-Z or a-z  in the Last Name  field </p>";
			 
		  if (empty ($Email =stripslashes($_POST['Email'])))
			echo "<p> You need to enter your Email Address </p>";
                        
		  else 
			if(filter_var($EMail,FILTER_VALIDATE_EMAIL) === false) // you are welcome to use this on
				echo  "<p> Please enter a valid E - mail address  </p>"; 
				
			if (empty ($pWord =stripslashes($_POST['Pass'])))
				 echo "<p> You need to enter your password </p>";
				
		  else 
			if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pWord))
				echo  "<p> Password is not valid, please try a different password, note password has to be 8 characters or longer </p>"; 
							
		  else if (strlen($pWord) > 8)
																		
							
//*** connect to databse , and insert values

                if ( $ConPass == $pWord)
                {
			$sql = "Insert into CustTest(FName, LName, Email, Pass) values ('$firsName', '$lastName', '$Email', '$pWord');";
			 //echo'1';
			//$QueryResult = mysqli_query ($DBConnect , $SQL);
			
			if ( mysqli_query($DBConnect,$sql) === TRUE) 
                        {
                            echo "Registration completed";
                        } 
                        else 
                        {
                            echo "Registration failed, please try again";
                        }
	
		}
                else
                {
                        echo " <p> Passwords did not match </p>";
                }
                  
        }
                        
?>                 		  
