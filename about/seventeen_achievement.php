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
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">  
<title>SEVENTEEN Achievement Timeline</title>
	<link href="../css/bootstrap.css" rel="stylesheet" >
 <link rel="stylesheet" href="../css/achiev_css.css">        
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
<div class="container" style=" max-width: 800px;
margin: 0 auto;
position: relative;">
	<div class="title-2" style="padding-top:100px;color: #ffffff;padding-top:50px;-webkit-text-stroke:0.5px black; padding-top:100px;">
		<h1 style="font-weight:bold;">🎧♪⋆.✮ SEVENTEEN ACHIEVEMENT ✮⋆♪˙🎧</h1>

	</div>

	<div class="timeline">
		<div class="timeline-item">
			<div class="content-group">
				<div class="photo-container">
					<img src="../image/svt_2016_01.jpg" alt="2016" />
				</div>
				<div class="info-box">
					<div class="member-name">2016 新人赏</div>
					<div class="debut-date">SEVENTEEN quickly rose to fame <br>with their “self-producing idol” image <br>and won multiple Rookie of the <br>Year awards, marking their <br>official breakthrough.</div>
				</div>
			</div>

		</div>

		<div class="timeline-item">
			<div class="content-group">
				<div class="photo-container">
					<img src="../image/svt_2017.jpg" alt="2017" />
				</div>
				<div class="info-box">
					<div class="member-name">2017 Love & Letter</div>
					<div class="debut-date">With the repackage album <br>Love & Letter and title track Pretty U, <br>the group earned their very first Golden<br>Disc Bonsang, proving their musical talent.</div>
				</div>
			</div>

		</div>

		<div class="timeline-item">
			<div class="content-group">
				<div class="photo-container">
					<img src="../image/svt_2018.jpg" alt="2018" />
				</div>
				<div class="info-box">
					<div class="member-name"> 2018 Teen, Age </div>
					<div class="debut-date">Their second full album Teen, <br>Age with the powerful track Clap <br>showcased stronger stage energy<br> and brought them another Golden <br>Disc Bonsang.</div>
				</div>
			</div>

		</div>

		<div class="timeline-item">
			<div class="content-group">
				<div class="photo-container">
					<img src="../image/svt_2019.png" alt="2019" />
				</div>
				<div class="info-box">
					<div class="member-name">2019 You Make My Day </div>
					<div class="debut-date">The mini album You Make My Day and<br> its refreshing title track Oh My! <br>captured the public’s hearts, <br>earning them another Bonsang at <br>the Golden Disc Awards.</div>
				</div>
			</div>

		</div>

		<div class="timeline-item">
			<div class="content-group">
				<div class="photo-container">
					<img src="../image/svt_2020.jpg" alt="2020" />
				</div>
				<div class="info-box">
					<div class="member-name"> 2020 An Ode </div>
					<div class="debut-date"> The third full album An Ode presented a<br> darker concept with Fear, highlighting<br> the group’s musical diversity<br> and winning them a Bonsang.</div>
				</div>
			</div>

		</div>

		<div class="timeline-item">
			<div class="content-group">
				<div class="photo-container">
					<img src="../image/svt_2021.jpg" alt="2021" />
				</div>
				<div class="info-box">
					<div class="member-name">2021 Heng:garae</div>
					<div class="debut-date"> With the mini album Heng:garae <br>and uplifting track Left & Right,<br> SEVENTEEN offered comfort to fans <br>during the pandemic and once again<br> received a Bonsang.</div>
				</div>
			</div>

		</div>

		<div class="timeline-item">
			<div class="content-group">
				<div class="photo-container">
					<img src="../image/svt_2022.png" alt="2022" />
				</div>
				<div class="info-box">
					<div class="member-name">2022 Attacca</div>
					<div class="debut-date">Returning with their ninth mini album <br>Attacca and the passionate track Rock<br> with you, the group continued their streak with <br>another Golden Disc Bonsang.</div>
				</div>
			</div>

		</div>

		<div class="timeline-item">
			<div class="content-group">
				<div class="photo-container">
					<img src="../image/svt_2023.jpg" alt="2023" />
				</div>
				<div class="info-box">
					<div class="member-name">2023 Face the Sun </div>
					<div class="debut-date">The fourth full album Face the Sun surpassed<br> 3 million sales, with title track <br>HOT marking a bold breakthrough,<br> and earned them yet another Bonsang.</div>
				</div>
			</div>
		</div>
	 <div class="timeline-item">
			<div class="content-group">
				<div class="photo-container">
					<img src="../image/svt_2024_02.jpg" alt="2024" />
				</div>
				<div class="info-box">
					<div class="member-name">2024 FML</div>
					<div class="debut-date"> Their tenth mini album FML broke K-Pop<br> sales records worldwide with Super, <br>earning SEVENTEEN both a Bonsang and the prestigious <br>Daesang at the Golden Disc Awards.</div>
				</div>
			</div>
		</div><div class="timeline-item">
			<div class="content-group">
				<div class="photo-container">
					<img src="../image/svt_2025.jpg" alt="2025" />
				</div>
				<div class="info-box">
					<div class="member-name">2025 Spill the Feels</div>
					<div class="debut-date">With the eleventh mini album Spill the <br>Feels and well-loved title track Sara Sara,<br> SEVENTEEN continued their success, once again winning <br>both a Bonsang and Daesang.</div>
				</div>
			</div>
		</div>
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

 <script src="../js/bootstrap.bundle.min.js" >
  </script>
</body>
</html>