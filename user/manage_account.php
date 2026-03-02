<?php
session_start();
include_once "../common/connection.php";
include_once "../common/nav_profile.php";

$profile = null;

if (isset($_SESSION['account_id'])) {
    $account_id = $_SESSION['account_id'];
    $profile = getProfile($account_id, $connection);
}
else {
    header("Location: ../signin.php");
    exit();
}

// 2. Get current user ID
$self_id = $_SESSION['account_id'];
$message = "";

// 3. Handle form submission
if (isset($_POST['edit'])) {
    $account_id = $_POST['account_id'];
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Only allow user to change their own password
    if ($account_id != $self_id) {
        $message = "You do not have permission to change this account password.";
    } else {
        if (empty($password) || empty($confirm_password)) {
            $message = "Password cannot be empty.";
        } elseif ($password !== $confirm_password) {
            $message = "Passwords do not match.";
        } else {
            // Hash the password and update the database
            $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
            $updateStmt = $connection->prepare("UPDATE account SET account_password = ? WHERE account_id = ?");
            if ($updateStmt->execute([$hashed_pwd, $self_id])) {
                $message = "Password updated successfully.";
            } else {
                $message = "Update failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Account - Change Password</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container user-profile-box mt-5">
    <h1><strong>Change Password</strong></h1>
    <p>Here you can change your account password.</p>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
	<div class= table-container>
    <form method="post" action="">
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>

        <input type="hidden" name="account_id" value="<?= $self_id ?>">

        <button type="submit" name="edit" class="btn btn-primary search-btn" style="width:200px;">Update Password</button>
        <a href="edit_user_profile.php" class="btn btn-secondary search-btn" style="width:200px;">Back to Edit Profile</a>
    </form>
	</div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
