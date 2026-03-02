<?php
session_start();
include_once "../common/connection.php";
include_once "../common/nav_profile.php";
// ✅ 检查是否已登录 & 是否管理员
if (
!isset($_SESSION["account_id"]) || 
strtoupper($_SESSION["account_role"]) !== "ADM"
) {
header("Location: admin_signin.php");
exit();
}



$account_id = $_SESSION["account_id"];

// 1. 取管理员 profile
$stmt = $connection->prepare("SELECT * FROM profile WHERE account_id = ?");
$stmt->execute([$account_id]);
$profile = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. social media
$getSocial = $connection->prepare("SELECT * FROM socialmedia WHERE profile_id = ?");
$getSocial->execute([$account_id]);
$socialMedias = $getSocial->fetchAll(PDO::FETCH_ASSOC);

$iconMap = [
'facebook'  => 'fab fa-facebook',
'instagram' => 'fab fa-instagram',
'twitter'   => 'fab fa-twitter',
'youtube'   => 'fab fa-youtube',
'email'     => 'fas fa-envelope',
'tiktok'    => 'fab fa-tiktok'
];

$genderIconMap = [
'M' => 'fa-solid fa-mars text-primary',   // Male
'F' => 'fa-solid fa-venus text-danger'    // Female
];



?>


<!doctype html>
<html lang="en">
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
		<div class="container-flex">
			<div class="row">
				<div class="col-sm-2 profile1">
					<?php 
					if (isset($_SESSION["account_id"]) && isset($_SESSION["account_username"])) {
						if (!empty($profile)) { ?>
							<div class="image-box">
								<img src="../<?= $profile["profile_photo"] ?>">
							</div>
						<?php } ?>

						<div class="profile_nav">
							 <a class="profile_btn" href="admin_profile.php">Admin Profile</a>
							<a class="profile_btn" href="manage_user_account.php">Manage Account</a>
							<a class="profile_btn" href="manage_post.php">Manage Post</a>
							<a class="profile_btn" href="manage_event.php">Manage Event</a>
							<a class="profile_btn" href="../logout.php">Logout</a>
						</div>
					<?php } ?>
				</div>            

				<div class="col-sm-10 pr-box">
				   <br>
					<?php 
					if (isset($_SESSION["account_id"]) && isset($_SESSION["account_username"])) { ?>
						 <div class="user-profile-box" > 


							  <div class="row align-items-center">  

								  <?php if ($profile): ?>
								  <div class="profile-image-box col-sm-5">
								 <img src="../<?= $profile["profile_photo"] ?>">
								  </div>
								  <?php endif; ?>

								<div class="profile-info col-sm-7">
									<div class="profile-social" style="text-align: right;">
									 <a href="edit_admin_profile.php" target="_blank" ><i class="bi bi-pencil-square" style="font-size:20px;"></i></a>
								</div>

									 <?php if ($profile): ?>
									  <h1 style="display:flex; align-items:center; gap:10px;">
										<?= htmlspecialchars($profile["profile_name"]) ?>
										<?php 
										  $gender = strtoupper($profile["profile_gender"]); // M / F
										  if (isset($genderIconMap[$gender])) {
											  echo '<i class="' . $genderIconMap[$gender] . '" style="font-size:20px;"></i>';
										  }
										?>
									  </h1>

								  <h2>AccountId<?= $profile["account_id"] ?></h2>
								  <p>Desc: <?= $profile["profile_desc"] ?></p>

										<div class="profile-social">
								<?php if (!empty($socialMedias)): ?>
									<?php foreach ($socialMedias as $s): ?>
										<?php 
											$type = strtolower($s['social_media_type']); // 统一小写 
											$link = htmlspecialchars($s['social_media_link']);
											$icon = $iconMap[$type] ?? 'fas fa-link'; // 默认图标
										?>
										<a href="<?= $link ?>" target="_blank" style="margin-right:10px;">
											<i class="<?= $icon ?>"></i>
										</a>
									<?php endforeach; ?>
								<?php else: ?>
									<p>No social media added yet</p>
								<?php endif; ?>
							</div>


									<?php else: ?>
									  <p>Please fill up your profile information</p>
									  <a href="edit_user_profile.php">Edit Profile</a>
									<?php endif; ?>

								</div> 
							  </div>
							</div>
						</div>
					<?php } ?>
			</div>
  </div>
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

<script src="js/bootstrap.bundle.min.js" >

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script>
document.addEventListener("DOMContentLoaded", () => {
document.querySelectorAll(".like-btn").forEach(button => {
button.addEventListener("click", function() {
  const postId = this.dataset.postid;
  const postOwner = this.dataset.owner;
  const icon = this.querySelector("i"); // 找到里面的 <i> 图标

  fetch("../like.php?craft_post_id=" + postId + "&postOwner=" + postOwner)
	.then(response => response.json())
	.then(data => {
	  if (data.status === "Liked") {

		icon.classList.remove("bi-heart");
		icon.classList.add("bi-heart-fill");
		this.classList.add("btn-primary");
		this.classList.remove("btn-outline-primary");
	  } else if (data.status === "Unliked") {

		icon.classList.remove("bi-heart-fill");
		icon.classList.add("bi-heart");
		this.classList.add("btn-outline-primary");
		this.classList.remove("btn-primary");
	  }

	  // 更新数量
	  document.getElementById("like-count-" + postId).innerText = data.likes;
	})
	.catch(err => console.error(err));
});
});
});
</script>
</body>
</html>
