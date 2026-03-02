<?php
    include_once "../common/connection.php";


    $id = $_GET["id"];
  
    //3)Get the account to be edited on the screen
    $deleteRecord = $connection->prepare('DELETE FROM post WHERE craft_post_id = ?');

    //4)Execute the SQL statement
    $deleteRecordResult = $deleteRecord->execute([$id]);

     if($deleteRecordResult){
              header("Location: manage_post.php");
            }

            else{
               echo "failed to delete account";
            }


?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Bootstrap demo</title>
        <link href="../css/bootstrap.css" rel="stylesheet" >
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css"> <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">  
       <link rel="stylesheet" href="../css/style.css"> 
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
       
  </head>
  <body>
    <h3>Delete Event</h3>
  </body>
</html>