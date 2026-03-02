<?php
//1) Make connection to database
include_once "common/connection.php";

//2) Collect data from the form
$username = $_POST["username"];
$password = $_POST["password"];
$role = $_POST["role"];

//3 a)Check if the username is available to be used
$getRecord = $connection->prepare('SELECT * FROM account WHERE account_username = ?');

//3 b)Execute the SQL Statement
$getRecord->execute([$username]);

//3 c)Collect the record retrieved from the table using the SQL
$getRecordResult = $getRecord->fetch();

if($getRecordResult){
    echo "account username existing";
    header("Location:index.html");
}
else{
    //Encrypt the password
    $encrypted_pwd = password_hash($password,PASSWORD_DEFAULT);
    //insert the record
    $insertRecord = $connection->prepare('INSERT INTO account(account_username,account_password,account_role) VALUES(?,?,?)');
    
    
    $insertResult = $insertRecord->execute([$username,$encrypted_pwd,$role]);
    
    if($insertResult){
        echo " account created";
    }
    
    else{
        echo "failed to create account";
    }
    
}
?>,