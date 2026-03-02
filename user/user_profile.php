<?php
session_start();
include_once "../common/connection.php";
include_once "../common/nav_profile.php";

// 先取自己的资料 (for navbar)
$selfProfile = null;
if (isset($_SESSION['account_id'])) {
$self_id = $_SESSION['account_id'];
$stmtSelf = $connection->prepare("SELECT * FROM profile WHERE account_id = ?");
$stmtSelf->execute([$self_id]);
$selfProfile = $stmtSelf->fetch(PDO::FETCH_ASSOC);
} else {
header("Location: ../signin.php");
exit();
}

// 判断当前页面是否是自己


// 再决定要看的 profile （可能是别人，也可能是自己）
$account_id = isset($_GET['account_id']) ? intval($_GET['account_id']) : $_SESSION['account_id'];
$getRecord = $connection->prepare("SELECT * FROM profile WHERE account_id = ?");
$getRecord->execute([$account_id]);
$profile = $getRecord->fetch(PDO::FETCH_ASSOC);

$isOwnProfile = isset($_SESSION['account_id']) && $_SESSION['account_id'] == $account_id;


// 2. social media
$getSocial = $connection->prepare("SELECT * FROM socialmedia WHERE profile_id = ?");
$getSocial->execute([$account_id]);
$socialMedias = $getSocial->fetchAll(PDO::FETCH_ASSOC);

// 3.  posts
$sqlCraft = "
SELECT post.*, profile.profile_photo, profile.profile_name, 
COUNT(post_like.craft_post_id) AS like_count
FROM post
JOIN profile ON post.account_id = profile.account_id
LEFT JOIN post_like ON post.craft_post_id = post_like.craft_post_id
WHERE profile.account_id = ?
GROUP BY post.craft_post_id
";
$stmtCraft = $connection->prepare($sqlCraft);
$stmtCraft->execute([$account_id]);
$craftPosts = $stmtCraft->fetchAll(PDO::FETCH_ASSOC);


// 4. events
$sqlEvent = "SELECT event.*, profile.profile_photo, profile.profile_name
FROM event
JOIN profile ON event.account_id = profile.account_id
WHERE event.account_id = ?";
$stmtEvent = $connection->prepare($sqlEvent);
$stmtEvent->execute([$account_id]); // 同样修正
$eventPosts = $stmtEvent->fetchAll(PDO::FETCH_ASSOC);

// 5.  posts like
$sqlLike = "
SELECT p.*, pr.profile_photo, pr.profile_name,
(SELECT COUNT(*) FROM post_like pl WHERE pl.craft_post_id = p.craft_post_id) AS like_count
FROM post_like l
JOIN post p ON l.craft_post_id = p.craft_post_id
JOIN profile pr ON p.account_id = pr.account_id
WHERE l.account_id = ?
GROUP BY p.craft_post_id
";

$stmtLike = $connection->prepare($sqlLike);
$stmtLike->execute([$account_id]);
$likedPosts = $stmtLike->fetchAll(PDO::FETCH_ASSOC);

// 6. Social media icon 映射
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
		<a href="../user/user_profile.php">
			<?php if (!empty($selfProfile['profile_photo'])): ?>
				<img src="../<?= htmlspecialchars($selfProfile['profile_photo']); ?>" 
					 alt="profile_image" 
					 style="width:40px; height:40px; border-radius:50%;">
			<?php else: ?>
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
<div class="container-flex  " >
	<div class="row">

				<div class="col-sm-2 profile1">
					  <?php 
						if(isset($_SESSION["account_id"]) && isset($_SESSION["account_username"])) {

					?>

					 <?php if ($profile): ?>
					<div class="image-box">
				   <img src="../<?= $profile["profile_photo"] ?>">
					</div>
					<?php endif; ?>
					<div class="profile_nav">

					<a class="profile_btn" href="../user/user_profile.php">User Profile</a>
				  <div class="profile_nav">
					<?php if ($isOwnProfile): ?>
						<a class="profile_btn" href="../user/create_event.php">Create Event</a>
						<a class="profile_btn" href="../user/create_craft.php">Create Craft</a>
					  <a class="profile_btn" 
						 href="../logout.php">Logout</a>
					<?php endif; ?>
				</div>

					 </div>
					 <?php
					   } 
				?>
				</div>

				 <div class="col-sm-10 pr-box">
						<br>
				   <?php 
						if(isset($_SESSION["account_id"]) && isset($_SESSION["account_username"])) {

					?>
						<div class="user-profile-box" >  
							<div class="row align-items-center">  

							  <?php if ($profile): ?>
							  <div class="profile-image-box col-sm-4">
							 <img src="../<?= $profile["profile_photo"] ?>">
							  </div>
							  <?php endif; ?>

							<div class="profile-info col-sm-7">
								<?php if ($isOwnProfile): ?>
							<div class="profile-social edit-icon" >
								<a href="edit_user_profile.php" target="_blank">
									<i class="bi bi-pencil-square" style="font-size:20px;padding:1%;"></i>
								</a>
							</div>
							<?php endif; ?>
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
									<?php if($isOwnProfile):?>
								  <p>Please fill up your profile information</p>
								  <a href="edit_user_profile.php">Edit Profile</a>

									<?php else:?>
									<p>This user profile is emtpy</p>
									<?php endif;?>
								<?php endif; ?>

							</div> 
						  </div>
						</div>
					 <div class="profile-tabs">
					 <ul class="nav nav-tabs" id="profileTabs">
					  <li class="nav-item">
						<button class="nav-link active" style="color:black;" data-bs-toggle="tab" data-bs-target="#craft">Craft Posted</button>
					  </li>
					  <li class="nav-item">
						<button class="nav-link" style="color:black;"data-bs-toggle="tab" data-bs-target="#event ">Event Created</button>
					  </li>
						<?php if ($isOwnProfile): ?>
					  <li class="nav-item">

						<button class="nav-link" style="color:black;" data-bs-toggle="tab" data-bs-target="#like">Like</button>
					  </li> 
						<?php endif;?>
					</ul>

					<div class="tab-content mt-3">
					  <!-- Craft posts -->
					  <div class="tab-pane fade show active" id="craft">
						  <div class="row">
							<?php foreach ($craftPosts as $post): ?>
							  <div class="col-md-4">
								<div class="card mb-3 card-post" style="background:rgba(255, 255, 255, 0.62);">

								  <!-- 用户头像 + 名字 -->
								  <div class="card-header d-flex justify-content-between align-items-center">
								<!-- Left side: profile photo + name -->
								<div class="d-flex align-items-center">
									<img src="../<?= $post['profile_photo'] ?>" 
										 alt="User Photo" 
										 class="rounded-circle" 
										 style="width:57px; height:50px; object-fit:cover;">
									<span class="ms-2"><?= htmlspecialchars($post['profile_name']) ?></span>
								</div>

								<!-- Right side: icons -->
									  <?php if ($isOwnProfile): ?>
								<div class="profile-edit">
									<!-- Edit icon -->
									<a href="edit_post.php?id=<?= $post['craft_post_id'] ?>" 
									   class="btn-sm btn-primary me-1" 
									   title="Edit">
										<i class="bi bi-pencil-square"></i>
									</a>

									<!-- Delete icon -->
									<a href="delete_post.php?id=<?= $post['craft_post_id'] ?>" 
									   class="btn-sm btn-danger me-1" 
									   onclick="return confirm('Are you sure you want to delete this post?')" 
									   title="Delete">
										<i class="bi bi-trash-fill"></i>
									</a>
								</div>
									  <?php endif;?>
								</div>



								  <!-- 作品图 -->
								<div class="d-flex justify-content-center">
								  <a href="../craft_post_details.php?craft_post_id=<?= $post['craft_post_id'] ?>">
									<img src="../<?= $post['post_photo']; ?>" 
										 class="card-img-top d-block mx-auto"
										 style="aspect-ratio: 3/4; object-fit: cover; width:80%;">
								  </a>
								</div>

								  <!-- 描述 -->
								  <div class="card-body">
									<p><?= htmlspecialchars($post['post_desc']); ?></p>
								  </div>
								  <!-- like 按钮 -->
								  <div class="card-footer">
									<div class="d-flex justify-content-end align-content-end" style=padding:12px;>
									<button class="btn btn-outline-primary like-btn" 
											data-postid="<?= $post['craft_post_id']; ?>" 
											data-owner="<?= $post['account_id']; ?>">
									  <i class="bi bi-heart"></i>
									  <span id="like-count-<?= $post['craft_post_id']; ?>">
										<?= $post['like_count'] ?? 0 ?>
									  </span>
									</button>
								  </div>

								</div>
							  </div>  
							  </div>
							<?php endforeach; ?>

						  </div>
						</div>


					  <!-- Event posts -->
					  <div class="tab-pane fade" id="event">
						<?php foreach ($eventPosts as $event): ?>
						  <div class="col-md-12">
						   <div class="card mb-3 shadow-sm card-event " style="background:rgba(255, 255, 255, 0.62);border-radius:20px;">
							  <div class="card-header d-flex justify-content-between align-items-center" style="margin:0 -2%;">
								<!-- Left side: profile photo + name -->
								<div class="d-flex align-items-center">
									<img src="../<?= $post['profile_photo'] ?>" 
										 alt="User Photo" 
										 class="rounded-circle" 
										 style="width:57px; height:50px; object-fit:cover;">
									<span class="ms-2"><?= htmlspecialchars($post['profile_name']) ?></span>
								</div>

								<!-- Right side: icons -->
								<div class="profile-edit">
									<!-- Edit icon -->
									<a href="edit_event.php?id=<?= $event['event_id'] ?>" 
									   class="btn-sm btn-primary me-1" 
									   title="Edit">
										<i class="bi bi-pencil-square"></i>
									</a>

									<!-- Delete icon -->
									<a href="delete_event.php?id=<?= $event['event_id'] ?>" 
									   class="btn-sm btn-danger me-1" 
									   onclick="return confirm('Are you sure you want to delete this post?')" 
									   title="Delete">
										<i class="bi bi-trash-fill"></i>
									</a>
								</div>
							</div>

						<div class="row">
							<div class="col-sm-7">
							  <?php
						$photoStmt = $connection->prepare("SELECT photo_path FROM event_photo WHERE event_id = ?");
						$photoStmt->execute([$event["event_id"]]);
						$photos = $photoStmt->fetchAll(PDO::FETCH_ASSOC);

						if ($photos) {
						  echo '<div class="event-photos">';
						  $count = 0;
						  foreach ($photos as $p) {
							if ($count >= 3) break;
							echo '<div class="photo-box">
									<img src="../'.htmlspecialchars($p["photo_path"]).'" alt="event photo">
								  </div>';
							$count++;
						  }
						  echo '</div>';
						} else {
						  echo '<div class="event-photos">
								  <div class="photo-box">
									<img src="../image/default_event.jpg" alt="default">
								  </div>
								</div>';
						}
					  ?>
							</div>
						 <div class="event-info col-sm-5 d-flex flex-column" >

							<h5 class="card-title"><?= htmlspecialchars($event["event_name"]); ?></h5>
							<p class="card-text">
							  <strong>Date:</strong> <?= htmlspecialchars($event["event_date"]); ?><br>
							  <strong>Venue:</strong> <?= htmlspecialchars($event["event_venue"]); ?>
							</p>
							<p class="card-text"><?= nl2br(htmlspecialchars($event["event_desc"])); ?></p>

					 <div class="mt-auto d-flex justify-content-end " style="margin:10px;">
					  <?php if (isset($_SESSION['account_id'])): ?>
						<!-- User logged in -->
						<a href="../event/event_details.php?event_id=<?= $event["event_id"]; ?>" 
						   class="btn search-btn btn-sm" style="width:140px;">View Details</a>
						<a href="view_event_participants.php?event_id=<?= $event['event_id'] ?>" class="btn btn-sm search-btn" title="Participants"  style="width:140px;margin-left:5px;">View List
						</a>
					  <?php else: ?>
						<!-- User not logged in -->
						<a href="../signin.php" 
						   class="btn btn-outline-primary btn-sm">Login to View</a>
					  <?php endif; ?>
							</div>
								</div>
							  </div>
						  </div>
						  </div>
						<?php endforeach; ?>
					  </div>

					  <!-- Liked posts -->
					<?php if ($isOwnProfile): ?>
					  <div class="tab-pane fade" id="like"> 
					  <div class="row">
						<?php foreach ($likedPosts as $like): ?>
						  <div class="col-md-4">
							<div class="card mb-3 card-post" style="background:rgba(255, 255, 255, 0.62);">

							  <!-- 用户头像 + 名字 -->
							   <div class="card-header d-flex align-items-center">
						  <?php if (isset($_SESSION['account_id'])): ?>
							<!-- Logged in: link to user profile -->
							<a href="user_profile.php?account_id=<?= $like['account_id']; ?>">
							  <img src="../<?= $like['profile_photo'] ?>" 
								   alt="User Photo" 
								   class="rounded-circle" 
								   style="width:57px; height:50px; object-fit:cover;">
							</a>
						  <?php else: ?>
							<!-- Not logged in: link to login page -->
							<a href="signin.php">
							  <img src="../<?= $like['profile_photo'] ?>" 
								   alt="User Photo" 
								   class="rounded-circle" 
								   style="width:57px; height:50px; object-fit:cover;">
							</a>
						  <?php endif; ?>
						  <span class="ms-2"><?= $post['profile_name'] ?></span>
						</div>
							  <!-- 点进去看详情 -->
								<div class="d-flex justify-content-center">
								  <a href="../craft_post_details.php?craft_post_id=<?= $like['craft_post_id'] ?>">
									<img src="../<?= $like['post_photo']; ?>" 
										 class="card-img-top d-block mx-auto"  
										 style="aspect-ratio: 3/4; object-fit: cover; width:80%;">
								  </a>
								</div>

							  <!-- 描述文字 -->
							  <div class="card-body">
								<p><?= htmlspecialchars($like['post_desc']); ?></p>
							  </div>

							  <!-- like 按钮 -->
							  <div class="card-footer">
								  <div class="d-flex justify-content-end align-content-end" style=padding:12px;>
								<button class="btn btn-outline-primary like-btn" 
									data-postid="<?= $like['craft_post_id']; ?>" 
									data-owner="<?= $_SESSION['account_id']; ?>">

								  <i class="bi bi-heart"></i>
								  <span id="like-count-<?= $like['craft_post_id']; ?>">
									<?= $like['like_count'] ?? 0 ?>
								  </span>
								</button>
							  </div>
								</div>
							</div>
						  </div>
						<?php endforeach; ?>
					  </div>
					</div>
				<?php endif; ?>



					</div>
				</div>

				</div>

				<?php
					   } 
				?>

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
document.addEventListener("DOMContentLoaded", function() {
document.querySelectorAll(".like-btn").forEach(button => {
const postId = button.dataset.postid;
const postOwner = button.dataset.owner;
const icon = button.querySelector("i");

// 🔹 Check status on load
fetch("../like_status.php?craft_post_id=" + postId + "&account_id=" + postOwner)
.then(response => response.json())
.then(data => {
if (data.liked) {
  icon.classList.remove("bi-heart");
  icon.classList.add("bi-heart-fill");
  button.classList.add("btn-primary");
  button.classList.remove("btn-outline-primary");
} else {
  icon.classList.remove("bi-heart-fill");
  icon.classList.add("bi-heart");
  button.classList.add("btn-outline-primary");
  button.classList.remove("btn-primary");
}
})
.catch(err => console.error(err));

// 🔹 Handle click
button.addEventListener("click", function() {
fetch("../like.php?craft_post_id=" + postId + "&account_id=" + postOwner)
.then(response => response.json())
.then(data => {
  if (data.status === "Liked") {
	icon.classList.remove("bi-heart");
	icon.classList.add("bi-heart-fill");
	button.classList.add("btn-primary");
	button.classList.remove("btn-outline-primary");
  } else if (data.status === "Unliked") {
	icon.classList.remove("bi-heart-fill");
	icon.classList.add("bi-heart");
	button.classList.add("btn-outline-primary");
	button.classList.remove("btn-primary");
  }

  document.getElementById("like-count-" + postId).innerText = data.likes;
})
.catch(err => console.error(err));
});
});
});
</script>
</body>
</html>
