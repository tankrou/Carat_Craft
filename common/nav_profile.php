<?php
function getProfile($account_id, $conn) {
    $sql = "SELECT * FROM profile WHERE account_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$account_id]);   // PDO 传参数
    return $stmt->fetch(PDO::FETCH_ASSOC); // 返回一行
}
