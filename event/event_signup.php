<?php
if (isset($_POST["signup"])) {
    include_once "../common/connection.php";

    $event_id = $_POST["event_id"];
    $name     = $_POST["name"];
    $email    = $_POST["email"];
    $phone    = $_POST["phone"];

    // 1) 检查 email 或 phone 是否已经存在
    $check = $connection->prepare("
        SELECT * FROM event_signup 
        WHERE event_id = ? AND (email = ? OR phone = ?)
    ");
    $check->execute([$event_id, $email, $phone]);
    $exists = $check->fetch();

    if ($exists) {
        if ($exists['phone'] === $phone) {
            $message = "Phone already exists.";
        } elseif ($exists['email'] === $email) {
            $message = "Email already exists.";
        } else {
            $message = "You already signed up.";
        }
    } else {
        // 2) 插入新记录
        $insert = $connection->prepare("
            INSERT INTO event_signup (event_id, name, email, phone, signup_time) 
            VALUES (?, ?, ?, ?, NOW())
        ");
        $insert->execute([$event_id, $name, $email, $phone]);

        $message = "Sign up successfully!";
    }

    // 🔹 redirect 回 event_details.php，并带上 message
    header("Location: event_details.php?event_id=$event_id&message=" . urlencode($message));
    exit();
}
?>

