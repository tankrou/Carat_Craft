<?php
include_once "../common/connection.php";

$craft_post_id = $_GET['craft_post_id'] ?? 0;
//$account_id = $_GET['account_id'] ?? 0;
$account_id = $_SESSION['account_id']; 

$sql = "SELECT * FROM post_like WHERE craft_post_id = ? AND account_id = ?";
$stmt = $connection->prepare($sql);
$stmt->execute([$craft_post_id, $account_id]);

if ($stmt->fetch()) {
    echo json_encode(["liked" => true]);
} else {
    echo json_encode(["liked" => false]);
}
?>