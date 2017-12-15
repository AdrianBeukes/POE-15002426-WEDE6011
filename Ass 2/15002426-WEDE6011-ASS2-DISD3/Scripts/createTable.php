<?php

include "DBCon.php";

       
       
       //Insert new users data into txt file first
       
       
$file = fopen("userData.txt","a");
$sql =mysqli_query($DBConnect,"SELECT FName, LName, Email, Pass from CustTest");

while($row = mysqli_fetch_array($sql))
{
    $firstname = $row['FName'];
    $lastname = $row['LName'];
    $email = $row['Email'];
    $password = $row['Pass'];

   


    fwrite($file,("insert into CustTest (FName, LName, Email, Email) values ('".$firstname."','".$lastname ."','".$email."','".$password."');"."\n"));
}

fclose($file);


include "DBCon.php";
$result = mysqli_query($DBConnect, "SHOW TABLES LIKE 'CustTest'");


if($result->num_rows>0)
{

    echo "<p>table has alreaddy been created<p>";
    
    
    
    //*****************************************************
    //drop table
    
    require "DBCon.php";
    if ($DBConnect->query("DROP TABLE CustTest") === TRUE) 
    {
            echo "Table has been deleted successfully";
    } else 
    {
            echo "Could not delete table" . $conn->error;
    }
    
    
    
    //*****************************************************
    //recreate table
    
     $sql= "CREATE TABLE CustTest 
     ( 
             FName varchar(255) NOT NULL,
             LName varchar(255) NOT NULL, 
             Email varchar(255) NOT NULL primary key,
             Pass varchar(255) NOT NULL 
     )";
                  
             if ($DBConnect->query($sql) === TRUE) 
             {
                    echo "<br><pTable has been created successfully</p><br>";
             }
             else 
             {
                    echo "\n\nError creating table: " . $DBConnect->error;
             }

                  
                  
     //****************************************************
     // reinsert all the data
     
             $txt = file_get_contents('userData.txt');
             $queries = explode(';', $txt);
             foreach($queries as $sql)
             {
                   mysqli_query($DBConnect,$sql);
             }
                        
                   echo "<br><p>Insert created</p><br>";
                  
        }
        else
        {
                echo "Databse could not be created";
    
        }
?>