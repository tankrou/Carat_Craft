<?php
session_start();
include_once "../common/connection.php";
include_once "../common/nav_profile.php";

$profile = null;

if (isset($_SESSION['account_id'])) {
$account_id = $_SESSION['account_id'];
$profile = getProfile($account_id, $connection);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">  
<title>Bootstrap demo</title>
	<link href="../css/bootstrap.css" rel="stylesheet" >
 <link rel="stylesheet" href="../css/about_style.css">        
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
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

<div class="w3-content w3-section" style="max-width:300%; align-item:center ">
  <img class="mySlides" src="../image/MainpageUP_photo.jpg" style="width:100%">
  <img class="mySlides" src="../image/MainpageUP_photo2.jpg" style="width:100%">
  <img class="mySlides" src="../image/MainpageUP_photo3.jpg" style="width:100%">
</div>



<section class="about-box">
<div class="about-text">
  <h2>SEVENTEEN <span style="font-family: sans-serif;">세븐틴</span></h2>
  <p>SEVENTEEN IS A SUPER-LARGE GROUP COMPRISED OF 13 MEMBERS, FORMED FROM THREE SUB-GROUPS.</p>
  <div class="subteams">
	<strong>HipHop Team:</strong> S.COUPS, WONWOO, MINGYU, VERNON<br>
	<strong>Vocal Team:</strong> WOOZI, JEONGHAN, JOSHUA, DK, SEUNGKWAN<br>
	<strong>Performance Team:</strong> HOSHI, JUN, THE8, DINO
  </div>
</div>
<div class="about-img"></div>
</section>



<!-- slideshow 2 -->
<div class="albums-title" style="text-align: center; padding-top:20px;font-weight:bold;  color: #ffffff; -webkit-text-stroke:0.8px black;">🎧⋆˙♪⋆✮ ALBUMS ✮⋆♪˙⋆🎧</div>

<div class="slideshow-container">
<!-- Album 1 -->
<div class="slide active" data-index="0">
<div style="width:100%; height:100%; background:url('../image/slide_show1.jpg') center/cover no-repeat;"></div>
<div class="slide-title">17 CARAT</div>
</div>

<!-- Album 2 -->
<div class="slide right" data-index="1">
<div style="width:100%; height:100%; background:url('../image/slide_show2.jpg') center/cover no-repeat;"></div>
<div class="slide-title">HAPPY BURTDAY</div>
</div>

<!-- Album 3 -->
<div class="slide hidden" data-index="2">
<div style="width:100%; height:100%; background:url('../image/slide_show3.jpg') center/cover no-repeat;"></div>
<div class="slide-title">GOD OF MUSIC</div>
</div>

<!-- Album 4 -->
<div class="slide hidden" data-index="3">
<div style="width:100%; height:100%; background:url('../image/slide_show4.jpg') center/cover no-repeat;"></div>
<div class="slide-title">SEMICOLON</div>
</div>

<!-- Album 5 -->
<div class="slide hidden" data-index="4">
<div style="width:100%; height:100%; background:url('../image/slide_show5.jpg') center/cover no-repeat;"></div>
<div class="slide-title">FACE THE SUN</div>
</div>

<!-- Album 6 -->
<div class="slide left" data-index="5">
<div style="width:100%; height:100%; background:url('../image/slide_show6.jpg') center/cover no-repeat;"></div>
<div class="slide-title">ATTACCA</div>
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


<!-- About below photo -->
<section class="container strip" style="padding-top:40px;">
<div class="img" role="img" aria-label="About_below_photo"></div>
</section>

<!-- icon row -->

<div class="icons" style="padding-left:30px;">
  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_1.jpg" class="image-default" alt="AboutCartoon1">
	  <img src="../image/About_cartoon_1_hover.jpg" class="image-hover" alt="AboutCartoon1hover">
	</div>    
	<div class="label">ChoitCherry</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_2.jpg" class="image-default" alt="AboutCartoon2">
	  <img src="../image/About_cartoon_2_hover.jpg" class="image-hover" alt="AboutCartoon2 hover">
	</div>
	<div class="label">JJongToram</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_3.jpg" class="image-default" alt="AboutCartoon3">
	  <img src="../image/About_cartoon_3_hover.jpg" class="image-hover" alt="AboutCartoon3 hover">
	</div>
	<div class="label">ShuaSumi</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_4.jpg" class="image-default" alt="AboutCartoon4">
	  <img src="../image/About_cartoon_4_hover.jpg" class="image-hover" alt="AboutCartoon4 hover">
	</div>
	<div class="label">OpenCloseLock</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_5.jpg" class="image-default" alt="AboutCartoon5">
	  <img src="../image/About_cartoon_5_hover.jpg" class="image-hover" alt="AboutCartoon5 hover">
	</div>
	<div class="label">TamTam</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_6.jpg" class="image-default" alt="AboutCartoon6">
	  <img src="../image/About_cartoon_6_hover.jpg" class="image-hover" alt="AboutCartoon6 hover">
	</div>
	<div class="label">FoxDungee</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_7.jpg" class="image-default" alt="AboutCartoon7">
	  <img src="../image/About_cartoon_7_hover.jpg" class="image-hover" alt="AboutCartoon7 hover">
	</div>
	<div class="label">PpyoPuli</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_8.jpg" class="image-default" alt="AboutCartoon8">
	  <img src="../image/About_cartoon_8_hover.jpg" class="image-hover" alt="AboutCartoon8 hover">
	</div>
	<div class="label">ThePalee</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_9.jpg" class="image-default" alt="AboutCartoon9">
	  <img src="../image/About_cartoon_9_hover.jpg" class="image-hover" alt="AboutCartoon9 hover">
	</div>
	<div class="label">Kimja</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_10.jpg" class="image-default" alt="AboutCartoon10">
	  <img src="../image/About_cartoon_10_hover.jpg" class="image-hover" alt="AboutCartoon10 hover">
	</div>
	<div class="label">DoaDoa</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_11.jpg" class="image-default" alt="AboutCartoon11">
	  <img src="../image/About_cartoon_11_hover.jpg" class="image-hover" alt="AboutCartoon11 hover">
	</div>
	<div class="label">BBooGyuli</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_12.jpg" class="image-default" alt="AboutCartoon12">
	  <img src="../image/About_cartoon_12_hover.jpg" class="image-hover" alt="AboutCartoon12 hover">
	</div>
	<div class="label">Nonver</div>
  </div>

  <div>
	<div class="bubble">
	  <img src="../image/About_cartoon_13.jpg" class="image-default" alt="AboutCartoon13">
	  <img src="../image/About_cartoon_13_hover.jpg" class="image-hover" alt="AboutCartoon13 hover">
	</div>
	<div class="label">ChanDalee</div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>