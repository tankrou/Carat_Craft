<?php
include_once "../common/connection.php";

$id = $_GET["id"];

try {
    // Delete related signups first
    $deleteSignup = $connection->prepare('DELETE FROM event_signup WHERE event_id = ?');
    $deleteSignup->execute([$id]);

    // Then delete the event
    $deleteEvent = $connection->prepare('DELETE FROM event WHERE event_id = ?');
    $deleteEventResult = $deleteEvent->execute([$id]);

    if ($deleteEventResult) {
        header("Location: user_profile.php");
        exit();
    } else {
        echo "Failed to delete event";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
​?>
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