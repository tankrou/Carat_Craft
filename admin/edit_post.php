<?php
$message = "";
session_start();
include_once "../common/connection.php";
include_once "../common/nav_profile.php";

$profile = null;

if (isset($_SESSION['account_id'])) {
    $account_id = $_SESSION['account_id'];
    $profile = getProfile($account_id, $connection);
	
}
$id = $_GET["id"];
// 3) 查询 post 记录
$getRecord = $connection->prepare('SELECT * FROM post WHERE craft_post_id = ?');
$getRecord->execute([$id]);
$getRecordResult = $getRecord->fetch();

if ($getRecordResult) {
    $post_id = $getRecordResult["craft_post_id"];
    $post_desc = $getRecordResult["post_desc"];
    $post_photo = $getRecordResult["post_photo"];
    $categories_id = $getRecordResult["categories_id"];
    $member_id = $getRecordResult["member_id"];
}

// 类别映射
$categories = [
    1 => "Keychain",
    2 => "Illustration",
    3 => "Poster",
    4 => "Other"
];

// 成员映射
$members = [
    1 => "Seventeen",
    2 => "Mingyu",
    3 => "Yoon Jeonghan",
    4 => "Wonwoo",
    5 => "Hoshi",
    6 => "The8",
    7 => "Woozi",
    8 => "DK",
    9 => "Joshua Hong",
    10 => "Wen Junhui",
    11 => "S.Coups",
    12 => "Vernon",
    13 => "Seungkwan",
    14 => "Dino"
];

// 4) 提交表单后更新
if (isset($_POST["edit"])) {
    $post_desc_new = $_POST["post_desc"];
    $categories_new = $_POST["categories_id"];
    $member_new = $_POST["member_id"];

    // 更新 SQL
    $sql = "UPDATE post SET post_desc = ?, categories_id = ?, member_id = ? WHERE craft_post_id = ?";
    $updateRecord = $connection->prepare($sql);
    $result = $updateRecord->execute([
        $post_desc_new,
        $categories_new,
        $member_new,
        $post_id
    ]);

    $message = $result ? "Post updated successfully!" : "Failed to update post.";
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Event</title>
<link href="../css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
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
				<a href="../admin/admin_profile.php">
					<?php if (!empty($profile['profile_photo'])): ?>
						<!-- 3. Has uploaded photo -->
						<img src="../<?= htmlspecialchars($profile['profile_photo']); ?>" 
							 alt="profile_image" 
							class="nav-photo" style="width:40px; height:40px; border-radius:50%;">
					<?php else: ?>
						<!-- 2. No uploaded photo → default image -->
						<img src="../image/default.png" 
							 alt="default_profile_image" 
							 class="nav-photo" style="width:40px; height:40px; border-radius:50%;">
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</li>

         
        </ul>
        
      </div>
  </div>
</nav>
	 <div style="height: 50px;"></div>   
<div class="container user-profile-box mt-4">
    <h1><strong>Edit Post</strong></h1>
	<div class="table-container" style="padding:20px;">
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Post Description</label>
            <textarea class="form-control" name="post_desc" rows="4" required><?= htmlspecialchars($post_desc) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select class="form-select" name="categories_id" required>
                <?php foreach ($categories as $id => $name): ?>
                    <option value="<?= $id ?>" <?= ($categories_id == $id) ? 'selected' : '' ?>>
                        <?= $name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Member</label>
            <select class="form-select" name="member_id" required>
                <?php foreach ($members as $id => $name): ?>
                    <option value="<?= $id ?>" <?= ($member_id == $id) ? 'selected' : '' ?>>
                        <?= $name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="post_id" value="<?= $post_id ?>">

        <button type="submit" name="edit" class="btn search-btn" style="width:150px;">Update Post</button>
        <a href="manage_post.php" class="btn search-btn">Back</a>

        <?php if ($message): ?>
					<div class="alert alert-info mt-2"><?= htmlspecialchars($message) ?></div>
				  <?php endif; ?>
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
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
