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

$account_id = $_SESSION["account_id"];
$message = "";

if (isset($_POST["upload"])) {
    $profile_name   = $_POST["profile_name"];
    $profile_email  = $_POST["profile_email"];
    $profile_desc   = $_POST["profile_desc"];
    $profile_gender = $_POST["profile_gender"];

    // 处理上传的头像
    $profile_photo = null;
    if (!empty($_FILES["profile_photo"]["name"])) {
        $target_folder = "image/profile/";
        $allowed_ext   = array('jpg', 'jpeg', 'png', 'gif');
        $file_ext      = strtolower(pathinfo($_FILES["profile_photo"]["name"], PATHINFO_EXTENSION));
        $new_name      = $target_folder . "profile_" . time() . "." . $file_ext;

        if (in_array($file_ext, $allowed_ext)) {
            if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"],"../". $new_name)) {
                $profile_photo = $new_name;
            }
        }
    }

    // 检查 profile 是否已存在
    $getRecord = $connection->prepare("
        SELECT account.account_username, account.account_email
        FROM account
        INNER JOIN profile ON account.account_id = profile.account_id 
        WHERE account.account_id = ?");
    $getRecord->execute([$account_id]);
    $getRecordResult = $getRecord->fetch();

 // 先保存/更新 profile
    if ($getRecordResult) {
        if ($profile_photo) {
            $sql = "UPDATE profile SET profile_name=?, profile_email=?, profile_desc=?, profile_gender=?, profile_photo=? WHERE account_id=?";
            $stmt = $connection->prepare($sql);
            $stmt->execute([$profile_name, $profile_email, $profile_desc, $profile_gender, $profile_photo, $account_id]);
        } else {
            $sql = "UPDATE profile SET profile_name=?, profile_email=?, profile_desc=?, profile_gender=? WHERE account_id=?";
            $stmt = $connection->prepare($sql);
            $stmt->execute([$profile_name, $profile_email, $profile_desc, $profile_gender, $account_id]);
        }
    } else {
        $sql = "INSERT INTO profile (account_id, profile_name, profile_email, profile_desc, profile_gender, profile_photo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$account_id, $profile_name, $profile_email, $profile_desc, $profile_gender, $profile_photo]);
    }


    $connection->prepare("DELETE FROM socialmedia WHERE profile_id=?")->execute([$account_id]);


    if (!empty($_POST["social_media_type"]) && !empty($_POST["social_media_link"])) {
        $types = $_POST["social_media_type"];
        $links = $_POST["social_media_link"];

        for ($i = 0; $i < count($types); $i++) {
            if (!empty($types[$i]) && !empty($links[$i])) {
                $sql = "INSERT INTO socialmedia (profile_id, social_media_type, social_media_link) VALUES (?, ?, ?)";
                $stmt = $connection->prepare($sql);
                $stmt->execute([$account_id, $types[$i], $links[$i]]);
            }
        }
}


header("Location: user_profile.php");
exit();

}

// 获取 profile + account 信息
$getRecord = $connection->prepare("
    SELECT account.account_username, account.account_email, profile.*
    FROM account
    LEFT JOIN profile ON account.account_id = profile.account_id
    WHERE account.account_id = ?");
$getRecord->execute([$account_id]);
$getRecordResult = $getRecord->fetch();
?>

<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Bootstrap demo</title>
        <link href="../css/bootstrap.css" rel="stylesheet" >
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css"> <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">  
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
       <link rel="stylesheet" href="../css/style.css"> 
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
       
  </head>
  <body>

  <nav class="navbar navbar-expand-lg bg-blue fixed-top" >
        <div class="container">
  <a class=" navbar-brand title" href="../index.php" ><img src="../image/carat_craft_logo.png"
              style="height: 30px" alt="logo">Carat Craft</a></div>
  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="offcanvas offcanvas-end " tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
   <div class="offcanvas-header bg-blue">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Carat Craft</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body bg-blue">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle rcorners1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 About
                </a>
                <ul class="dropdown-menu bg-pink ">
                  <li><a class="dropdown-item" href="../about/about.seventeen.php">Seventeen</a></li>
                  <li><a class="dropdown-item" href="../about/seventeen_achievement.php">Seventeen's Achievement</a></li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link active rcorners1 " aria-current="page" href="../event/event.php">Event</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle rcorners1 " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 Craft Categories
                </a>
                <ul class="dropdown-menu bg-pink">
                  <li><a class="dropdown-item dropdown_box" href="../categories/keychain.php">Keychain</a></li>
                  <li><a class="dropdown-item dropdown_box" href="../categories/poster.php">Poster</a></li>
                    <li><a class="dropdown-item dropdown_box" href="../categories/illustration.php">illustration</a></li>
                  <li><a class="dropdown-item dropdown_box" href="../categories/other.php">Other</a></li>

                </ul>
            </li>
           <li class="nav-item">
			<?php if (!isset($_SESSION['account_id'])): ?>
				<!-- 1. Not logged in -->
				<a class="nav-link active rcorners1" href="../signin.php">Login/Register</a>

			<?php else: ?>
				<!-- 2 & 3. Logged in -->
				<a href="../user/user_profile.php">
					<?php if (!empty($profile['profile_photo'])): ?>
						<!-- 3. Has uploaded photo -->
						<img src="../<?= htmlspecialchars($profile['profile_photo']); ?>" 
							 alt="profile_image" 
							 style="width:40px; height:40px; border-radius:50%;">
					<?php else: ?>
						<!-- 2. No uploaded photo → default image -->
						<img src="../image/default.png" 
							 alt="default_profile_image" 
							 style="width:40px; height:40px; border-radius:50%;">
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</li>

         
        </ul>
        
      </div>
  </div>
</nav>
    <div style="height: 50px;"></div>   
<div class="container mt-5 user-profile-box">
    <h1><strong>Edit Profile</strong></h1>
    <p style="color:green;"><?= $message ?></p>
	<div class="table-container" style="padding:20px">
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Profile Image</label><br>
          <?php if (!empty($getRecordResult['profile_photo'])): ?>
                <img src="../<?= $getRecordResult['profile_photo'] ?>" width="100">
            <?php endif; ?>
            <input type="file" name="profile_photo" class="form-control">
        </div>
        
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="profile_name" class="form-control" 
                   value="<?= $getRecordResult['profile_name'] ?? $getRecordResult['account_username'] ?>" required>
        </div>

        <div class="mb-3">
            <label>User Email</label>
            <input type="email" name="profile_email" class="form-control" 
                   value="<?= $getRecordResult['profile_email'] ?? $getRecordResult['account_email'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Profile Description</label>
            <textarea name="profile_desc" class="form-control"><?= $getRecordResult['profile_desc'] ?? '' ?></textarea>
        </div>
        <div class="mb-3">
            <label>Gender</label>
            <select name="profile_gender" class="form-control" required>
                <option value="">Choose your gender</option>
                <option value="M" <?= (isset($getRecordResult['profile_gender']) && $getRecordResult['profile_gender']=="M")?"selected":"" ?>>male</option>
                <option value="F" <?= (isset($getRecordResult['profile_gender']) && $getRecordResult['profile_gender']=="F")?"selected":"" ?>>female</option>
            </select>
        </div>
        
        <h4>Social Media (Limit 3)</h4>
        <?php
        // 先查 social media
        $getSocial = $connection->prepare("SELECT * FROM socialmedia WHERE profile_id=? LIMIT 3");
        $getSocial->execute([$account_id]);
        $socialMedias = $getSocial->fetchAll(PDO::FETCH_ASSOC);

        // 给表单准备数据（最多 3 个）
        for ($i = 0; $i < 3; $i++) {
            $type = $socialMedias[$i]['social_media_type'] ?? '';
            $link = $socialMedias[$i]['social_media_link'] ?? '';
        ?>
            <div class="row mb-2">
                <div class="col">
                    <select name="social_media_type[]" class="form-select">
                        <option value="">choose</option>
                        <option value="facebook"  <?= $type == 'facebook' ? 'selected' : '' ?>>Facebook</option>
                        <option value="instagram" <?= $type == 'instagram' ? 'selected' : '' ?>>Instagram</option>
                        <option value="twitter"   <?= $type == 'twitter' ? 'selected' : '' ?>>Twitter</option>
                        <option value="youtube"   <?= $type == 'youtube' ? 'selected' : '' ?>>YouTube</option>
                        <option value="tiktok"    <?= $type == 'tiktok' ? 'selected' : '' ?>>TikTok</option>
                        <option value="email"     <?= $type == 'email' ? 'selected' : '' ?>>Email</option>
                    </select>
                </div>
                <div class="col">
                    <input type="text" name="social_media_link[]" class="form-control"
                           value="<?= htmlspecialchars($link) ?>" placeholder="Insert social media link">
                </div>
            </div>
        <?php } ?>

        
        <button type="submit"  name="upload" class="btn search-btn">Save</button>
		 <a class="btn search-btn" style="width:200px;" href="manage_account.php?id=<?= $account_id ?>">Change Password</a>


    </form>
	</div>
</div>
	  <div style="height:40px;"></div>
	<footer class="site-footer">
  <div class="container-flex">
    <div class="row align-items-start">
      
      <!-- 左边：图片（小屏幕时占一行，上方显示） -->
      <div class="col-12 col-md-7 footer-logo mb-4 mb-md-0">
        <img src="../image/Footer_pic.png" alt="Seventeen Characters" class="img-fluid">
      </div>

      <!-- 右边：内容（小屏幕时在下方） -->
      <div class="col-12 col-md-5 footer-links ">
        <div class="footer-column">
			<a href="../index.php">
          <h3>Home</h3></a>
        </div>

        <div class="footer-column">
			<a href="../event/event.php">
          <h3>Event</h3></a>
        </div>

        <div class="footer-column">
          <h3>About </h3>
          <ul>
            <li><a href="../about/about.seventeen.php">Seventeen Info</a></li>
            <li><a href="../about/seventeen_achievement.php">Seventeen Achievement</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h3>Categories</h3>
          <ul>
            <li><a href="../categories/keychain.php">Keychain</a></li>
            <li><a href="../categories/illustration.php">Illustration</a></li>
            <li><a href="../categories/poster.php">Poster</a></li>
            <li><a href="../categories/other.php">Other</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <?php if (!isset($_SESSION['account_id'])): ?>
				<!-- 1. Not logged in -->
				<a class=" active " href="../signin.php"><h3>Login/Register</h3></a>

			<?php else: ?>
				<!-- 2 & 3. Logged in -->
				<a href="../user/user_profile.php">
					<?php if (!empty($profile['profile_photo'])): ?>
						<!-- 3. Has uploaded photo -->
						<img src="../<?= htmlspecialchars($profile['profile_photo']); ?>" 
							 alt="profile_image" 
							 class="d-flex justify-content-end align-items-end nav-photo" style="width:80px; height:80px; border-radius:50%;border:1px solid #F9DCDE">
					<?php else: ?>
						<!-- 2. No uploaded photo → default image -->
						<img src="../image/default.png" 
							 alt="default_profile_image" 
							 class="d-flex justify-content-end align-items-end nav-photo" style="width:80px; height:80px; border-radius:50%;border:1px solid #F9DCDE">
					<?php endif; ?>
				</a>
			<?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</footer>
	  
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
