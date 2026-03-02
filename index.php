<?php
session_start();
include_once "common/connection.php";
include_once "common/nav_profile.php";

$profile = null;

if (isset($_SESSION['account_id'])) {
$account_id = $_SESSION['account_id'];
$profile = getProfile($account_id, $connection);
}



$member_id = $_GET["member_id"] ?? null;


$categories_id = [1, 2, 3, 4];
$postsByCategory = [];



foreach ($categories_id as $categoryId) {
if ($member_id) {

	$sql = "SELECT post.*, profile.profile_photo, profile.profile_name ,
	   (SELECT COUNT(*) 
		FROM post_like 
		WHERE post_like.craft_post_id = post.craft_post_id) AS like_count
	FROM post 
	LEFT JOIN profile ON post.account_id = profile.account_id 
	WHERE categories_id = ? AND member_id = ? LIMIT 4";
	$getRecord = $connection->prepare($sql);
	$getRecord->execute([$categoryId, $member_id]);
} 
else {


	$sql = "SELECT post.*, profile.profile_photo, profile.profile_name ,
	   (SELECT COUNT(*) 
		FROM post_like 
		WHERE post_like.craft_post_id = post.craft_post_id) AS like_count
	FROM post 
	LEFT JOIN profile ON post.account_id = profile.account_id 
	WHERE categories_id = ? LIMIT 4";

	$getRecord = $connection->prepare($sql);
	$getRecord->execute([$categoryId]);


}
$postsByCategory[$categoryId] = $getRecord->fetchAll(PDO::FETCH_ASSOC);
}



?>



<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">  
<title>Bootstrap demo</title>
	<link href="css/bootstrap.css" rel="stylesheet" >
 <link rel="stylesheet" href="css/style.css">        
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
<style>
.mySlides {display:none;}
</style>

</head>

<body>

	<!-- nav start-->

<nav class="navbar navbar-expand-lg bg-blue fixed-top" >
	<div class="container">
<a class=" navbar-brand title" href="index.php" ><img src="image/carat_craft_logo.png"
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
			  <li><a class="dropdown-item" href="about/about.seventeen.php">Seventeen</a></li>
			  <li><a class="dropdown-item" href="about/seventeen_achievement.php">Seventeen's Achievement</a></li>

			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link active rcorners1 " aria-current="page" href="event/event.php">Event</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle rcorners1 " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			 Craft Categories
			</a>
			<ul class="dropdown-menu bg-pink">
			  <li><a class="dropdown-item dropdown_box" href="categories/keychain.php">Keychain</a></li>
			  <li><a class="dropdown-item dropdown_box" href="categories/poster.php">Poster</a></li>
				<li><a class="dropdown-item dropdown_box" href="categories/illustration.php">illustration</a></li>
			  <li><a class="dropdown-item dropdown_box" href="categories/other.php">Other</a></li>

			</ul>
		</li>
	   <li class="nav-item">
		<?php if (!isset($_SESSION['account_id'])): ?>
			<!-- 1. Not logged in -->
			<a class="nav-link active rcorners1" href="signin.php">Login/Register</a>

		<?php else: ?>
			<!-- 2 & 3. Logged in -->
			<a href="user/user_profile.php">
				<?php if (!empty($profile['profile_photo'])): ?>
					<!-- 3. Has uploaded photo -->
					<img src="<?= htmlspecialchars($profile['profile_photo']); ?>" 
						 alt="profile_image" 
						 style="width:40px; height:40px; border-radius:50%;">
				<?php else: ?>
					<!-- 2. No uploaded photo → default image -->
					<img src="image/default.png" 
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

  <!-- nav end-->




	<div class="w3-content w3-section" style="max-width:300%; align-item:center ">
	  <img class="mySlides" src="image/MainpageUP_photo.jpg" style="width:100%">
	  <img class="mySlides" src="image/MainpageUP_photo2.jpg" style="width:100%">
	  <img class="mySlides" src="image/MainpageUP_photo3.jpg" style="width:100%">
	</div>


	   <!--slide-->
<!-- slideshow 2 -->
<div class="albums-title" style="color: #ffffff;padding-top:50px;-webkit-text-stroke:0.5px black">🎧⋆˙♪⋆.✮ CARAT CRAFT TOP 5 ✮⋆♪˙⋆˙🎧</div>


<div class="slideshow-container">
<!-- Album 1 -->
<div class="slide active" data-index="0">
<div style="width:100%; height:100%; background:url('image/indexslide_show1.jpg') center/cover no-repeat;"></div>
<div class="slide-title">大王扇来袭！</div>
</div>

<!-- Album 2 -->
<div class="slide right" data-index="1">
<div style="width:100%; height:100%; background:url('image/indexslide_show2.jpg') center/cover no-repeat;"></div>
<div class="slide-title">无偿分享</div>
</div>

<!-- Album 3 -->
<div class="slide hidden" data-index="2">
<div style="width:100%; height:100%; background:url('image/indexslide_show3.jpg') center/cover no-repeat;"></div>
<div class="slide-title">黑皮 miniteen !</div>
</div>

<!-- Album 4 -->
<div class="slide hidden" data-index="3">
<div style="width:100%; height:100%; background:url('image/indexslide_show4.jpg') center/cover no-repeat;"></div>
<div class="slide-title">Patch Freedom</div>
</div>

<!-- Album 5 -->
<div class="slide hidden" data-index="4">
<div style="width:100%; height:100%; background:url('image/indexslide_show5.jpg') center/cover no-repeat;"></div>
<div class="slide-title">酷 + 奎</div>
</div>

<!-- Album 6 -->
<div class="slide left" data-index="5">
<div style="width:100%; height:100%; background:url('image/indexslide_show6.jpg') center/cover no-repeat;"></div>
<div class="slide-title">The 8 CD</div>
</div>
</div>

<div class="dots-container">
<div class="dot active" data-slide="0"></div>
<div class="dot" data-slide="1"></div>
<div class="dot" data-slide="2"></div>
<div class="dot" data-slide="3"></div>
<div class="dot" data-slide="4"></div>
<div class="dot" data-slide="5"></div>
</div>

<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
const totalSlides = slides.length;
let autoSlideInterval;

function updateSlidePositions() {
  slides.forEach((slide, index) => {
	  slide.classList.remove('active', 'left', 'right', 'hidden');

	  if (index === currentSlide) {
		  slide.classList.add('active');
	  } else if (index === (currentSlide - 1 + totalSlides) % totalSlides) {
		  slide.classList.add('left');
	  } else if (index === (currentSlide + 1) % totalSlides) {
		  slide.classList.add('right');
	  } else {
		  slide.classList.add('hidden');
	  }
  });

  dots.forEach((dot, index) => {
	  dot.classList.toggle('active', index === currentSlide);
  });
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % totalSlides;
  updateSlidePositions();
}

function goToSlide(slideIndex) {
  currentSlide = slideIndex;
  updateSlidePositions();
}

function startAutoSlide() {
  autoSlideInterval = setInterval(nextSlide, 2000);
}

function stopAutoSlide() {
  clearInterval(autoSlideInterval);
}

slides.forEach((slide, index) => {
  slide.addEventListener('click', () => {
	  if (index !== currentSlide) {
		  stopAutoSlide();
		  goToSlide(index);
		  setTimeout(startAutoSlide, 3000);
	  }
  });
});

dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
	  stopAutoSlide();
	  goToSlide(index);
	  setTimeout(startAutoSlide, 3000);
  });
});

const container = document.querySelector('.slideshow-container');
container.addEventListener('mouseenter', stopAutoSlide);
container.addEventListener('mouseleave', startAutoSlide);

updateSlidePositions();
startAutoSlide();
</script>

   <div class="container filter" style="padding:20px;">

   <form method="get" action="">
<label for="member_id" style="font-size:20px;font-weight:bold;  color: rgb(255, 255, 255); -webkit-text-stroke:0.8px black; padding-right:10px;">Filter</label>
<select class="dropbtn dropbtn-toggle"  id="member_id" name="member_id" onchange="this.form.submit()">
  <option value="">All</option>
  <option value="1" <?= ($member_id==1 ? "selected" : "") ?>>Seventeen</option>
  <option value="2" <?= ($member_id==2 ? "selected" : "") ?>>Mingyu</option>
  <option value="3" <?= ($member_id==3 ? "selected" : "") ?>>Yoon Jeonghan</option>
  <option value="4" <?= ($member_id==4 ? "selected" : "") ?>>Wonwoo</option>
  <option value="5" <?= ($member_id==5 ? "selected" : "") ?>>Hoshi</option>
  <option value="6" <?= ($member_id==6 ? "selected" : "") ?>>The8</option>
  <option value="7" <?= ($member_id==7 ? "selected" : "") ?>>Woozi</option>
  <option value="8" <?= ($member_id==8 ? "selected" : "") ?>>DK</option>
  <option value="9" <?= ($member_id==9 ? "selected" : "") ?>>Joshua Hong</option>
  <option value="10" <?= ($member_id==10 ? "selected" : "") ?>>Wen Junhui</option>
  <option value="11" <?= ($member_id==11 ? "selected" : "") ?>>S.Coups</option>
  <option value="12" <?= ($member_id==12 ? "selected" : "") ?>>Vernon</option>
  <option value="13" <?= ($member_id==13 ? "selected" : "") ?>>Seungkwan</option>
  <option value="14" <?= ($member_id==14 ? "selected" : "") ?>>Dino</option>
</select>
</form>
  </div>
   <br>


<!--cntainer-->
<div class="container box1" style="padding:20px;">
	 <h3 style="text-align: start; padding:8px; padding-bottom:20px;font-weight:bold;  color: #ffffff; -webkit-text-stroke:0.8px black; "> KEYCHAIN ˚🎧⋆⁺₊⋆꙳</h3>
 <div class="row">

		<?php foreach ($postsByCategory[1] as $post): ?>
		<?php if (!$member_id || $post['member_id'] == $member_id): ?>
		  <div class="col-md-3">
			  <div class="card mb-3 card-post" >
				  <div class="card-header d-flex align-items-center">
				  <?php if (isset($_SESSION['account_id'])): ?>
					<!-- Logged in: link to user profile -->
					<a href="user/user_profile.php?account_id=<?= $post['account_id']; ?>">
					  <img src="<?= $post['profile_photo'] ?>" 
						   alt="User Photo" 
						   class="rounded-circle" 
						   style="width:57px; height:50px; object-fit:cover;">
					</a>
				  <?php else: ?>
					<!-- Not logged in: link to login page -->
					<a href="signin.php">
					  <img src="<?= $post['profile_photo'] ?>" 
						   alt="User Photo" 
						   class="rounded-circle" 
						   style="width:57px; height:50px; object-fit:cover;">
					</a>
				  <?php endif; ?>
				  <span class="ms-2"><?= $post['profile_name'] ?></span>
				</div>


				 <a href="craft_post_details.php?craft_post_id=<?= $post['craft_post_id'] ?>">
				  <img src="<?= $post['post_photo']; ?>" 
					   class="card-img-top" style="aspect-ratio: 3/4 ;object-fit:cover;width:80%;">
				</a>
				 <div class="d-flex justify-content-start align-content-start";>
				  <div class="card-body" >
					<p><?= $post['post_desc']; ?></p>
				   </div>
				  </div>
				<div class="d-flex justify-content-end align-content-end" style=padding:12px;>
					 <?php if (isset($_SESSION['account_id'])): ?>
					  <!-- User logged in: show real like button -->
					  <button class="btn btn-outline-primary btn-sm like-btn " 
							  data-postid="<?= $post['craft_post_id']; ?>" 
							  data-owner="<?= $post['account_id']; ?>">
						<i class="bi bi-heart"></i>
						<span id="like-count-<?= $post['craft_post_id']; ?>">
						  <?= $post['like_count'] ?? 0 ?>
						</span>
					  </button>
					<?php else: ?>
					  <!-- User not logged in: show login button -->
					  <a href="signin.php" class="btn btn-outline-primary btn-sm ">
						Login to Like
					  </a>
					<?php endif; ?>
				  </div>
			</div>
		  </div>
		<?php endif; ?>
	  <?php endforeach; ?>
		<div class="text-center mt-3">
			<a href="categories/keychain.php<?= $member_id ? '?member_id='.$member_id : '' ?>" class="btn btn-primary ">More</a>
		  </div>
	  </div>

	</div>
   <br>

<div class="container box1" style="padding:20px;">
	 <h3 style="text-align: start; padding:8px; padding-bottom:20px;font-weight:bold;  color: #ffffff; -webkit-text-stroke:0.8px black; ">ILLUSTRATION ˚🎧⋆⁺₊⋆꙳</h3>
 <div class="row">
	  <?php foreach ($postsByCategory[2] as $post): ?>
		 <?php if (!$member_id || $post['member_id'] == $member_id): ?>
		  <div class="col-md-3">
			  <div class="card mb-3 card-post">
				  <div class="card-header d-flex align-items-center">
				  <?php if (isset($_SESSION['account_id'])): ?>
					<!-- Logged in: link to user profile -->
					<a href="user/user_profile.php?account_id=<?= $post['account_id']; ?>">
					  <img src="<?= $post['profile_photo'] ?>" 
						   alt="User Photo" 
						   class="rounded-circle" 
						   style="width:57px; height:50px; object-fit:cover;">
					</a>
				  <?php else: ?>
					<!-- Not logged in: link to login page -->
					<a href="signin.php">
					  <img src="<?= $post['profile_photo'] ?>" 
						   alt="User Photo" 
						   class="rounded-circle" 
						   style="width:57px; height:50px; object-fit:cover;">
					</a>
				  <?php endif; ?>
				  <span class="ms-2"><?= $post['profile_name'] ?></span>
				</div>


				 <a href="craft_post_details.php?craft_post_id=<?= $post['craft_post_id'] ?>">
				  <img src="<?= $post['post_photo']; ?>" 
					  class="card-img-top" style="aspect-ratio: 3/4 ;object-fit:cover;width:80%;">
				</a>

				  <div class="card-body">
					<p><?= $post['post_desc']; ?></p>
				  </div>
				<div class="d-flex justify-content-end align-content-end" style=padding:12px;>
				   <?php if (isset($_SESSION['account_id'])): ?>
					  <!-- User logged in: show real like button -->
					  <button class="btn btn-outline-primary like-btn btn-sm" 
							  data-postid="<?= $post['craft_post_id']; ?>" 
							  data-owner="<?= $post['account_id']; ?>">
						<i class="bi bi-heart"></i>
						<span id="like-count-<?= $post['craft_post_id']; ?>">
						  <?= $post['like_count'] ?? 0 ?>
						</span>
					  </button>
					<?php else: ?>
					  <!-- User not logged in: show login button -->
					  <a href="signin.php" class="btn btn-outline-primary btn-sm">
						Login to Like
					  </a>
					<?php endif; ?>
				</div>
				</div>
		  </div>
		<?php endif; ?>
	  <?php endforeach; ?>
	  <div class="text-center mt-3">
		<a href="categories/illustration.php<?= $member_id ? '?member_id='.$member_id : '' ?>" class="btn btn-primary">More</a>
	  </div>
	</div>
  </div>

   <br>

<div class="container box1" style="padding:20px;">
	 <h3 style="text-align: start; padding:8px; padding-bottom:20px;font-weight:bold;  color: #ffffff; -webkit-text-stroke:0.8px black; ">POSTER ˚🎧⋆⁺₊⋆꙳</h3>
 <div class="row">
		 <?php foreach ($postsByCategory[3] as $post): ?>
			 <?php if (!$member_id || $post['member_id'] == $member_id): ?>
		  <div class="col-md-3">
			  <div class="card mb-3 card-post">
				  <div class="card-header d-flex align-items-center">
				  <?php if (isset($_SESSION['account_id'])): ?>
					<!-- Logged in: link to user profile -->
					<a href="user/user_profile.php?account_id=<?= $post['account_id']; ?>">
					  <img src="<?= $post['profile_photo'] ?>" 
						   alt="User Photo" 
						   class="rounded-circle" 
						   style="width:57px; height:50px; object-fit:cover;">
					</a>
				  <?php else: ?>
					<!-- Not logged in: link to login page -->
					<a href="signin.php">
					  <img src="<?= $post['profile_photo'] ?>" 
						   alt="User Photo" 
						   class="rounded-circle" 
						   style="width:57px; height:50px; object-fit:cover;">
					</a>
				  <?php endif; ?>
				  <span class="ms-2"><?= $post['profile_name'] ?></span>
				</div>


				 <a href="craft_post_details.php?craft_post_id=<?= $post['craft_post_id'] ?>">
				  <img src="<?= $post['post_photo']; ?>" 
					  class="card-img-top" style="aspect-ratio: 3/4 ;object-fit:cover;width:80%;">
				</a>

				  <div class="card-body">
					<p><?= $post['post_desc']; ?></p>
				  </div>
				<div class="d-flex justify-content-end align-content-end" style=padding:12px;>
					<?php if (isset($_SESSION['account_id'])): ?>
					  <!-- User logged in: show real like button -->
					  <button class="btn btn-outline-primary like-btn btn-sm" 
							  data-postid="<?= $post['craft_post_id']; ?>" 
							  data-owner="<?= $post['account_id']; ?>">
						<i class="bi bi-heart"></i>
						<span id="like-count-<?= $post['craft_post_id']; ?>">
						  <?= $post['like_count'] ?? 0 ?>
						</span>
					  </button>
					<?php else: ?>
					  <!-- User not logged in: show login button -->
					  <a href="signin.php" class="btn btn-outline-primary btn-sm">
						Login to Like
					  </a>
					<?php endif; ?>
				</div>
			</div>
		  </div>
		<?php endif; ?>
		<?php endforeach; ?>
		<div class="text-center mt-3">
			<a href="categories/poster.php<?= $member_id ? '?member_id='.$member_id : '' ?>" class="btn btn-primary">More</a>
		  </div>
	  </div>

	</div>
   <br>

	  <div class="container box1" style="padding:20px;">
	 <h3 style="text-align: start; padding:8px; padding-bottom:20px;font-weight:bold;  color: #ffffff; -webkit-text-stroke:0.8px black; ">OTHER ˚🎧⋆⁺₊⋆꙳</h3>
 <div class="row">
		  <?php foreach ($postsByCategory[4] as $post): ?>
			 <?php if (!$member_id || $post['member_id'] == $member_id): ?>
		  <div class="col-md-3">
			  <div class="card mb-3 card-post" >
				  <div class="card-header d-flex align-items-center">
				  <?php if (isset($_SESSION['account_id'])): ?>
					<!-- Logged in: link to user profile -->
					<a href="user/user_profile.php?account_id=<?= $post['account_id']; ?>">
					  <img src="<?= $post['profile_photo'] ?>" 
						   alt="User Photo" 
						   class="rounded-circle" 
						   style="width:57px; height:50px; object-fit:cover;">
					</a>
				  <?php else: ?>
					<!-- Not logged in: link to login page -->
					<a href="signin.php">
					  <img src="<?= $post['profile_photo'] ?>" 
						   alt="User Photo" 
						   class="rounded-circle" 
						   style="width:57px; height:50px; object-fit:cover;">
					</a>
				  <?php endif; ?>
				  <span class="ms-2"><?= $post['profile_name'] ?></span>
				</div>

				 <a href="craft_post_details.php?craft_post_id=<?= $post['craft_post_id'] ?>">
				  <img src="<?= $post['post_photo']; ?>" 
						class="card-img-top" style="aspect-ratio: 3/4 ;object-fit:cover;width:80%;">
				</a>

				  <div class="card-body">
					<p><?= $post['post_desc']; ?></p>
				  </div>
				<div class="d-flex justify-content-end align-content-end" style=padding:12px;>
				   <?php if (isset($_SESSION['account_id'])): ?>
					  <!-- User logged in: show real like button -->
					  <button class="btn btn-outline-primary like-btn btn-sm" 
							  data-postid="<?= $post['craft_post_id']; ?>" 
							  data-owner="<?= $post['account_id']; ?>">
						<i class="bi bi-heart"></i>
						<span id="like-count-<?= $post['craft_post_id']; ?>">
						  <?= $post['like_count'] ?? 0 ?>
						</span>
					  </button>
					<?php else: ?>
					  <!-- User not logged in: show login button -->
					  <a href="signin.php" class="btn btn-outline-primary btn-sm">
						Login to Like
					  </a>
					<?php endif; ?>
				</div>
			</div>
		  </div>
		<?php endif; ?>
		<?php endforeach; ?>
		  <div class="text-center mt-3">
			<a href="categories/other.php<?= $member_id ? '?member_id='.$member_id : '' ?>" class="btn btn-primary">More</a>
		  </div>
	  </div>
	</div>

   <div style="height:40px";></div>

  <footer class="site-footer">
<div class="container-flex">
<div class="row align-items-start">

  <!-- 左边：图片（小屏幕时占一行，上方显示） -->
  <div class="col-12 col-md-7 footer-logo mb-4 mb-md-0">
	<img src="image/Footer_pic.png" alt="Seventeen Characters" class="img-fluid">
  </div>

  <!-- 右边：内容（小屏幕时在下方） -->
  <div class="col-12 col-md-5 footer-links ">
	<div class="footer-column">
		<a href="index.php">
	  <h3>Home</h3></a>
	</div>

	<div class="footer-column">
		<a href="event/event.php">
	  <h3>Event</h3></a>
	</div>

	<div class="footer-column">
	  <h3>About </h3>
	  <ul>
		<li><a href="about/about.seventeen.php">Seventeen Info</a></li>
		<li><a href="about/seventeen_achievement.php">Seventeen Achievement</a></li>
	  </ul>
	</div>

	<div class="footer-column">
	  <h3>Categories</h3>
	  <ul>
		<li><a href="categories/keychain.php">Keychain</a></li>
		<li><a href="categories/illustration.php">Illustration</a></li>
		<li><a href="categories/poster.php">Poster</a></li>
		<li><a href="categories/other.php">Other</a></li>
	  </ul>
	</div>

	<div class="footer-column">
	  <?php if (!isset($_SESSION['account_id'])): ?>
			<!-- 1. Not logged in -->
			<a class=" active " href="../signin.php"><h3>Login/Register</h3></a>

		<?php else: ?>
			<!-- 2 & 3. Logged in -->
			<a href="user/user_profile.php">
				<?php if (!empty($profile['profile_photo'])): ?>
					<!-- 3. Has uploaded photo -->
					<img src="<?= htmlspecialchars($profile['profile_photo']); ?>" 
						 alt="profile_image" 
						 class="d-flex justify-content-end align-items-end nav-photo" style="width:80px; height:80px; border-radius:50%;border:1px solid #F9DCDE">
				<?php else: ?>
					<!-- 2. No uploaded photo → default image -->
					<img src="image/default.png" 
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
   <script>
  /* When the user clicks on the button,
  toggle between hiding and showing the dropdown content */
  function myFunction() {
	document.getElementById("myDropdown").classList.toggle("show");
  }

  function filterFunction() {
	const input = document.getElementById("myInput");
	const filter = input.value.toUpperCase();
	const div = document.getElementById("myDropdown");
	const a = div.getElementsByTagName("a");
	for (let i = 0; i < a.length; i++) {
	  txtValue = a[i].textContent || a[i].innerText;
	  if (txtValue.toUpperCase().indexOf(filter) > -1) {
		a[i].style.display = "";
	  } else {
		a[i].style.display = "none";
	  }
	}
  }
  </script>
   <!-- Side show start-->
   <script>
	var myIndex = 0;
	carousel();

	function carousel() {
	  var i;
	  var x = document.getElementsByClassName("mySlides");
	  for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";  
	  }
	  myIndex++;
	  if (myIndex > x.length) {myIndex = 1}    
	  x[myIndex-1].style.display = "block";  
	  setTimeout(carousel, 2000); // Change image every 2 seconds
	}
	</script>
 <!-- Side show end-->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>


document.addEventListener("DOMContentLoaded", function() {
document.querySelectorAll(".like-btn").forEach(button => {
const postId = button.dataset.postid;
const postOwner = button.dataset.owner;
const icon = button.querySelector("i");

// 🔹 Check status on load
fetch("like_status.php?craft_post_id=" + postId + "&account_id=" + postOwner)
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
  fetch("like.php?craft_post_id=" + postId + "&account_id=" + postOwner)
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