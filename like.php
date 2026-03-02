<?php
session_start();
include_once "common/connection.php";

if (isset($_GET['craft_post_id'])) {
    $craft_post_id = trim($_GET['craft_post_id']);
    $account_id = $_SESSION['account_id']; // 当前登录用户
    //$postOwner = $_GET['postOwner'] ?? null;

    // 1. 检查是否已点赞
    $stmt = $connection->prepare("
        SELECT COUNT(*) 
        FROM post_like 
        WHERE craft_post_id = ? AND account_id = ?
    ");
    $stmt->execute([$craft_post_id, $account_id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // 已点过 → 取消点赞
        $stmt = $connection->prepare("
            DELETE FROM post_like 
            WHERE craft_post_id = ? AND account_id = ?
        ");
        $stmt->execute([$craft_post_id, $account_id]);
        $message = "Unliked";
    } else {
        // 没点过 → 点赞
        $stmt = $connection->prepare("
            INSERT INTO post_like (account_id, craft_post_id) 
            VALUES (?, ?)
        ");
        $stmt->execute([$account_id, $craft_post_id]);
        $message = "Liked";
    }

    // 2. 返回点赞总数
    $stmt = $connection->prepare("
        SELECT COUNT(*) 
        FROM post_like 
        WHERE craft_post_id = ?
    ");
    $stmt->execute([$craft_post_id]);
    $likeCount = $stmt->fetchColumn();

    echo json_encode([
        "status" => $message,
        "likes" => $likeCount
    ]);
}
